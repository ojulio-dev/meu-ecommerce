<?php

require_once(__DIR__ . '/../../models/Product.php');

if (isset($_GET['search'])) {
    $product = new Product;

    $search = $product->readBySearch($_GET['search']);
}

?>

<?php if ($search): ?>
    <h2 class="main-subtitle subtitle-category">Search</h2>

    <article class="products">
        <?php foreach ($search as $product) { ?>
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

<?php else: ?>
    <h3 class="main-subtitle"><i class="fa-solid fa-triangle-exclamation"></i> A sua pesquisa não retornou resultados</h3>
<?php endif ?>