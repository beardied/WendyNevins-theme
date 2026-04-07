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
                
                // Build styled HTML email
                $email_subject = sprintf(__('Contact Form: %s', 'wendynevins'), $subject);
                
                $site_name = get_bloginfo('name');
                $site_url = home_url();
                $current_date = date_i18n(get_option('date_format') . ' ' . get_option('time_format'));
                
                $email_body = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f7fafc;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 40px 20px;">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; width: 100%; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0d8f4f 0%, #0a8043 100%); padding: 30px 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: 600;">New Contact Form Message</h1>
                            <p style="color: rgba(255,255,255,0.9); margin: 10px 0 0 0; font-size: 14px;">{$site_name}</p>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="color: #4a5568; font-size: 16px; line-height: 1.6; margin: 0 0 25px 0;">You have received a new message from your website contact form.</p>
                            
                            <!-- Sender Details -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background: #f7fafc; border-radius: 8px; margin-bottom: 25px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h2 style="color: #0d8f4f; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 15px 0;">Sender Details</h2>
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="padding: 8px 0; color: #718096; font-size: 14px; width: 100px;"><strong>Name:</strong></td>
                                                <td style="padding: 8px 0; color: #1a1a1a; font-size: 14px;">{$name}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; color: #718096; font-size: 14px;"><strong>Email:</strong></td>
                                                <td style="padding: 8px 0; color: #1a1a1a; font-size: 14px;"><a href="mailto:{$email}" style="color: #0d8f4f; text-decoration: none;">{$email}</a></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; color: #718096; font-size: 14px;"><strong>Subject:</strong></td>
                                                <td style="padding: 8px 0; color: #1a1a1a; font-size: 14px;">{$subject}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 8px 0; color: #718096; font-size: 14px;"><strong>Date:</strong></td>
                                                <td style="padding: 8px 0; color: #1a1a1a; font-size: 14px;">{$current_date}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Message -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-left: 4px solid #0d8f4f; background: #f0fdf4; border-radius: 0 8px 8px 0;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <h2 style="color: #0d8f4f; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 15px 0;">Message</h2>
                                        <p style="color: #1a1a1a; font-size: 15px; line-height: 1.7; margin: 0; white-space: pre-wrap;">{$message}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="background: #f7fafc; padding: 20px 40px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="color: #718096; font-size: 12px; margin: 0;">This email was sent from the contact form on <a href="{$site_url}" style="color: #0d8f4f; text-decoration: none;">{$site_name}</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
                
                $headers = array(
                    'Content-Type: text/html; charset=UTF-8',
                    'From: ' . $name . ' <' . $email . '>'
                );
                
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
                        " autocomplete="on">
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
                                    autocomplete="name"
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
                                    autocomplete="email"
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
                                    autocomplete="off"
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
                                    autocomplete="off"
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
