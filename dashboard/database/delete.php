<?php

require_once(__DIR__ . '../../../models/Product.php');

$product = new Product;

if (isset($_GET['id'])) {
    $delete = $product->delete($_GET['id']);

    $_SESSION['msg'] = 'Deletado com sucesso';

    header("Location: ../?page=read");
}