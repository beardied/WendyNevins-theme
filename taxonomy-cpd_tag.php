<?php
/**
 * Template for CPD Tag pages (upcoming, on-demand, free)
 *
 * @package WendyNevins
 */

get_header();

$term = get_queried_object();
?>

<div class="wn-page-header wn-animate">
    <div class="wn-container">
        <h1 class="wn-page-title"><?php echo esc_html($term->name); ?> <?php _e('CPD', 'wendynevins'); ?></h1>
        <?php if ($term->description) : ?>
            <p class="wn-page-description"><?php echo esc_html($term->description); ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            
            <?php if (have_posts()) : ?>
                
                <div class="wn-grid-3">
                    <?php while (have_posts()) : the_post(); 
                        $event_id = get_the_ID();
                        $start_date = get_post_meta($event_id, '_cpd_start_date', true);
                        $cost = get_post_meta($event_id, '_cpd_cost', true);
                        $currency = get_post_meta($event_id, '_cpd_currency', true) ?: 'GBP';
                    ?>
                        
                        <article class="wn-card wn-animate">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', array('class' => 'wn-card-image')); ?>
                                </a>
                            <?php endif; ?>
                            
                            <div class="wn-card-content">
                                <h2 class="wn-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="wn-card-meta">
                                    <?php if ($start_date) : ?>
                                        <span class="wn-event-date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            <?php echo esc_html(date_i18n('j M Y', strtotime($start_date))); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="wn-card-text">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </div>
                                
                                <div class="wn-card-footer">
                                    <div class="wn-event-price">
                                        <?php if ($cost !== '' && $cost !== '0') : 
                                            $symbol = $currency === 'GBP' ? '£' : ($currency === 'EUR' ? '€' : '$');
                                            echo esc_html($symbol . $cost);
                                        else : ?>
                                            <span class="wn-free-text"><?php _e('Free', 'wendynevins'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" class="wn-btn wn-btn-small wn-btn-primary">
                                        <?php _e('View Course', 'wendynevins'); ?>
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
                    <h2><?php _e('No CPD Events Found', 'wendynevins'); ?></h2>
                    <p><?php _e('There are currently no events in this category.', 'wendynevins'); ?></p>
                </div>
                
            <?php endif; ?>
            
        </div>
        
        <aside class="wn-sidebar">
            <div class="widget">
                <h3 class="widget-title"><?php _e('CPD Categories', 'wendynevins'); ?></h3>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/cpd-type/upcoming/')); ?>"><?php _e('Upcoming CPD', 'wendynevins'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cpd-type/on-demand/')); ?>"><?php _e('On Demand CPD', 'wendynevins'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cpd-type/free/')); ?>"><?php _e('Free CPD', 'wendynevins'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/cpd-category/')); ?>"><?php _e('All Categories', 'wendynevins'); ?></a></li>
                </ul>
            </div>
            
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <?php dynamic_sidebar('sidebar-1'); ?>
            <?php endif; ?>
        </aside>
        
    </div>
</div>

<?php
get_footer();
