<?php   
    if ( ! defined('ABSPATH')) exit; // if direct access 
    
        if(empty($_POST['quick_related_post_hidden']))
            {
        
            $quick_related_post_max_number       = get_option( 'quick_related_post_max_number' );
            $quick_related_post_item_per_slide   = get_option( 'quick_related_post_item_per_slide' );

            $quick_related_post_headline         = get_option( 'quick_related_post_headline' );
            $quick_related_post_title_font_size  = get_option( 'quick_related_post_title_font_size' );
            $quick_related_post_title_font_color = get_option( 'quick_related_post_title_font_color' );
    
            
            $quick_related_post_title            = get_option( 'quick_related_post_title' );
            $quick_related_post_thumbnail        = get_option( 'quick_related_post_thumbnail' );
            $quick_related_post_author           = get_option( 'quick_related_post_author' );
            $quick_related_post_date             = get_option( 'quick_related_post_date' );
            $quick_related_post_excerpt          = get_option( 'quick_related_post_excerpt' );
            $quick_related_post_readmore         = get_option( 'quick_related_post_readmore' );

            $quick_related_post_style_default    = get_option( 'quick_related_post_style_default' );
            $quick_related_post_custom_style     = get_option( 'quick_related_post_custom_style' );

            //var_dump($quick_related_post_style_default);

            }
        else
            {   
                if($_POST['quick_related_post_hidden'] == 'Y') {
                    //Form data sent
                    //var_dump($_POST);

                    if (isset($_POST[ 'quick_related_post_max_number' ])){
                        $quick_related_post_max_number = sanitize_text_field($_POST['quick_related_post_max_number']);
                        update_option('quick_related_post_max_number', $quick_related_post_max_number); 
                    }

                    if (isset($_POST[ 'quick_related_post_item_per_slide' ])){
                        $quick_related_post_item_per_slide = sanitize_text_field($_POST['quick_related_post_item_per_slide']);
                        update_option('quick_related_post_item_per_slide', $quick_related_post_item_per_slide); 
                    }
                     
                    if (isset($_POST[ 'quick_related_post_headline' ])){
                        $quick_related_post_headline = sanitize_text_field($_POST['quick_related_post_headline']);
                        update_option('quick_related_post_headline', $quick_related_post_headline);
                    } 
                    
                    if (isset($_POST[ 'quick_related_post_title_font_size' ])){
                        $quick_related_post_title_font_size = sanitize_text_field($_POST['quick_related_post_title_font_size']);
                        update_option('quick_related_post_title_font_size', $quick_related_post_title_font_size);
                    } 
                    
                    if (isset($_POST[ 'quick_related_post_title_font_color' ])){
                        $quick_related_post_title_font_color = sanitize_text_field($_POST['quick_related_post_title_font_color']);
                        update_option('quick_related_post_title_font_color', $quick_related_post_title_font_color);
                    } 
                                             
                    if (isset($_POST[ 'quick_related_post_thumbnail' ])){
                        $quick_related_post_thumbnail = sanitize_text_field($_POST['quick_related_post_thumbnail']);
                        update_option('quick_related_post_thumbnail', $quick_related_post_thumbnail);
                    }else{
                        update_option('quick_related_post_thumbnail', '');
                    } 
    
                    if (isset($_POST[ 'quick_related_post_author' ])){
                        $quick_related_post_author = sanitize_text_field($_POST['quick_related_post_author']);
                        update_option('quick_related_post_author', $quick_related_post_author);
                    }else{
                        update_option('quick_related_post_author', '');
                    } 
    
                    if (isset($_POST[ 'quick_related_post_date' ])){
                        $quick_related_post_date = sanitize_text_field($_POST['quick_related_post_date']);
                        update_option('quick_related_post_date', $quick_related_post_date);
                    }else{
                        update_option('quick_related_post_date', '');
                    }

                    if (isset($_POST[ 'quick_related_post_excerpt' ])){
                        $quick_related_post_excerpt = sanitize_text_field($_POST['quick_related_post_excerpt']);
                        update_option('quick_related_post_excerpt', $quick_related_post_excerpt);
                    }else{
                        update_option('quick_related_post_excerpt', '');
                    }

                    if (isset($_POST[ 'quick_related_post_readmore' ])){
                        $quick_related_post_readmore = sanitize_text_field($_POST['quick_related_post_readmore']);
                        update_option('quick_related_post_readmore', $quick_related_post_readmore);
                    }else{
                        update_option('quick_related_post_readmore', '');
                    }
                    
                    if (isset($_POST[ 'quick_related_post_title' ])){
                        $quick_related_post_title = sanitize_text_field($_POST['quick_related_post_title']);
                        update_option('quick_related_post_title', $quick_related_post_title);
                    }else{
                        update_option('quick_related_post_title', '');
                    }
                    
                    if (isset($_POST[ 'quick_related_post_style_default' ])){
                        $quick_related_post_style_default = sanitize_text_field($_POST['quick_related_post_style_default']);
                        //var_dump($quick_related_post_style_default);
                        update_option('quick_related_post_style_default', $quick_related_post_style_default);
                    }else{
                        update_option('quick_related_post_style_default', '');
                    }

                    if (isset($_POST[ 'quick_related_post_custom_style' ])){
                        $quick_related_post_custom_style = sanitize_text_field($_POST['quick_related_post_custom_style']);
                        update_option('quick_related_post_custom_style', $quick_related_post_custom_style);
                    }else{
                        update_option('quick_related_post_custom_style', '');
                    }

                    ?>
        <div class="updated">
            <p><strong><?php _e('Changes Saved.' ); ?></strong></p>
        </div>
        <?php
                } 
            }
        ?>
        <div class="qrp-wrap">
            <?php echo "<h2>".__(quick_related_post_plugin_name.' Settings')."</h2>";?>
            <form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                <input type="hidden" name="quick_related_post_hidden" value="Y">
                <?php settings_fields( 'quick_related_post_plugin_options' );
                    do_settings_sections( 'quick_related_post_plugin_options' );
                    
                    ?>
                <div class="qrp-content qrp-setting">
                    <ul class="tab-nav">
                        <li nav="1" class="nav1 active">General Configuration</li>
                        <li nav="2" class="nav2">Custom Display</li>
                        <li nav="3" class="nav3">Custom Style</li>
                        <li nav="4" class="nav3">Using Theme</li>
                    </ul> <!-- tab-nav end --> 
                    <ul class="options">
                        <li style="display: block;" class="box1 tab-box active">
                            <div class="qrp-box">
                                <p class="">Maximum number of post to display</p>
                                <p class=""></p>
                                <input placeholder="4" type="text" name="quick_related_post_max_number" value="<?php if(!empty($quick_related_post_max_number)) echo $quick_related_post_max_number; else '4'; ?>" />
                            </div>
                            <div class="qrp-box">
                                <p class="">Item Per Slide (If use themes="owlslider")</p>
                                <p class=""></p>
                                <input placeholder="4" type="text" name="quick_related_post_item_per_slide" value="<?php if(!empty($quick_related_post_item_per_slide)) echo $quick_related_post_item_per_slide; else '4'; ?>" />
                            </div>
                            <div class="qrp-box">
                                <p class="">Head line text</p>
                                <p class=""></p>
                                <input placeholder="Related Posts..." type="text" name="quick_related_post_headline" value="<?php if(!empty($quick_related_post_headline)) echo $quick_related_post_headline; else ''; ?>" />
                            </div>
                            <div class="qrp-box">
                                <p class="">Post title font size</p>
                                <p class=""></p>
                                <input placeholder="13px" type="text" name="quick_related_post_title_font_size" value="<?php if(!empty($quick_related_post_title_font_size)) echo $quick_related_post_title_font_size; else ''; ?>" />
                            </div>
                            <div class="qrp-box">
                                <p class="">Post title font color</p>
                                <p class=""></p>
                                <input class="quick_related_post_title_font_color" placeholder="#ffffff" type="text" name="quick_related_post_title_font_color" value="<?php if(!empty($quick_related_post_title_font_color)) echo $quick_related_post_title_font_color; else ''; ?>" />
                            </div>
                        </li>
                        <li style="display: none;" class="box2 tab-box">    

                            <div class="qrp-box">
                                <p class=""><input class="quick_related_post_title" <?php if(!empty($quick_related_post_title)) echo 'checked'; else ''; ?>  type="checkbox" name="quick_related_post_title" value="post_title" />Post title</p>
                            </div>    
                            <div class="qrp-box">
                                <p class=""><input class="quick_related_post_thumbnail" <?php if(!empty($quick_related_post_thumbnail)) echo 'checked'; else ''; ?>  type="checkbox" name="quick_related_post_thumbnail" value="post_thumbnail" />Post thumbnail</p>
                            </div>
                            <div class="qrp-box">
                                <p class=""><input class="quick_related_post_author" <?php if(!empty($quick_related_post_author)) echo 'checked'; else ''; ?> type="checkbox" name="quick_related_post_author" value="post_author" />Post author</p>
                            </div>
                            <div class="qrp-box">
                                <p class=""><input class="quick_related_post_date" <?php if(!empty($quick_related_post_date)) echo 'checked'; else ''; ?> type="checkbox" name="quick_related_post_date" value="post_date" />Post date</p>
                            </div>
                            <div class="qrp-box">
                                <p class=""><input class="quick_related_post_excerpt" <?php if(!empty($quick_related_post_excerpt)) echo 'checked'; else ''; ?> type="checkbox" name="quick_related_post_excerpt" value="post_excerpt" />Post excerpt</p>
                            </div>
                            <div class="qrp-box">
                                <p class=""><input class="quick_related_post_readmore" <?php if(!empty($quick_related_post_readmore)) echo 'checked'; else ''; ?> type="checkbox" name="quick_related_post_readmore" value="post_readmore" />Button readmore</p>
                            </div>
                            <div class="shortcode">
                                <div class="qrp-box">
                                    <p class="qrp-box-title">For php file</p>
                                    <p class="qrp-box-description">Shortcode inside loop by dynamic post id you can use anywhere inside loop on .php files.</p>
                                    <strong><pre>&#60;?php<br />echo do_shortcode( '&#91;quick_related_post themes="custom" id="'.get_the_ID().'"&#93;' ); <br />?&#62;</pre></strong>
                                </div>
                                <hr/>
                                <div class="qrp-box">
                                    <p class="qrp-box-title">For content editor</p>
                                    <p class="qrp-box-description">Shortcode inside content for fixed post id you can use anywhere inside content.</p>
                                    <strong><pre>[quick_related_post themes="custom"]</pre></strong>
                                </div>
                            </div><!--/ shortcode-->

                        </li>

                        <li style="display: none;" class="box3 tab-box">
                            <div class="qrp-box">
                                <input class="quick_related_post_style_default" <?php if(!empty($quick_related_post_style_default)) echo 'checked'; else ''; ?>  type="checkbox" name="quick_related_post_style_default" value="style_default" />Use Style Default</p>
                            </div> 
                            <div class="qrp-box">
                                <textarea class="quick_related_post_custom_style" name="quick_related_post_custom_style"> <?php echo $quick_related_post_custom_style; ?> </textarea>
                            </div>
                        </li>

                        <li style="display: none;" class="box4 tab-box">
                            <div class="shortcode">
                                <div class="qrp-box">
                                    <p class="qrp-box-title">For php file</p>
                                    <p class="qrp-box-description">Shortcode inside loop by dynamic post id you can use anywhere inside loop on .php files.</p>
                                    <strong><pre>&#60;?php<br />echo do_shortcode( '&#91;quick_related_post themes="thumbnail" id="'.get_the_ID().'"&#93;' ); <br />?&#62;</pre></strong>
                                    <pre>Themes: text, thumbnail, owlslider </pre>
                                </div>
                                <hr/>
                                <div class="qrp-box">
                                    <p class="qrp-box-title">For content editor</p>
                                    <p class="qrp-box-description">Shortcode inside content for fixed post id you can use anywhere inside content.</p>
                                    <strong><pre>[quick_related_post themes="thumbnail"]</pre></strong>
                                    <pre>Themes: text, thumbnail, owlslider </pre>
                                </div>
                            </div><!--/ shortcode-->
                        </li>

                    </ul>

                </div>
                <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
            </form>
        </div>
        <!-- end wrap -->