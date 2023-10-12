<?php
/**
 * UPVancouver functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UPVancouver
 */

namespace Core;

// Useful global constants

define( 'CORE_URL', get_stylesheet_directory_uri() );
define( 'CORE_TEMPLATE_URL', get_template_directory_uri() ); 
define( 'CORE_PATH', dirname( __FILE__ ). '/' ); 
define( 'CORE_INC', CORE_PATH . 'includes/' );
define( 'CORE_PLUGINS_PATH', plugins_url() );
define( 'CORE_WIDGET', CORE_INC . 'widgets/' );
define( 'CORE_SHORTCODE', CORE_INC . 'shortcodes/' );
define( 'CORE_VENDOR', CORE_PATH . 'vendor/' );

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}



 /**
 * Enqueue scripts and styles.
 */
add_action( 'wp_enqueue_scripts', '\Core\upvancouer_enqueue_styles' );
function upvancouer_enqueue_styles() 
{	
	// wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'upvancouver-style', get_stylesheet_uri(), array(), _S_VERSION ); 
} 