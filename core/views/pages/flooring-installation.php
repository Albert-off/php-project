<?php $this->layout('layouts/app'); ?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== HERO BANNER ====================-->
    <?= $this->insert('components/hero-banner') ?>

    <!--==================== FLOORING INSTALLATION ====================-->
    <section class="flooring-installation">
        <div class="container">

            <h1 class="flooring-installation__title">Top-Quality Flooring Installations at Competitive Prices</h1>

            <div class="flooring-installation__wrapper">
                <p class="flooring-installation__description">
                    At RingRoadFlooring Carpet & Flooring, we pride ourselves on providing
                    top-quality professional flooring installations at attractive prices.
                    Our team of highly experienced professionals is skilled in installing
                    every type of flooring material according to the manufacturer’s specifications.
                    <br><br>
                    We are committed to ensuring that our installations reflect your design preferences and vision,
                    from the initial planning stages to the project's successful completion.
                    Your interior design goals, budget, and schedule are our top priorities.
                    <br><br>
                    Our well-trained, licensed, and fully insured installation team takes every necessary step to
                    ensure you receive the aesthetic and value you expect.
                    Regardless of the flooring product chosen, we strive to exceed your expectations.
                    Over the years, RingRoadFlooring Carpet & Flooring has earned a solid reputation
                    for delivering exceptional service to our customers.
                </p>
                <img src="<?= $this->asset('img/service/flooring-installation.jpg') ?>" alt="">
            </div>


            <h1 class="flooring-installation__subtitle">Unmatched Quality and Service</h1>

            <p class="flooring-installation__description">
                We provide and professionally install a wide range of flooring products
                for homeowners and businesses throughout the greater Calgary area.
                Our inventory includes a vast selection of carpet, hardwood, laminate, tile, sheet vinyl, and more.
                At RingRoadFlooring Carpet & Flooring, we go above and beyond to ensure
                our customers are completely satisfied with their new flooring installation.
                <br><br>
                From start to finish, we handle every detail, including the removal of old furniture and flooring,
                installation of new products, and thorough clean-up.
                Visit our showroom in Calgary or give us a call to discuss your flooring and installation needs.
                We're here to make sure your experience is seamless and satisfying.
            </p>
        </div>
    </section>

    <!--==================== CONTACT ====================-->
    <?= $this->insert('components/contact-section') ?>
</main>