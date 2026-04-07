<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a href="#main-content" class="skip-link"><?php _e('Skip to main content', 'wendynevins'); ?></a>

<?php
// Get header styling settings from CPD
$header_title_size = get_option('cpd_header_title_size', '30');
$header_title_color = get_option('cpd_header_title_color', '#ffffff');
$header_tagline_size = get_option('cpd_header_tagline_size', '12');
$header_tagline_color = get_option('cpd_header_tagline_color', 'rgba(255,255,255,0.9)');
?>
<header class="wn-header">
    <div class="wn-container">
        <div class="wn-header-inner">
            
            <!-- Logo -->
            <div class="wn-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <span class="wn-logo-title" style="font-size: <?php echo esc_attr($header_title_size); ?>px; color: <?php echo esc_attr($header_title_color); ?>;">Wendy Nevins RVN</span>
                    <span class="wn-logo-tagline" style="font-size: <?php echo esc_attr($header_tagline_size); ?>px; color: <?php echo esc_attr($header_tagline_color); ?>;">REGISTERED VETERINARY NURSE</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="wn-nav" aria-label="<?php _e('Primary Menu', 'wendynevins'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location'  => 'primary',
                    'menu_class'      => 'wn-nav-list',
                    'container'       => false,
                    'fallback_cb'     => false,
                    'depth'           => 2,
                ));
                ?>
            </nav>
            
            <!-- Mobile Menu Toggle -->
            <button 
                class="wn-menu-toggle" 
                aria-expanded="false" 
                aria-controls="mobile-nav"
                aria-label="<?php _e('Toggle navigation menu', 'wendynevins'); ?>"
            >
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
            
        </div>
    </div>
    
    <!-- Mobile Navigation -->
    <nav 
        id="mobile-nav" 
        class="wn-mobile-nav" 
        aria-label="<?php _e('Mobile Menu', 'wendynevins'); ?>"
    >
        <?php
        wp_nav_menu(array(
            'theme_location'  => 'primary',
            'menu_class'      => 'wn-mobile-nav-list',
            'container'       => false,
            'fallback_cb'     => false,
            'depth'           => 2,
        ));
        ?>
    </nav>
</header>

<?php if (is_front_page() && !is_paged()) : ?>
    <?php
    // Get hero settings
    $hero_image_id = get_option('cpd_hero_image', 0);
    $hero_overlay_opacity = get_option('cpd_hero_overlay_opacity', '85');
    $hero_overlay_color = get_option('cpd_hero_overlay_color', '#0d8f4f');
    
    // Get hero image URL
    if ($hero_image_id) {
        $hero_image_url = wp_get_attachment_url($hero_image_id);
    } elseif (get_header_image()) {
        $hero_image_url = get_header_image();
    } else {
        $hero_image_url = get_template_directory_uri() . '/assets/images/hero-default.jpg';
    }
    
    // Convert hex color to RGB for gradient
    $hex = ltrim($hero_overlay_color, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    // Calculate opacity - ensure 0 = fully transparent, 100 = fully opaque
    $base_opacity = max(0, min(100, intval($hero_overlay_opacity))) / 100;
    
    // Calculate RGBA values for gradient (all using same opacity for true transparency control)
    $opacity_value = $base_opacity;
    ?>
    <!-- Hero Section for Homepage -->
    <section class="wn-hero" style="background: transparent;">
        <div class="wn-hero-bg">
            <img src="<?php echo esc_url($hero_image_url); ?>" alt="" style="opacity: 1;" />
        </div>
        <div class="wn-hero-overlay" style="background: linear-gradient(135deg, rgba(<?php echo "$r,$g,$b,$opacity_value"; ?>) 0%, rgba(<?php echo "$r,$g,$b,$opacity_value"; ?>) 50%, rgba(<?php echo "$r,$g,$b,$opacity_value"; ?>) 100%);"></div>
        <div class="wn-hero-content">
            <div class="wn-container">
                <div class="wn-hero-inner wn-animate">
                    <h1 class="wn-hero-title"><?php _e('Wendy Nevins RVN', 'wendynevins'); ?></h1>
                    <p class="wn-hero-description"><?php _e('Discover expertly curated courses, workshops and webinars tailored for Veterinary Nurses to elevate clinical knowledge and professional growth.', 'wendynevins'); ?></p>
                    <div class="wn-hero-actions">
                        <a href="<?php echo esc_url(home_url('/cpd-type/upcoming/')); ?>" class="wn-btn wn-btn-primary">
                            <?php _e('Upcoming CPD', 'wendynevins'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/cpd-type/on-demand/')); ?>" class="wn-btn wn-btn-secondary">
                            <?php _e('On Demand CPD', 'wendynevins'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/cpd-type/free/')); ?>" class="wn-btn wn-btn-outline">
                            <?php _e('Free CPD', 'wendynevins'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<main id="main-content" class="wn-main">
