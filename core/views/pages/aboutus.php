<?php $this->layout('layouts/app'); ?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== HERO BANNER ====================-->
    <?= $this->insert('components/hero-banner') ?>

    <!--==================== ABOUT US ====================-->
    <section class="aboutus">
        <div class="container">

            <div class="aboutus__logo">
                <img src="<?= $this->asset('img/RRF-logo.svg') ?>" class="aboutus__logo-img" alt="">
                <span class="aboutus__logo-shadow"></span>
            </div>

            <h1 class="aboutus__title">Discover the Expertise of RingRoadFlooring in Calgary</h1>

            <p class="aboutus__description">
                At RingRoadFlooring, we take pride in being Calgary's leading flooring specialists.
                Our team of experienced professionals is dedicated to transforming your spaces with top-tier flooring solutions.
                Whether you're looking to elevate your home or office, we offer a diverse selection of flooring options to fit every style and budget.
            </p>

            <h2 class="aboutus__subtitle">Our Services Include:</h2>

            <p class="aboutus__description">
                Carpet: Soft, comfortable, and available in various colors and textures to complement any décor.<br>
                Wool Carpet: Stylish and durable, ideal for high-traffic areas.<br>
                Cork: Eco-friendly and resilient, offering a unique, natural aesthetic.<br>
                Hardwood: Timeless elegance and durability for a classic finish.<br>
                Laminate: Affordable and versatile, mimicking the appearance of hardwood or stone.<br>
                Vinyl: Water-resistant and easy to maintain, perfect for any room.<br>
                Luxury Vinyl: Offers a high-end look with the practicality of vinyl, adding a sophisticated touch.<br>
                <br>
                Our experts are committed to delivering exceptional craftsmanship and personalized service.<br>
                Trust RingRoadFlooring to bring your flooring vision to life with precision and care.
            </p>
        </div>
    </section>

    <!--==================== CONTACT ====================-->
    <?= $this->insert('components/contact-section') ?>
</main>