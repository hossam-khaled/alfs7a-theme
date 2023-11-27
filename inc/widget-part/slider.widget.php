<?php
class khy_slider extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            global $khafagy_post;
            $args = array(
              'posts_per_page' => '4',
              'cat' => $instance['category'] ,
              'ignore_sticky_posts' => 1,
              'no_found_rows' => true
            );
            $the_query = new WP_Query( $args );
            ?>
            <div class="clearfix read-title-block" style="background:<?php //echo $instance['title_backgroundcolor1']; ?>;border-color:<?php //echo $instance['title_color1']; ?>;">
              <h3 class="block-title" style="background-color:<?php //echo $instance['title_color1']; ?>;">
                <?php
                if ( !empty( $instance['title'] ) ) {
                  echo $instance['title'];
                } elseif ( $instance['category'] == 'recent' ) {
                   echo 'احدث الاخبار';
                } else {
                   echo get_cat_name( $instance['category'] );
                }
                ?>
              </h3>

            </div>
            <div class="the-slider clearfix">
              <div class="posts-slider swiper-holder" id="slider">


                <div class="main-slides">
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $i = 1;
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                          get_template_part( 'parts/slider/swiper', 'slide' );
                          $i++;
                        endwhile;
                      ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                  </div>
                </div>
                <div class="pagination">
                  <?php
                  $i = 1;
                  while ( $the_query->have_posts() ) : $the_query->the_post();

                    get_template_part( 'parts/slider/pagination' );

                    $i++;
                  endwhile;
                  ?>
                </div>
              </div>
            </div>
            <style media="screen">
            .posts-slider .pagination > a.single-post,
            .posts-slider .pagination > a.single-post .inner .the-title {
                background-color:<?php echo $instance['bar_color']?> !important;
            }
            .posts-slider .pagination > a.single-post:hover,
            .posts-slider .pagination > a.single-post.active,
            .posts-slider .pagination > a.single-post.active .the-title,
            .posts-slider .pagination > a.single-post:hover .the-title{
                background-color:<?php echo $instance['hover_color']?> !important;
            }
            /* .posts-slider .ditals > * {
              border-color: <?php echo $instance['hover_color']?> !important;
              color: <?php echo $instance['hover_color']?> !important;
            } */
            </style>
            <?php

            echo $after_widget;
        }
        //WIDGET Admin Form
        function backend() {

            $categories = get_categories();
            $categories_array[] = array(
              'label' => 'احدث الاخبار',
              'name' => 'recent'
            );
            foreach ($categories as $category) {
              $categories_array[] = array(
                'label' => $category->name,
                'name' => $category->term_id
              );
            }

            // widget settings
            $args['widget_name'] = 'سليدير اهم الأخبار';
            $args['description'] = '';
            $args['extra_class'] = '';
            //widget options
            $args['options'][] = array(
              'label' => 'العنوان',
              'name' => 'title',
              'type' => 'input',
              'default' => 'احدث الاخبار'
            );

            $args['options'][] = array(
              'label' => 'قسم',
              'name' => 'category',
              'type' => 'select',
              'values' => $categories_array
            );

            $args['options'][] = array(
              'label' => ' لون البار',
              'name' => 'bar_color',
              'type' => 'color-picker',
              'default' => ''
            );

            $args['options'][] = array(
              'label' => 'لون الهفر للبار',
              'name' => 'hover_color',
              'type' => 'color-picker',
              'default' => ''
            );

            return $args;
       }

}
add_action( 'widgets_init', create_function('', 'return register_widget("khy_slider");') );
