<?php

require_once( __DIR__ . '/../models/ProductCategory.php');

$productCategory = new ProductCategory;

?>


<header class="main-header">
    <a href="index.php?page=home"><img class="apple-icon" src="assets/images/home/header/icon.png" alt=""></a>

    <nav class="main-items">
        <a class="items" href="index.php?page=home">Início</a>
        <?php foreach($productCategory->read() as $category) { ?>
            <a class="items" href="<?= DIR_PATH . '?page=category&slug=' . $category['slug']?>"><?= $category['name'] ?></a>
        <?php } ?>
        <a class="items" href="index.php?page=about">Sobre</a>
    </nav>

    <form class="form-search" method="GET">
        <img src="assets/images/home/header/search.png" class="search-icon" alt="">
        <input type="hidden" name="page" class="input-search" value="search">
        <input type="search" name="search" class="input-search">
    </form>

    <div class="main-menu-burguer">
        <label class="hamburguer" for="menu-burguer"> <i class="fa-solid fa-bars fa-2xl"></i> </label>
        <input type="checkbox" id="menu-burguer">

        <nav class="menu-items">
            <div class="close-wrapper">
                <h2>Categoria</h2>
                <label class="close-menu" for="menu-burguer"><i class="fa-solid fa-xmark fa-2xl"></i></label>
            </div>
            <ul class="category-items">
                <li> <a class="items items-menu" href="index.php?page=home">Início</a> </li>

                <?php foreach($productCategory->read() as $category) { ?>

                <li> <a class="items items-menu" href="<?= DIR_PATH . 'index.php?page=category&slug=' . $category['slug']?>"><?= $category['name'] ?></a> </li>

                <?php } ?>
                <li> <a class="items items-menu" href="index.php?page=about">Sobre</a> </li>   
            </ul>

            <ul class="category-items">
                <li> <h2 class="menu-title">Conta</h2> </li>
                <li> <a class="items items-menu" href="index.php?page=cart"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a> </li>
                <li> <a class="items items-menu" href="index.php?page=customer<?= !empty($_SESSION['customer']) ? '&action=read' : ''?>"><i class="fa-solid fa-user"></i> Conta</a> </li>

                <?php if (isset($_SESSION['customer'])): ?>
                <li> <a class="items items-menu" href="index.php?page=customer&action=logout"><i class="fa-solid fa-user"></i> Sair da Conta</a> </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>

    <div class="icons">
        <a href="index.php?page=customer<?= !empty($_SESSION['customer']) ? '&action=read' : ''?>"> <img class="customer-icon" src="assets/images/home/header/customer.png" alt=""> </a>
        <a href="index.php?page=cart"> <img class="cart-icon" src="assets/images/home/header/cart.png" alt=""> </a>
    </div>
</header>