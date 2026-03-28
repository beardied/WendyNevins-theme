</main><!-- /.wn-main -->

<footer class="wn-footer">
    <div class="wn-container">
        
        <div class="wn-footer-grid">
            
            <!-- Footer Widget Column 1 -->
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="wn-footer-widget">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Footer Widget Column 2 -->
            <?php if (is_active_sidebar('footer-2')) : ?>
                <div class="wn-footer-widget">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Footer Widget Column 3 -->
            <?php if (is_active_sidebar('footer-3')) : ?>
                <div class="wn-footer-widget">
                    <?php dynamic_sidebar('footer-3'); ?>
                </div>
            <?php endif; ?>
            
            <!-- Footer Widget Column 4 -->
            <?php if (is_active_sidebar('footer-4')) : ?>
                <div class="wn-footer-widget">
                    <?php dynamic_sidebar('footer-4'); ?>
                </div>
            <?php endif; ?>
            
        </div>
        
        <div class="wn-footer-bottom">
            <div class="wn-footer-copyright">
                <?php
                printf(
                    /* translators: %1$s: current year, %2$s: site name */
                    esc_html__('© %1$s %2$s. All rights reserved.', 'wendynevins'),
                    esc_html(date_i18n('Y')),
                    esc_html(get_bloginfo('name'))
                );
                ?>
            </div>
            
            <?php if (has_nav_menu('footer')) : ?>
                <nav class="wn-footer-nav" aria-label="<?php _e('Footer Menu', 'wendynevins'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'footer',
                        'menu_class'      => 'wn-footer-menu',
                        'container'       => false,
                        'depth'           => 1,
                    ));
                    ?>
                </nav>
            <?php endif; ?>
        </div>
        
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
