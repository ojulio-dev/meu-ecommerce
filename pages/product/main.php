<?php

require_once(__DIR__ . '../../../models/Product.php');

$product = new Product;

if (isset($_GET['slug'])) {
    $product = $product->readBySlug($_GET['slug']);
}

if (isset($_GET['insert']) && isset($_SESSION['customer']) && $product['amount'] > 0 && $product['status'] == 1) {
    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $index = array_search($product['product_id'], array_column($_SESSION['cart'], 'product_id'));

    if ($index !== false) {
        $_SESSION['cart'][$index]['quantity'] = $_SESSION['cart'][$index]['quantity'] + 1;

        header("Location: index.php?page=cart");
    } else {
        $product['quantity'] = 1;

        unset($product['description']);

        array_push($_SESSION['cart'], $product);

        header("Location: index.php?page=cart");
    }
} elseif (isset($_GET['insert']) && ($product['amount'] <= 0 || $product['status'] == 0)) {
    $_SESSION['msg'] = "Produto indisponível"; ?>

    <div class="flash-message">
        <span class="ms erro"><?= $_SESSION['msg'] ?></span>
    </div>
<?php unset($_SESSION['msg']);
}

?>

<main class="container-detail">

    <?php $image = file_exists(BASE_PATH . '/assets/images/' . $product['banner'])
        ? DIR_IMG . '/' . $product['banner']
        : DIR_IMG . '/products/placeholder.png'; ?>

    <div class="main-image">
        <img class="image-item" src="<?= $image ?>" alt="">
    </div>
    <div class="product-info">
        <div class="product-wrapper">
            <div class="infos-wrapper">
                <h1 class="title-product"><?= $product['name'] ?></h1>

                <?php $product['status'] == 1 && $product['amount'] > 0 ? $statusColor = 'status-sucess' : $statusColor = 'status-danger' ?>

                <p class="product-status <?= $statusColor ?>"><?php echo $product['status'] == 1 && $product['amount'] > 0 ? 'Produto Disponível' : 'Produto indisponível' ?> </p>

                <p class="description-price">à vista</p>

                <div class="main-price">
                    <h3 class="special-price">R$ <?= number_format($product['special_price'], 2, ',', '.') ?></h3>

                    <h4 class="price">R$ <?= number_format($product['price'], 2, ',', '.') ?></h4>
                </div>

                <a class="button-cart" href="<?= isset($_SESSION['customer']) ? '?page=product&slug=' . $product['slug'] . '&insert=cart' : '?page=customer' ?>"> ADICIONAR AO CARRINHO</a>

                <p class="status-description">Quantidade: <?= $product['amount'] ?></p>

                <h2 class="product-description"><?= $product['description'] ?></h2>
            </div>
            <div class="cards-wrapper">
                <img class="card-image" src="assets/images/detail/cartao-visa.png" alt="">
                <img class="card-image" src="assets/images/detail/cartao-mastercard.png" alt="">
                <img class="card-image" src="assets/images/detail/cartao america express.png" alt="">
                <img class="card-image" src="assets/images/detail/payment.png" alt="">
                <img class="card-image" src="assets/images/detail/cartao de credito1.png" alt="">
            </div>
        </div>
    </div>
</main>