<footer class="footer">
    <hr class="hr" />
    <div class="footer__container container grid">
        <div>
            <a href="<?= $this->baseUrl() ?>" class="footer__logo">
                <img src="<?= $this->asset('img/RRF-logo.svg') ?>" alt="">
            </a>

            <p class="footer__description">
                Experience timeless sophistication <br>
                with our expertly installed flooring <br>
                options.
                <!-- From luxury vinyl to plush carpet, 
                our designs seamlessly combine elegance 
                with enduring resilience. -->
            </p>
        </div>

        <div class="footer__content">
            <div>
                <h3 class="footer__title">Flooring</h3>

                <ul class="footer__links">
                    <li><a href="<?= $this->baseUrl() ?>products" class="footer__link">Products</a></li>
                    <li><a href="<?= $this->baseUrl() ?>flooring-installation" class="footer__link">Services</a></li>
                    <li><a href="<?= $this->baseUrl() ?>contact" class="footer__link">Contact info</a></li>
                </ul>
            </div>

            <div>
                <h3 class="footer__title">Products</h3>

                <ul class="footer__links">
                    <li><a href="<?= $this->baseUrl() ?>products/carpet" class="footer__link">Carpet</a></li>
                    <li><a href="<?= $this->baseUrl() ?>products/cork" class="footer__link">Cork</a></li>
                    <li><a href="<?= $this->baseUrl() ?>products/hardwood" class="footer__link">Hardwood</a></li>
                </ul>
            </div>

            <div>
                <h3 class="footer__title">Business Hours</h3>

                <p class="footer__information">
                    Monday - Friday <br>
                    9AM - 9PM <br>
                    <br>
                    Saturday - Sunday <br>
                    9AM - 6PM
                </p>
            </div>

            <div>
                <h3 class="footer__title">Contact Us</h3>

                <ul class="footer__social">
                    <li>
                        <a href="https://www.facebook.com/RingRoadFlooring/" target="_blank" class="footer__social-link">
                            <i class="ri-facebook-fill"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.instagram.com/ringroadflooring.ca/" target="_blank" class="footer__social-link">
                            <i class="ri-instagram-line"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.youtube.com/@RingRoadFlooring/" target="_blank" class="footer__social-link">
                            <i class="ri-youtube-line"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://www.linkedin.com/in/ringroadfloorig/" target="_blank" class="footer__social-link">
                            <i class="ri-linkedin-line"></i>
                        </a>
                    </li>

                    <li>
                        <a href="https://x.com/RingRdFlooring/" target="_blank" class="footer__social-link">
                            <i class="ri-twitter-line"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer__info container">
        <span class="footer__copy">
            &#169; RingRoadFlooring <?= date("Y"); ?>.
            <p align="center">All rights reserved.</p>
        </span>

        <a href="#" class="footer__privacy">
            Terms & Conditions
        </a>
    </div>
</footer>