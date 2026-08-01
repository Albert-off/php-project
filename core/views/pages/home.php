<?php
// require_once BASE_PATH . 'src/helpers.php';

// Getting the current user.
// $user = currentUser();

// Getting home_page_content db data
// $homeContent = returnHomePageContent();

$this->layout('layouts/app');
?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== IMAGE SLIDER ====================-->
    <section class="carousel" id="carousel">
        <div class="carousel__time"></div>

        <div class="carousel__list">
            <div class="carousel__item">
                <img src="<?= $this->asset('img/carousel/carpet.avif') ?>" alt="Carpet flooring" class="carousel__img" loading="eager" fetchpriority="high">
                <div class="carousel__content container">
                    <div class="carousel__content-inner">
                        <div class="carousel__author">DESIGNS</div>
                        <div class="carousel__title">CARPET</div>
                        <div class="carousel__topic">VARIETY</div>
                        <div class="carousel__descr">
                            Carpet flooring provides a cozy feel underfoot, ideal for living rooms and bedrooms.
                            Available in various colors, textures, and patterns, carpets enhance any space’s aesthetic 
                            while offering insulation and noise reduction.
                        </div>

                        <div class="carousel__actions">
                            <a href="#products" class="button button--flex carousel__btn">
                                Explore <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                            <a href="#contact" class="button button--flex carousel__btn">
                                Request an Estimate <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel__item">
                <img src="<?= $this->asset('img/carousel/laminate.avif') ?>" alt="Laminate flooring" class="carousel__img" loading="lazy">
                <div class="carousel__content container">
                    <div class="carousel__content-inner">
                        <div class="carousel__author">DESIGNS</div>
                        <div class="carousel__title">LAMINATE</div>
                        <div class="carousel__topic">VARIETY</div>
                        <div class="carousel__descr">
                            Laminate flooring is a versatile and cost-effective option that mimics the look of natural wood or stone.
                            It’s durable, easy to install, and resistant to scratches and stains, making it ideal for high-traffic areas.
                        </div>
                        <div class="carousel__actions">
                            <a href="#products" class="button button--flex carousel__btn">
                                Explore <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                            <a href="#contact" class="button button--flex carousel__btn">
                                Request an Estimate <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel__item">
                <img src="<?= $this->asset('img/carousel/wool-carpet.avif') ?>" alt="Wool carpet" class="carousel__img" loading="lazy">
                <div class="carousel__content container">
                    <div class="carousel__content-inner">
                        <div class="carousel__author">DESIGNS</div>
                        <div class="carousel__title">WOOL CARPET</div>
                        <div class="carousel__topic">VARIETY</div>
                        <div class="carousel__descr">
                            Wool carpet flooring adds a striking and vibrant touch to any space.
                            Available in a range of colors and patterns, it combines comfort and style, 
                            making it perfect for creating a unique and inviting atmosphere.
                        </div>
                        <div class="carousel__actions">
                            <a href="#products" class="button button--flex carousel__btn">
                                Explore <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                            <a href="#contact" class="button button--flex carousel__btn">
                                Request an Estimate <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="carousel__item">
                <img src="<?= $this->asset('img/carousel/luxury-vinyl.avif') ?>" alt="Luxury Vinyl" class="carousel__img" loading="lazy">
                <div class="carousel__content container">
                    <div class="carousel__content-inner">
                        <div class="carousel__author">DESIGNS</div>
                        <div class="carousel__title">LUXURY VINYL</div>
                        <div class="carousel__topic">VARIETY</div>
                        <div class="carousel__descr">
                            Luxury vinyl flooring offers the perfect blend of style and functionality.
                            It replicates the look of natural materials like wood and stone while providing superior water resistance and durability.
                        </div>
                        <div class="carousel__actions">
                            <a href="#products" class="button button--flex carousel__btn">
                                Explore <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                            <a href="#contact" class="button button--flex carousel__btn">
                                Request an Estimate <i class="ri-arrow-right-down-line button__icon"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel__thumbnails">
            <div class="carousel__thumb-item">
                <img src="<?= $this->asset('img/carousel/carpet.avif') ?>" alt="" class="carousel__thumb-img" loading="lazy">
                <div class="carousel__thumb-content">
                    <div class="carousel__thumb-title">Carpet</div>
                    <div class="carousel__thumb-descr">Cozy <br> Comfort</div>
                </div>
            </div>

            <div class="carousel__thumb-item">
                <img src="<?= $this->asset('img/carousel/laminate.avif') ?>" alt="" class="carousel__thumb-img" loading="lazy">
                <div class="carousel__thumb-content">
                    <div class="carousel__thumb-title">Laminate</div>
                    <div class="carousel__thumb-descr">Durable <br> Versatility</div>
                </div>
            </div>

            <div class="carousel__thumb-item">
                <img src="<?= $this->asset('img/carousel/wool-carpet.avif') ?>" alt="" class="carousel__thumb-img" loading="lazy">
                <div class="carousel__thumb-content">
                    <div class="carousel__thumb-title">Wool Carpet</div>
                    <div class="carousel__thumb-descr">Bold <br> Statement</div>
                </div>
            </div>

            <div class="carousel__thumb-item">
                <img src="<?= $this->asset('img/carousel/luxury-vinyl.avif') ?>" alt="" class="carousel__thumb-img" loading="lazy">
                <div class="carousel__thumb-content">
                    <div class="carousel__thumb-title">Luxury Vinyl</div>
                    <div class="carousel__thumb-descr">Elegant <br> Resilience</div>
                </div>
            </div>
        </div>

        <div class="carousel__arrows">
            <div class="carousel__arrows-inner container">
                <button class="carousel__arrow carousel__arrow--prev" id="prev" aria-label="Previous slide">
                    <i class="ri-arrow-left-s-line"></i>
                </button>
                <button class="carousel__arrow carousel__arrow--next" id="next" aria-label="Next slide">
                    <i class="ri-arrow-right-s-line"></i>
                </button>
            </div>
        </div>
    </section>


    <!--==================== PRODUCTS ====================-->
    <section class="product section" id="products">
        <div class="container">
            <h2 class="product__title">
                Looking for new floors in the Calgary area?
            </h2>

            <h3 class="product__subtitle">
                Explore Our Extensive Flooring Guide
            </h3>

            <div class="product__container grid">
                <article class="product__card">
                    <img src="<?= $this->asset('img/products/carpet/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Carpet</h3>

                        <a href="<?= $this->baseUrl() ?>products/carpet" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="product__card">
                    <img src="<?= $this->asset('img/products/hardwood/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Hardwood</h3>

                        <a href="<?= $this->baseUrl() ?>products/hardwood" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="product__card">
                    <img src="<?= $this->asset('img/products/laminate/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Laminate</h3>

                        <a href="<?= $this->baseUrl() ?>products/laminate" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="product__card">
                    <img src="<?= $this->asset('img/products/vinyl/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Vinyl</h3>

                        <a href="<?= $this->baseUrl() ?>products/vinyl" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>

                <article class="product__card">
                    <img src="<?= $this->asset('img/products/luxury-vinyl/img1.jpg') ?>" alt="" class="product__img">

                    <div class="product__data">
                        <h3 class="product__card-title">Luxury Vinyl</h3>

                        <a href="<?= $this->baseUrl() ?>products/luxury-vinyl" class="product__link">
                            View Information <span class="product__arrow">&rarr;</span>
                        </a>
                    </div>
                </article>
            </div>

            <div class="product__btn">
                <a href="<?= $this->baseUrl() ?>products" class="button button--flex">
                    View all producrs
                    <i class="ri-arrow-right-up-line button__icon"></i>
                </a>
            </div>
        </div>
    </section>


    <!--==================== HERO BANNER ====================-->
    <?= $this->insert('components/hero-banner') ?>


    <!-- ================ FEATURE 1 ================ -->
    <section class="section feature feature-1" aria-labelledby="feature-label-1">
        <div class="feature__content-1 container">

            <figure class="feature-banner">
                <img src="<?= $this->asset('img/feature/feature-banner-1.webp') ?>"
                    alt=""
                    width="1020"
                    height="690"
                    loading="lazy"
                    class="feature__image">
            </figure>

            <div class="feature-content">

                <h2 class="headline-medium" id="feature-label">
                    Explore Top Flooring Solutions
                </h2>

                <p class="feature-text">
                    Elevate your home with our premium flooring options.
                    Whether you’re drawn to the timeless elegance of hardwood, the robust durability of laminate,
                    or the cozy comfort of carpet, we have the ideal solution for you.
                    Our expert team guarantees impeccable installation and outstanding customer service.
                </p>

                <ul class="feature-list">
                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Premium Materials</span>
                    </li>

                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Diverse Styles</span>
                    </li>

                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Expert Installation</span>
                    </li>

                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Competitive Prices</span>
                    </li>
                </ul>

            </div>

        </div>
    </section>


    <!--==================== QUESTIONS ====================-->
    <section class="questions section" id="faqs">
        <div class="container">
            <h2 class="questions__title">
                Some common questions <br> were often asked
            </h2>

            <div class="questions__container grid">
                <div class="questions__group">
                    <div class="questions__item">
                        <details class="questions__details" name="faq">
                            <summary class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <span class="questions__item-title">
                                    How do I choose the right flooring for my space?
                                </span>
                            </summary>
                        </details>

                        <div class="questions__content" role="definition">
                            <div class="questions__overflow">
                                <p class="questions__description">
                                    Consider factors like lifestyle, budget, room usage, and maintenance.
                                    Think about whether you need flooring that is water-resistant, scratch-resistant, or easy to clean.
                                    Match the flooring style to your interior design and overall aesthetic.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="questions__item">
                        <details class="questions__details" name="faq">
                            <summary class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <span class="questions__item-title">
                                    How do I maintain and care for my flooring?
                                </span>
                            </summary>
                        </details>

                        <div class="questions__content" role="definition">
                            <div class="questions__overflow">
                                <p class="questions__description">
                                    Regularly sweep or vacuum to remove dirt and debris.
                                    Use appropriate cleaning products based on the flooring type.
                                    Place area rugs in high-traffic spots to protect the floor.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="questions__item">
                        <details class="questions__details" name="faq">
                            <summary class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <span class="questions__item-title">
                                    Do I need a subfloor, and if so, what kind?
                                </span>
                            </summary>
                        </details>

                        <div class="questions__content" role="definition">
                            <div class="questions__overflow">
                                <p class="questions__description">
                                    Yes, a subfloor is essential. It provides stability and prevents moisture.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="questions__group">
                    <div class="questions__item">
                        <details class="questions__details" name="faq">
                            <summary class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <span class="questions__item-title">
                                    What is the best type of carpet for high-traffic areas?
                                </span>
                            </summary>
                        </details>

                        <div class="questions__content" role="definition">
                            <div class="questions__overflow">
                                <p class="questions__description">
                                    Nylon or polyester carpets are usually the best choices for high-traffic areas
                                    due to their durability and stain resistance.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="questions__item">
                        <details class="questions__details" name="faq">
                            <summary class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <span class="questions__item-title">
                                    Should I install carpeting in an area with high foot traffic?
                                </span>
                            </summary>
                        </details>

                        <div class="questions__content" role="definition">
                            <div class="questions__overflow">
                                <p class="questions__description">
                                    Consider durability and maintenance when choosing carpet for high-traffic areas.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="questions__item">
                        <details class="questions__details" name="faq">
                            <summary class="questions__header">
                                <i class="ri-add-line questions__icon"></i>
                                <span class="questions__item-title">
                                    What is a carpet pad, and do I need it?
                                </span>
                            </summary>
                        </details>

                        <div class="questions__content" role="definition">
                            <div class="questions__overflow">
                                <p class="questions__description">
                                    A carpet pad provides cushioning and insulation. It's recommended..
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ================ FEATURE 2 ================ -->
    <section class="section feature feature-2" aria-labelledby="feature-label-2">
        <div class="feature__content-2 container">

            <figure class="feature-banner">
                <img src="<?= $this->asset('img/feature/feature-banner-2.png') ?>" width="1020" height="690" loading="lazy"
                    alt="" class="feature__image">
            </figure>

            <div class="feature-content">

                <h2 class="headline-medium" id="feature-label-2">
                    Why Choose Our Flooring Services
                </h2>

                <p class="feature-text">
                    Our flooring services are tailored to your unique needs, ensuring a perfect fit for your space.
                    We provide personalized consultations to guide you in selecting the ideal flooring option.
                    Committed to quality and customer satisfaction, we guarantee a smooth, hassle-free experience from start to finish.
                </p>

                <ul class="feature-list">
                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Expert Guidance</span>
                    </li>

                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Customized Solutions</span>
                    </li>

                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Satisfaction Guaranteed</span>
                    </li>

                    <li class="feature-item">
                        <i class="ri-checkbox-circle-line feature-icon"></i>
                        <span class="body-medium">Eco-Friendly Choices</span>
                    </li>
                </ul>

            </div>

        </div>
    </section>


    <!--==================== CONTACT ====================-->
    <!-- // require_once BASE_PATH . "includes/contact-section.php"; 
    // require $this->component('contact-section'); -->
    <?= $this->insert('components/contact-section') ?>
</main>