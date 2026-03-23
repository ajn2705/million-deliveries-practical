<?php
/*1. REGISTER CUSTOM POST TYPE: SERVICES */
function md_register_services_cpt() {
    $labels = array(
        'name'          => 'Services',
        'singular_name' => 'Service',
    );
    $args = array(
        'labels'      => $labels,
        'public'      => true,
        'has_archive' => true,
        'menu_icon'   => 'dashicons-admin-site',
        'supports'    => array('title', 'editor', 'thumbnail', 'excerpt'),
    );
    register_post_type('services', $args); // Slug is 'services'
}
add_action('init', 'md_register_services_cpt');

/*2. BACKEND: METABOX SETUP */
add_action('add_meta_boxes', function() {
    add_meta_box('md_services_section_id', 'Services Section Settings', 'md_services_metabox_html', 'page', 'normal', 'high');
});

function md_services_metabox_html($post) {
    wp_nonce_field('md_services_nonce_action', 'md_services_nonce');
    $data = get_post_meta($post->ID, 'md_services_section', true) ?: [];

    $services = get_posts([
        'post_type'   => 'services', 
        'numberposts' => -1, 
        'post_status' => 'publish'
    ]);
    ?>
    <div style="padding:10px;">
        <p><strong>Section Title:</strong><br><input type="text" name="md_services_section[title]" value="<?php echo esc_attr($data['title'] ?? ''); ?>" style="width:100%;"></p>
        <p><strong>Subtitle:</strong><br><input type="text" name="md_services_section[subtitle]" value="<?php echo esc_attr($data['subtitle'] ?? ''); ?>" style="width:100%;"></p>
        <p><strong>Description:</strong><br>
            <?php wp_editor($data['description'] ?? '', 'md_desc_editor', ['textarea_name' => 'md_services_section[description]', 'textarea_rows' => 4]); ?>
        </p>
        <p><strong>Button Text / Link:</strong><br>
            <input type="text" name="md_services_section[btn_text]" placeholder="Text" value="<?php echo esc_attr($data['btn_text'] ?? ''); ?>" style="width:49%;">
            <input type="text" name="md_services_section[btn_link]" placeholder="URL" value="<?php echo esc_attr($data['btn_link'] ?? ''); ?>" style="width:49%;">
        </p>
        <p><strong>Select Services to Display:</strong><br>
            <select name="md_services_section[services][]" multiple style="width:100%; height:150px;">
                <?php if($services): foreach ($services as $s): ?>
                    <option value="<?php echo $s->ID; ?>" <?php echo in_array($s->ID, (array)($data['services'] ?? [])) ? 'selected' : ''; ?>>
                        <?php echo esc_html($s->post_title); ?>
                    </option>
                <?php endforeach; else: ?>
                    <option disabled>No services found. Please create some "Services" posts first.</option>
                <?php endif; ?>
            </select>
        </p>
    </div>
    <?php
}

add_action('save_post', function($post_id) {
    if (!isset($_POST['md_services_nonce']) || !wp_verify_nonce($_POST['md_services_nonce'], 'md_services_nonce_action')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['md_services_section'])) {
        update_post_meta($post_id, 'md_services_section', $_POST['md_services_section']);
    }
});

/* FRONTEND: AUTOMATIC DISPLAY LOGIC */
function md_auto_display_services($content) {
    // Only show on Front Page or pages with 'service' in the name/template
    if ( is_front_page() || is_page_template('template-services.php') || is_page('services') ) {
        
        $data = get_post_meta(get_the_ID(), 'md_services_section', true);

        // Check if we have at least a title and some selected services
        if (empty($data) || empty($data['title'])) return $content;

        $selected_ids = $data['services'] ?? [];

        ob_start(); ?>
        <style>
            .md-section { max-width: 1200px; margin: 60px auto; padding: 0 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
            .md-header-flex { display: flex; justify-content: space-between; align-items: flex-start; gap: 50px; margin-bottom: 40px; flex-wrap: wrap; }
            .md-col-left { flex: 1.2; }
            .md-col-right { flex: 0.8; }
            .md-badge { color: #0056b3; font-weight: 700; display: block; margin-bottom: 12px; font-size: 14px; text-transform: uppercase; }
            .md-main-title { font-size: 44px; line-height: 1.1; color: #1a1a1a; margin: 0; font-weight: 800; }
            .md-desc-box { color: #555; font-size: 17px; line-height: 1.6; margin-bottom: 25px; }
            .md-cta-btn { background: #0056b3; color: #fff !important; padding: 16px 32px; text-decoration: none; font-weight: bold; display: inline-flex; align-items: center; gap: 8px; border-radius: 2px; }
            .md-services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px; }
            .md-card-item { height: 380px; background-size: cover; background-position: center; border-radius: 4px; position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
            .md-card-item::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.4)); }
        </style>

        <div class="md-section">
            <div class="md-header-flex">
                <div class="md-col-left">
                    <span class="md-badge">▸ <?php echo esc_html($data['subtitle'] ?? 'Our Service'); ?></span>
                    <h2 class="md-main-title"><?php echo esc_html($data['title']); ?></h2>
                </div>
                <div class="md-col-right">
                    <div class="md-desc-box"><?php echo wp_kses_post($data['description'] ?? ''); ?></div>
                    <?php if(!empty($data['btn_link'])): ?>
                        <a href="<?php echo esc_url($data['btn_link']); ?>" class="md-cta-btn">
                            <?php echo esc_html($data['btn_text'] ?: 'Get a Quote'); ?> ↗
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="md-services-grid">
                <?php if(!empty($selected_ids)): foreach ($selected_ids as $s_id): 
                    $img = get_the_post_thumbnail_url($s_id, 'large'); 
                    if(!$img) continue; ?>
                    <div class="md-card-item" style="background-image: url('<?php echo esc_url($img); ?>');"></div>
                <?php endforeach; endif; ?>
            </div>
        </div>
        <?php
        $services_html = ob_get_clean();
        return $content . $services_html; // Appends it after your page content
    }
    return $content;
}
add_filter('the_content', 'md_auto_display_services');