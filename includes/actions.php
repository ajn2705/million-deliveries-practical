<?php
    
  
add_action('after_setup_theme', 'mp_after_setup_theme');
function mp_after_setup_theme()
{
   
    //add_theme_support('woocommerce');
    register_nav_menus([
        'primary_menu' => 'Primary Menu',
        'footer_service' => 'Footer Services',
        'quick_links' => 'Quick Links'
    ]);
    if (function_exists('acf_add_options_page')) acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
    if (function_exists('acf_add_options_page')) acf_add_options_page([
        'page_title' => 'Home Settings',
        'menu_title' => 'Home Settings',
        'menu_slug' => 'home-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
    ]);
}

// This theme uses post thumbnails
add_theme_support('post-thumbnails');

 add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 300,
    'flex-height' => true,
    'flex-width'  => true,
  ));

add_action('widgets_init', 'mp_widgets_init');
function mp_widgets_init()
{
    register_sidebar(array(
        'name' => 'Product Archive Left Sidebar',
        'id' => 'mp_left_sidebar',
        'before_widget' => '<div class="categorylistbox">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar-heading">',
        'after_title' => '</div>',
    ));
}

add_action('wp_footer', 'mp_get_template_url_in_js');

// This theme uses post thumbnails
add_theme_support('post-thumbnails');

add_filter('nav_menu_css_class', 'special_nav_class', 10, 3);
function special_nav_class($classes, $item, $args)
{
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    if (in_array('current-menu-ancestor', $classes)) {
        $classes[] = 'active';
    }
    if (in_array('current-page-ancestor', $classes)) {
        $classes[] = 'active';
    }
    if (in_array('current-product-ancestor', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}

add_action('admin_menu', 'md_theme_settings_menu');

function md_theme_settings_menu() {
    add_menu_page(
        'Theme Settings',
        'Theme Settings',
        'manage_options',
        'md-theme-settings',
        'md_theme_settings_page',
        'dashicons-admin-generic',
        60
    );
}

function md_theme_settings_page() {
?>
<div class="wrap">
    <h1>Theme Settings</h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('md_theme_options_group');
        do_settings_sections('md-theme-settings');
        submit_button();
        ?>
    </form>
</div>
<?php
}

add_action('admin_init', 'md_register_theme_settings');

function md_register_theme_settings() {

    // Register settings
    register_setting('md_theme_options_group', 'md_phone');
    register_setting('md_theme_options_group', 'md_email');
    register_setting('md_theme_options_group', 'md_facebook');
    register_setting('md_theme_options_group', 'md_instagram');
    register_setting('md_theme_options_group', 'md_linkedin');
    register_setting('md_theme_options_group', 'md_quote_text');
      register_setting('md_theme_options_group', 'md_quote_link');

    // Section
    add_settings_section(
        'md_general_section',
        'General Settings',
        null,
        'md-theme-settings'
    );

    // Phone
    add_settings_field(
        'md_phone',
        'Phone Number',
        function() {
            echo '<input type="text" name="md_phone" value="' . esc_attr(get_option('md_phone')) . '" class="regular-text">';
        },
        'md-theme-settings',
        'md_general_section'
    );

    // Email
    add_settings_field(
        'md_email',
        'Email',
        function() {
            echo '<input type="email" name="md_email" value="' . esc_attr(get_option('md_email')) . '" class="regular-text">';
        },
        'md-theme-settings',
        'md_general_section'
    );

    // Facebook
    add_settings_field(
        'md_facebook',
        'Facebook URL',
        function() {
            echo '<input type="url" name="md_facebook" value="' . esc_attr(get_option('md_facebook')) . '" class="regular-text">';
        },
        'md-theme-settings',
        'md_general_section'
    );

    // Instagram
    add_settings_field(
        'md_instagram',
        'Instagram URL',
        function() {
            echo '<input type="url" name="md_instagram" value="' . esc_attr(get_option('md_instagram')) . '" class="regular-text">';
        },
        'md-theme-settings',
        'md_general_section'
    );
    
     // linkedin
    add_settings_field(
        'md_linkedin',
        'linkedin URL',
        function() {
            echo '<input type="url" name="md_linkedin" value="' . esc_attr(get_option('md_linkedin')) . '" class="regular-text">';
        },
        'md-theme-settings',
        'md_general_section'
    );
    
    // Get a Quote - Button Text
add_settings_field(
    'md_quote_text',
    'Button Text',
    function() {
        echo '<input type="text" name="md_quote_text" value="' . esc_attr(get_option('md_quote_text')) . '" class="regular-text" placeholder="Get a Quote">';
    },
    'md-theme-settings',
    'md_general_section'
);

// Get a Quote - Button Link
add_settings_field(
    'md_quote_link',
    'Button Link',
    function() {
        echo '<input type="url" name="md_quote_link" value="' . esc_attr(get_option('md_quote_link')) . '" class="regular-text" placeholder="https://example.com">';
    },
    'md-theme-settings',
    'md_general_section'
);
}