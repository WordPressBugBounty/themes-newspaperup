<?php
if (!class_exists('Three_Column_Slider')) :
    /**
     * Adds Three_Column_Slider widget.
     */
    class Three_Column_Slider extends Newspaperup_Widget_Base {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('newspaperup-posts-design-slider-title', 'newspaperup-excerpt-length');
            $this->select_fields = array('newspaperup-select-category');

            $widget_ops = array(
                'classname' => 'newspaperup_posts_design_slider_widget',
                'description' => __('Displays posts slider from selected category.', 'newspaperup'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('three_column_slider', __('AR: 3 Column Posts Slider', 'newspaperup'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {
            $instance = parent::newspaperup_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */
            $title = apply_filters('widget_title', $instance['newspaperup-posts-design-slider-title'], $instance, $this->id_base);
            $category = isset($instance['newspaperup-select-category']) ? $instance['newspaperup-select-category'] : 0;

            // open the widget container
            echo $args['before_widget'];
            ?>
            <div class="slider-widget mb-4<?php if (!empty($title)) { echo ' wd-back'; } ?> design-slider-widget">
            <?php newspaperup_widget_title($title);
            $all_posts = newspaperup_get_posts(5 , $category); ?>

                <div class="colmnthree bs swiper-container">
                    <div class="swiper-wrapper">
                    <!-- item -->
                    <?php if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            global $post;
                            $url = newspaperup_get_freatured_image_url($post->ID, 'newspaperup-slider-full'); ?>
                            <div class="swiper-slide"> 
                                <div class="bs-blog-post three lg back-img bshre" style="background-image: url('<?php echo esc_url($url); ?>');">
                                    <?php newspaperup_post_categories(); ?>
                                    <div class="inner">
                                        <div class="title-wrap">
                                            <h4 class="title lg"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <div class="btn-wrap">
                                                <a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                        <?php newspaperup_post_meta(); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        endif;
                        wp_reset_postdata(); ?>
                    </div>
                    <!-- Add Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance) {
            $this->form_instance = $instance;
            $options = array(
                'true' => __('Yes', 'newspaperup'),
                'false' => __('No', 'newspaperup')
            );
            $categories = newspaperup_get_terms();

            if (isset($categories) && !empty($categories)) {
                
                echo parent::newspaperup_generate_text_input('newspaperup-posts-design-slider-title', __('Title', 'newspaperup'), 'Posts 3 Column Slider');

                echo parent::newspaperup_generate_select_options('newspaperup-select-category', __('Select category', 'newspaperup'), $categories);

            }
        }
    }
endif;