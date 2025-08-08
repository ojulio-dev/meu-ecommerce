<?php

if (isset($_SESSION['cart']) && isset($_SESSION['customer'])) {
    $cart = $_SESSION['cart'];

    if (isset($_GET['create'])) {
        if (empty($_SESSION['orders'])) {
            $_SESSION['orders'] = [];
        }

        array_push($_SESSION['orders'], $cart);

        if (!isset($_SESSION['amount'])) {
            $_SESSION['amount'] = [];
        }

        $_SESSION['amount'] = $cart;

        unset($_SESSION['cart']);

        header("Location: ?page=customer&action=read");
    }

    if (isset($_GET['remove'])) {
        $productId = $_GET['remove'];

        $index = array_search($productId, array_column($_SESSION['cart'], 'product_id'));

        if ($_SESSION['cart'][$index]['quantity'] > 1) {
            $_SESSION['cart'][$index]['quantity'] = $_SESSION['cart'][$index]['quantity'] - 1;
        } else {
            unset($_SESSION['cart'][$index]);
        }

        header("Location: ?page=cart");
    }
}

?>

<main class="cart-container">
    <?php if (isset($cart) && !empty($cart)): ?>

        <table class="main-table">
            <thead>
                <tr>
                    <th class="table-title product-title table-first">Produto</th>
                    <th class="table-title product-title table-quantity">Quantidade</th>
                    <th class="table-title product-title table-value">Valor</th>
                    <th class="table-title product-title table-remove">Remover</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($cart as $product): ?>
                    <?php $image = file_exists(BASE_PATH . '/assets/images/' . $product['banner'])
                        ? DIR_IMG . '/' . $product['banner']
                        : DIR_IMG . '/products/placeholder.png'; ?>
                    <tr>
                        <td class="table-column product-column">
                            <div class="column-product-wrapper">
                                <img class="table-photo product-photo" src="<?= $image ?>" alt="">
                                <p class="column-first"><?= $product['name'] ?></p>
                            </div>
                        </td>
                        <td class="table-column product-column column-quantity">
                            <p><?= $product['quantity'] ?></p>
                        </td>
                        <td class="table-column product-column column-value">
                            <p>R$ <?= number_format($product['special_price'] * $product['quantity'], 2, ',', '.') ?></p>
                        </td>
                        <td class="table-column product-column column-remove">
                            <p class="button-quantity"><?= $product['quantity'] ?></p>
                            <a href="index.php?page=cart&remove=<?= $product['product_id'] ?>"><i class="fa-solid fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="cart-button-wrapper">
            <a class="cart-button-buy" href="?page=cart&create=order">COMPRAR</a>
        </div>
    <?php else: ?>
        <div class="cart-logout">
            <h2 class="cart-subtitle">Seu carrinho está vazio :(</h2>
            <?php if (!isset($_SESSION['customer'])): ?>
                <a href="?page=customer" class="cart-create-account">Fazer Login</a>
            <?php endif ?>
        </div>
    <?php endif ?>
</main>