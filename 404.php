<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WendyNevins
 */

get_header();
?>

<div class="wn-error-page">
    <div class="wn-container">
        
        <div class="wn-error-content wn-animate">
            <div class="wn-error-code">404</div>
            
            <h1 class="wn-error-title"><?php _e('Page Not Found', 'wendynevins'); ?></h1>
            
            <p class="wn-error-message">
                <?php _e('Oops! The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'wendynevins'); ?>
            </p>
            
            <div class="wn-error-search">
                <h2><?php _e('Try Searching', 'wendynevins'); ?></h2>
                <?php get_search_form(); ?>
            </div>
            
            <div class="wn-error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="wn-btn wn-btn-primary">
                    <?php _e('Back to Homepage', 'wendynevins'); ?>
                </a>
            </div>
            
            <div class="wn-error-help">
                <h3><?php _e('Popular Links', 'wendynevins'); ?></h3>
                <nav class="wn-error-nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'  => 'primary',
                        'menu_class'      => 'wn-error-menu',
                        'container'       => false,
                        'depth'           => 1,
                    ));
                    ?>
                </nav>
            </div>
        </div>
        
    </div>
</div>

<?php
get_footer();
