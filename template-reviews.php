<?php
/**
 * Template Name: Reviews Page
 *
 * Displays all approved CPD reviews
 *
 * @package WendyNevins
 */

get_header();

// Get overall stats
$overall_average = VET_CPD_Reviews::get_overall_average_rating();
$total_reviews = VET_CPD_Reviews::get_total_review_count();

// Get reviews for distribution chart
$distribution = [];
for ($i = 5; $i >= 1; $i--) {
    $distribution[$i] = VET_CPD_Reviews::get_reviews_by_rating($i);
}
$max_count = max($distribution);
?>

<div class="wn-reviews-hero">
    <div class="wn-container">
        <h1 class="wn-reviews-hero-title"><?php _e('CPD Reviews', 'wendynevins'); ?></h1>
        <p class="wn-reviews-hero-desc"><?php _e('Real feedback from veterinary professionals', 'wendynevins'); ?></p>
        
        <?php if ($overall_average && $total_reviews) : ?>
        <div class="wn-reviews-hero-stats">
            <div class="wn-reviews-big-rating">
                <span class="wn-reviews-number"><?php echo number_format($overall_average, 1); ?></span>
                <span class="wn-reviews-outof">/5</span>
            </div>
            <div class="wn-reviews-stars"><?php echo str_repeat('★', round($overall_average)); ?></div>
            <div class="wn-reviews-count">Based on <?php echo $total_reviews; ?> review<?php echo $total_reviews !== 1 ? 's' : ''; ?></div>
        </div>
        
        <!-- Rating Distribution -->
        <div class="wn-reviews-distribution">
            <?php for ($i = 5; $i >= 1; $i--) : 
                $count = $distribution[$i];
                $percentage = $total_reviews > 0 ? round(($count / $total_reviews) * 100) : 0;
                $bar_width = $max_count > 0 ? round(($count / $max_count) * 100) : 0;
            ?>
            <div class="wn-reviews-bar-row">
                <span class="wn-reviews-bar-label"><?php echo $i; ?> ★</span>
                <div class="wn-reviews-bar-bg">
                    <div class="wn-reviews-bar-fill" style="width: <?php echo $bar_width; ?>%"></div>
                </div>
                <span class="wn-reviews-bar-count"><?php echo $count; ?></span>
            </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="wn-container wn-reviews-main">
    <?php echo do_shortcode('[cpd_reviews_page]'); ?>
</div>

<?php
get_footer();
