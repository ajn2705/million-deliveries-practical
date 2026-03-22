<?php
add_filter('upload_mimes', 'mp_upload_mimes');
function mp_upload_mimes($mimp_types)
{
    $mimp_types['svg'] = 'image/svg+xml';
    return $mimp_types;
}
add_filter('wp_get_attachment_image_attributes', 'mp_wp_get_attachment_image_attributes', 10, 2);
function mp_wp_get_attachment_image_attributes($attr, $attachment)
{
    if (!isset($attr['alt']) || trim($attr['alt']) === '') $attr['alt'] = $attachment->post_title;
    return $attr;
}
/* Add page class to each page body */
add_filter('body_class', 'mp_add_slug_body_class');
function mp_add_slug_body_class($classes)
{
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    if (is_tax('product_cat')) {
        $cat = get_queried_object();
        if ($cat->parent == 0) $classes[] = 'subcategory';
    }
    return $classes;
}
add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('wpcf7_special_mail_tags', 'mp_wpcf7_special_mail_tags', 10, 2);
function mp_wpcf7_special_mail_tags($output, $name)
{
    if ('_logo' == $name) {
        return mp_get_image(mp_get_field('logo', 'option', 0));
    }
    if ('_copyright' == $name) {
        return '&copy;' . ' ' . date('Y') . ' ' . get_bloginfo('name') . ' | All Rights Reserved';
    }
    return $output;
}

/* 301 Pages  */
add_filter('paginate_links', 'mp_paginate_links');
function mp_paginate_links($link)
{
    return preg_replace('/page\/1\/$/', '', $link);
}

add_filter('wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link');

function yoast_seo_breadcrumb_append_link($links)
{
    global $post;
    if (is_single()) {
        $breadcrumb[] = array(
            'url' => site_url('/blog/'),
            'text' => 'Blog',
        );
        array_splice($links, 1, -2, $breadcrumb);
    }
    return $links;
}
