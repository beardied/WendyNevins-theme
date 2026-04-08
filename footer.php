</main><!-- /.wn-main -->

<footer class="wn-footer">
    <div class="wn-container">
        
        <?php
        // Check if using blank template
        $is_blank_template = is_page_template('template-blank.php');
        ?>
        <div class="wn-footer-grid <?php echo $is_blank_template ? 'wn-footer-no-quicklinks' : ''; ?>">
            
            <?php if (!$is_blank_template) : ?>
            <!-- Quick Links -->
            <div class="wn-footer-col">
                <h4 class="wn-footer-title"><?php _e('Quick Links', 'wendynevins'); ?></h4>
                <ul class="wn-footer-links">
                    <li><a href="<?php echo esc_url(home_url('/cpd-type/upcoming/')); ?>"><?php _e('Upcoming CPD', 'wendynevins'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cpd-type/on-demand/')); ?>"><?php _e('On Demand CPD', 'wendynevins'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cpd-type/free/')); ?>"><?php _e('Free CPD', 'wendynevins'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cpd-category/')); ?>"><?php _e('Categories', 'wendynevins'); ?></a></li>
                </ul>
            </div>
            <?php endif; ?>
            
            <?php if ($is_blank_template) : ?>
            <!-- Empty left column to center the content -->
            <div class="wn-footer-col"></div>
            <?php endif; ?>
            
            <!-- Center Logo/Social -->
            <div class="wn-footer-col wn-footer-center">
                <div class="wn-footer-logo">
                    <span class="wn-footer-logo-title">Wendy Nevins RVN</span>
                    <span class="wn-footer-logo-tagline">REGISTERED VETERINARY NURSE</span>
                </div>
                
                <div class="wn-footer-social">
                    <?php
                    // Get social media links from CPD settings
                    $social_links = [
                        'facebook' => get_option('cpd_social_facebook', ''),
                        'instagram' => get_option('cpd_social_instagram', ''),
                        'twitter' => get_option('cpd_social_twitter', ''),
                        'youtube' => get_option('cpd_social_youtube', ''),
                        'tiktok' => get_option('cpd_social_tiktok', ''),
                        'linkedin' => get_option('cpd_social_linkedin', ''),
                    ];
                    
                    // Social icons SVG
                    $social_icons = [
                        'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
                        'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
                        'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>',
                        'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>',
                        'tiktok' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path></svg>',
                        'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
                    ];
                    
                    // Display only filled social links
                    foreach ($social_links as $platform => $url) {
                        if (!empty($url)) {
                            echo '<a href="' . esc_url($url) . '" class="wn-social-link" aria-label="' . esc_attr(ucfirst($platform)) . '" target="_blank" rel="noopener noreferrer">';
                            echo $social_icons[$platform];
                            echo '</a>';
                        }
                    }
                    ?>
                </div>
            </div>
            
            <!-- Contact -->
            <div class="wn-footer-col wn-footer-right">
                <h4 class="wn-footer-title"><?php _e('Contact', 'wendynevins'); ?></h4>
                <p class="wn-footer-contact">
                    <?php
                    $footer_email = get_option('cpd_footer_email', '');
                    if (!empty($footer_email)) {
                        echo '<a href="mailto:' . esc_attr($footer_email) . '">' . esc_html($footer_email) . '</a>';
                    } else {
                        echo '<a href="mailto:info@wendynevins.com">info@wendynevins.com</a>';
                    }
                    ?>
                </p>
            </div>
            
        </div>
        
        <div class="wn-footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'wendynevins'); ?></p>
        </div>
        
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
