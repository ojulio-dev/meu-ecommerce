<?php

require_once(__DIR__ . '/../../../models/Product.php');

$product = new Product;

if (isset($_GET['id'])) {
    $data = $product->readById($_GET['id']);
}

if (isset($_POST['submit'])) {
    $update = $product->update($_POST);

    if ($update) {
        $_SESSION['msg'] = 'Atualizado com sucesso';

        header("Location: index.php?page=read");
    }
}

?>

<main class="main-form">  
    <h1 class="main-title">Update</h1>

    <form class="main-form" method="POST" enctype="multipart/form-data">

        <input type="hidden" class="form-control" id="name" name="product_id" required value="<?= $data['product_id'] ?>">

        <div class="form-group">
            <label for="name">Produto</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o Nome" required value="<?= $data['name'] ?>">
        </div>

        <div class="form-group">
            <label for="category">Categoria</label>
            <select class="form-control" name="category_id" id="category_id" required>
                <option value="" selected disable>Selecione a categoria</option>
                <option value="1">Games</option>
                <option value="2">Livros</option>
                <option value="3">Eletrônicos</option>
                <option value="4">Moda</option>
                <option value="5">Móveis</option>
            </select>
        </div>

        <div class="form-group">
            <label for="number">Quantidade</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Digite a Quantidade" required value="<?= $data['amount'] ?>">
        </div>

        <div class="form-group">
            <label for="author">Descrição</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Digite a Descrição" required value="<?= $data['description'] ?>">
        </div>

        <div class="form-group">
            <label for="author">Valor</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Digite o Valor" required value="<?= $data['price'] ?>">
        </div>

        <div class="form-group">
            <label for="author">Desconto</label>
            <input type="number" step="0.01" class="form-control" id="special_price" name="special_price" placeholder="Digite o Desconto" required value="<?= $data['special_price'] ?>">
        </div>

        <div class="form-group">
            <label for="formFile" class="form-label">Imagem</label>
            <input class="form-control" name="image" type="file" id="formFile">
        </div>

        <div class="form-group">
            <label for="price">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" placeholder="Digite o Slug" required value="<?= $data['slug'] ?>">
        </div>

        <div class="form-group">
            <label for="category">Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value="1" selected>Ativado</option>
                <option value="0">Desativado</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</main>