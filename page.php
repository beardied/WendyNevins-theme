<?php
/**
 * The template for displaying all pages
 *
 * @package WendyNevins
 */

get_header();
?>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            
            <?php
            while (have_posts()) :
                the_post();
                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('wn-page-content'); ?>>
                    
                    <?php if (!has_post_thumbnail()) : ?>
                        <header class="wn-page-header-simple wn-animate">
                            <h1 class="wn-page-title"><?php the_title(); ?></h1>
                        </header>
                    <?php else : ?>
                        <div class="wn-page-hero wn-animate">
                            <?php the_post_thumbnail('full', array('class' => 'wn-page-hero-image')); ?>
                            <div class="wn-page-hero-content">
                                <h1 class="wn-page-title"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="wn-page-body wn-animate">
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
                // If comments are open or we have at least one comment, load up the comment template.
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
