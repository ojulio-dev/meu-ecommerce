<?php

require_once(__DIR__ . '/../classes/Database.php');

class Customer extends Database
{
    private $stmt, $sql, $conn, $table;

    public function __construct()
    {
        $this->conn = parent::conn();

        $this->table = 'customer';
    }

    public function createFile($file, $id)
    {

        $extension = strtolower(substr($file['name'], -4));

        $newName = $id . $extension;

        $destiny = __DIR__ . '/../assets/images/customer/' . $newName;

        if (file_exists($destiny)) unlink($destiny);

        move_uploaded_file($file['tmp_name'], $destiny);

        return "customer/$newName";
    }

    public function create($data)
    {
        try {

            $this->setSql("INSERT INTO {$this->table} (name, email, age, password) VALUES ('" . $data['name'] . "', '" . $data['email'] . "'," . $data['age'] . ",'" . md5($data['password']) . "')");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            if ($this->stmt->rowCount()) {

                $id = $this->conn->lastInsertId();

                $destiny = $this->createFile($_FILES['image'], $id);

                $this->updateByField($destiny, 'image', $id);

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function login($data)
    {
        try {
            $this->setSql("SELECT * from " . $this->table . " WHERE email = '{$data['email']}' and password = '" . md5($data['password']) . "' ");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            if ($this->stmt->columnCount()) {
                return $this->stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function readById($id)
    {
        try {
            $this->setSql("SELECT * from " . $this->table . " WHERE customer_id = $id ");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            return $this->stmt->fetch();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function readByEmail($email)
    {
        try {
            $this->setSql("SELECT * from " . $this->table . " WHERE email = '$email' ");

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            if ($this->stmt->rowCount()) {
                return $this->stmt->fetch();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function updateByField($data, string $field, $productId): bool
    {
        try {
            $this->setSql(
                "UPDATE " . $this->table . "
                SET $field = '$data'
            WHERE
                customer_id = $productId
            "
            );

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            if ($this->stmt->rowCount()) {
                $id = $this->conn->lastInsertId();

                $destiny = $this->createFile($_FILES['image'], $id);

                $this->updateByField($destiny, 'image', $id);

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($data)
    {
        try {
            $this->setSql(
                "UPDATE " . $this->table . "
                SET name = '{$data['name']}', age = {$data['age']}, email = '{$data['email']}'
            WHERE
                customer_id = {$data['customer_id']}
            "
            );

            $this->stmt = $this->conn->prepare($this->getSql());

            $this->stmt->execute();

            if ($this->stmt->rowCount()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete() {}

    public function setSql($sql)
    {
        $this->sql = $sql;
    }

    public function getSql()
    {
        return $this->sql;
    }
}
