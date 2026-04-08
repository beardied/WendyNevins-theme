<?php
/**
 * Template Name: Blank Template
 * Description: Template without header/menu, with footer (no Quick Links)
 *
 * @package WendyNevins
 */

// Output basic HTML structure without header
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class('template-blank'); ?>>
<?php wp_body_open(); ?>

<main id="main-content" class="wn-main wn-blank-main">
    <div class="wn-container">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('wn-page-content'); ?>>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>
