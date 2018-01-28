<?php
/**
 *
 * Higo child theme functions and definitions
 *
 * @package Higo
 * @author  Sopka Themes
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 */

 function higo_child_enqueue_styles() {

  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'higo-style', get_template_directory_uri() . '/assets/css/main.css' );

  wp_enqueue_style( 'child-style',
  get_stylesheet_directory_uri() . '/style.css',
  array( 'parent-style' ),
    wp_get_theme()->get('Version')
  );

  wp_enqueue_script('yt-widget', 'https://apis.google.com/js/platform.js');
 }
 add_action( 'wp_enqueue_scripts', 'higo_child_enqueue_styles' );

/* Put all your custom functions for the theme here. */

// Nettoyage du <head> -------------------------------------------------
// Retire du tag wp_head tous les trucs dont on a pas besoin
 function wphead_cleanup () {
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wp_shortlink_wp_head');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
  add_filter('the_generator', '__return_false');
  add_filter('show_admin_bar','__return_false');
  remove_action( 'wp_head', 'print_emoji_detection_script', 7);
  remove_action( 'wp_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'feed_links', 2);
  remove_action( 'wp_head', 'rest_output_link_wp_head', 10);
  remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10);
  remove_action('wp_head', 'wp_oembed_add_host_js');
  remove_action('wp_head', 'rel_canonical');
 }
 add_action('after_setup_theme', 'wphead_cleanup');
// --------------------------------------------------------------------

// Retrait des widgets inutilisés -------------------------------------
function remove_unused_widgets() {
	// Widgets WordPress
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Media_Gallery');
	unregister_widget('WP_Widget_Media_Audio');
	unregister_widget('WP_Widget_Media_Image');
	unregister_widget('WP_Widget_Media_Video');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('Jetpack_Search_Widget_Filters');
	unregister_widget('Jetpack_Widget_Authors');
	unregister_widget('Jetpack_Blog_Stats_Widget');
	unregister_widget('Jetpack_Contact_Info_Widget');
	unregister_widget('Jetpack_EU_Cookie_Law_Widget');
	unregister_widget('WPCOM_Widget_Facebook_LikeBox');
	unregister_widget('Jetpack_Flickr_Widget');
	unregister_widget('Jetpack_Gallery_Widget');
	unregister_widget('WPCOM_Widget_Goodreads');
	unregister_widget('Jetpack_Google_Translate_Widget');
	unregister_widget('WPCOM_Widget_GooglePlus_Badge');
	unregister_widget('Jetpack_Gravatar_Profile_Widget');
	unregister_widget('Jetpack_Image_Widget');
	unregister_widget('Jetpack_Internet_Defense_League_Widget');
	unregister_widget('Jetpack_MailChimp_Subscriber_Popup_Widget');
	unregister_widget('Milestone_Widget');
	unregister_widget('Jetpack_My_Community_Widget');
	unregister_widget('Jetpack_RSS_Links_Widget');
	unregister_widget('WPCOM_social_media_icons_widget');
	unregister_widget('Jetpack_Twitter_Timeline_Widget');
	unregister_widget('Jetpack_Upcoming_Events_Widget');
	unregister_widget('Jetpack_Display_Posts_Widget');
	unregister_widget('WordAds_Sidebar_Widget');
}
add_action( 'widgets_init', 'remove_unused_widgets' );
// --------------------------------------------------------------------
