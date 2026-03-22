<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
// Dynamic Data from your Options
$phone      = get_option('md_phone');
$email      = get_option('md_email');
$quote_text = get_option('md_quote_text');
$quote_link = get_option('md_quote_link');
$facebook   = get_option('md_facebook');
$instagram  = get_option('md_instagram');
$linkedin   = get_option('md_linkedin');
?>

<header>
    <div class="top-header">
        <div class="container">
            <ul class="contact">
                <?php if($phone): ?>
                <li>
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.23935 7.84784C7.73812 8.88671 8.41808 9.86033 9.27912 10.7214C10.1402 11.5826 11.1139 12.2625 12.1528 12.7613C12.2421 12.8041 12.2868 12.8256 12.3433 12.8421C12.5443 12.9007 12.7909 12.8586 12.9611 12.7368C13.009 12.7024 13.0499 12.6615 13.1318 12.5796C13.3824 12.329 13.5076 12.2037 13.6336 12.1219C14.1087 11.813 14.7211 11.813 15.1962 12.1219C15.3222 12.2037 15.4474 12.329 15.698 12.5796L15.8376 12.7192C16.2185 13.1001 16.4089 13.2905 16.5123 13.495C16.718 13.9017 16.718 14.3821 16.5123 14.7889C16.4089 14.9933 16.2185 15.1838 15.8376 15.5646L15.7246 15.6776C15.3451 16.0572 15.1553 16.2469 14.8973 16.3918C14.611 16.5526 14.1663 16.6683 13.8379 16.6673C13.542 16.6665 13.3397 16.609 12.9353 16.4942C10.7614 15.8772 8.71011 14.7131 6.99883 13.0018C5.28751 11.2905 4.12336 9.23915 3.50635 7.06534C3.39154 6.66083 3.33413 6.45858 3.33326 6.16265C3.33228 5.83427 3.44791 5.3896 3.60874 5.1033C3.75368 4.84529 3.94345 4.65551 4.32301 4.27596L4.43597 4.163C4.81682 3.78215 5.00725 3.59172 5.21176 3.48828C5.6185 3.28255 6.09883 3.28255 6.50557 3.48828C6.71008 3.59172 6.90051 3.78215 7.28136 4.163L7.42101 4.30265C7.67155 4.55319 7.79683 4.67846 7.87872 4.80442C8.18759 5.27948 8.18759 5.89191 7.87872 6.36696C7.79683 6.49292 7.67155 6.6182 7.42101 6.86873C7.33909 6.95066 7.29813 6.99161 7.26385 7.03949C7.14201 7.20964 7.09995 7.45635 7.15851 7.65727C7.17499 7.71381 7.19644 7.75848 7.23935 7.84784Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                </li>
                <?php endif; ?>

                <?php if($email): ?>
                <li>
                    <span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.5 6.41602L8.62367 10.7026C9.11957 11.0497 9.36752 11.2233 9.63722 11.2905C9.87542 11.3499 10.1246 11.3499 10.3628 11.2905C10.6325 11.2233 10.8804 11.0497 11.3763 10.7026L17.5 6.41602M6.1 16.166H13.9C15.1601 16.166 15.7901 16.166 16.2715 15.9208C16.6949 15.7051 17.039 15.3609 17.2547 14.9375C17.5 14.4562 17.5 13.8262 17.5 12.566V7.76602C17.5 6.5059 17.5 5.87584 17.2547 5.39454C17.039 4.97117 16.6949 4.62697 16.2715 4.41125C15.7901 4.16602 15.1601 4.16602 13.9 4.16602H6.1C4.83988 4.16602 4.20982 4.16602 3.72852 4.41125C3.30515 4.62697 2.96095 4.97117 2.74524 5.39454C2.5 5.87584 2.5 6.5059 2.5 7.76602V12.566C2.5 13.8262 2.5 14.4562 2.74524 14.9375C2.96095 15.3609 3.30515 15.7051 3.72852 15.9208C4.20982 16.166 4.83988 16.166 6.1 16.166Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                </li>
                <?php endif; ?>
            </ul>

            <div class="social-icon">
                <ul>
                    <?php if ($facebook) : ?>
                    <li>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.4726 12.4903L15.9425 9.43689H13.003V7.45542C13.003 6.62007 13.4136 5.80583 14.7302 5.80583H16.0667V3.20631C16.0667 3.20631 14.8538 3 13.6942 3C11.2733 3 9.69102 4.46233 9.69102 7.10971V9.43689H7V12.4903H9.69102V19.8717C10.2306 19.9561 10.7837 20 11.347 20C11.9104 20 12.4635 19.9561 13.003 19.8717V12.4903H15.4726Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if ($instagram) : ?>
                    <li>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if ($linkedin) : ?>
                    <li>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.12454 7.24907C7.29789 7.24907 8.24907 6.29789 8.24907 5.12454C8.24907 3.95119 7.29789 3 6.12454 3C4.95119 3 4 3.95119 4 5.12454C4 6.29789 4.95119 7.24907 6.12454 7.24907Z" fill="currentColor"></path>
                                <path d="M7.89498 8.66913H4.35409C4.15863 8.66913 4 8.82776 4 9.02322V19.6459C4 19.8414 4.15863 20 4.35409 20H7.89498C8.09044 20 8.24907 19.8414 8.24907 19.6459V9.02322C8.24907 8.82776 8.09044 8.66913 7.89498 8.66913Z" fill="currentColor"></path>
                                <path d="M18.4467 8.07954C16.9334 7.56115 15.0404 8.01651 13.9052 8.83304C13.8662 8.68078 13.7274 8.56748 13.5624 8.56748H10.0215C9.82607 8.56748 9.66744 8.72611 9.66744 8.92157V19.5442C9.66744 19.7397 9.82607 19.8983 10.0215 19.8983H13.5624C13.7579 19.8983 13.9165 19.7397 13.9165 19.5442V11.9101C14.4887 11.4172 15.2259 11.26 15.8293 11.5163C16.4143 11.7635 16.7492 12.3669 16.7492 13.1706V19.5442C16.7492 19.7397 16.9079 19.8983 17.1033 19.8983H20.6442C20.8397 19.8983 20.9983 19.7397 20.9983 19.5442V12.4575C20.9579 9.5476 19.589 8.47046 18.4467 8.07954Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="container">
            <div class="logo">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
                    </a>
                <?php endif; ?>
            </div>

            <div class="menu">
                <div class="menu-top">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.png" alt="White Logo">
                    </a>
                    <button type="button" class="close-menu" onclick="toggleMenu()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
                
                <nav class="primary-menu-container">
                    <?php 
                    if (has_nav_menu('primary_menu')) :
                        wp_nav_menu(array(
                            'theme_location' => 'primary_menu',
                            'menu_class'     => 'main-menu',
                            'container'      => false,
                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        ));
                    endif; 
                    ?>
                </nav>
            </div>

            <div class="last-btn">
                <?php if($quote_text && $quote_link): ?>
                    <a href="<?php echo esc_url($quote_link); ?>" class="btn btn-transparent">
                        <?php echo esc_html($quote_text); ?>
                        <span class="icons"></span>
                    </a>
                <?php endif; ?>

                <a href="/track" class="btn btn-primary">Track Your Order 
                    <span class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.5C12.663 6.5 13.2989 6.76339 13.7678 7.23223C14.2366 7.70107 14.5 8.33696 14.5 9C14.5 9.3283 14.4353 9.65339 14.3097 9.95671C14.1841 10.26 13.9999 10.5356 13.7678 10.7678C13.5356 10.9999 13.26 11.1841 12.9567 11.3097C12.6534 11.4353 12.3283 11.5 12 11.5C11.337 11.5 10.7011 11.2366 10.2322 10.7678C9.76339 10.2989 9.5 9.66304 9.5 9C9.5 8.33696 9.76339 7.70107 10.2322 7.23223C10.7011 6.76339 11.337 6.5 12 6.5ZM12 2C13.8565 2 15.637 2.7375 16.9497 4.05025C18.2625 5.36301 19 7.14348 19 9C19 13.4539 13.962 19.707 12.4341 21.5011C12.2036 21.7717 11.7964 21.7717 11.5659 21.5011C10.038 19.707 5 13.4539 5 9C5 7.14348 5.7375 5.36301 7.05025 4.05025C8.36301 2.7375 10.1435 2 12 2ZM12 4C10.6739 4 9.40215 4.52678 8.46447 5.46447C7.52678 6.40215 7 7.67392 7 9C7 9.96702 7 11.8691 11.5214 18.0613C11.7582 18.3856 12.2418 18.3856 12.4786 18.0613C17 11.8691 17 9.96702 17 9C17 7.67392 16.4732 6.40215 15.5355 5.46447C14.5979 4.52678 13.3261 4 12 4Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </a>

                <button type="button" class="btn-menu" onclick="toggleMenu()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M3 18H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>