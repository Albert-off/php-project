<section class="contact section" id="contact">
    <div class="contact__container container grid">
        <div class="contact__box">
            <h2 class="contact__title">
                Contact us today!
            </h2>

            <div class="contact__svg">
                <img src="<?= $this->asset('img/contact/Contact_Us.svg') ?>" alt="">
            </div>

            <div class="contact__data">
                <h3 class="contact__data-title">
                    Contact information
                </h3>

                <a href="tel:+18259626262" class="contact__information">
                    <i class="ri-phone-line contact__icon"></i>
                    +1 825 962 6262
                </a>

                <a href="mailto:info@ringroadflooring.ca" class="contact__information">
                    <i class="ri-mail-line contact__icon"></i>
                    info@ringroadflooring.ca
                </a>
            </div>
        </div>

        <!-- ================ ESTIMATE FORM ================ -->
        <?= $this->insert('components/estimate-form') ?>
    </div>
</section>
