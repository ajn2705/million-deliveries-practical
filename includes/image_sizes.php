<?php
add_action('after_setup_theme', 'mp_add_image_sizes');
function mp_add_image_sizes()
{
  add_image_size('sv_listing', 836, 450, true);
  add_image_size('bloglisting', 450, 250, true);
}
