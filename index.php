<?php
/**
 * The main template file
 *
 * @package WendyNevins
 */

get_header();
?>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            
            <?php if (have_posts()) : ?>
                
                <?php if (is_home() && !is_front_page()) : ?>
                    <header class="wn-page-header wn-animate">
                        <h1 class="wn-page-title"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>
                
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
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) :
                                        ?>
                                        <div class="wn-post-categories">
                                            <?php foreach (array_slice($categories, 0, 2) as $category) : ?>
                                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="wn-post-category">
                                                    <?php echo esc_html($category->name); ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h2 class="wn-post-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    
                                    <div class="wn-post-meta">
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date()); ?>
                                        </time>
                                        <span class="wn-post-meta-sep">|</span>
                                        <span class="wn-post-author">
                                            <?php the_author(); ?>
                                        </span>
                                    </div>
                                </header>
                                
                                <div class="wn-post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer class="wn-post-footer">
                                    <a href="<?php the_permalink(); ?>" class="wn-post-readmore">
                                        <?php _e('Read Article', 'wendynevins'); ?>
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
                    <h2><?php _e('Nothing Found', 'wendynevins'); ?></h2>
                    <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'wendynevins'); ?></p>
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
