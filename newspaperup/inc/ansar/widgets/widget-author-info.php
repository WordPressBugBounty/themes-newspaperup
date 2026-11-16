<?php
add_action('admin_enqueue_scripts','newspaperup_author_widget_scripts');

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

        echo '<!-- Start Author Widget -->' . $before_widget;

        $newspaperup_btnone_target = !empty($instance['open_btnone_new_window']) ? '_blank' : '_self';
        $title = !empty($instance['title']) ? apply_filters( 'widget_title', $instance['title'] ) : '';
        ?>
        
        <div class="bs-author-widget wd-back">
            <?php if (!empty($instance['title'])){ ?>
            <!-- bs-sec-title -->
            <div class="bs-widget-title one">
				<h4 class="title"><span><i class="fas fa-arrow-right"></i></span><?php echo esc_html($title) ?></h4>
                <div class="border-line"></div>
			</div>
            <!-- // bs-sec-title -->
            <?php } ?>
            <div class="bs-author"> 
                <?php  if( !empty($instance['image_uri']) || !empty($instance['name']) || !empty($instance['desg']) ) { ?>
                    <div class="d-flex align-center inner">
                    <?php if (!empty($instance['image_uri'])) { ?> 
                        <div class="bs-author-img">
                            <img class="rounded-circle" src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo !empty($instance['name']) ? esc_attr($instance['name']) : ''; ?>" />
                        </div>
                    <?php } ?>
                    <div class="bs-author-info">
                        <?php if (!empty($instance['name'])) {
                            echo '<h4 class="name">'. esc_html($instance['name']).'</h4>';
                        } if (!empty($instance['desg'])) {
                            echo '<span class="designation">'. esc_html($instance['desg']).'</span>';
                        } ?>
                    </div>
                </div>
                <?php } if (!empty($instance['desc'])) {
                    echo '<p class="description">' . esc_html($instance['desc']) . '</p>';
                } if( !empty($instance['facebook']) || !empty($instance['twt']) || !empty($instance['insta']) || !empty($instance['youtube']) ) { ?>
                    <ul class="bs-social">
                        <?php
                        $social_links = [
                            'facebook' => 'fab fa-facebook',
                            'twt'      => 'fab fa-x-twitter',
                            'insta'    => 'fab fa-instagram',
                            'youtube'  => 'fab fa-youtube',
                        ];
                        foreach ($social_links as $key => $icon) {
                            if (!empty($instance[$key])) {
                                ?>
                                <li>
                                    <a class="<?php echo esc_attr($key); ?>" href="<?php echo esc_url($instance[$key]); ?>" target="<?php echo esc_attr($newspaperup_btnone_target); ?>">
                                        <i class="<?php echo esc_attr($icon); ?>"></i>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                <?php } ?>
            </div>
            </div>
            <?php
        echo $after_widget . '<!-- End Author Widget -->';
    }
   
    function update($new_instance, $old_instance) {

        $instance = array();

        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['name'] = !empty($new_instance['name']) ? sanitize_text_field($new_instance['name']) : '';
        $instance['desc'] = !empty($new_instance['desc']) ? sanitize_textarea_field($new_instance['desc']) : '';
        $instance['desg'] = !empty($new_instance['desg']) ? sanitize_text_field($new_instance['desg']) : '';
        $instance['image_uri'] = !empty($new_instance['image_uri']) ? esc_url_raw($new_instance['image_uri']) : '';
        $instance['open_btnone_new_window'] = !empty($new_instance['open_btnone_new_window']) ? 'on' : '';

        $social_platforms = ['facebook', 'twt', 'insta', 'youtube'];
        foreach ($social_platforms as $platform) {
            $instance[$platform] = !empty($new_instance[$platform]) ? esc_url_raw($new_instance[$platform]) : '';
        }

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
        <p class="author-image-wrap">
            <label for="<?php echo esc_attr($this->get_field_id('image_uri')); ?>"><?php _e('Author Image', 'newspaperup'); ?></label><br/>
            <img 
                class="custom_media_image_team" 
                src="<?php echo esc_url($instance['image_uri']); ?>" 
                style="max-width:100px; margin-bottom:5px; <?php echo empty($instance['image_uri']) ? 'display:none;' : 'display:block;'; ?>" 
                alt="<?php esc_attr_e('Uploaded image', 'newspaperup'); ?>" 
            />
            <input 
                type="text" 
                class="widefat custom_media_url_team" 
                style="margin-bottom: 10px;" 
                name="<?php echo esc_attr($this->get_field_name('image_uri')); ?>" 
                id="<?php echo esc_attr($this->get_field_id('image_uri')); ?>" 
                value="<?php echo esc_attr($instance['image_uri']); ?>" 
            />
            <button 
                type="button" 
                class="button button-primary custom_media_button_team">
                <?php esc_html_e('Upload Image', 'newspaperup'); ?>
            </button>
            <button 
                type="button" 
                class="button button-secondary custom_media_remove_team" 
                style="<?php echo empty($instance['image_uri']) ? 'display:none;' : 'display:inline-block;'; ?>">
                <?php esc_html_e('Remove', 'newspaperup'); ?>
            </button>
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name','newspaperup' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'desg' ); ?>"><?php _e( 'Designation','newspaperup' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id( 'desg' ); ?>" name="<?php echo $this->get_field_name( 'desg' ); ?>" type="text" value="<?php echo esc_attr( $instance['desg'] ); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description','newspaperup' ); ?></label> 
           <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>"><?php echo esc_textarea( $instance['desc'] ); ?></textarea>
        </p>
        <table>
            <?php
            $social_platforms = [
                'facebook' => __('Facebook Link', 'newspaperup'),
                'twt'      => __('Twitter Link', 'newspaperup'),
                'insta'    => __('Instagram Link', 'newspaperup'),
                'youtube'  => __('YouTube Link', 'newspaperup'),
            ];

            foreach ($social_platforms as $key => $label) {
                ?>
                <tr>
                    <td>
                        <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $label; ?></label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" value="<?php echo esc_attr($instance[$key]); ?>" />
                    </td>
                </tr>
                <?php
            }
            ?>
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