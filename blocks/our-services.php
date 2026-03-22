<?php
$service_title        = get_field('service_title');
$service_content      = get_field('service_content');
$service_btn_link     = get_field('service_button_link');
$service_btn_text     = get_field('service_button_text');
?>
<section class="service-section section-gapping">
        <div class="container container-sm">
<div class="top-service">
    <div class="main-title">
        <?php if (!empty($service_title)) : ?>
            <h2>Our Service</h2>
        <?php endif; ?>

        <?php if (!empty($service_title)) : ?>
            <h3><?php echo esc_html($service_title); ?></h3>
        <?php endif; ?>
    </div>

    <div class="service-content">

        <?php if (!empty($service_content)) : ?>
            <?php echo ($service_content); ?>
        <?php endif; ?>

        <?php if (!empty($service_btn_link) && !empty($service_btn_text)) : ?>
            <a href="<?php echo esc_url($service_btn_link); ?>" class="btn">
                <?php echo esc_html($service_btn_text); ?>
                <span class="icons"></span>
            </a>
        <?php endif; ?>

    </div>

</div>

        <div class="swiper service-box">
            <div class="swiper-wrapper">

                <?php
                $services = get_field('select_services'); // ACF Post Object

                if ($services) :
                    foreach ($services as $post) :
                        setup_postdata($post);
                ?>

                <!-- ✅ Correct Swiper Structure -->
                <div class="swiper-slide">
                    <div class="box">

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" class="img-responsive">
                        <?php endif; ?>

                        <!-- Title + Link -->
                        <a href="<?php the_permalink(); ?>" class="arrow-link">
                            <h4><?php the_title(); ?></h4>

                            <!-- SVG Arrow -->
                            <svg width="32" height="32" viewBox="0 0 32 32">
                                <path d="M8.53317 23.9993L6.6665 22.1327L19.4665 9.33268H7.99984V6.66602H23.9998V22.666H21.3332V11.1993L8.53317 23.9993Z" fill="currentColor"/>
                            </svg>
                        </a>

                        <!-- Hover Content -->
                        <div class="hover-box">
                            <h4><?php the_title(); ?></h4>

                            <!-- Use excerpt OR trimmed content -->
                            <p>
                                <?php 
                                if (has_excerpt()) {
                                    echo get_the_excerpt();
                                } else {
                                    echo wp_trim_words(get_the_content(), 20);
                                }
                                ?>
                            </p>
                        </div>

                    </div>
                </div>

                <?php
                    endforeach;
                    wp_reset_postdata();
                endif;
                ?>

            </div>
        </div>
</div>
</div>