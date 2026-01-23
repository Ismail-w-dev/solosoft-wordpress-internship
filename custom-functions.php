<?php
function my_custom_form_shortcode() {
    ob_start(); ?>
        <div class="why-form-container">
    <h2>Download Free Trial</h2>
    <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post"  id="downloadForm" class="why-form">
    
    <!-- hidden field for some backend operation to download the file-->
    <input type="hidden" name="action"  value="download_file_form">
    
    <!-- Name -->
    <input type="text" name="your-name" id="name" class="why-field" placeholder="*Name" required>

    <!-- Email -->
    <input type="email" name="your-email" id="email" class="why-field" placeholder="*Email" required>

    <!-- Phone -->
    <input type="tel" name="your-tel" id="phone" class="why-field" placeholder="*Phone" required>

    <!-- Reseller -->
    <input type="text" name="your-reseller" id="reseller"  class="why-field condition-checkbox" placeholder="*Reseller" >

    <!-- Checkbox Group -->
    <label class="why-checkbox">
        <input type="checkbox" id="check-partner" name="checkbox-556[]" value="I'm in touch with a NAKIVO partner." >
        I'm in touch with a NAKIVO partner.
    </label>

    <label class="why-checkbox">
        <input  type="checkbox" id="consent" name="checkbox-556[]" value="Yes, I consent to receiving NAKIVO offers.">
        Yes, I consent to receiving NAKIVO offers.
    </label>

    <p>By submitting this form, you agree to your personal data being processed by NAKIVO. </p>
    <!-- Submit -->
    <button type="submit" id="submitBtn" class="why-submit">DOWNLOAD FREE TRIAL</button>
    </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('why-nakivo-form', 'my_custom_form_shortcode');


function my_custom_form_assets() {
  if (is_page('why-nakivo')) { // ← Change 'your-page-slug'
    // CSS
    wp_enqueue_style('my-custom-form-style', get_stylesheet_directory_uri() . '/css/why-nakivo-form.css');
    
    // JS
    wp_enqueue_script('my-custom-form-script', get_stylesheet_directory_uri() . '/js/why-nakivo-form.js', array(), false, true);
  }
}
add_action('wp_enqueue_scripts', 'my_custom_form_assets');

//add the type of file (.exe) to word press because it wasn't accepted first
function allow_exe_uploads($mime_types) {
    $mime_types['exe'] = 'application/octet-stream'; // Add .exe extension
    return $mime_types;
}
add_filter('upload_mimes', 'allow_exe_uploads');

add_action('admin_post_download_file_form', 'handle_download_form');
add_action('admin_post_nopriv_download_file_form', 'handle_download_form'); // for guests

function handle_download_form() {
  
    
    // 3. Serve the file
    $file_path = get_template_directory() . '/downloads/NAKIVO.pdf';

    if (!file_exists($file_path)) {
        wp_die('File not found.');
    }
    if (ob_get_length()) {
    ob_end_clean();
    }
    // 4. Set headers and read file
    header('Content-Description: File Transfer');
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="NAKIVO_Backup_Replication_v11.0.3.92400_Installer-TRIAL.pdf"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));

    readfile($file_path);
    exit;
}
