<?php
/**
 * Template Name: Reviews Page
 *
 * Displays all approved CPD reviews
 *
 * @package WendyNevins
 */

get_header();
?>

<div class="wn-page-header">
    <div class="wn-container">
        <h1 class="wn-page-title"><?php _e('CPD Reviews', 'wendynevins'); ?></h1>
        <p class="wn-page-description"><?php _e('Read what others are saying about our veterinary CPD courses', 'wendynevins'); ?></p>
    </div>
</div>

<div class="wn-container">
    <?php echo do_shortcode('[cpd_reviews_page]'); ?>
</div>

<?php
get_footer();
