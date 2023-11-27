<?php
class recent_articles extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            //WIDGET Database Checks
            ?>
            <div class="recent-articles" >
              <div class="read-title-block" style="background-color: <?php //echo $instance['background_color'] ?>;border-color: <?php //echo $instance['title_color'] ?>;">
                <h3 class="block-title" style="color: <?php //echo $instance['title_color'] ?>;background-color: <?php //echo $instance['title_color'] ?>;">
                  <?php  if ( !empty( $instance['title'] ) ) {echo $instance['title'];}else { echo get_cat_name( $instance['category'] );}; ?>
                </h3>
                <!-- <a href="<?php echo esc_url(get_category_link( $instance['category'] )); ?>" class="read-more" style="background-color: <?php echo $instance['border_color'] ?>;"></a> -->
              </div>
              <!-- no-background -->
              <div class="section section-articles " style="background: <?php //echo $instance['background_block'] ?>;">
                  <?php
                  $args = array(
                    'posts_per_page' => $instance['news_count'],
                    'cat' => $instance['category'],
                    'ignore_sticky_posts' => 1,
                    'no_found_rows' => true
                  );
                  $the_query = new WP_Query( $args );
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                      get_template_part( 'parts/section-articles/section', 'articles' );
                  endwhile;
                  ?>
              </div>
          </div>
            <?php
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
         $args['widget_name'] = ' احدث المقالات';
         $args['description'] = '';
         $args['extra_class'] = '';

         $args['options'][] = array(
           'label' => 'العنوان',
           'name' => 'title',
           'type' => 'input'
         );

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
         //   'label' => 'لون الخلفية للباوك',
         //   'name' => 'background_block',
         //   'type' => 'color-picker',
         //   'default' => ''
         // );

         // $args['options'][] = array(
         //   'label' => 'لون العنوان',
         //   'name' => 'title_color',
         //   'type' => 'color-picker',
         //   'default' => ''
         // );
         // $args['options'][] = array(
         //   'label' => 'لون الخلفية للعنوان',
         //   'name' => 'background_color_title',
         //   'type' => 'color-picker',
         //   'default' => ''
         //   );
         //   $args['options'][] = array(
         //     'label' => 'لون خلفيه بار العنوان',
         //     'name' => 'background_color',
         //     'type' => 'color-picker',
         //     'default' => ''
         //   );
         // $args['options'][] = array(
         //   'label' => 'لون البوردر',
         //   'name' => 'border_color',
         //   'type' => 'color-picker',
         //   'default' => ''
         // );
         return $args;
      }

}
add_action( 'widgets_init', create_function('', 'return register_widget("recent_articles");') );
