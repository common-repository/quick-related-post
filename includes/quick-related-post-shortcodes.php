<?php
if ( ! defined('ABSPATH')) exit; // if direct access 

function quick_related_post_display($atts) {
	$atts = shortcode_atts(
	array(
		'id' => "", //post id
		'themes' => "text", //name theme				
		), $atts);
	$post_id = $atts['id'];
	$themes  = $atts['themes'];
	$html = '';
	if($themes== "text")
	{
		$html.= quick_related_post_theme_text();
	}
	else if($themes== "thumbnail")
	{
		$html.= quick_related_post_theme_thumnail();
	}
	else if($themes== "custom")
	{
		$html.= quick_related_post_theme_custom();
	}
	else if($themes== "owlslider")
	{
		$html.= quick_related_post_theme_owlslider();
	}				
	return $html;
}
add_shortcode('quick_related_post', 'quick_related_post_display');