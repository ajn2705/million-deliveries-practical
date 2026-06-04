<footer>
    <?php
    $locations = get_nav_menu_locations();
    if (isset($locations['footer_service'])) :
        $menu_id    = $locations['footer_service'];
        $menu_items = wp_get_nav_menu_items($menu_id);
        if ($menu_items) :
    ?>
    <div class="marquee">
        <ul>
            <?php 
            // repeat 3 times for smooth marquee
            for ($j = 0; $j < 3; $j++) : 
                foreach ($menu_items as $item) : 
            ?>
                <li>
                    <span>
                        <img src="<?php echo esc_url(get_template_directory_uri() . '/images/vector.png'); ?>" alt="">
                    </span>
                    <?php echo esc_html($item->title); ?>
                </li>
            <?php 
                endforeach;
            endfor; 
            ?>
        </ul>
    </div>
    <?php
        endif;
    endif;
    ?>

    <div class="main-footer">
        <div class="container container-sm">
            <div class="footer-cols">
                <div class="footer-left">
                    <div class="footer-menus">
                        <div class="menu-link dropdown">
                            <h2 class="dropdownButton">
                                Quick Link 
                                <span class="arrow-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                            </h2>
                            <nav class="primary-menu-container">
                                <?php if (has_nav_menu('quick_links')) :
                                    wp_nav_menu(array(
                                        'theme_location' => 'quick_links',
                                        'menu_class'     => 'dropdownMenu',
                                        'container'      => false,
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    ));
                                endif; ?>
                            </nav>
                        </div>

                        <div class="menu-link dropdown">
                            <h2 class="dropdownButton">
                                Services 
                                <span class="arrow-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                            </h2>
                            <nav class="primary-menu-container">
                                <?php if (has_nav_menu('footer_service')) :
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer_service',
                                        'menu_class'     => 'dropdownMenu',
                                        'container'      => false,
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    ));
                                endif; ?>
                            </nav>
                        </div>

                        <div class="menu-link dropdown">
                            <h2 class="dropdownButton">
                                Legal 
                                <span class="arrow-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </span>
                            </h2>
                            <nav class="primary-menu-container">
                                <ul class="dropdownMenu">
                                    <li><a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy Policy</a></li>
                                    <li><a href="<?php echo esc_url(home_url('/terms')); ?>">Terms of Service</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="copyright">
                        <p>© <?php echo date('Y'); ?> Million Deliveries. All rights reserved. Website by <a href="https://tpots.co" target="_blank">TPOTS</a></p>
                        
                        <?php
                            $facebook  = get_option('md_facebook');
                            $instagram = get_option('md_instagram');
                            $linkedin  = get_option('md_linkedin');
                        ?>
                        <ul>
                            <?php if ($facebook) : ?>
                            <li>
                                <a href="<?php echo esc_url($facebook); ?>" target="_blank">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.4726 12.4903L15.9425 9.43689H13.003V7.45542C13.003 6.62007 13.4136 5.80583 14.7302 5.80583H16.0667V3.20631C16.0667 3.20631 14.8538 3 13.6942 3C11.2733 3 9.69102 4.46233 9.69102 7.10971V9.43689H7V12.4903H9.69102V19.8717C10.2306 19.9561 10.7837 20 11.347 20C11.9104 20 12.4635 19.9561 13.003 19.8717V12.4903H15.4726Z" fill="currentColor"></path></svg>
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
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.12454 7.24907C7.29789 7.24907 8.24907 6.29789 8.24907 5.12454C8.24907 3.95119 7.29789 3 6.12454 3C4.95119 3 4 3.95119 4 5.12454C4 6.29789 4.95119 7.24907 6.12454 7.24907Z" fill="currentColor"></path><path d="M7.89498 8.66913H4.35409C4.15863 8.66913 4 8.82776 4 9.02322V19.6459C4 19.8414 4.15863 20 4.35409 20H7.89498C8.09044 20 8.24907 19.8414 8.24907 19.6459V9.02322C8.24907 8.82776 8.09044 8.66913 7.89498 8.66913Z" fill="currentColor"></path><path d="M18.4467 8.07954C16.9334 7.56115 15.0404 8.01651 13.9052 8.83304C13.8662 8.68078 13.7274 8.56748 13.5624 8.56748H10.0215C9.82607 8.56748 9.66744 8.72611 9.66744 8.92157V19.5442C9.66744 19.7397 9.82607 19.8983 10.0215 19.8983H13.5624C13.7579 19.8983 13.9165 19.7397 13.9165 19.5442V11.9101C14.4887 11.4172 15.2259 11.26 15.8293 11.5163C16.4143 11.7635 16.7492 12.3669 16.7492 13.1706V19.5442C16.7492 19.7397 16.9079 19.8983 17.1033 19.8983H20.6442C20.8397 19.8983 20.9983 19.7397 20.9983 19.5442V12.4575C20.9579 9.5476 19.589 8.47046 18.4467 8.07954Z" fill="currentColor"></path></svg>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="footer-contact-detail">
                    <div class="newslatter">
                        <p class="title">Stay In Touch</p>
                        <h3>Subscribe To Our Newsletter</h3>
                        <div class="form-shortcode">
                            <?php echo do_shortcode('[contact-form-7 id="64559b9" title="Newsletter Form"]'); ?>
                        </div>
                    </div>
                    <ul>
                        <li>
                            <span class="icon">
                                <svg width="54" height="55" viewBox="0 0 54 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.5465 21.6874C20.8931 24.4924 22.729 27.1211 25.0539 29.4461C27.3789 31.7711 30.0078 33.607 32.8127 34.9537C33.054 35.0694 33.1745 35.1275 33.3272 35.172C33.8697 35.33 34.5357 35.2165 34.9951 34.8875C35.1245 34.7948 35.235 34.6844 35.4562 34.4632C36.1326 33.7866 36.4708 33.4483 36.811 33.2274C38.0937 32.3934 39.7472 32.3934 41.0299 33.2274C41.3701 33.4483 41.7083 33.7866 42.3847 34.4632L42.7617 34.8401C43.7901 35.8685 44.3042 36.3826 44.5834 36.9349C45.1389 38.0329 45.1389 39.3299 44.5834 40.4282C44.3042 40.9802 43.7901 41.4945 42.7617 42.5227L42.4567 42.8277C41.432 43.8526 40.9196 44.365 40.2229 44.7562C39.4499 45.1904 38.2492 45.5027 37.3627 45.5C36.5637 45.4977 36.0175 45.3427 34.9254 45.0327C29.056 43.3667 23.5175 40.2236 18.8971 35.6031C14.2765 30.9825 11.1333 25.444 9.46738 19.5746C9.15738 18.4825 9.00238 17.9364 9.00002 17.1374C8.99737 16.2508 9.30958 15.0502 9.74382 14.2771C10.1352 13.5805 10.6475 13.0681 11.6723 12.0433L11.9773 11.7383C13.0056 10.71 13.5198 10.1959 14.072 9.91659C15.1702 9.36114 16.4671 9.36114 17.5652 9.91659C18.1174 10.1959 18.6316 10.71 19.6599 11.7383L20.037 12.1154C20.7134 12.7918 21.0516 13.1301 21.2728 13.4702C22.1067 14.7528 22.1067 16.4064 21.2728 17.689C21.0516 18.0291 20.7134 18.3674 20.037 19.0438C19.8158 19.265 19.7052 19.3756 19.6126 19.5049C19.2837 19.9643 19.1701 20.6304 19.3282 21.1729C19.3727 21.3255 19.4306 21.4461 19.5465 21.6874Z" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </span>
                            <div class="">
                                <p>Give us a call</p>
                                <h3><a href="tel:+18886454661">+1 (888) 645 4661</a></h3>
                            </div>
                        </li>
                        <li>
                            <span class="icon">
                                <svg width="54" height="55" viewBox="0 0 54 55" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 17.825L23.2839 29.3987C24.6229 30.3361 25.2923 30.8046 26.0205 30.9861C26.6636 31.1465 27.3364 31.1465 27.9795 30.9861C28.7077 30.8046 29.3771 30.3361 30.7161 29.3987L47.25 17.825M16.47 44.15H37.53C40.9324 44.15 42.6334 44.15 43.933 43.4878C45.0762 42.9054 46.0054 41.9762 46.5878 40.833C47.25 39.5334 47.25 37.8324 47.25 34.43V21.47C47.25 18.0677 47.25 16.3665 46.5878 15.067C46.0054 13.9239 45.0762 12.9946 43.933 12.4121C42.6334 11.75 40.9324 11.75 37.53 11.75H16.47C13.0677 11.75 11.3665 11.75 10.067 12.4121C8.92392 12.9946 7.99457 13.9239 7.41213 15.067C6.75 16.3665 6.75 18.0677 6.75 21.47V34.43C6.75 37.8324 6.75 39.5334 7.41213 40.833C7.99457 41.9762 8.92392 42.9054 10.067 43.4878C11.3665 44.15 13.0677 44.15 16.47 44.15Z" stroke="white" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </span>
                            <div class="">
                                <p>Send us an email</p>
                                <h3><a href="mailto:info@milliondeliveries.com">info@milliondeliveries.com</a></h3>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>