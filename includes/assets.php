<?php
add_action('wp_enqueue_scripts', 'mp_wp_enqueue_scripts', 11);
function mp_wp_enqueue_scripts()
{
    wp_enqueue_script('jquery', false, array(), false, false);
    mp_enqueue_assets([
        'common' => [
            'styles' => [],
            'scripts' => [],
        ],
        'home' => [
            'styles' => ['accordion.min', 'swiper-bundle.min', 'style', 'responsive','custom'],
            'scripts' => ['accordion.min', 'custom', 'swiper-bundle.min'],
            'cond' => is_front_page(),
        ],
       
    ], [
        'script' => [
            'ajax_url' => home_url('/wp-admin/admin-ajax.php'),
            'base_url' => home_url('/'),
        ],
    ]);
}
