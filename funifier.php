<?php
/*
Plugin Name: Funifier
Plugin URI: http://www.funifier.com
Description: O plugin do Funifier foi criado para integração com o sistema de gamificação da empresa.
Author: Jefferson Alessandro
Author URI: https://plus.google.com/+jeffalessandro/about
Contributors: Caio Lucena
Tags: admin, javascript, gamification, funifier
Version: 1.0
*/

/**
 * Add admin menu
 */
function funifier_add_menu() {
    add_menu_page('Funifier Settings', 'Funifier', 'manage_options', 'funifier', 'funifier_options', plugin_dir_url( __FILE__ ).'funifier.png');
}

/**
 * Sanitize options
 */
function funifier_options_validate($input) {
    return $input;
}

/**
 * Include options page
 */
function funifier_options() {
    include 'funifier-options.php';
}

/**
 * Add widget start - Admin Control
 */
function admin_funifier_js(){
    $funifierApiKey = stripslashes(get_option('funifier-api-key'));
    $funifierLoginImplicit = stripslashes(get_option('funifier-login-implicit'));

    if($funifierLoginImplicit){
        global $current_user;
        $current_user = wp_get_current_user();
        $user_info = get_userdata($current_user->ID);
        //$first_name = $user_info->first_name;
        $user_email = $user_info->user_email;
        $funifierHtmlLoginImplicit = "
            Funifier.auth.authenticate({
                auth_mode: 'IMPLICIT',
                player: '$user_email'
            }, function (err, data) { });
        ";
    }

    wp_enqueue_script( 'my_custom_script', '//client2.funifier.com/2.0.0/funifier.js' );
    echo '<script type="text/javascript">';
    echo 'window.funifierAsyncInit = function(){ Funifier.init({ apiKey : "'.$funifierApiKey.'" },function(err){ 
        Funifier._$("body").append(\'<div data-funifier-gui="start" data-id="pluginStart"></div>\');
        Funifier.widget._init();
        '.$funifierHtmlLoginImplicit.' }); };';
    echo "</script>";
}

$funifierCheckWidgetAdmin = stripslashes(get_option('funifier-check-widget-admin'));
if($funifierCheckWidgetAdmin){
    add_action( 'admin_enqueue_scripts', 'admin_funifier_js' );
}

/**
 * Add widget start - Website
 */
function site_funifier_js(){
    $funifierApiKey = stripslashes(get_option('funifier-api-key'));
    
    wp_enqueue_script( 'my_custom_script', '//client2.funifier.com/2.0.0/funifier.js' );
    echo '<script type="text/javascript">';
    echo 'window.funifierAsyncInit = function(){ Funifier.init({ apiKey : "'.$funifierApiKey.'" },function(err){
            if(err==null){
               Funifier._$("body").append(\'<div data-funifier-gui="start" data-id="pluginStart"></div>\');
               Funifier.widget._init();
            }
        }); };';
    echo "</script>";
}

$funifierCheckWidgetSite = stripslashes(get_option('funifier-check-widget-site'));
if($funifierCheckWidgetSite){
    add_action( 'wp_enqueue_scripts', 'site_funifier_js' );
}

/**
 * Add Funifier Menu
 */
add_action('admin_menu', 'funifier_add_menu');

?>
