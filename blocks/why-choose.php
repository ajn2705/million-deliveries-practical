<?php
$why_title                = get_field('why_choose_title');
$why_group                = get_field('why_choose_content');
$why_choose_big_title     = get_field('why_choose_big_title');
$why_choose_button_title  = get_field('why_choose_button_title');
$why_choose_button_link   = get_field('why_choose_button_link');
?>

<section class="why-section section-gapping">
    <div class="container">

        <div class="main-title">

            <?php if ($why_title) : ?>
                <h2><?php echo esc_html($why_title); ?></h2>
            <?php endif; ?>

            <?php if ($why_choose_big_title) : ?>
                <h3><?php echo esc_html($why_choose_big_title); ?></h3>
            <?php endif; ?>

            <?php if ($why_choose_button_title && $why_choose_button_link) : ?>
                <a href="<?php echo esc_url($why_choose_button_link); ?>" class="btn">
                    <?php echo esc_html($why_choose_button_title); ?>
                    <span class="icons"></span>
                </a>
            <?php endif; ?>

        </div>

        <div class="boxs">

            <?php
            for ($i = 1; $i <= 3; $i++) :

                $title   = $why_group["box{$i}_title"] ?? '';
                $content = $why_group["box{$i}_content"] ?? '';
                $img     = $why_group["box{$i}_icon_img"] ?? '';
            ?>

                <?php if ($title || $content || $img) : ?>

                    <div></div>

                    <div class="box">

                        <?php if ($img) : ?>
                            <div class="img">
                                <img 
                                    src="<?php echo esc_url(is_array($img) ? $img['url'] : $img); ?>" 
                                    alt="<?php echo esc_attr($title); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if ($title) : ?>
                            <h4><?php echo esc_html($title); ?></h4>
                        <?php endif; ?>

                        <?php if ($content) : ?>
                            <div class="desc">
                                <?php echo wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                    </div>

                <?php endif; ?>

            <?php endfor; ?>

        </div>
    </div>
</section>
