<?php
// 1. Fetch the data from your custom metabox
$data = get_post_meta(get_the_ID(), 'md_services_section', true);

// 2. Map metabox keys to your variable names
$service_title    = $data['title'] ?? '';
$service_subtitle = $data['subtitle'] ?? ''; // This is "Our Service" in your HTML
$service_content  = $data['description'] ?? '';
$service_btn_text = $data['btn_text'] ?? '';
$service_btn_link = $data['btn_link'] ?? '';
$selected_ids     = $data['services'] ?? []; // This is the array of Service Post IDs

// Only display if data exists
if (!empty($data)) :
?>

<section class="service-section section-gapping">
    <div class="container container-sm">
        <div class="top-service">
            <div class="main-title">
                <?php if (!empty($service_subtitle)) : ?>
                    <h2><?php echo esc_html($service_subtitle); ?></h2>
                <?php endif; ?>

                <?php if (!empty($service_title)) : ?>
                    <h3><?php echo esc_html($service_title); ?></h3>
                <?php endif; ?>
            </div>

            <div class="service-content">
                <div class="content-text">
                <?php if (!empty($service_content)) : ?>
                    
                        <p><?php echo wp_kses_post($service_content); ?></p>
                <?php endif; ?>

                <?php if (!empty($service_btn_link) && !empty($service_btn_text)) : ?>
                    <a href="<?php echo esc_url($service_btn_link); ?>" class="btn">
                        <?php echo esc_html($service_btn_text); ?>
                        <span class="icons"></span>
                    </a>
                <?php endif; ?>
                    </div>
                    
            </div>
        </div>

        <div class="swiper service-box">
            <div class="swiper-wrapper">

                <?php
                if (!empty($selected_ids)) :
                    foreach ($selected_ids as $service_id) :
                        // Get post data for each selected service
                        $title     = get_the_title($service_id);
                        $permalink = get_permalink($service_id);
                        $thumbnail = get_the_post_thumbnail_url($service_id, 'full');
                        $excerpt   = get_the_excerpt($service_id);
                        
                        // Fallback if excerpt is empty
                        if (empty($excerpt)) {
                            $excerpt = wp_trim_words(get_post_field('post_content', $service_id), 20);
                        }
                ?>

                <div class="swiper-slide">
                    <div class="box">
                        <?php if ($thumbnail) : ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>" class="img-responsive">
                        <?php endif; ?>

                        <a href="<?php echo esc_url($permalink); ?>" class="arrow-link">
                            <h4><?php echo esc_html($title); ?></h4>

                            <svg width="32" height="32" viewBox="0 0 32 32">
                                <path d="M8.53317 23.9993L6.6665 22.1327L19.4665 9.33268H7.99984V6.66602H23.9998V22.666H21.3332V11.1993L8.53317 23.9993Z" fill="currentColor"/>
                            </svg>
                        </a>

                        <div class="hover-box">
                            <h4><?php echo esc_html($title); ?></h4>
                            <p><?php echo esc_html($excerpt); ?></p>
                        </div>
                    </div>
                </div>

                <?php
                    endforeach;
                endif;
                ?>

            </div>
        </div>
    </div>
</section>

<?php endif; ?>