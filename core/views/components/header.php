<!-- 
Более правильное решение:
Не заставлять каждый контроллер создавать $user.
В начале header.php: 

<php
if (session_status() === PHP_SESSION_NONE) session_start();
$user = currentUser();
>

Тогда шаблон сам получает текущего пользователя и не зависит от того, кто его подключил.
После этого условие становится:
<php if (($user['role'] ?? null) === 'Admin'): >
-->


<header class="header" id="header">

    <?php if (session_status() != PHP_SESSION_NONE && isset($user) && $user['role'] === 'Admin'): ?>
        <div class="admin-pre-header">
            <div class="admin-pre-header__links container">
                <a href="<?= $this->baseUrl() ?>admin/admin.php">Go to Admin Page</a>

                <a class="admin-pre-header__link-group" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">
                    Logout
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                    </svg>
                    <form id="logout-form" action="/logout" method="post" style="display: none;"></form>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <nav class="nav container">
        <div class="nav__data">
            <a href="<?= $this->baseUrl() ?>" class="nav__logo">
                <img src="<?= $this->asset('img/RRF-logo.svg') ?>" class="logo__img" alt="">
            </a>

            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-menu-line nav__burger"></i>
                <i class="ri-close-line nav__close"></i>
            </div>
        </div>

        <!-- ================ NAV MENU ================ -->
        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">

                <li><a href="<?= $this->baseUrl() ?>" class="nav__link">Home</a></li>

                <!-- ================ DROPDOWN 1 ================ -->
                <li class="dropdown__item">
                    <div class="nav__link">
                        <a href="<?= $this->baseUrl() ?>products">Products</a> <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

                    <ul class="dropdown__menu">
                        <!-- ================ DROPDOWN SUBMENU 1 ================ -->
                        <li class="dropdown__subitem">
                            <div class="dropdown__link">
                                <a href="<?= $this->baseUrl() ?>products/carpet">Carpet</a> <i class="ri-add-line dropdown__add"></i>
                            </div>

                            <ul class="dropdown__submenu">
                                <li><a href="<?= $this->baseUrl() ?>products/carpet" class="dropdown__sublink">About Carpet</a></li>
                                <li><a href="<?= $this->baseUrl() ?>products/carpet/smarthcushion" class="dropdown__sublink">SmartCushion</a></li>
                                <li><a href="<?= $this->baseUrl() ?>products/carpet/smartstrand" class="dropdown__sublink">SmartStrand</a></li>
                                <li><a href="<?= $this->baseUrl() ?>products/carpet/smartstrand-colormax" class="dropdown__sublink">SmartStrand ColorMax</a></li>
                                <li><a href="<?= $this->baseUrl() ?>products/carpet/fabrica-carpet" class="dropdown__sublink">Fabrica Carpet</a></li>
                            </ul>
                        </li>

                        <li><a href="<?= $this->baseUrl() ?>products/wool-carpet" class="dropdown__link">Wool Carpet</a></li>
                        <li><a href="<?= $this->baseUrl() ?>products/cork" class="dropdown__link">Cork</a></li>

                        <!-- ================ DROPDOWN SUBMENU 2 ================ -->
                        <li class="dropdown__subitem">
                            <div class="dropdown__link">
                                <a href="<?= $this->baseUrl() ?>products/hardwood">Hardwood</a> <i class="ri-add-line dropdown__add"></i>
                            </div>

                            <ul class="dropdown__submenu">
                                <li><a href="<?= $this->baseUrl() ?>products/hardwood" class="dropdown__sublink">About Hardwood</a></li>
                            </ul>
                        </li>

                        <li><a href="<?= $this->baseUrl() ?>products/laminate" class="dropdown__link">Laminate</a></li>
                        <li><a href="<?= $this->baseUrl() ?>products/vinyl" class="dropdown__link">Vinyl</a></li>

                        <!-- ================ DROPDOWN SUBMENU 3 ================ -->
                        <li class="dropdown__subitem">
                            <div class="dropdown__link">
                                <a href="<?= $this->baseUrl() ?>products/luxury-vinyl">Luxury Vinyl</a> <i class="ri-add-line dropdown__add"></i>
                            </div>

                            <ul class="dropdown__submenu">
                                <li><a href="<?= $this->baseUrl() ?>products/luxury-vinyl" class="dropdown__sublink">About Luxury Vinyl</a></li>
                            </ul>
                        </li>

                        <li><a href="<?= $this->baseUrl() ?>products" class="dropdown__link">See All Products</a></li>
                    </ul>
                </li>

                <!-- ================ DROPDOWN 2 ================ -->
                <li class="dropdown__item">
                    <div class="nav__link">
                        <a href="<?= $this->baseUrl() ?>flooring-installation">Services</a> <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

                    <ul class="dropdown__menu">
                        <li><a href="<?= $this->baseUrl() ?>flooring-installation" class="dropdown__link">Flooring Installation</a></li>
                        <!-- <li><a href="#" class="dropdown__link">Hardwood Refinishing</a></li> -->
                        <!-- <li><a href="#" class="dropdown__link">View All Services</a></li> -->
                    </ul>
                </li>

                <!-- ================ DROPDOWN 3 ================ -->
                <li class="dropdown__item">
                    <div class="nav__link">
                        <a href="<?= $this->baseUrl() ?>aboutus">About Us</a> <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                    </div>

                    <ul class="dropdown__menu">
                        <!-- <li><a href="#" class="dropdown__link">Blog</a></li>
                        <li><a href="#" class="dropdown__link">Brands We Love</a></li> -->
                        <li><a href="<?= $this->baseUrl() ?>aboutus" class="dropdown__link">Who We Are</a></li>
                    </ul>
                </li>

                <li><a href="<?= $this->baseUrl() ?>contact" class="nav__link">Contact</a></li>
            </ul>
        </div>
    </nav>
</header>