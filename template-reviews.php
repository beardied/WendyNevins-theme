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

// Get reviews for pagination
$per_page = 9;
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $per_page;

// Get reviews
$reviews = VET_CPD_Reviews::get_all_reviews('approved', $per_page, $offset);
$total_pages = ceil($total_reviews / $per_page);

// Get distribution for chart
$distribution = [];
for ($i = 5; $i >= 1; $i--) {
    $distribution[$i] = VET_CPD_Reviews::get_reviews_by_rating($i);
}
$max_count = max($distribution) ?: 1;
?>

<!-- Hero Section -->
<div class="wn-reviews-hero">
    <div class="wn-container">
        <h1 class="wn-reviews-hero-title">CPD Reviews</h1>
        <p class="wn-reviews-hero-desc">Real feedback from veterinary professionals</p>
    </div>
</div>

<!-- Stats Section -->
<div class="wn-reviews-stats">
    <div class="wn-container">
        <div class="wn-reviews-stats-grid">
            
            <!-- Big Rating -->
            <div class="wn-reviews-stats-main">
                <div class="wn-reviews-big-number"><?php echo number_format($overall_average, 1); ?></div>
                <div class="wn-reviews-big-stars"><?php echo str_repeat('★', round($overall_average)); ?></div>
                <div class="wn-reviews-total">Based on <?php echo $total_reviews; ?> review<?php echo $total_reviews !== 1 ? 's' : ''; ?></div>
            </div>
            
            <!-- Distribution Bars -->
            <div class="wn-reviews-bars">
                <?php for ($i = 5; $i >= 1; $i--) : 
                    $count = $distribution[$i];
                    $percentage = $total_reviews > 0 ? round(($count / $total_reviews) * 100) : 0;
                    $bar_width = round(($count / $max_count) * 100);
                ?>
                <div class="wn-reviews-bar">
                    <span class="wn-reviews-bar-star"><?php echo $i; ?> ★</span>
                    <div class="wn-reviews-bar-track">
                        <div class="wn-reviews-bar-fill" style="width: <?php echo $bar_width; ?>%"></div>
                    </div>
                    <span class="wn-reviews-bar-num"><?php echo $count; ?></span>
                </div>
                <?php endfor; ?>
            </div>
            
        </div>
    </div>
</div>

<!-- Reviews Grid -->
<div class="wn-reviews-grid-section">
    <div class="wn-container">
        <?php if (empty($reviews)) : ?>
            <div class="wn-reviews-empty">
                <div class="wn-reviews-empty-icon">⭐</div>
                <h2>No Reviews Yet</h2>
                <p>Be the first to leave a review on one of our CPD courses!</p>
            </div>
        <?php else : ?>
            <div class="wn-reviews-tiles">
                <?php foreach ($reviews as $review) : 
                    $cpd_link = get_permalink($review->cpd_event_id);
                ?>
                    <div class="wn-review-tile">
                        <div class="wn-review-tile-header">
                            <div class="wn-review-tile-stars"><?php echo str_repeat('★', $review->star_rating); ?></div>
                            <div class="wn-review-tile-date"><?php echo date_i18n('j M Y', strtotime($review->created_at)); ?></div>
                        </div>
                        <div class="wn-review-tile-body">
                            <p>"<?php echo esc_html(wp_trim_words($review->review_comment, 25)); ?>"</p>
                        </div>
                        <div class="wn-review-tile-footer">
                            <div class="wn-review-tile-author">
                                <span class="wn-review-tile-avatar"><?php echo esc_html(substr($review->reviewer_name, 0, 1)); ?></span>
                                <span class="wn-review-tile-name"><?php echo esc_html($review->reviewer_name); ?></span>
                            </div>
                            <a href="<?php echo esc_url($cpd_link); ?>" class="wn-review-tile-cpd"><?php echo esc_html($review->cpd_title); ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if ($total_pages > 1) : ?>
                <div class="wn-reviews-pagination">
                    <?php
                    echo paginate_links([
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'format' => '?paged=%#%',
                        'current' => $paged,
                        'total' => $total_pages,
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                    ]);
                    ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
