<?php 
/** @var string $code */
/** @var string $title */
/** @var string $description */
$this->layout($layout ?? 'layouts/app');
?>
<!-- ================ MAIN ================ -->
<main class="main">

    <!--==================== ERROR PAGE ====================-->
    <section class="not-found">
        <div class="container">
            <!-- Error code (404, 500, etc.) -->
            <h1 class="not-found__code"><?= $code ?></h1>
            
            <h2 class="not-found__title"><?= $title ?></h2>
            
            <p class="not-found__description">
                <?= $description ?>
            </p>

            <div class="not-found__btn">
                <a href="<?= $this->baseUrl() ?>" class="button button--flex">
                    Back to Home <i class="ri-arrow-left-line button__icon"></i>
                </a>
            </div>
        </div>
    </section>
</main>