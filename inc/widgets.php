<?php
/**
 * Custom Widgets for WendyNevins Theme
 *
 * @package WendyNevins
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Recent Posts Widget with Title
 */
class WendyNevins_Recent_Posts_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'wendynevins_recent_posts',
            __('WN Recent Posts', 'wendynevins'),
            array(
                'description' => __('Displays recent posts with a custom title', 'wendynevins'),
                'classname'   => 'widget_recent_entries',
            )
        );
    }
    
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent Posts', 'wendynevins');
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        
        echo $args['before_widget'];
        
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
        
        $recent_posts = new WP_Query(array(
            'posts_per_page' => $number,
            'post_status'    => 'publish',
        ));
        
        if ($recent_posts->have_posts()) :
            echo '<ul>';
            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
                </li>
                <?php
            endwhile;
            echo '</ul>';
            wp_reset_postdata();
        endif;
        
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $number = !empty($instance['number']) ? absint($instance['number']) : 5;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'wendynevins'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number of posts:', 'wendynevins'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1" max="15" value="<?php echo esc_attr($number); ?>">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        return $instance;
    }
}

/**
 * Search Widget with SVG Icon
 */
class WendyNevins_Search_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'wendynevins_search',
            __('WN Search', 'wendynevins'),
            array(
                'description' => __('Search form with magnifying glass icon', 'wendynevins'),
                'classname'   => 'widget_search',
            )
        );
    }
    
    public function widget($args, $instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        
        echo $args['before_widget'];
        
        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
        ?>
        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <label>
                <span class="screen-reader-text"><?php _e('Search for:', 'wendynevins'); ?></span>
                <input type="search" class="search-field" placeholder="<?php _e('Search...', 'wendynevins'); ?>" value="" name="s" />
            </label>
            <button type="submit" class="search-submit" aria-label="<?php _e('Search', 'wendynevins'); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </form>
        <?php
        echo $args['after_widget'];
    }
    
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'wendynevins'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }
    
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }
}

/**
 * Register Custom Widgets
 */
function wendynevins_register_widgets() {
    register_widget('WendyNevins_Recent_Posts_Widget');
    register_widget('WendyNevins_Search_Widget');
}
add_action('widgets_init', 'wendynevins_register_widgets');
