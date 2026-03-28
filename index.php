<?php
/**
 * The main template file
 *
 * @package WendyNevins
 */

get_header();
?>

<?php if (is_front_page() && !is_paged()) : ?>
    <!-- Homepage Content -->
    <div class="wn-container">
        <div class="wn-content-layout">
            
            <div class="wn-primary">
                
                <?php if (have_posts()) : ?>
                    <section class="wn-section">
                        <div class="wn-section-header">
                            <h2 class="wn-section-title"><?php _e('Latest News', 'wendynevins'); ?></h2>
                            <p class="wn-section-description"><?php _e('Stay updated with the latest in veterinary nursing', 'wendynevins'); ?></p>
                        </div>
                        
                        <div class="wn-grid-2">
                            <?php
                            $post_count = 0;
                            while (have_posts() && $post_count < 4) :
                                the_post();
                                $post_count++;
                                ?>
                                
                                <article id="post-<?php the_ID(); ?>" <?php post_class('wn-card'); ?>>
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium_large', array('class' => 'wn-card-image')); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <div class="wn-card-content">
                                        <header>
                                            <h3 class="wn-card-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="wn-card-meta">
                                                <?php echo esc_html(get_the_date()); ?> | <?php the_author(); ?>
                                            </div>
                                        </header>
                                        <div class="wn-card-text">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <div class="wn-card-footer">
                                            <a href="<?php the_permalink(); ?>" class="wn-post-readmore">
                                                <?php _e('Read More', 'wendynevins'); ?>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                                
                            <?php endwhile; ?>
                        </div>
                        
                        <div style="text-align: center; margin-top: 2rem;">
                            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="wn-btn wn-btn-primary">
                                <?php _e('View All News', 'wendynevins'); ?>
                            </a>
                        </div>
                    </section>
                <?php endif; ?>
                
                <!-- Featured Upcoming CPDs Section -->
                <?php if (function_exists('wendynevins_get_upcoming_cpd')) : ?>
                    <section class="wn-section wn-section-alt">
                        <div class="wn-section-header">
                            <h2 class="wn-section-title"><?php _e('Upcoming CPD Courses', 'wendynevins'); ?></h2>
                            <p class="wn-section-description"><?php _e('Don\'t miss these upcoming veterinary nursing courses', 'wendynevins'); ?></p>
                        </div>
                        
                        <div class="wn-grid-3">
                            <?php
                            $upcoming_cpd = wendynevins_get_upcoming_cpd(3);
                            if ($upcoming_cpd->have_posts()) :
                                while ($upcoming_cpd->have_posts()) : $upcoming_cpd->the_post();
                                    ?>
                                    <article class="wn-card">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('medium_large', array('class' => 'wn-card-image')); ?>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <div class="wn-card-content">
                                            <h3 class="wn-card-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="wn-card-meta">
                                                <?php
                                                $start_date = get_post_meta(get_the_ID(), '_cpd_start_date', true);
                                                if ($start_date) {
                                                    echo esc_html(date_i18n('j M Y', strtotime($start_date)));
                                                }
                                                ?>
                                            </div>
                                            <div class="wn-card-text">
                                                <?php the_excerpt(); ?>
                                            </div>
                                            <div class="wn-card-footer">
                                                <a href="<?php the_permalink(); ?>" class="wn-post-readmore">
                                                    <?php _e('View Course', 'wendynevins'); ?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                        
                        <div style="text-align: center; margin-top: 2rem;">
                            <a href="<?php echo esc_url(home_url('/cpd-type/upcoming/')); ?>" class="wn-btn wn-btn-primary">
                                <?php _e('View All Upcoming CPD', 'wendynevins'); ?>
                            </a>
                        </div>
                    </section>
                <?php endif; ?>
                
            </div>
            
            <!-- Sidebar -->
            <aside class="wn-sidebar">
                <?php dynamic_sidebar('sidebar-1'); ?>
                
                <!-- Free CPD Section in Sidebar -->
                <?php if (function_exists('wendynevins_get_free_cpd')) : ?>
                    <div class="widget wn-widget-free-cpd">
                        <h3 class="widget-title"><?php _e('Free CPD', 'wendynevins'); ?></h3>
                        <ul class="wn-free-cpd-list">
                            <?php
                            $free_cpd = wendynevins_get_free_cpd(5);
                            if ($free_cpd->have_posts()) :
                                while ($free_cpd->have_posts()) : $free_cpd->the_post();
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                        <span class="wn-free-badge"><?php _e('Free', 'wendynevins'); ?></span>
                                    </li>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                        <a href="<?php echo esc_url(home_url('/cpd-type/free/')); ?>" class="wn-sidebar-more">
                            <?php _e('View All Free CPD', 'wendynevins'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </aside>
            
        </div>
    </div>

<?php else : ?>
    <!-- Standard Blog Listing -->
    <div class="wn-page-header">
        <div class="wn-container">
            <h1 class="wn-page-title">
                <?php if (is_home()) : ?>
                    <?php single_post_title(); ?>
                <?php else : ?>
                    <?php the_archive_title(); ?>
                <?php endif; ?>
            </h1>
        </div>
    </div>

    <div class="wn-container">
        <div class="wn-content-layout">
            
            <div class="wn-primary">
                
                <?php if (have_posts()) : ?>
                    <div class="wn-grid-2">
                        <?php while (have_posts()) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('wn-card'); ?>>
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
                                            <?php echo esc_html(get_the_date()); ?> | <?php the_author(); ?>
                                        </div>
                                    </header>
                                    <div class="wn-card-text">
                                        <?php the_excerpt(); ?>
                                    </div>
                                    <div class="wn-card-footer">
                                        <a href="<?php the_permalink(); ?>" class="wn-post-readmore">
                                            <?php _e('Read More', 'wendynevins'); ?>
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
                    <p><?php _e('No posts found.', 'wendynevins'); ?></p>
                <?php endif; ?>
                
            </div>
            
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <aside class="wn-sidebar">
                    <?php dynamic_sidebar('sidebar-1'); ?>
                </aside>
            <?php endif; ?>
            
        </div>
    </div>

<?php endif; ?>

<?php
get_footer();
