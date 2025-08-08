<?php

require_once(__DIR__ . '/../../models/Customer.php');
require_once(__DIR__ . '/../../models/Product.php');

$customer = new Customer;

if (!isset($_SESSION['customer'])) {
    header("Location: ?page=home");
}

if (isset($_SESSION['customer'])) {
    $user = $_SESSION['customer'];

    if (isset($_SESSION['orders'])) {
        $orders = $_SESSION['orders'];
    }


    if (isset($_SESSION['amount'])) {
        $amount = $_SESSION['amount'];

        $product = new Product;

        foreach ($amount as $index) {
            $replaceAmount = $index['amount'] - $index['quantity'];

            $updateByAmount = $product->updateByAmount($replaceAmount, $index['product_id']);
        }
    }

    unset($_SESSION['amount']);

    if (isset($_SESSION['msg'])): ?>

        <div class="flash-message">
            <span class="ms ok"><?= $_SESSION['msg'] ?></span>
        </div>

<?php unset($_SESSION['msg']);
    endif;
}

?>

<main class="customer-read-container">
    <table class="main-table">
        <thead>
            <tr>
                <th class="table-title">Nome</th>
                <th class="table-title table-second">Email</th>
                <th class="table-title table-third">Idade</th>
                <th class="table-title table-four">Sair</th>
            </tr>
        </thead>

        <tbody>
            <?php $image = file_exists(BASE_PATH . '/assets/images/' . $user['image'])
                ? DIR_IMG . '/' . $user['image']
                : DIR_IMG . '/products/placeholder.png'; ?>
            <tr>
                <td class="table-column">
                    <div class="column-name-wrapper">
                        <img class="table-photo" src="<?= $image ?>" alt="">
                        <p class="column-name">
                            <?php
                            echo strlen($user['name']) > 20
                                ? substr($user['name'], 0, 20) . '...'
                                : $user['name'] ?>
                        </p>
                    </div>
                </td>
                <td class="table-column column-second">
                    <p class="column-email">
                        <?php
                        echo strlen($user['email']) > 25
                            ? substr($user['email'], 0, 25) . '...'
                            : $user['email'] ?>
                    </p>
                </td>
                <td class="table-column column-third">
                    <p><?= $user['age'] ?></p>
                </td>
                <td class="table-column column-button">
                    <a href="?page=customer&action=logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </td>
            </tr>
        </tbody>
    </table>

    <?php if (isset($orders)): ?>
        <h2 class="customer-order-title">Todos os Pedidos</h2>
        <ul class="customer-list-products">
            <?php $index = 1;
            foreach ($orders as $order => $products): ?>
                <li class="customer-orders">
                    <p><?= "Pedido $index" ?></p>
                    <?php foreach ($products as $product): ?>
                        <?php $image = file_exists(BASE_PATH . '/assets/images/' . $product['banner'])
                            ? DIR_IMG . '/' . $product['banner']
                            : DIR_IMG . '/products/placeholder.png'; ?>

                        <div class="customer-order">
                            <div class="customer-list-name">
                                <img class="customer-photo-product" src="<?= $image ?>" alt="">

                                <p><?= $product['quantity'] ?> - <?= $product['name'] ?></p>
                            </div>
                            <a class="customer-button" href="?page=product&slug=<?= $product['slug'] ?>">Ver Produto</a>
                        </div>

                    <?php endforeach ?>
                </li>
            <?php $index++;
            endforeach ?>
        </ul>
    <?php endif ?>
</main>