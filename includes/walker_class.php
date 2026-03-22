<?php
class My_Walker_Nav_Menu extends Walker_Nav_Menu
{
    private $curItem;
    public $exclude;
    public $view;
    public $thumbsize;
    public $licount;
    public function __construct($exclude = null, $view = 'desktop', $thumbsize = 'full', $licount = 0)
    {
        $this->exclude = $exclude;
        $this->view = $view;
        $this->thumbsize = $thumbsize;
        $this->licount = $licount;
    }
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $class = '';
        $indent = str_repeat("\t", $depth);
        if ($depth != 0) {
            $div = "";
        } else if ($depth == 0) {
            $div = '<div class="submenu"><div class="menu_wrap"><div class="menu_col">';
            $class = 'sub_menulink';
        }
        $output .= $div . "\n$indent <ul class='" . $class . "' >\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        //$menu_image = get_field('menu_image', 'option');
        $access_patient_images_url = get_field('_access_patient_images_url', 'option');
        $image = vr_get_image($menu_image, 'menu_image', false, ['class' => '']);
        if (vr_is_visitor_patient()) {
            $output .= "";
        }
    }
}
