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

     wp_enqueue_style( 'child-style',
         get_stylesheet_directory_uri() . '/style.css',
         array( 'parent-style' ),
         wp_get_theme()->get('Version')
     );

 }
 add_action( 'wp_enqueue_scripts', 'higo_child_enqueue_styles' );

/* Put all your custom functions for the theme here. */
