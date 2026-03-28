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

<header class="wn-header">
    <div class="wn-container">
        <div class="wn-header-inner">
            
            <!-- Logo -->
            <div class="wn-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <span class="wn-logo-title"><?php bloginfo('name'); ?></span>
                    <?php if (get_bloginfo('description')) : ?>
                        <span class="wn-logo-tagline"><?php bloginfo('description'); ?></span>
                    <?php endif; ?>
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
    <!-- Hero Section for Homepage -->
    <section class="wn-hero">
        <div class="wn-hero-bg">
            <?php if (get_header_image()) : ?>
                <img src="<?php echo esc_url(get_header_image()); ?>" alt="" />
            <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-default.jpg'); ?>" alt="" />
            <?php endif; ?>
        </div>
        <div class="wn-hero-overlay"></div>
        <div class="wn-hero-content">
            <div class="wn-container">
                <div class="wn-hero-inner wn-animate">
                    <h1 class="wn-hero-title">
                        <?php 
                        $hero_title = get_theme_mod('hero_title', __('Welcome to Wendy Nevins RVN', 'wendynevins'));
                        echo esc_html($hero_title);
                        ?>
                    </h1>
                    <p class="wn-hero-description">
                        <?php 
                        $hero_description = get_theme_mod('hero_description', __('Your trusted source for veterinary nursing CPD courses. Advance your career with expert-led training designed for RVNs.', 'wendynevins'));
                        echo esc_html($hero_description);
                        ?>
                    </p>
                    <div class="wn-hero-actions">
                        <a href="<?php echo esc_url(get_theme_mod('hero_button_url', '/cpd-type/upcoming/')); ?>" class="wn-btn wn-btn-primary">
                            <?php echo esc_html(get_theme_mod('hero_button_text', __('Browse CPD Courses', 'wendynevins'))); ?>
                        </a>
                        <a href="<?php echo esc_url(get_theme_mod('hero_button2_url', '/cpd-type/free/')); ?>" class="wn-btn wn-btn-outline">
                            <?php echo esc_html(get_theme_mod('hero_button2_text', __('Free CPD', 'wendynevins'))); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<main id="main-content" class="wn-main">
