<?php
/**
 * The template for displaying all single posts
 *
 * @package WendyNevins
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('wn-single-post'); ?>>
    
    <div class="wn-container">
        <div class="wn-content-layout">
            
            <div class="wn-primary">
                
                <?php if (has_post_thumbnail()) : ?>
                    <div class="wn-post-featured-image">
                        <?php the_post_thumbnail('large', array('class' => 'wn-post-featured-img')); ?>
                    </div>
                <?php endif; ?>
                
                <header class="wn-post-header-single wn-animate">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                        ?>
                        <div class="wn-post-categories">
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="wn-post-category">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <h1 class="wn-post-title-single"><?php the_title(); ?></h1>
                    
                    <div class="wn-post-meta-single">
                        <div class="wn-post-meta-author">
                            <?php echo get_avatar(get_the_author_meta('ID'), 48, '', '', array('class' => 'wn-author-avatar')); ?>
                            <div class="wn-author-info">
                                <span class="wn-author-name"><?php the_author(); ?></span>
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date()); ?>
                                </time>
                            </div>
                        </div>
                        
                        <?php if (comments_open()) : ?>
                            <div class="wn-post-meta-comments">
                                <a href="#comments">
                                    <?php
                                    printf(
                                        _n('%s Comment', '%s Comments', get_comments_number(), 'wendynevins'),
                                        number_format_i18n(get_comments_number())
                                    );
                                    ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>
                
                <div class="wn-post-body wn-animate">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="wn-page-links">' . __('Pages:', 'wendynevins'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
                
                <footer class="wn-post-footer-single wn-animate">
                    <?php if (has_tag()) : ?>
                        <div class="wn-post-tags">
                            <span class="wn-tags-label"><?php _e('Tags:', 'wendynevins'); ?></span>
                            <?php the_tags('', '', ''); ?>
                        </div>
                    <?php endif; ?>
                </footer>
                
                <?php
                // Author bio
                if (get_the_author_meta('description')) :
                    ?>
                    <div class="wn-author-bio wn-animate">
                        <div class="wn-author-bio-header">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'wn-author-bio-avatar')); ?>
                            <div class="wn-author-bio-info">
                                <h3 class="wn-author-bio-name">
                                    <?php the_author(); ?>
                                </h3>
                                <?php if (get_the_author_meta('user_url')) : ?>
                                    <a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>" class="wn-author-bio-url" target="_blank" rel="noopener noreferrer">
                                        <?php echo esc_url(get_the_author_meta('user_url')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p><?php echo wp_kses_post(get_the_author_meta('description')); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php
                // Post navigation
                the_post_navigation(array(
                    'prev_text' => '<span class="wn-nav-label">' . __('Previous Article', 'wendynevins') . '</span><span class="wn-nav-title">%title</span>',
                    'next_text' => '<span class="wn-nav-label">' . __('Next Article', 'wendynevins') . '</span><span class="wn-nav-title">%title</span>',
                ));
                ?>
                
                <?php
                // Comments
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            </div>
            
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <aside class="wn-sidebar">
                    <?php dynamic_sidebar('sidebar-1'); ?>
                </aside>
            <?php endif; ?>
            
        </div>
    </div>
</article>

<?php
get_footer();
