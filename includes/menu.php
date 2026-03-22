<?php
/* EXTEND SUBNAV
******************************************/
class submenu_wrap extends Walker_Nav_Menu
{

    // for classes 
    private $current_item = [];
    private function get_parent_item($item)
    {
        $parent_item = null;

        foreach ($this->current_item as $c_item) {
            if ($c_item->ID === intval($item->menu_item_parent)) {
                $parent_item = $c_item;
                break;
            }
        }
        return $parent_item;
    }

    //start_el for start li structure
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $this->current_item[] = $item;
        $parent_item = $this->get_parent_item($item);
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($item->classes), $item, $args, $depth));
        $menu_desc = get_field('menu_desc', $item->ID);
        $mnuimg = '';
        $menu_cta_img = get_field('menu_cta_img', 'option');
        $cate_menu = get_field('image', $item->ID);
        if ($cate_menu) {
            $mnuimg = $cate_menu;
        } else {
            $mnuimg = $cmn_mnuimg;
        }
        $imgcat = wp_get_attachment_image($mnuimg, 'muimg', '', array('class' => ''));

        //if need to add images or div in main li 
        if (in_array('subsv', $item->classes)) {
            $output .= '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '"><a href=' . $item->url . '> ' . $title . ' <i class="fa fa-angle-down menudrop" aria-hidden="true"></i></a>';
        } elseif ((in_array('svmenuinfo', $item->classes))) {
            $output .= '<div class="menu-info">' . $title . '</div>  <p>' . $menu_desc . ' </p>';
        } elseif ((in_array('svpara', $item->classes))) {
            $output .= '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '"><a href=' . $item->url . '> </a>' . $title . '<p>' . $menu_desc . '</p> ';
        } elseif ((in_array('svtitle', $item->classes))) {
            $output .= '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '"><a href=' . $item->url . '> ' . $title . '<span>' . $menu_desc . '</span> </a>';
        } elseif ((in_array('menuinfo', $item->classes))) {
            $output .= '<div class="menu-info">' . $title . '</div>';
        } else {
            parent::start_el($output, $item, $depth, $args, $id);
        }
    }

    //end_el for close li
    function end_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        array_pop($this->current_item);
        $parent_item = $this->get_parent_item($item);

        if (in_array('img', $item->classes)) {
            $output .= '</li>';
        } else {
            parent::end_el($output, $item, $depth, $args, $id);
        }
    }

    //start_lvl for start ul structure
    function start_lvl(&$output, $depth = 0, $args = [])
    {
        $current_item = end($this->current_item);
        $parent_item = $this->get_parent_item($current_item);

        if (in_array('servicemenu', $current_item->classes)) {
            $output .= '<div class="sub-menu dropmenu"><div class="megamenu-wrap"><ul class="sublink">';
        } else if (in_array('subsv', $current_item->classes)) {
            $output .= '<div class="sub-menu menu-level menu-level2"><ul class="sub-menulink">';
        } else if (in_array('areamenu', $current_item->classes)) {
            $output .= '<div class="sub-menu megamenu"><ul class="sublink"><div class="menu-heading">Areas we serve</div>';
        } else if (in_array('svtitle', $current_item->classes)) {
            $output .= '<div class="sub-menu menu-level2"><ul class="sub-menulink">';
        } else if (in_array('simplemenu', $current_item->classes)) {
            $output .= '<div class="sub-menu childmenu"><ul class="sublink">';
        } else {
            $output .= "<ul class='submenu'>";
        }
    }

    //end_lvl for end ul structure
    function end_lvl(&$output, $depth = 0, $args = [])
    {
        $phone = get_field('phone', 'option');
        $book_appointment_link = get_field('book_appointment_link', 'option');
        $menu_cta_img = get_field('menu_cta_img', 'option');
        $menu_cta_text = get_field('menu_cta_text', 'option');
        $current_item = end($this->current_item);
        $parent_item = $this->get_parent_item($current_item);

        if (in_array('servicemenu', $current_item->classes)) {
            $output .= "</ul><div class='menu-img'>
                        <img width='485' height='191' src='$menu_cta_img'  class='menuimg' alt='menu-image'> <p>$menu_cta_text</p><div class='btn-row'> <a href='tel:$phone' class='button button-black-border'><img src='https://myxpertplumber.flywheelsites.com/wp-content/uploads/2025/04/call-icon.svg' alt='call' width='16' height='16'>$phone</a><a href='#get_quote' class='button button-theme fancyboxform'>Get a free quote</a></div>
                        </div></div></div>";
        } else if (in_array('subsv', $current_item->classes)) {
            $output .= "</ul></div>";
        } else if (in_array('areamenu', $current_item->classes)) {
            $output .= "</ul></div>";
        } else if (in_array('svtitle', $current_item->classes)) {
            $output .= "</ul></div>";
        } else if (in_array('simplemenu', $current_item->classes)) {
            $output .= "</ul></div>";
        } else {
            $output .= "</ul>";
        }
    }
}
