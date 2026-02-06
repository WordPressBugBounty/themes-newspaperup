<?php add_action('admin_enqueue_scripts','newspaperup_author_widget_scripts');

function newspaperup_author_widget_scripts() {    

    wp_enqueue_media();

    wp_enqueue_script('news_author_widget_script', get_template_directory_uri() . '/js/widget-image.js', false, '1.0', true);

}
class Newspaperup_author_info extends WP_Widget {  



    public function __construct() {
        parent::__construct(
            'post-author-widget',
            __( 'AR: Author Info', 'newspaperup' )
        );
    }

    function widget($args, $instance) {

        extract($args);

        $defaults = array(
            'title'    => '',
            'name'     => '',
            'desc'     => '',
            'desg'     => '',
            'image_uri'=> '',
            'facebook' => '',
            'twt'      => '',
            'insta'    => '',
            'youtube'  => '',
            'open_btnone_new_window' => 0,
        );
        
        $instance = wp_parse_args( (array) $instance, $defaults );

        echo '<!-- Start Author Widget -->' . $before_widget;

        $newspaperup_btnone_target = '_self';
        if( !empty($instance['open_btnone_new_window']) ):
            $newspaperup_btnone_target = '_blank';
        endif; ?>
        
        <div class="bs-author-widget wd-back">
            <?php if (!empty($instance['title'])){ ?>
            <!-- bs-sec-title -->
            <div class="bs-widget-title one">
				<h4 class="title"><span><i class="fas fa-arrow-right"></i></span><?php echo esc_html($instance['title']) ?></h4>
                <div class="border-line"></div>
			</div> 
            <!-- // bs-sec-title -->
            <?php } ?>
            <div class="bs-author"> 
                <div class="d-flex align-center inner">
                    <?php if( !empty($instance['image_uri']) ): ?> 
                        <div class="bs-author-img">
                            <img class="rounded-circle" src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo apply_filters('widget_title', $instance['name']); ?>" />
                        </div>
                    <?php endif; ?>
                    <div class="bs-author-info">
                        <h4 class="name"><?php echo $instance['name']; ?></h4>
                        <?php if(!empty($instance['desg'])){ echo '<span class="designation">'. $instance['desg'].'</span>'; } ?>
                    </div>
                </div>
                <p><?php echo $instance['desc'] ?></p>                
                <ul class="bs-social">
                    <?php if($instance['facebook'] !=''){ ?>
                    <li>
                        <a class="facebook" <?php if($instance['open_btnone_new_window']) { ?> target="_blank" <?php } ?>href="<?php echo esc_url($instance['facebook']); ?>">
                            <i class="fab  fa-facebook"></i>
                        </a>
                    </li>
                    <?php } if($instance['twt'] !=''){ ?>
                    <li>
                        <a class="twitter" <?php if($instance['open_btnone_new_window']) { ?>target="_blank" <?php } ?>href="<?php echo esc_url($instance['twt']);?>">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </li>
                    <?php } if($instance['insta'] !=''){ ?>
                    <li>
                        <a class="instagram" <?php if($instance['open_btnone_new_window']) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($instance['insta']); ?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <?php } if($instance['youtube'] !=''){ ?>
                    <li>
                        <a class="youtube" <?php if($instance['open_btnone_new_window']) { ?>target="_blank" <?php } ?> href="<?php echo esc_url($instance['youtube']); ?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                    <?php } ?>
                </ul>        
            </div>
        </div>
        <?php echo $after_widget . '<!-- End Author Widget -->';

    }
   
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        // Basic text fields
        $instance['title'] = sanitize_text_field( $new_instance['title'] ?? '' );
        $instance['name']  = sanitize_text_field( $new_instance['name'] ?? '' );
        $instance['desg']  = sanitize_text_field( $new_instance['desg'] ?? '' );

        // Description - lets keep it plain text but use textarea sanitizer
        $instance['desc'] = sanitize_textarea_field( $new_instance['desc'] ?? '' );

        // Image URL and social URLs — sanitize as URLs
        $instance['image_uri'] = esc_url_raw( $new_instance['image_uri'] ?? '' );
        $instance['facebook']  = esc_url_raw( $new_instance['facebook'] ?? '' );
        $instance['twt']       = esc_url_raw( $new_instance['twt'] ?? '' );
        $instance['insta']     = esc_url_raw( $new_instance['insta'] ?? '' );
        $instance['youtube']   = esc_url_raw( $new_instance['youtube'] ?? '' );

        // Checkbox — ensure it's always 0 or 1 (avoids undefined index / null)
        $instance['open_btnone_new_window'] = ! empty( $new_instance['open_btnone_new_window'] ) ? 1 : 0;

        return $instance;
    }

    function form($instance) {
        $defaults = array(
            'title' => 'Author Details',
            'name'  => '',
            'desc'  => '',
            'desg'  => '',
            'image_uri' => '',
            'facebook' => '',
            'twt' => '',
            'insta' => '',
            'youtube' => '',
            'open_btnone_new_window' => 0,
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title','newspaperup' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Author Image', 'newspaperup'); ?></label><br/>

            <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" alt="'.__( 'Uploaded image', 'newspaperup' ).'" /><br />';

            endif;

            ?>

            <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">
            <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_team" name="<?php echo $this->get_field_name('image_uri'); ?>" value="<?php _e('Upload Image','newspaperup'); ?>" style="margin-top:5px;">
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name','newspaperup' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'desg' ); ?>"><?php _e( 'Designation','newspaperup' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'desg' ); ?>" name="<?php echo $this->get_field_name( 'desg' ); ?>" type="textarea" value="<?php echo esc_attr( $instance['desg'] ); ?>" />
        </p>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description','newspaperup' ); ?></label> 
           <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>"><?php echo esc_textarea( $instance['desc'] ); ?></textarea>
        </p>
      
            
        <table>
            <tr>
                <td>
                    <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook', 'newspaperup'); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name('facebook'); ?>" id="<?php echo $this->get_field_id('facebook'); ?>" value="<?php if( !empty($instance['facebook']) ): echo $instance['facebook']; endif; ?>" class="widefat"/>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="<?php echo $this->get_field_id('twt'); ?>"><?php _e('Twitter', 'newspaperup'); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name('twt'); ?>" id="<?php echo $this->get_field_id('twt'); ?>" value="<?php if( !empty($instance['twt']) ): echo $instance['twt']; endif; ?>" class="widefat"/>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="<?php echo $this->get_field_id('insta'); ?>"><?php _e('Instagram', 'newspaperup'); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name('insta'); ?>" id="<?php echo $this->get_field_id('insta'); ?>" value="<?php if( !empty($instance['insta']) ): echo $instance['insta']; endif; ?>" class="widefat"/>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube', 'newspaperup'); ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="<?php echo $this->get_field_name('youtube'); ?>" id="<?php echo $this->get_field_id('youtube'); ?>" value="<?php if( !empty($instance['youtube']) ): echo $instance['youtube']; endif; ?>" class="widefat"/>
                </td>
            </tr>
        </table>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('open_btnone_new_window')); ?>">
                <input type="checkbox" 
                    id="<?php echo esc_attr($this->get_field_id('open_btnone_new_window')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('open_btnone_new_window')); ?>"
                    value="1" <?php checked( $instance['open_btnone_new_window'], 1 ); ?> />
                <?php esc_html_e( 'Open link in new tab','newspaperup' ); ?>
            </label>
        </p>
    <?php

    }
}