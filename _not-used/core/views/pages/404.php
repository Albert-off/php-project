<?php /** @var \App\Rendering\ViewEnvironment $view */ ?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== 404 NOT FOUND ====================-->
    <section class="not-found">
        <div class="container">
            <h1 class="not-found__code">404</h1>
            
            <h2 class="not-found__title">Page Not Found</h2>
            
            <p class="not-found__description">
                Sorry, the page you’re looking for doesn’t exist or has been moved.
            </p>

            <div class="not-found__btn">
                <a href="<?= $view->baseUrl() ?>" class="button button--flex">
                    Back to Home <i class="ri-arrow-left-line button__icon"></i>
                </a>
            </div>
        </div>
    </section>
</main>