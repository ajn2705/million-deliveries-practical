<?php
if (is_front_page()) :

    $data = get_post_meta(get_the_ID(), 'md_wc_section', true);

    if (!empty($data)) :

        $why_title               = $data['title'] ?? '';
        $why_choose_big_title    = $data['subtitle'] ?? '';
        $why_choose_button_title = $data['btn_text'] ?? '';
        $why_choose_button_link  = $data['btn_link'] ?? '';
        $features                = $data['features'] ?? [];
?>

<section class="why-section section-gapping">
    <div class="container">

        <div class="main-title">
            <?php if (!empty($why_title)) : ?>
                <h2><?php echo esc_html($why_title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($why_choose_big_title)) : ?>
                <h3><?php echo esc_html($why_choose_big_title); ?></h3>
            <?php endif; ?>

            <?php if (!empty($why_choose_button_title) && !empty($why_choose_button_link)) : ?>
                <a href="<?php echo esc_url($why_choose_button_link); ?>" class="btn">
                    <?php echo esc_html($why_choose_button_title); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if (!empty($features)) : ?>
    <div class="boxs">
        <?php foreach ($features as $item) : 

            $title   = $item['f_title'] ?? '';
            $content = $item['f_desc'] ?? '';
            $img_url = $item['icon'] ?? '';

        ?>
        <div></div>
            <div class="box">

                <?php if (!empty($img_url)) : ?>
                    <div class="img">
                        <img src="<?php echo esc_url($img_url); ?>" alt="">
                    </div>
                <?php endif; ?>

                <?php if (!empty($title)) : ?>
                    <h4><?php echo esc_html($title); ?></h4>
                <?php endif; ?>

                <?php if (!empty($content)) : ?>
                    <div class="desc">
                        <?php echo esc_html($content); ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    </div>
</section>
<?php 
    endif; 
endif; 
?>