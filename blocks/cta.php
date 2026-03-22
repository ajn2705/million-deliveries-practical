<?php
$cta_title         = get_field('cta_title');
$cta_big_title     = get_field('cta_big_title');
$cta_btn_text      = get_field('cta_button_title');
$cta_btn_link      = get_field('cta_button_link');
?>

<section class="cta-section section-gapping">
    <div class="container">
        <div class="main-title">

            <?php if ($cta_title) : ?>
                <h2><?php echo esc_html($cta_title); ?></h2>
            <?php endif; ?>

            <?php if ($cta_big_title) : ?>
                <h3><?php echo esc_html($cta_big_title); ?></h3>
            <?php endif; ?>

            <?php if ($cta_btn_text && $cta_btn_link) : ?>
                <a href="<?php echo esc_url($cta_btn_link); ?>" class="btn">
                    <?php echo esc_html($cta_btn_text); ?>
                    <span class="icons"></span>
                </a>
            <?php endif; ?>

        </div>
    </div>
</section>