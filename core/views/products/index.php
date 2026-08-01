<?php $this->layout('layouts/app'); ?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== HERO BANNER ====================-->
    <?= $this->insert('components/hero-banner') ?>
    

    <!--==================== SEE ALL PRODUCTS ====================-->
    <section class="all-products section">
        <div class="container">

            <h2 class="product__title">
                All Products
            </h2>

            <h3 class="product__subtitle">
                Explore Our Extensive Flooring Guide
            </h3>

            <div class="see-all-products-grid product__container grid">
                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/carpet/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Carpet</h3>

                        <a href="<?= $this->baseUrl() ?>products/carpet" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/wool-carpet/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Wool Carpet</h3>

                        <a href="<?= $this->baseUrl() ?>products/wool-carpet" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/cork/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Cork</h3>

                        <a href="<?= $this->baseUrl() ?>products/cork" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/hardwood/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Hardwood</h3>

                        <a href="<?= $this->baseUrl() ?>products/hardwood" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/laminate/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Laminate</h3>

                        <a href="<?= $this->baseUrl() ?>products/laminate" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/vinyl/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Vinyl</h3>

                        <a href="<?= $this->baseUrl() ?>products/vinyl" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="see-all-products-card product__card">
                    <img src="<?= $this->asset('img/products/luxury-vinyl/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Luxury Vinyl</h3>

                        <a href="<?= $this->baseUrl() ?>products/luxury-vinyl" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!--==================== CONTACT ====================-->
    <?= $this->insert('components/contact-section') ?>
</main>