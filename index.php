<?php
/**
 * The main template file
 *
 * @package WendyNevins
 */

get_header();
?>

<?php if (is_front_page() && !is_paged()) : ?>
    
    <!-- Why Choose Section -->
    <section class="wn-section wn-section-alt">
        <div class="wn-container">
            <div class="wn-section-header wn-animate">
                <h2 class="wn-section-title"><?php _e('Why Choose Wendy Nevins RVN?', 'wendynevins'); ?></h2>
                <p class="wn-section-description"><?php _e('Your trusted partner in veterinary nursing professional development', 'wendynevins'); ?></p>
            </div>
            
            <div class="wn-grid-4">
                <div class="wn-feature wn-animate wn-animate-delay-1">
                    <div class="wn-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                    </div>
                    <h3 class="wn-feature-title"><?php _e('RCVS Accredited', 'wendynevins'); ?></h3>
                    <p class="wn-feature-text"><?php _e('All our CPD courses meet RCVS standards for professional development.', 'wendynevins'); ?></p>
                </div>
                
                <div class="wn-feature wn-animate wn-animate-delay-2">
                    <div class="wn-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3 class="wn-feature-title"><?php _e('Expert Speakers', 'wendynevins'); ?></h3>
                    <p class="wn-feature-text"><?php _e('Learn from industry-leading veterinary professionals and specialists.', 'wendynevins'); ?></p>
                </div>
                
                <div class="wn-feature wn-animate wn-animate-delay-3">
                    <div class="wn-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <h3 class="wn-feature-title"><?php _e('Flexible Learning', 'wendynevins'); ?></h3>
                    <p class="wn-feature-text"><?php _e('Choose from live webinars, in-person events, or on-demand courses.', 'wendynevins'); ?></p>
                </div>
                
                <div class="wn-feature wn-animate wn-animate-delay-4">
                    <div class="wn-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                    </div>
                    <h3 class="wn-feature-title"><?php _e('Practical Skills', 'wendynevins'); ?></h3>
                    <p class="wn-feature-text"><?php _e('Gain hands-on skills you can apply immediately in your practice.', 'wendynevins'); ?></p>
                </div>
            </div>
        </div>
    </section>
    
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
                            <h2 class="wn-section-title"><?php _e('Upcoming CPD', 'wendynevins'); ?></h2>
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
