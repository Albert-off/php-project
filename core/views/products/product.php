<?php 
/** 
 * @var array{
 *     slug: string,
 *     title: string,
 *     description: string,
 *     imageExtension: string,
 *     sections: array<array{title: string, text: string}>
 * } $product
 */
$this->layout('layouts/app');
?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== HERO BANNER ====================-->
    <?= $this->insert('components/hero-banner') ?>


    <!--==================== ABOUT PRODUCT ====================-->
    <section class="about-product section">
        <div class="about-product__container container">
            <h1 class="about-product__title">
                <?= $this->e($product['title']); ?>
            </h1>

            <div class="about-product__flex">
                <p class="about-product__description">
                    <?= nl2br($this->e($product['description'])); ?>
                </p>

                <img src="<?= $this->asset("img/products/{$product['slug']}/about-{$product['slug']}.{$product['imageExtension']}") ?>" alt="">
            </div>

            <br />

            <?php foreach ($product['sections'] as $section): ?>
                <h2 class="about-product__sub-title">
                    <?= $this->e($section['title']); ?>
                </h2>

                <p class="about-product__sub-description">
                    <?= $this->e($section['text']); ?>
                </p>

                <br />
            <?php endforeach; ?>
        </div>
    </section>

    <hr class="hr product-info__hr">

    <!--==================== PRODUCR GRID IMAGES ====================-->
    <section class="product-grid-images">
        <div class="product-grid-images__container">

            <h2 class="product-grid-images__title">Reimagine your space</h2>
            <h3 class="product-grid-images__subtitle">GET INSPIRET WITH OUR BAUTIFUL FLOORING GALLERIES</h3>

            <div class="product-grid-images__wrapper">
                <div class="image-container">
                    <img src="<?= $this->asset("img/products/{$product['slug']}/img1.jpg") ?>" alt="">
                </div>

                <div class="image-container">
                    <img src="<?= $this->asset("img/products/{$product['slug']}/img2.jpg") ?>" alt="">
                </div>

                <div class="image-container">
                    <img src="<?= $this->asset("img/products/{$product['slug']}/img3.jpg") ?>" alt="">
                </div>

                <div class="image-container">
                    <img src="<?= $this->asset("img/products/{$product['slug']}/img4.jpg") ?>" alt="">
                </div>

                <div class="image-container">
                    <img src="<?= $this->asset("img/products/{$product['slug']}/img5.jpg") ?>" alt="">
                </div>

                <div class="image-container">
                    <img src="<?= $this->asset("img/products/{$product['slug']}/img6.jpg") ?>" alt="">
                </div>
            </div>
        </div>
    </section>

    <!--==================== CONTACT ====================-->
    <?= $this->insert('components/contact-section') ?>
</main>