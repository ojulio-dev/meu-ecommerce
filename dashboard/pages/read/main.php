<?php

require_once(__DIR__ . '/../../../models/Product.php');

$product = new Product;

$read = $product->read();

?>

<?php

if (isset($_SESSION['msg'])) { ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['msg'] ?>
    </div>

<?php unset($_SESSION['msg']); } ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>id</th>
            <th>Categoria</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Desconto</th>
            <th>Quantidade</th>
            <th>Slug</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach($read as $value): $id = $value['product_id'] ?> 

        <tr>
            <td><?php echo $value['product_id']?></td>
            <td><?php echo $value['category_id'] ?></td>
            <td><?php echo $value['name'] ?></td>
            <td>
                <?php echo strlen($value['description']) > 100 
                ? substr($value['description'], 0, 100) . '...' 
                : $value['description'] ?>
            </td>
            <td><?php echo $value['price'] ?></td>
            <td><?php echo $value['special_price'] ?></td>
            <td><?php echo $value['amount'] ?></td>
            <td><?php echo $value['slug'] ?></td>
            <td><?php echo $value['status'] ?></td>

            <td>
                <a class="btn btn-primary" href="?page=update&id=<?= $id ?>">Update</a>
            </td>

            <td>
                <a class="btn btn-danger" href="database/delete.php?id=<?= $id ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>