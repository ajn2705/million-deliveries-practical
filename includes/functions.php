<?php

function mp_get_themp_version()
{
    $theme = wp_get_theme();
    $ver = $theme->get('Version');
    return is_string($ver) ? $ver : false;
}

function mp_enqueue_assets($assets, $params = [])
{
    foreach ($assets as $asset) {
        if (!isset($asset['cond']) || $asset['cond']) {
            if (isset($asset['styles']) && is_array($asset['styles'])) {
                $deps = [];
                foreach ($asset['styles'] as $style) {
                    wp_enqueue_style('mp-' . $style, get_template_directory_uri() . '/assets/css/' . $style . '.css', $deps, mp_get_themp_version());
                    $deps[] = 'mp-' . $style;
                }
            }
            if (isset($asset['scripts']) && is_array($asset['scripts'])) {
                $deps = [];
                foreach ($asset['scripts'] as $script) {
                    wp_enqueue_script('mp-' . $script, get_template_directory_uri() . '/assets/js/' . $script . '.js', $deps, mp_get_themp_version(), true);
                    if (isset($params[$script])) wp_localize_script('mp-' . $script, 'params_' . str_replace('-', '_', $script), $params[$script]);
                    $deps[] = 'mp-' . $script;
                }
            }
        }
    }
}

function mp_get_image($attachment_id, $size = 'full', $icon = false, $attr = '', $default = true)
{
    $attr = $attr === '' || is_array($attr) ? $attr : ['class' => $attr];
    $image = wp_get_attachment_image($attachment_id, $size, $icon, $attr);
    if (!$image) {
        $image = $default === true
            ? wp_get_attachment_image(mp_get_field('dummy_image'), $size, $icon, $attr)
            : mp_get_image($default, $size, $icon, $attr);
    }
    return $image;
}

function mp_get_image_url($attachment_id, $size = 'full', $default = true, $icon = false)
{
    $image_url = wp_get_attachment_image_url($attachment_id, $size, $icon);
    if (!$image_url) {
        $image_url = $default === true
            ? wp_get_attachment_image_url(mp_get_field('dummy_image'), $size, $icon)
            : mp_get_image_url($default, $size, $icon);
    }
    return $image_url;
}

function mp_get_field_id()
{
    $id = 'option';
    if (is_singular()) {
        $id = get_the_ID();
    } elseif (is_shop()) {
        $id = wc_get_page_id('shop');
    } elseif (is_archive()) {
        $queried_object = get_queried_object();
        $id = $queried_object->taxonomy . '_' . get_queried_object()->term_id;
    } elseif (is_404()) {
        $id = '404_not_found';
    }
    return $id;
}

function mp_get_title()
{
    $title = mp_get_field('title');

    if (is_singular()) {
        $title = mp_get_field('title', get_the_ID());
        $title = $title ? $title : get_the_title();
    }
    /* elseif (is_shop()) {
        $shop_page_id = wc_get_page_id('shop');
        $title = mp_get_field('title', $shop_page_id);
        $title = $title ? $title : get_the_title($shop_page_id);
    } */ elseif (is_archive()) {
        $queried_object = get_queried_object();
        $title = mp_get_field('title', $queried_object->taxonomy . '_' . $queried_object->term_id);
        $title = $title ? $title : $queried_object->name;
    } elseif (is_404()) {
        $title = '404';
    }
    return $title;
}

function mp_get_field($selector, $post_id = 'option', $default = '', $format_value = true)
{
    return ($value = get_field($selector, $post_id, $format_value)) ? $value : $default;
}

function mp_get_grouped_field($group, $selector, $post_id = 'option', $default = '')
{
    if (($group = get_field($group, $post_id)) && key_exists($selector, $group)) return $group[$selector];
    return $default;
}

function mp_get_attachment_description($post_id = 0)
{
    $post = get_post((int)$post_id);
    if (!$post || $post->post_type !== 'attachment') return false;
    return apply_filters('wp_get_attachment_description', $post->post_content, $post->ID);
}

function mp_limit_length($str, $len = 20)
{
    return strlen($str) <= $len ? $str : substr($str, 0, $len) . '...';
}

