<?php

//Recent Articles widget
class category_news extends khafagy_widget {

  //var_dump( $before_title );

        //WIDGET Args
        function widget($args, $instance) {
          extract($args, EXTR_SKIP);
          echo $before_widget;?>

                <div class="clearfix read-title-block" style="background:<?php //echo $instance['background_color']; ?>;border-color:<?php //echo $instance['title_color']; ?>;">
                  <h3 class="block-title" style="color:<?php //echo $instance['title_color']; ?>;background-color:<?php //echo $instance['title_color']; ?>;">
                    <?php if ( !empty( $instance['title'] ) ) {
                      echo $instance['title'];
                    } else {
                      echo get_cat_name( $instance['category'] );
                    }?>
                    <?php //echo $instance['title']; ?>
                  </h3>

                  <!-- <a href="<?php echo esc_url(get_category_link( $instance['category'] )); ?>" class="read-more" style="background-color:<?php echo $instance['border_color']; ?>;"></a> -->
                </div>
                <?php
                if ( $instance['selected_style'] !=  'fourth' ) {
                  $background_block = 'no-background'; //'background-block';
                }else {
                  $background_block = 'no-background';
                }
                echo '<div class="section ' . $background_block . '">';
                $args = array(
                  'posts_per_page' => $instance['news_count'],
                  'cat' => $instance['category'],
                  'ignore_sticky_posts' => 1,
                  'no_found_rows' => true );
                $the_query = new WP_Query( $args );

              if($the_query->have_posts()):
                if ( $instance['selected_style'] == 'side-big-n-thumbnails' ) { ?>
                  <div class="clearfix single-block">
                    <div class="section-b">
                      <?php
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                          get_template_part('parts/section-d/section','d');
                          break;
                        endwhile
                      ?>
                    </div>
                    <div class="section-c ">
                      <?php
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            get_template_part('parts/section-c/section','c');
                        endwhile
                      ?>
                    </div>

                  </div>
                  <?php

                  } elseif ( $instance['selected_style'] == 'single_picture' ) { ?>
                    <div class="clearfix single-block">
                      <div class="section-e">
                        <?php
                          while ( $the_query->have_posts() ) : $the_query->the_post();
                            get_template_part('parts/section-e/section','e');
                            break;
                          endwhile
                        ?>
                      </div>
                      <div class="section-a row-block">
                        <?php
                          while ( $the_query->have_posts() ) : $the_query->the_post();
                            echo "<div class='half'>";
                              get_template_part('parts/section-a/section','a');
                            echo "</div>";
                          endwhile
                        ?>
                      </div>

                    </div>
                    <?php

                  } elseif ( $instance['selected_style'] == 'thumbnails' ) { ?>
                      <div class="section-c">
                       <?php
                         while ( $the_query->have_posts() ) : $the_query->the_post();
                             get_template_part('parts/section-c/section','c');
                         endwhile;
                        ?>
                      </div>
                    <?php
                  }
                endif;
                echo '</div>';;
            echo $after_widget;
          }

       //WIDGET Admin Form
       function backend() {

             $categories = get_categories();

             foreach ($categories as $category) {
               $categories_array[] = array(
                 'label' => $category->name,
                 'name' => $category->term_id
               );
             }

             // widget settings
             $args['widget_name'] = ' اخبار بالشريط الجانبى';
             $args['description'] = 'اخر الأخبار و الأخبار الأكثر قراءة مع المصعرات ';
             $args['extra_class'] = '';

             //widget options
             $args['options'][] = array(
               'label' => 'العنوان',
               'name' => 'title',
               'type' => 'input',
               'default' => 'احدث الاخبار'
             );
             $args['options'][] = array(
               'label' => 'الاقسام',
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

             $args['options'][] = array(
               'label' => 'الشكل',
               'name' => 'selected_style',
               'type' => 'image-selector',
               'values' => array(
                 array(
                   'name' => 'thumbnails',
                   'label' => 'الأول'
                 ),
                 array(
                   'name' => 'side-big-n-thumbnails',
                   'label' => 'الأول'
                 ),
                 array(
                   'name' => 'single_picture',
                   'label' => 'الثانى',
                 ),
               ),
             );
             // $args['options'][] = array(
             //   'label' => 'لون العنوان',
             //   'name' => 'title_color',
             //   'type' => 'color-picker',
             //   'default' => ''
             // );
             // $args['options'][] = array(
             //   'label' => 'لون خلفيه العنوان',
             //   'name' => 'background_color_title',
             //   'type' => 'color-picker',
             //   'default' => ''
             // );
             // $args['options'][] = array(
             //   'label' => 'لون البار كامل ',
             //   'name' => 'background_color',
             //   'type' => 'color-picker',
             //   'default' => ''
             // );
             //
             // $args['options'][] = array(
             //   'label' => 'لون البوردر',
             //   'name' => 'border_color',
             //   'type' => 'color-picker',
             //   'default' => ''
             // );

             return $args;
        }

}
add_action( 'widgets_init', create_function('', 'return register_widget("category_news");') );
