<?php
/**
 * Plugin Name: bbPress Like Button
 * Plugin URI:  http://jordiplana.com/bbpress-like-button-plugin
 * Description: Add a Like button in all your posts and replies. Let the users appreciate others contribution.
 * Author:      Jordi Plana
 * Author URI:  http://jordiplana.com
 * Version:     1.0
 */

/*
 * TODO:
 * 
 * Dashboard====
 * export CSV
 * reply/post list view column with like number in the dashboard
 * new options:
 *  -enable/disable tooltip
 *  -allow anonymous vote (ip)
 *  -allow like only replies (exclude OP)
 *  -automatically embed
 * reset logs button
 * add do_action and apply_filters
 * 
 * Frontend ====
 * icons
 * public unlike?
 * widget most liked post/user
 * show number of likes
 *  
 */

load_plugin_textdomain( 'bbpl', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

require_once(dirname(__FILE__).'/class.bbpress_like.php');

//Inits and menus
add_action('init', array('bbpress_like','init'));
add_action('admin_menu', array('bbpress_like', 'admin_menu'));

//Scripts and Styles
add_action('admin_enqueue_scripts', array('bbpress_like', 'admin_enqueue_scripts'));
add_action('wp_enqueue_scripts', array('bbpress_like', 'public_enqueue_scripts'));
add_action('wp_enqueue_scripts', array('bbpress_like', 'public_styles') );

//Output
add_action('bbp_theme_before_reply_admin_links', array('bbpress_like','bbpl_show_button'));

//Ajax requests
add_action('wp_ajax_like_this', array('bbpress_like','like_this'));
add_action('wp_ajax_nopriv_like_this', array('bbpress_like','like_this'));
add_action('wp_ajax_delete_like', array('bbpress_like','delete_like'));

//Shortcodes
add_shortcode('most_liked_users', array('bbpress_like','get_most_liked_users_shortcode'));
add_shortcode('most_liking_users', array('bbpress_like','get_most_liking_users_shortcode'));
add_shortcode('most_liked_posts', array('bbpress_like','get_most_liked_posts_shortcode'));

//Activation and deactivation hooks
register_activation_hook( __FILE__, array('bbpress_like','plugin_activation') );
register_uninstall_hook( __FILE__, array('bbpress_like','plugin_uninstall') );

//Public function for showing the button manually
function bbp_like_button($echo = true){
    bbpress_like::bbpl_show_button($echo);
}