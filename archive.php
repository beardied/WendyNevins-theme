<?php
/**
 * The template for displaying archive pages
 *
 * @package WendyNevins
 */

get_header();
?>

<div class="wn-page-header wn-animate">
    <div class="wn-container">
        <?php
        the_archive_title('<h1 class="wn-page-title">', '</h1>');
        the_archive_description('<p class="wn-page-description">', '</p>');
        ?>
    </div>
</div>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            
            <?php if (have_posts()) : ?>
                
                <div class="wn-grid-2">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('wn-card wn-animate'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'wn-card-image')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="wn-card-content">
                                <header>
                                    <h2 class="wn-card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <div class="wn-card-meta">
                                        <?php echo esc_html(get_the_date()); ?>
                                    </div>
                                </header>
                                <div class="wn-card-text">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="wn-card-footer">
                                    <a href="<?php the_permalink(); ?>" class="wn-post-readmore">
                                        <?php _e('Read Article', 'wendynevins'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <div class="wn-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => __('Previous', 'wendynevins'),
                        'next_text' => __('Next', 'wendynevins'),
                    ));
                    ?>
                </div>
                
            <?php else : ?>
                
                <div class="wn-no-posts wn-animate">
                    <h2><?php _e('Nothing Found', 'wendynevins'); ?></h2>
                    <p><?php _e('It seems we can\'t find what you\'re looking for.', 'wendynevins'); ?></p>
                </div>
                
            <?php endif; ?>
            
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
