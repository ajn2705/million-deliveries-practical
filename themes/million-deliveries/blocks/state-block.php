<?php
$stats = get_field('state_section');

$bg_img = $stats['state_section_bgimage'] ?? '';

$stat1_num   = $stats['stat1_num'] ?? '';
$stat1_label = $stats['stat1_label'] ?? '';

$stat2_num   = $stats['stat2_num'] ?? '';
$stat2_label = $stats['stat2_label'] ?? '';

$stat3_num   = $stats['stat3_num'] ?? '';
$stat3_label = $stats['stat3_label'] ?? '';
?>

<section class="metrix-section section-gapping">
    <div class="container container-sm">

        <?php if ($bg_img) : ?>
            <div class="metrix-img">
                <img 
                    src="<?php echo esc_url(is_array($bg_img) ? $bg_img['url'] : $bg_img); ?>" 
                    alt="" 
                    class="img-responsive">
            </div>
        <?php endif; ?>

        <div class="metrix">
            <div class="col-1"></div>

            <div class="col-2">

                <!-- Stat 1 -->
                <?php if ($stat1_num || $stat1_label) : ?>
                    <div class="col">
                        <?php if ($stat1_num) : ?>
                            <h2><?php echo esc_html($stat1_num); ?></h2>
                        <?php endif; ?>
                        <?php if ($stat1_label) : ?>
                            <p><?php echo esc_html($stat1_label); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div></div>
                <div></div>

                <!-- Stat 2 -->
                <?php if ($stat2_num || $stat2_label) : ?>
                    <div class="col">
                        <?php if ($stat2_num) : ?>
                            <h2><?php echo esc_html($stat2_num); ?></h2>
                        <?php endif; ?>
                        <?php if ($stat2_label) : ?>
                            <p><?php echo esc_html($stat2_label); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Stat 3 -->
                <?php if ($stat3_num || $stat3_label) : ?>
                    <div class="col">
                        <?php if ($stat3_num) : ?>
                            <h2><?php echo esc_html($stat3_num); ?></h2>
                        <?php endif; ?>
                        <?php if ($stat3_label) : ?>
                            <p><?php echo esc_html($stat3_label); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div></div>

            </div>
        </div>

    </div>
</section>