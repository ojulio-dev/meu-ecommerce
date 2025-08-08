<?php

require_once(__DIR__ . '/../classes/Database.php');
require_once(__DIR__ . '/interfaces/ProductCategoryInterface.php');

class ProductCategory extends Database implements ProductCategoryInterface
{
    private $stmt, $sql, $conn, $table;

    public function __construct() 
    {
        $this->conn = parent::conn();
        $this->table = "product_category";
    }

    public function create(array $data): bool
    {
        return true;
    }

    public function read(): array
    {
        try {
            $this->setSql("SELECT * from {$this->table} WHERE status = 1");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function readByCategory($id)
    {
        try {
            $this->setSql("SELECT 
            pc.name category, po.* from
                {$this->table} pc 
            INNER JOIN product po on po.category_id = pc.category_id
            WHERE pc.category_id = $id order by po.product_id DESC LIMIT 8");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function readBySlug($slug): array
    {
        try {
            $this->setSql("SELECT * from {$this->table} WHERE slug = '$slug'");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
    public function update(array $data): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function setSql($sql): void
    {
        $this->sql = $sql;
    }


    public function getSql(): string
    {
        return $this->sql;
    }
}
