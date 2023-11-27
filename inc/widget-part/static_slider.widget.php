<?php

class static_slider extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;

            global $khafagy_post;
            $args = array(
              'posts_per_page' => '5',
              'cat' => $instance['category'] ,
              'ignore_sticky_posts' => 1,
              'no_found_rows' => true
            );
            $the_query = new WP_Query( $args );
            $the_query1 = new WP_Query( $args );
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
            <div id="khy-static-slider" class="section clearfix">
              <div class="static-slider">
                <div class="big-block">
                    <?php
                       while ( $the_query->have_posts() ) : $the_query->the_post();
                          get_template_part( 'parts/static-slider/static', 'slider' );
                        break;
                        endwhile;
                    ?>
                  </div>
                  <div class="small-block">
                    <?php
                        $i=1;
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                          get_template_part( 'parts/static-slider/static', 'slider-small' );
                          if ( $i == 4 ) break;
                          $i++;
                        endwhile;
                    ?>
                  </div>
              </div>


              <div class="the-slider clearfix">
                <div class="posts-slider swiper-holder" id="slider">

                  <div class="main-slides">
                    <div class="swiper-container">
                      <div class="swiper-wrapper">
                          <?php
                          while ( $the_query1->have_posts() ) : $the_query1->the_post();
                            get_template_part( 'parts/slider/swiper', 'slide' );
                          endwhile;
                        ?>
                      </div>
                      <div class="pagination">
                        <?php
                        while ( $the_query1->have_posts() ) : $the_query1->the_post();
                          echo "<span></span>";
                        endwhile;
                        ?>
                      </div>
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                    </div>
                  </div>

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
            $args['widget_name'] = 'سليدر ثابت';
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

            return $args;
       }

}
add_action( 'widgets_init', create_function('', 'return register_widget("static_slider");') );
