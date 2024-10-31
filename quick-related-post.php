<?php
/*
Plugin Name: Quick Related Post
Plugin URI: http://ezhotdeal.net/quick-related-post.zip
Description: Easy display Related Post under post by tags and category.
Version: 2.0
Author: chuoitaotau
Author URI: http://ezhotdeal.net
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

define('quick_related_post_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('quick_related_post_plugin_dir', plugin_dir_path( __FILE__ ) );
define('quick_related_post_plugin_name', 'Quick Related Post' );

// Add Shortcodes
require_once( plugin_dir_path( __FILE__ ) . 'includes/quick-related-post-shortcodes.php');

//Themes php files
require_once( plugin_dir_path( __FILE__ ) . 'themes/text/index.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes/thumbnail/index.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes/custom/index.php');
require_once( plugin_dir_path( __FILE__ ) . 'themes/owlslider/index.php');


function quick_related_post_init_scripts()
{
		//Manage Admin
		wp_enqueue_style('admin', quick_related_post_plugin_url.'admin/css/style_admin.css');	
		wp_enqueue_script('admin', plugins_url( 'admin/js/js_admin.js' , __FILE__ ) , array( 'jquery' ));

		//Manage theme
		wp_enqueue_script('qrp_theme_js', plugins_url( 'assets/js/js_frontend.js' , __FILE__ ) , array( 'jquery' ));
		wp_enqueue_script('qrp_owl-carousel_js', plugins_url( 'assets/js/owl.carousel.min.js' , __FILE__ ) , array( 'jquery' ));
		
		// Style for themes
		wp_enqueue_style('quick_related-post-owl-carousel-css', quick_related_post_plugin_url.'themes/owlslider/owl.carousel.css');
		wp_enqueue_style('quick_related-post-owl-theme-css', quick_related_post_plugin_url.'themes/owlslider/owl.theme.css');

		wp_enqueue_style('quick_related-post-style-text', quick_related_post_plugin_url.'themes/text/style.css');
		wp_enqueue_style('quick_related-post-style-thumbnail', quick_related_post_plugin_url.'themes/thumbnail/style.css');

		$quick_related_post_style_default    = get_option( 'quick_related_post_style_default' );
		
		if(!empty($quick_related_post_style_default)){
			wp_enqueue_style('quick_related-post-style-custom', quick_related_post_plugin_url.'themes/custom/style.css');
		}
}
add_action("init","quick_related_post_init_scripts");


register_activation_hook(__FILE__, 'quick_related_post_activation');
register_deactivation_hook(__FILE__, 'quick_related_post_deactivation');

function quick_related_post_activation()
{
		$quick_related_post_version       = "1.0";
		update_option('quick_related_post_version', $quick_related_post_version); //update plugin version.

		$quick_related_post_title         = "post_title";
		update_option('quick_related_post_title', $quick_related_post_title);

		$quick_related_post_thumbnail     = "post_thumbnail";
		update_option('quick_related_post_thumbnail', $quick_related_post_thumbnail);

		$quick_related_post_author        = "post_author";
		update_option('quick_related_post_author', $quick_related_post_author);

		$quick_related_post_date          = "post_date";
		update_option('quick_related_post_date', $quick_related_post_date);

		$quick_related_post_excerpt       = "post_excerpt";
		update_option('quick_related_post_excerpt', $quick_related_post_excerpt);

		$quick_related_post_readmore      = "post_readmore";
		update_option('quick_related_post_readmore', $quick_related_post_readmore);

		$quick_related_post_style_default = 'style_default';
		update_option('quick_related_post_style_default', $quick_related_post_style_default);
}

function quick_related_post_deactivation(){ 
	// implement here
}

add_action('admin_menu', 'quick_related_post_menu_init');

function quick_related_post_menu_init()
{
		add_menu_page(
			__('quick-related-post','quick-related-post'), 
			__('Quick Related Post','author_box'), 
			'manage_options', 
			'quick_related_post_menu_settings', 
			'quick_related_post_menu_settings', 
			'dashicons-feedback'
			);
}

function quick_related_post_menu_settings()
{
	include('quick-related-post-settings.php');	
}

function quick_related_post_add_custom_css() {

	$quick_related_post_custom_style    = get_option( 'quick_related_post_custom_style' );

	$output="<style>".$quick_related_post_custom_style."</style>";

	echo $output;

}
add_action('wp_head','quick_related_post_add_custom_css');


function quick_related_post_add_owl_carousel_script() {

	$quick_related_post_item_per_slide    = get_option( 'quick_related_post_item_per_slide' );

	if(empty($quick_related_post_item_per_slide))
	{
		$quick_related_post_item_per_slide = 4;
	}

    echo $output = '<script type="text/javascript">
			            jQuery("#qrp_owl_carousel").owlCarousel({
			                autoPlay: 3500, //Set AutoPlay to 3 second
			                items: '.$quick_related_post_item_per_slide.',
			                itemsDesktop: [1199, 5],
			                itemsDesktopSmall: [979, 4],
			                itemsTablet : [768, 4],
			                itemsMobile : [600, 2],
			                width: 1000,
			                responsiveClass:true
			            });
			        </script>';
}
add_action( 'wp_footer', 'quick_related_post_add_owl_carousel_script', 100 );
?>