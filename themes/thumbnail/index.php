<?php
if ( ! defined('ABSPATH')) exit; // if direct access 
function quick_related_post_theme_thumnail()
{
	$quick_related_post_max_number = get_option( 'quick_related_post_max_number' );		
	$quick_related_post_headline = get_option( 'quick_related_post_headline' );
	$quick_related_post_title_font_size = get_option( 'quick_related_post_title_font_size' );
	$quick_related_post_title_font_color = get_option( 'quick_related_post_title_font_color' );

	$quick_related_post_thumbnail = get_option( 'quick_related_post_thumbnail' );
    $quick_related_post_author = get_option( 'quick_related_post_author' );
    $quick_related_post_date = get_option( 'quick_related_post_date' ); 

	if(empty($quick_related_post_max_number))
	{
		$quick_related_post_max_number = 4;
	}
	$post_id = get_the_ID();
	$html = '';
	$html .= '<div  class="qrp_wrap_content qrp_thumbnail">';
	    if(!empty($quick_related_post_headline))
	    {
	    	$html .= '<div  class="qrp_title_headline">'.$quick_related_post_headline.'</div>';
	    }
	    else
	    {
	    	$html .= '<div  class="qrp_title_headline">'.__('Related Post', 'quickrelatedpost').'</div>';
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
				        $thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
				        $html .= '<li class="qrp_item">';
				            $html.= '<a href="'.get_the_permalink().'">';
				                $html.= '<div class="qrp_info">';
				                    if(!empty($thumb_url))
				                    {
				                    	$html .= '<img src="'.$thumb_url.'" />';
				                    }
				                    else
				                    {
				                    	$html .= '<img src="'.quick_related_post_plugin_url.'assets/images/no-thumb.jpg" />';
				                    }
				                    $html .= '</div>';
				                $html .= '<div style="font-size:'.$quick_related_post_title_font_size.';color:'.$quick_related_post_title_font_color.';" class="related-post-title">'.get_the_title('', '', true, '40').'</div>';
				                $html .= '</a>';
				            $html .= '</li>';
				        endwhile; 
				        wp_reset_postdata(); 
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
		        if ($my_query_cat->have_posts())
		        {
			        while ($my_query_cat->have_posts()) : $my_query_cat->the_post();
			        {
			        $thumb_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			        $html .= '<li class="qrp_item">';
			            $html.= '<a href="'.get_the_permalink().'">';
			                $html.= '<div class="qrp_info">';
			                    if(!empty($thumb_url))
			                    {
			                    	$html .= '<img src="'.$thumb_url.'" />';
			                    }
			                    else
			                    {
			                    	$html .= '<img src="'.quick_related_post_plugin_url.'assets/images/no-thumb.jpg" />';
			                    }
			                    $html .= '</div>';
			                $html .= '<div style="font-size:'.$quick_related_post_title_font_size.';color:'.$quick_related_post_title_font_color.';" class="qrp_post_title">'.get_the_title('', '', true, '40').'</div>';
			                $html .= '</a>';
			            $html .= '</li>';
		        }
		        endwhile; 
		        wp_reset_query(); 
		        }
		        else
		        {
		        	$html .= '<p>'.__('No Related Post', 'quickrelatedpost').'</p>';
		        }
	        }
	        $html .= '</ul>';
	    $html .= '</div>'; // end 
	return $html;
}