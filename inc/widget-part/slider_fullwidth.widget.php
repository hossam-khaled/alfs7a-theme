<?php
class slider_fullwidth extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            global $khafagy_post;
            $args = array(
              'posts_per_page' => $instance['news_count'],
              'cat' => $instance['category'] ,
              'ignore_sticky_posts' => 1,
              'no_found_rows' => true
            );
            $the_query = new WP_Query( $args );
            ?>
            <div class="the-slider clearfix">
              <?php //var_dump($the_query); ?>
              <div class="full-slider swiper-holder" id="slider">
                <div class="main-slides">
                  <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <?php
                        $i = 1;

                        while ( $the_query->have_posts() ) : $the_query->the_post();
                          get_template_part( 'parts/full-slider/full-slide' );
                          $i++;
                        endwhile;
                      ?>
                    </div>
                  </div>
                </div>
                <div class="pagination">
                  <?php

                  // while ( $the_query->have_posts() ) : $the_query->the_post();
                  //
                  // endwhile;
                  ?>
                </div>
              </div>
            </div>

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
            $args['widget_name'] = 'سليدر العرض كامل';
            $args['description'] = '';
            $args['extra_class'] = '';
            //widget options

            $args['options'][] = array(
              'label' => 'قسم',
              'name' => 'category',
              'type' => 'select',
              'values' => $categories_array
            );

            $args['options'][] = array(
              'label' => 'عدد الاخبار',
              'name' => 'news_count',
              'type' => 'input',
              'default' => '5'
            );

            // $args['options'][] = array(
            //   'label' => 'لون الهفر للبار',
            //   'name' => 'hover_color',
            //   'type' => 'color-picker',
            //   'default' => ''
            // );

            return $args;
       }

}
add_action( 'widgets_init', create_function('', 'return register_widget("slider_fullwidth");') );