function mp_render_block($block)
{
    if (isset($_POST['action']) && $_POST['action'] === 'acf/ajax/fetch-block') { ?>
        <!--suppress SpellCheckingInspection -->
        <div style="background:#EDEFF0;padding:10px 20px;border:1px solid #D9DDDF;border-radius:4px;">
            <div style="font-weight:bold;"><?= $block['title']; ?></div>
            <div style="font-size:0.95em;"><?= $block['description']; ?></div>
        </div>
    <?php } else {
        $slug = str_replace('acf/', '', $block['name']);
        if (fimp_exists(get_themp_fimp_path("/templates/blocks/block-{$slug}.php"))) {
            /** @noinspection PhpIncludeInspection */
            include(get_themp_fimp_path("/templates/blocks/block-{$slug}.php"));
        }
    }
}

function mp_array_insert(&$array, $position, $insert)
{
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
    return $array;
}

function mp_array_insert_after(&$array, $position, $insert)
{
    $keys = array_keys($array);
    $position = is_int($position) ? $position + 1 : $keys[array_search($position, $keys) + 1];
    mp_array_insert($array, $position, $insert);
    return $array;
}

function mp_echo_flush($str)
{
    echo $str;
    flush();
    ob_flush();
}

function mp_request($param, $default = '')
{
    return isset($_REQUEST[$param]) ? $_REQUEST[$param] : $default;
}

function mp_request_get($param, $default = '')
{
    return isset($_GET[$param]) ? $_GET[$param] : $default;
}

function mp_request_post($param, $default = '')
{
    return isset($_POST[$param]) ? $_POST[$param] : $default;
}

function mp_first($array)
{
    return reset($array);
}

function mp_last($array)
{
    return end($array);
}

function mp_breadcrumbs()
{
    return function_exists('yoast_breadcrumb') ? yoast_breadcrumb('<ul class="woo_breadcrumbs"><li>', '</li></ul>', false) : '';
}

function mp_get_template_part($slug, $name = null, $echo = true)
{
    if ($echo) {
        get_template_part($slug, $name);

        return null;
    }
    ob_start();
    get_template_part($slug, $name);

    return ob_get_clean();
}

function mp_get_template_url_in_js()
{
    ?>
    <script>
        var templateUrl = '<?= get_bloginfo("template_url"); ?>';
    </script>
<?php
}

add_post_type_support('page', 'excerpt');

//word tream
function cmn_trim_words($text, $num_words = 38, $more = null)
{
    if (null === $more) {
        $more = __('&hellip;');
    }
    $original_text = $text;
    $text = wp_strip_all_tags($text);
    $num_words = (int)$num_words;
    /*
     * translators: If your word count is based on single characters (e.g. East Asian characters),
     * enter 'characters_excluding_spaces' or 'characters_including_spaces'. Otherwise, enter 'words'.
     * Do not translate into your own language.
     */
    if (strpos(_x('words', 'Word count type. Do not translate!'), 'characters') === 0 && preg_match('/^utf\-?8$/i', get_option('blog_charset'))) {
        $text = trim(preg_replace("/[\n\r\t ]+/", ' ', $text), ' ');
        preg_match_all('/./u', $text, $words_array);
        $words_array = array_slice($words_array[0], 0, $num_words + 1);
        $sep = '';
    } else {
        $words_array = preg_split("/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY);
        $sep = ' ';
    }

    if (count($words_array) > $num_words) {
        array_pop($words_array);
        $text = implode($sep, $words_array);
        $text = $text . $more;
    } else {
        $text = $original_text;
    }
    /**
     * Filters the text content after words have been trimmed.
     *
     * @param string $text The trimmed text.
     * @param int $num_words The number of words to trim the text to. Default 55.
     * @param string $more An optional string to append to the end of the trimmed text, e.g. &hellip;.
     * @param string $original_text The text before it was trimmed.
     * @since 3.3.0
     *
     */
    return apply_filters('wp_trim_words', $text, $num_words, $more, $original_text);
}

function ash_relative_time()
{
    $post_date = get_the_time('U');
    $delta = time() - $post_date;
    if ($delta < 60) {
        echo 'Just Now';
    } elseif ($delta > 60 && $delta < 120) {
        echo '1 minute ago';
    } elseif ($delta > 120 && $delta < (60 * 60)) {
        echo strval(round(($delta / 60), 0)), ' minutes ago';
    } elseif ($delta > (60 * 60) && $delta < (120 * 60)) {
        echo 'About an hour ago';
    } elseif ($delta > (120 * 60) && $delta < (24 * 60 * 60)) {
        echo strval(round(($delta / 3600), 0)), ' hours ago';
    } else {
        echo the_time(' g:i a');
    }
}
function disabmp_wp_responsive_images()
{
    return 1;
}
add_filter('max_srcset_image_width', 'disabmp_wp_responsive_images');
