<?php 

include('styles.css');

$submitted = sanitize_text_field($_POST['submitted']);
if (isset($submitted) && !empty($submitted)) {

    $apikey = sanitize_text_field($_POST['funifier-api-key']);
    $checkWidgetSite = sanitize_text_field($_POST['funifier-check-widget-site']);
    $checkWidgetAdmin = sanitize_text_field($_POST['funifier-check-widget-admin']);
    $loginImplicit = sanitize_text_field($_POST['funifier-login-implicit']);

    update_option('funifier-api-key', $apikey);
    update_option('funifier-check-widget-site', $checkWidgetSite);
    update_option('funifier-check-widget-admin', $checkWidgetAdmin);
    update_option('funifier-login-implicit', $loginImplicit);
}
?>

<div class="wrap">
    <form method="post" action="<?php echo get_option('siteurl').'/wp-admin/admin.php?page=funifier'; ?>" id="form-funifier">
        <div class="funifier-div">
            <div class="title-funifier"><img src="<?php echo esc_url(plugin_dir_url( __FILE__ ).'logo-funifier.png'); ?>" /></div>
            <table class="form-table">
                <tr class="funifier-tr">
                    <td class="funifier-th"><?php echo esc_html('API Key:'); ?></td>
                    <td><input type="text" size="25" name="funifier-api-key" value="<?php echo (stripslashes(get_option('funifier-api-key'))); ?>" class="funifier-input"></td>
                </tr>
                <tr class="funifier-tr">
                    <td class="funifier-th"><?php echo esc_html('Show Widget Site:'); ?></td>
                    <td><input type="checkbox" name="funifier-check-widget-site" value="1" class="funifier-input" <?php echo (stripslashes(get_option('funifier-check-widget-site'))) ? 'checked="checked"' : ''; ?>></td>
                </tr>
                <tr class="funifier-tr">
                    <td class="funifier-th"><?php echo esc_html('Show Widget Admin:'); ?></td>
                    <td><input type="checkbox" name="funifier-check-widget-admin" value="1" class="funifier-input" <?php echo (stripslashes(get_option('funifier-check-widget-admin'))) ? 'checked="checked"' : ''; ?>></td>
                </tr>
                <tr class="funifier-tr">
                    <td class="funifier-th"><?php echo esc_html('Login implicit with actual user wordpress:'); ?></td>
                    <td><input type="checkbox" name="funifier-login-implicit" value="1" class="funifier-input" <?php echo (stripslashes(get_option('funifier-login-implicit'))) ? 'checked="checked"' : ''; ?>></td>
                </tr>
            </table>
        </div>
        <input type="hidden" name="submitted" id="submitted" value="1">
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
    </form>
</div>

