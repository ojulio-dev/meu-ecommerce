<?php

require_once(__DIR__ . '/../../models/Product.php');
require_once(__DIR__ . '/../../models/ProductCategory.php');

$productCategory = new ProductCategory;
$products = new Product;

?>

<main class="main">
    <div class="banner">
        <img class="img-banner" src="assets/images/home/header/banner.png" alt="">
    </div>

    <section class="main-products">
        <h2 class="main-subtitle">Novidades</h2>
        <article class="products">
            <?php foreach ($products->readByNews() as $product) { ?>
                <?php $image = file_exists(BASE_PATH . '/assets/images/' . $product['banner'])
                    ? DIR_IMG . '/' . $product['banner']
                    : DIR_IMG . '/products/placeholder.png'; ?>

                <figure class="product-items">
                    <a href="?page=product&slug=<?= $product['slug'] ?>">
                        <div class="background-product">
                            <img class="image-product" src="<?= $image ?>" alt="">
                        </div>
                    </a>

                    <div class="items-about">
                        <a href="?page=product&slug=<?= $product['slug'] ?>" class="product-slug">
                            <figcaption class="about"><?= $product['name'] ?></figcaption>
                        </a>

                        <figcaption class="value">R$ <?= number_format($product['special_price'], 2, ',', '.') ?></figcaption>
                    </div>
                </figure>
            <?php } ?>
        </article>
    </section>

    <section class="main-products">
        <?php foreach ($productCategory->read() as $category) { ?>
            <?php $products = $productCategory->readByCategory($category['category_id']) ?>

            <?php if (count($products)): ?>
                <div class="products-title-wrapper">
                    <h2 class="main-subtitle"><?= $category['name'] ?></h2>
                    <a class="all-products" href="?page=category&slug=<?= $category['slug'] ?>">Ver todos</a>
                </div>

                <article class="products">
                    <?php foreach ($products as $product) { ?>
                        <?php $image = file_exists(BASE_PATH . '/assets/images/' . $product['banner'])
                            ? DIR_IMG . '/' . $product['banner']
                            : DIR_IMG . '/products/placeholder.png'; ?>

                        <figure class="product-items">
                            <a href="?page=product&slug=<?= $product['slug'] ?>">
                                <div class="background-product">
                                    <img class="image-product" src="<?= $image ?>" alt="">
                                </div>
                            </a>

                            <div class="items-about">
                                <a href="?page=product&slug=<?= $product['slug'] ?>" class="product-slug">
                                    <figcaption class="about"><?= $product['name'] ?></figcaption>
                                </a>

                                <figcaption class="value">R$ <?= number_format($product['special_price'], 2, ',', '.') ?></figcaption>
                            </div>
                        </figure>
                    <?php } ?>
                </article>
            <?php endif ?>
        <?php } ?>
    </section>
</main>