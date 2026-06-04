<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>
<main class="home-page">
<?php
$banner_video        = get_field('banner_video');
$banner_video_bgimage = get_field('banner_video_bgimage');
$banner_title        = get_field('banner_title');
$banner_content      = get_field('banner_title_content');
$banner_btn_text     = get_field('banner_button_title');
$banner_btn_link     = get_field('banner_button_link');
?>
<section class="banner-section">
    <?php if ($banner_video) : ?>
        <video autoplay muted playsinline 
            <?php if ($banner_video_bgimage) : ?>
                poster="<?php echo esc_url($banner_video_bgimage); ?>"
            <?php endif; ?>
        >
            <source src="<?php echo esc_url($banner_video); ?>" type="video/mp4">
        </video>
    <?php endif; ?>

    <div class="banner-content">
        <div class="container">
            <div class="banner-txt">

                <?php if ($banner_title) : ?>
                    <h2><?php echo esc_html($banner_title); ?></h2>
                <?php endif; ?>

                <?php if ($banner_content) : ?>
                    <div class="banner-desc">
                        <?php echo wp_kses_post($banner_content); ?>
                    </div>
                <?php endif; ?>

                <?php if ($banner_btn_text && $banner_btn_link) : ?>
                    <a href="<?php echo esc_url($banner_btn_link); ?>" class="btn">
                        <?php echo esc_html($banner_btn_text); ?>
                        <span class="icons"></span>
                    </a>
                <?php endif; ?>

            </div>
        </div>

        <div class="track_form">
            <form action="<?php echo esc_url(home_url('/track')); ?>" method="post" id="trackingForm">
                <h3>Track Your Delivery</h3>

                <div class="field">
                    <input type="text" id="trackingNumber" name="tracking_number" placeholder="Enter Tracking Number">
                    <span class="error_text" style="display: none;">Please enter tracking number</span>
                </div>

                <div class="btn_track">
                    <input type="submit" value="Track Your Order">
                </div>
            </form>
        </div>

    </div>
</section>
    <?php echo get_template_part("templates/blocks/why-choose"); ?>
    <?php echo get_template_part("templates/blocks/real-time-tracking"); ?>
    <?php echo get_template_part("templates/blocks/our-services"); ?>
    <?php echo get_template_part("templates/blocks/state-block"); ?>
   <?php echo get_template_part("templates/blocks/cta"); ?>

</main>
<?php get_footer();
