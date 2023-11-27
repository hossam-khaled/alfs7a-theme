<?php
class homapage_block extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
          extract($args, EXTR_SKIP);
          echo $before_widget;
          global $data;
          //WIDGET Database Checks

          if ( is_array( $data['recent_news_categories']  ) && count( $data['recent_news_categories']  ) > 0 ){
            foreach( $data['recent_news_categories'] as $key => $value )
              $excluded_categories[] = $key;
          }

         if ( $instance['selected_style'] != 'posts_slider_3_blocks'  &&  $instance['selected_style'] !=  'posts_slider_2_blocks') { ?>
                <div class="clearfix read-title-block" style="background:<?php //echo $instance['title_backgroundcolor1']; ?>;border-color:<?php //echo $instance['title_color1']; ?>;">
                  <h3 class="block-title" style="background-color:<?php //echo $instance['title_color1']; ?>;">
                    <?php
                    if ( !empty( $instance['title'] ) ) {
                      echo $instance['title'];
                    } elseif ( $instance['category1'] == 'recent' ) {
                       echo 'احدث الاخبار';
                    } else {
                       echo get_cat_name( $instance['category1'] );
                    }
                    ?>
                  </h3>

                </div>
            <?php }
            if ( $instance['selected_style'] ==  'big-and-fourth' &&  $instance['selected_style'] !=  'fourth' && $instance['selected_style'] !=  'posts_slider_2_blocks' && $instance['selected_style'] != 'video') {
              $background_block = 'no-background'; //'background-block';

            }else {
              $background_block = 'no-background';
            }
            if ($instance['selected_style'] !=  'posts_slider_2_blocks') {
              $section = 'section';
            }
            echo '<div class="' . $section.' '.$background_block . '">';
                if ( $instance['selected_style'] !=  'posts_slider_2_blocks' &&  $instance['selected_style'] !=  'posts_slider_3_blocks' ) {
                  global $the_query;
                  global $args;
                  $args = array(
                  'posts_per_page' => $instance['news_count'],
                  'ignore_sticky_posts' => 1,
                  'cat' => $instance['category1'],
                  'no_found_rows' => true
                 );
                  $the_query = new WP_Query( $args );
                }

                if ( $instance['selected_style'] == 'third' ) { ?>
                    <div class="section-a row-block">
                        <?php
                          $i = 1;

                          while ( $the_query->have_posts() ) : $the_query->the_post();
                                echo "<div class='third'>";
                                    get_template_part('parts/section-a/section','a');
                                echo "</div>";
                              $i++;
                          endwhile;
                         ?>
                    </div>
                  <?php
                } elseif ( $instance['selected_style'] == 'fourth' ) { ?>
                    <div class="section-a row-block">

                        <?php
                          $i = 1;
                          while ( $the_query->have_posts() ) : $the_query->the_post();
                            echo "<div class='fourth'>";
                                get_template_part('parts/section-a/section','a');
                            echo "</div>";
                              $i++;
                          endwhile;

                         ?>
                    </div>
                  <?php
                } elseif ( $instance['selected_style'] == 'big_and_fourth' ) { ?>
                    <div class="row-block">
                      <div class="clearfix ">
                        <div class="half">
                          <div class="section-b">
                            <?php
                              while ( $the_query->have_posts() ) : $the_query->the_post();
                                get_template_part('parts/section-b/section','b');
                                break ;
                              endwhile;
                            ?>
                          </div>
                        </div>
                        <div class="half">
                          <div class="section-a row-block">
                            <?php
                              $i = 1;
                              while ( $the_query->have_posts() ) : $the_query->the_post();
                                echo "<div class='half'>";
                                  get_template_part('parts/section-a/section','a');
                                echo "</div>";
                                if( $i == 4 ) break ;
                              $i++;
                              endwhile;
                            ?>
                          </div>
                        </div>
                      </div>

                      <div class="section-a">
                          <?php
                            while ( $the_query->have_posts() ) : $the_query->the_post();
                              echo "<div class='fourth'>";
                                  get_template_part('parts/section-a/section','a');
                              echo "</div>";
                            endwhile;
                           ?>
                      </div>
                    </div>
                  <?php

                } elseif ( $instance['selected_style'] == 'small-and-big' ) { ?>
                  <div class="clearfix">

                    <div class="section-d">
                      <?php
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                            get_template_part('parts/section-d/section','d');
                            break ;
                        endwhile;
                       ?>
                     </div>

                     <div class="row-block section-a">
                      <?php
                        $i = 1;
                        while ( $the_query->have_posts() ) : $the_query->the_post();
                              echo "<div class='fourth'>";
                                  get_template_part('parts/section-a/section','a');
                              echo "</div>";
                              if ( $i == 4 ) break;
                            $i++;
                        endwhile;
                       ?>
                     </div>
                  </div>
                  <?php
                } elseif ( $instance['selected_style'] == 'big-and-fourth' ) { ?>
                  <div class="row-block big-and-fourth">
                    <div class="half">
                      <div class="section-b ">
                        <?php
                          while ( $the_query->have_posts() ) : $the_query->the_post();
                              get_template_part('parts/section-b/section','b');
                              break ;
                          endwhile;
                         ?>
                       </div>

                    </div>

                    <div class="half">
                      <div class="section-c">
                       <?php
                         $i = 1;
                         while ( $the_query->have_posts() ) : $the_query->the_post();
                               get_template_part('parts/section-c/section','c');
                               if ( $i == 4 ) break;
                             $i++;
                         endwhile;
                        ?>
                      </div>
                       <!-- <div class="section-a row-block">
                          <?php
                            // $i = 1;
                            // while ( $the_query->have_posts() ) : $the_query->the_post();
                            //   echo "<div class='half'>";
                            //       get_template_part('parts/section-a/section','a');
                            //   echo "</div>";
                            //   if ( $x == 4 ) break;
                            // $i++;
                            // endwhile;
                           ?>
                       </div> -->
                    </div>
                  </div>
                  <?php
                } elseif ( $instance['selected_style'] ==  'posts_slider_2_blocks' ) {
                ?>
                  <div class="row-block">
                     <?php

                      for( $i = 1; $i <= 2; $i++  ) {
                         global $the_query;
                         $args = array(
                           'posts_per_page' => $instance['news_count'],
                           'ignore_sticky_posts' => 1,
                           'no_found_rows' => true,
                           'cat' => $instance['category'."$i"]

                         );

                          $the_query = new WP_Query( $args );
                          ?>
                          <div class="half section">
                            <div class="clearfix read-title-block" style="background:<?php //echo $instance['title_backgroundcolor'.$i]; ?>;border-color:<?php //echo $instance['title_color'.$i]; ?>;">
                              <h3 class="block-title" style="background-color:<?php //echo $instance['title_color'.$i]; ?>;">
                                <?php echo get_cat_name( $instance['category'."$i"] ); ?>
                              </h3>

                            </div>
                            <div class="clearfix <?php //echo $background_block; ?>">
                              <div class="section-b ">
                                <?php
                                  while ( $the_query->have_posts() ) : $the_query->the_post();
                                      get_template_part('parts/section-d/section','d');
                                      break ;
                                  endwhile;
                                 ?>
                               </div>
                               <div class="section-c">
                                <?php
                                  $x = 1;
                                  while ( $the_query->have_posts() ) : $the_query->the_post();
                                        get_template_part('parts/section-c/section','c');
                                      $x++;
                                  endwhile;
                                 ?>
                               </div>
                            </div>

                            <?php if( $selected_category1 != 'recent') { ?>
                              <a href="<?php echo esc_url(get_category_link( $instance['category'."$i"] )); ?>" class="read-more" style="background-color:<?php //echo $instance['bar_title_color1']; ?>;">عرض المزيد</a>
                            <?php } ?>
                          </div>
                         <?php
                       }
                     ?>
                  </div>
               <?php
                } elseif ( $instance['selected_style'] == 'video' ) { ?>
                    <div class="section-video">
                      <div class="big-video">
                        <?php
                          while ( $the_query->have_posts() ) : $the_query->the_post();
                            get_template_part( 'parts/section-video/section','video' );
                          break;
                          endwhile;
                        ?>
                      </div>
                      <div class="small-video ">
                      <?php
                        $i=1;
                          while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                              <?php get_template_part( 'parts/section-video/section','video-small' ); ?>
                          <?php
                          if ($i == 3 ) break;
                        $i++
                      ?>
                      <?php endwhile; ?>
                      </div>
                    </div>
                  <?php
                }
                if( false && $instance['category1'] == 'recent' ) { ?>
                  <div class="read-more lode-more">عرض المزيد</div>
                <?php }
                if( $instance['category1'] != 'recent' && $instance['selected_style'] !=  'posts_slider_2_blocks') { ?>
                  <a href="<?php echo esc_url(get_category_link( $instance['category1'] )); ?>" class="read-more" style="background-color:<?php //echo $instance['bar_title_color1']; ?>;">عرض المزيد</a>
                <?php }
                wp_reset_postdata();
                unset($the_query);
                unset($args);
                echo '</div>';
                echo $after_widget;
        }

        //WIDGET Admin Form
        function backend() {

          //hossam
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
              $args['widget_name'] = 'اخبار رئيسية';
              $args['description'] = 'اخبار الصفحة الرئيسية ';
              $args['extra_class'] = '';

              //widget options
              $args['options'][] = array(
                'label' => 'العنوان',
                'name' => 'title',
                'type' => 'input',
                'default' => 'احدث الاخبار'
              );
              $args['options'][] = array(
                'label' => 'عدد الاخبار',
                'name' => 'news_count',
                'type' => 'input',
                'default' => '5'
              );
              // $args['options'][] = array(
              //   'label' => 'لون خلفية البلوك' .$i,
              //   'name' => 'block_color',
              //   'type' => 'color-picker',
              //   'default' => ''
              // );

              $args['options'][] = array(
                'label' => 'الشكل',
                'name' => 'selected_style',
                'type' => 'image-selector',
                'values' => array(
                  // array(
                  //   'name' => 'big_and_fourth',
                  //   'label' => 'الأول'
                  // ),
                  array(
                    'name' => 'third',
                    'label' => 'الأول'
                  ),
                  // array(
                  //   'name' => 'black_third',
                  //   'label' => 'الأول'
                  // ),
                  array(
                    'name' => 'fourth',
                    'label' => 'الثانى',
                  ),
                  // array(
                  //   'name' => 'small-and-big',
                  //   'label' => 'الأول'
                  // ),
                  array(
                    'name' => 'posts_slider_2_blocks',
                    'label' => 'الثانى',
                  ),
                  array(
                    'name' => 'big-and-fourth',
                    'label' => 'الأول'
                  ),
                  array(
                    'name' => 'video',
                    'label' => 'الثانى',
                  ),
                ),
              );

              for( $i = 1; $i <= 2; $i++ ) {
                $args['options'][] = array(
                  'label' => 'قسم'.$i,
                  'name' => 'category'.$i,
                  'type' => 'select',
                  'values' => $categories_array
                );
                // $args['options'][] = array(
                //   'label' => 'لون خلفيه العنوان'.$i,
                //   'name' => 'title_color'.$i,
                //   'type' => 'color-picker',
                //   'default' => ''
                // );
                // $args['options'][] = array(
                //   'label' => 'لون البار كامل '.$i,
                //   'name' => 'title_backgroundcolor'.$i,
                //   'type' => 'color-picker',
                //   'default' => ''
                // );
                // $args['options'][] = array(
                //   'label' => 'لون البوردر' .$i,
                //   'name' => 'bar_title_color'.$i,
                //   'type' => 'color-picker',
                //   'default' => ''
                // );

              }

              return $args;
         }

}
add_action( 'widgets_init', create_function('', 'return register_widget("homapage_block");') );
