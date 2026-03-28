<?php
/**
 * The template for displaying search results pages
 *
 * @package WendyNevins
 */

get_header();
?>

<div class="wn-page-header wn-animate">
    <div class="wn-container">
        <h1 class="wn-page-title">
            <?php
            printf(
                /* translators: %s: search query. */
                esc_html__('Search Results for: %s', 'wendynevins'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        <p class="wn-page-description">
            <?php
            printf(
                /* translators: %s: number of results */
                esc_html(_n('Found %s result', 'Found %s results', (int) $wp_query->found_posts, 'wendynevins')),
                number_format_i18n($wp_query->found_posts)
            );
            ?>
        </p>
    </div>
</div>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            
            <?php if (have_posts()) : ?>
                
                <div class="wn-posts-grid">
                    <?php
                    $post_count = 0;
                    while (have_posts()) :
                        the_post();
                        $post_count++;
                        $animation_delay = ($post_count % 4) + 1;
                        ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('wn-post-card wn-animate wn-animate-delay-' . $animation_delay); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="wn-post-thumbnail-link" aria-hidden="true" tabindex="-1">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'wn-post-thumbnail')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="wn-post-content">
                                <header class="wn-post-header">
                                    <h2 class="wn-post-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <div class="wn-post-meta">
                                        <span class="wn-post-type"><?php echo esc_html(get_post_type_object(get_post_type())->label); ?></span>
                                        <span class="wn-post-meta-sep">|</span>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date()); ?>
                                        </time>
                                    </div>
                                </header>
                                
                                <div class="wn-post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="wn-post-footer">
                                    <a href="<?php the_permalink(); ?>" class="wn-post-readmore">
                                        <?php _e('View Result', 'wendynevins'); ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                    </a>
                                </footer>
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <div class="wn-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg> ' . __('Previous', 'wendynevins'),
                        'next_text' => __('Next', 'wendynevins') . ' <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    ));
                    ?>
                </div>
                
            <?php else : ?>
                
                <div class="wn-no-posts wn-animate">
                    <h2><?php _e('No Results Found', 'wendynevins'); ?></h2>
                    <p><?php _e('We couldn\'t find any results for your search. Try different keywords or browse our categories.', 'wendynevins'); ?></p>
                    <?php get_search_form(); ?>
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
