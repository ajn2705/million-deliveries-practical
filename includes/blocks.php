<?php

add_action('acf/init', 'br_init_blocks');
function br_init_blocks()
{
    if (function_exists('acf_register_block')) {
        acf_register_block([
            'name' => 'two-columns',
            'title' => __('Two Columns'),
            'description' => __('Block with left and right content.'),
            'render_callback' => 'br_render_block',
            'category' => 'formatting',
            'icon' => 'screenoptions',
            'keywords' => ['two', 'column'],
        ]);
    }

    if (function_exists('acf_register_block')) {
        acf_register_block([
            'name' => 'one-columns',
            'title' => __('One Columns'),
            'description' => __('Block with content.'),
            'render_callback' => 'br_render_block',
            'category' => 'formatting',
            'icon' => 'screenoptions',
            'keywords' => ['one', 'column'],
        ]);
    }
}
