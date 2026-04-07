<?php
/**
 * Template Name: Contact Page
 *
 * @package WendyNevins
 */

get_header();

// Handle form submission
$form_submitted = false;
$form_error = false;
$form_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wn_contact_submit'])) {
    // Verify nonce
    if (!isset($_POST['wn_contact_nonce']) || !wp_verify_nonce($_POST['wn_contact_nonce'], 'wn_contact_form')) {
        $form_error = true;
        $form_message = __('Security check failed. Please try again.', 'wendynevins');
    } else {
        // Hidden honeypot field check (spam prevention)
        if (!empty($_POST['wn_website'])) {
            // Bot detected - pretend success but don't send
            $form_submitted = true;
            $form_message = __('Thank you for your message. We will get back to you soon.', 'wendynevins');
        } else {
            // Process form
            $name = sanitize_text_field($_POST['wn_name'] ?? '');
            $email = sanitize_email($_POST['wn_email'] ?? '');
            $subject = sanitize_text_field($_POST['wn_subject'] ?? '');
            $message = sanitize_textarea_field($_POST['wn_message'] ?? '');
            
            // Validation
            if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                $form_error = true;
                $form_message = __('Please fill in all required fields.', 'wendynevins');
            } elseif (!is_email($email)) {
                $form_error = true;
                $form_message = __('Please enter a valid email address.', 'wendynevins');
            } else {
                // Get recipient email from CPD settings
                $recipient = get_option('cpd_contact_email', get_option('admin_email'));
                
                // Build email
                $email_subject = sprintf(__('Contact Form: %s', 'wendynevins'), $subject);
                $email_body = sprintf(
                    __("Name: %s\nEmail: %s\nSubject: %s\n\nMessage:\n%s\n\n---\nSent from: %s", 'wendynevins'),
                    $name,
                    $email,
                    $subject,
                    $message,
                    get_bloginfo('name')
                );
                $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');
                
                // Send email
                $sent = wp_mail($recipient, $email_subject, $email_body, $headers);
                
                if ($sent) {
                    $form_submitted = true;
                    $form_message = __('Thank you for your message. We will get back to you soon.', 'wendynevins');
                } else {
                    $form_error = true;
                    $form_message = __('Sorry, there was an error sending your message. Please try again later.', 'wendynevins');
                }
            }
        }
    }
}
?>

<div class="wn-page-header">
    <div class="wn-container">
        <h1 class="wn-page-title"><?php the_title(); ?></h1>
        <?php if (get_the_excerpt()) : ?>
            <p class="wn-page-description"><?php echo esc_html(get_the_excerpt()); ?></p>
        <?php endif; ?>
    </div>
</div>

<div class="wn-container">
    <div class="wn-content-layout">
        
        <div class="wn-primary">
            <div class="wn-page-body">
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                ?>
                
                <!-- Contact Form -->
                <div class="wn-contact-form-wrapper">
                    <?php if ($form_submitted || $form_error) : ?>
                        <div class="wn-alert <?php echo $form_error ? 'wn-alert-error' : 'wn-alert-success'; ?>" style="
                            padding: 1rem 1.5rem;
                            border-radius: var(--radius-lg);
                            margin-bottom: 1.5rem;
                            <?php echo $form_error ? 'background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;' : 'background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0;'; ?>
                        ">
                            <?php echo esc_html($form_message); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!$form_submitted) : ?>
                        <form method="post" action="" class="wn-contact-form" style="
                            background: var(--color-background);
                            padding: 2rem;
                            border-radius: var(--radius-xl);
                            box-shadow: var(--shadow-md);
                        ">
                            <?php wp_nonce_field('wn_contact_form', 'wn_contact_nonce'); ?>
                            
                            <!-- Honeypot field - hidden from real users -->
                            <div style="position: absolute; left: -9999px;" aria-hidden="true">
                                <input type="text" name="wn_website" tabindex="-1" autocomplete="off">
                            </div>
                            
                            <div class="wn-form-row" style="margin-bottom: 1.5rem;">
                                <label for="wn_name" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--color-text);">
                                    <?php _e('Your Name', 'wendynevins'); ?> <span style="color: #dc2626;">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="wn_name" 
                                    name="wn_name" 
                                    required
                                    style="
                                        width: 100%;
                                        padding: 0.875rem 1rem;
                                        border: 2px solid var(--color-border);
                                        border-radius: var(--radius-md);
                                        font-size: var(--font-size-base);
                                        transition: border-color var(--transition-fast);
                                    "
                                    onfocus="this.style.borderColor='var(--color-primary)'"
                                    onblur="this.style.borderColor='var(--color-border)'"
                                >
                            </div>
                            
                            <div class="wn-form-row" style="margin-bottom: 1.5rem;">
                                <label for="wn_email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--color-text);">
                                    <?php _e('Your Email', 'wendynevins'); ?> <span style="color: #dc2626;">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="wn_email" 
                                    name="wn_email" 
                                    required
                                    style="
                                        width: 100%;
                                        padding: 0.875rem 1rem;
                                        border: 2px solid var(--color-border);
                                        border-radius: var(--radius-md);
                                        font-size: var(--font-size-base);
                                        transition: border-color var(--transition-fast);
                                    "
                                    onfocus="this.style.borderColor='var(--color-primary)'"
                                    onblur="this.style.borderColor='var(--color-border)'"
                                >
                            </div>
                            
                            <div class="wn-form-row" style="margin-bottom: 1.5rem;">
                                <label for="wn_subject" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--color-text);">
                                    <?php _e('Subject', 'wendynevins'); ?> <span style="color: #dc2626;">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="wn_subject" 
                                    name="wn_subject" 
                                    required
                                    style="
                                        width: 100%;
                                        padding: 0.875rem 1rem;
                                        border: 2px solid var(--color-border);
                                        border-radius: var(--radius-md);
                                        font-size: var(--font-size-base);
                                        transition: border-color var(--transition-fast);
                                    "
                                    onfocus="this.style.borderColor='var(--color-primary)'"
                                    onblur="this.style.borderColor='var(--color-border)'"
                                >
                            </div>
                            
                            <div class="wn-form-row" style="margin-bottom: 1.5rem;">
                                <label for="wn_message" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--color-text);">
                                    <?php _e('Your Message', 'wendynevins'); ?> <span style="color: #dc2626;">*</span>
                                </label>
                                <textarea 
                                    id="wn_message" 
                                    name="wn_message" 
                                    rows="6" 
                                    required
                                    style="
                                        width: 100%;
                                        padding: 0.875rem 1rem;
                                        border: 2px solid var(--color-border);
                                        border-radius: var(--radius-md);
                                        font-size: var(--font-size-base);
                                        font-family: var(--font-body);
                                        resize: vertical;
                                        transition: border-color var(--transition-fast);
                                    "
                                    onfocus="this.style.borderColor='var(--color-primary)'"
                                    onblur="this.style.borderColor='var(--color-border)'"
                                ></textarea>
                            </div>
                            
                            <div class="wn-form-row">
                                <button 
                                    type="submit" 
                                    name="wn_contact_submit" 
                                    class="wn-btn wn-btn-primary"
                                    style="width: 100%;"
                                >
                                    <?php _e('Send Message', 'wendynevins'); ?>
                                </button>
                            </div>
                            
                            <p style="margin-top: 1rem; font-size: var(--font-size-sm); color: var(--color-text-muted);">
                                <span style="color: #dc2626;">*</span> <?php _e('Required fields', 'wendynevins'); ?>
                            </p>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
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
