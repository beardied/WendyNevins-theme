<?php
/**
 * The template for displaying all pages
 *
 * @package WendyNevins
 */

get_header();
?>

<?php if (!has_post_thumbnail()) : ?>
    <div class="wn-page-header wn-animate">
        <div class="wn-container">
            <h1 class="wn-page-title"><?php the_title(); ?></h1>
        </div>
    </div>
<?php else : ?>
    <div class="wn-hero wn-hero-small">
        <div class="wn-hero-bg">
            <?php the_post_thumbnail('full', array('class' => 'wn-hero-image')); ?>
        </div>
        <div class="wn-hero-overlay"></div>
        <div class="wn-hero-content">
            <div class="wn-container">
                <h1 class="wn-hero-title"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            
            <?php
            while (have_posts()) :
                the_post();
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('wn-page-content wn-animate'); ?>>
                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="wn-page-links">' . __('Pages:', 'wendynevins'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </article>
                
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                
            endwhile;
            ?>
            
        </div>
        
        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <aside class="wn-sidebar">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
        <?php endif; ?>
        
    </div>
</div>

<?php
get_footer();
