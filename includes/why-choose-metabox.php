<?php
/**
 * WHY CHOOSE META BOX 
   1. ADD META BOX */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'md_wc_metabox',
        'Why Choose Section',
        'md_wc_metabox_html',
        'page',
        'normal',
        'high'
    );
});


/*    2. META BOX HTML*/
function md_wc_metabox_html($post)
{
    wp_nonce_field('md_wc_nonce_action', 'md_wc_nonce');

    $data = get_post_meta($post->ID, 'md_wc_section', true);
    $data = is_array($data) ? $data : [];

    $title    = $data['title'] ?? '';
    $subtitle = $data['subtitle'] ?? '';
    $btn_text = $data['btn_text'] ?? '';
    $btn_link = $data['btn_link'] ?? '';
    $features = $data['features'] ?? [];
    ?>

    <style>
        .md-row { display:flex; gap:10px; margin-bottom:15px; }
        .md-col { width:50%; }
        .md-input { width:100%; padding:8px; border:1px solid #ddd; }
        .md-item { border:1px solid #ccc; padding:15px; margin-bottom:10px; position:relative; }
        .md-remove { position:absolute; top:10px; right:10px; color:red; cursor:pointer; }
        .md-img { max-width:60px; margin-top:10px; display:block; }
    </style>

    <div class="md-row">
        <div class="md-col">
            <label>Title</label>
            <input type="text" name="md_wc_data[title]" value="<?php echo esc_attr($title); ?>" class="md-input">
        </div>

        <div class="md-col">
            <label>Subtitle</label>
            <input type="text" name="md_wc_data[subtitle]" value="<?php echo esc_attr($subtitle); ?>" class="md-input">
        </div>
    </div>

    <!-- BUTTON -->
    <div class="md-row">
        <div class="md-col">
            <label>Button Text</label>
            <input type="text" name="md_wc_data[btn_text]" value="<?php echo esc_attr($btn_text); ?>" class="md-input">
        </div>

        <div class="md-col">
            <label>Button Link</label>
            <input type="text" name="md_wc_data[btn_link]" value="<?php echo esc_attr($btn_link); ?>" class="md-input">
        </div>
    </div>

    <h4>Why Choose Content</h4>

    <div id="md-wc-repeater">
        <?php foreach ($features as $i => $item): ?>
            <div class="md-item">
                <span class="md-remove">Remove</span>

                <label>Image</label>
                <input type="hidden" name="md_wc_data[features][<?php echo $i; ?>][icon]" value="<?php echo esc_attr($item['icon'] ?? ''); ?>" class="md-img-input">
                <button type="button" class="button md-upload">Upload</button>
                <img src="<?php echo esc_url($item['icon'] ?? ''); ?>" class="md-img">

                <label>Title</label>
                <input type="text" name="md_wc_data[features][<?php echo $i; ?>][f_title]" value="<?php echo esc_attr($item['f_title'] ?? ''); ?>" class="md-input">

                <label>Content</label>
                <textarea name="md_wc_data[features][<?php echo $i; ?>][f_desc]" class="md-input"><?php echo esc_textarea($item['f_desc'] ?? ''); ?></textarea>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button button-primary" id="md-wc-add">Add Content</button>

    <script>
    jQuery(function($){

        let i = <?php echo count($features); ?>;

        $('#md-wc-add').click(function(){
            let html = `
            <div class="md-item">
                <span class="md-remove">Remove</span>

                <label>Image</label>
                <input type="hidden" name="md_wc_data[features][${i}][icon]" class="md-img-input">
                <button type="button" class="button md-upload">Upload</button>
                <img src="" class="md-img">

                <label>Title</label>
                <input type="text" name="md_wc_data[features][${i}][f_title]" class="md-input">

                <label>Content</label>
                <textarea name="md_wc_data[features][${i}][f_desc]" class="md-input"></textarea>
            </div>`;
            
            $('#md-wc-repeater').append(html);
            i++;
        });

        $(document).on('click', '.md-remove', function(){
            $(this).closest('.md-item').remove();
        });

        $(document).on('click', '.md-upload', function(e){
            e.preventDefault();

            let btn = $(this);
            let input = btn.prev('.md-img-input');
            let img = btn.next('.md-img');

            let frame = wp.media({
                title: 'Select Image',
                button: { text: 'Use Image' },
                multiple: false
            });

            frame.on('select', function(){
                let file = frame.state().get('selection').first().toJSON();
                input.val(file.url);
                img.attr('src', file.url);
            });

            frame.open();
        });

    });
    </script>

<?php
}


/* -----------------------------
   3. SAVE DATA
------------------------------*/
add_action('save_post', function ($post_id) {

    if (!isset($_POST['md_wc_nonce']) ||
        !wp_verify_nonce($_POST['md_wc_nonce'], 'md_wc_nonce_action')) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['md_wc_data'])) {

        $data = $_POST['md_wc_data'];

        $clean = [
            'title'    => sanitize_text_field($data['title'] ?? ''),
            'subtitle' => sanitize_text_field($data['subtitle'] ?? ''),
            'btn_text' => sanitize_text_field($data['btn_text'] ?? ''),
            'btn_link' => esc_url_raw($data['btn_link'] ?? ''),
            'features' => []
        ];

        if (!empty($data['features'])) {
            foreach ($data['features'] as $f) {
                $clean['features'][] = [
                    'icon'    => esc_url_raw($f['icon'] ?? ''),
                    'f_title' => sanitize_text_field($f['f_title'] ?? ''),
                    'f_desc'  => sanitize_textarea_field($f['f_desc'] ?? ''),
                ];
            }
        }

        update_post_meta($post_id, 'md_wc_section', $clean);
    }
});