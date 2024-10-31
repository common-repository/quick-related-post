<?php
if ( ! defined('ABSPATH')) exit; // if direct access 
function quick_related_post_theme_text()
{

	$quick_related_post_max_number = get_option( 'quick_related_post_max_number' );	
	$quick_related_post_headline = get_option( 'quick_related_post_headline' );
	$quick_related_post_title_font_size = get_option( 'quick_related_post_title_font_size' );
	$quick_related_post_title_font_color = get_option( 'quick_related_post_title_font_color' );

	$post_id = get_the_ID();
	$html = '';
	$html .= '<div  class="qrp_wrap_content qrp_text">';

	    if(!empty($quick_related_post_headline))
	    {
	    	$html .= '<div  class="qrp_title_headline" >'.$quick_related_post_headline.'</div>';
	    }
	    else
	    {
	    	$html .= '<div class="qrp_title_headline" >'.__('Related Post', 'quickrelatedpost').'</div>';
	    }	
	    $html .= '<ul class="qrp_wrap_items">';
	        if (has_tag()) {
		        $tags = wp_get_post_tags($post_id);
		        $tagIDs = array();
			    if ($tags) {
			        $tagcount = count($tags);

			        for ($i = 0; $i < $tagcount; $i++) {
			        $tagIDs[$i] = $tags[$i]->term_id;
			        }

			        $args_tag = array('tag__in' => $tagIDs, 
			        		      'post__not_in' => array($post_id), 
			        		      'showposts' => $quick_related_post_max_number, 
			        		      'ignore_sticky_posts' => 1);

			        $my_query_tag = new WP_Query($args_tag);
			        if ($my_query_tag->have_posts())
			        {
			        while ($my_query_tag->have_posts()) : $my_query_tag->the_post();
			        $html .= '
			        <li class="qrp_item">';
			            $html .= '<a style="font-size:'.$quick_related_post_title_font_size.';color:'.$quick_related_post_title_font_color.';" href="'.get_the_permalink().'" >';
			            $html .= get_the_title('', '', true, '40');
			            $html .= '</a>';
		                $html .= '<span>'.get_the_author().'</span>';
		                $html .= '<span>'.get_the_date().'</span>';
			            $html .= '</li>';
			        endwhile; 
			        wp_reset_postdata(); 
			        }
			        else
			        { 
			        	$html = '<p>'.__('No Related Post', 'quickrelatedpost').'</p>';
			        }
		        }
	        }
	        else
	        {
	        $cat = get_the_category();
	        $category = $cat[0]->cat_ID;
	        global $wp_query, $paged, $post;

	        $args_cat = array('cat' => $category, 
	        				  'posts_per_page' => $quick_related_post_max_number, 
	        				  'post__not_in' => array($post_id));
	        $my_query_cat = new WP_Query($args_cat);

	        while ($my_query_cat->have_posts()) : $my_query_cat->the_post();
	        $html .= '
	        <li class="qrp_item">';
	            $html .= '<a style="font-size:'.$quick_related_post_title_font_size.';color:'.$quick_related_post_title_font_color.';" href="'.get_the_permalink() .'" >';
	            $html .= get_the_title('', '', true, '40');
	            $html .= '</a>';
                $html .= '<span> | '.get_the_author().'</span>';
                $html .= '<span> | '.get_the_date().'</span>';
	            $html .= '</li>';
	        endwhile;
	        //rewind_posts();
	        wp_reset_query(); 
	        }
	        $html .= '</ul>';
	    $html .= '</div>'; // end 
	return $html;
}