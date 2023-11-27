<?php
class today_top_news extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
                global $wp_query;
                extract($args, EXTR_SKIP);
                echo $before_widget;
                //WIDGET Database Checks
                $title = empty($instance['title']) ? 'الاكثر قراءة' : $instance['title'];

                if (!empty( $title ) && (strlen($title) > 1 )) { //echo $before_title . $title . $after_title; ?>
                  <div class="section top">

                    <div class="clearfix read-title-block" style="background: <?php //echo $instance['background_color'];?>;border-color: <?php //echo $instance['title_color'];?>;">
                      <h3 class="block-title" style="color:<?php //echo $instance['title_color']; ?>;background-color:<?php //echo $instance['title_color']; ?>;">
                        <?php echo $title; ?>
                      </h3>
                    </div>
                    <style media="screen">
                      .section.top .single-post .details .category {
                        color: <?php echo $instance['title_color']; ?>;
                      }
                      .section-top .single-post .thumbnail-block:before {
                        background-color: <?php echo $instance['title_color']; ?>;
                      }
                    </style>
                <?php
                }
                $today = getdate();
                $args = array(
                'posts_per_page' => $instance['news_count'],
                'meta_key'   => '_views',
                'date_query' => array(
              		array(
                    'after' => ( is_local_request() ? '5 years ago' : '5 days ago' ),
                    'before'=> array(
                    'year'  => $today["year"],
                    'month' => $today["mon"],
                    'day'   => $today["mday"],
              			),
              			'inclusive' => true,
              		),
              	),
                'ignore_sticky_posts' => 1,
                'orderby' => 'meta_value_num',
                'no_found_rows' => true);
                $the_query = new WP_Query( $args );
                echo '<div class="section-top clearfix no-background">';
                global $i;
                  $i = 1;
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    get_template_part('parts/section-top/section','top');
                    $i++;
                endwhile;
              echo '</div>';
            echo '</div>';

          echo $after_widget;
        }

       //WIDGET Admin Form
       function backend() {

         // widget settings
         $args['widget_name'] = 'الاكثر قرائة اليوم ';
         $args['description'] = 'الاخبار الاكثر قراءة اليوم ';
         $args['extra_class'] = 'widget-today-top-news';

         $args['options'][] = array(
           'label' => 'العنوان',
           'name' => 'title',
           'type' => 'input'
         );
         $args['options'][] = array(
           'label' => 'عدد الاخبار',
           'name' => 'news_count',
           'type' => 'input',
           'default' => '5'
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
         //   'label' => 'لون خلفيه للبار',
         //   'name' => 'background_color',
         //   'type' => 'color-picker',
         //   'default' => ''
         // );
         // $args['options'][] = array(
         //   'label' => 'لون البوردر',
         //   'name' => 'border_color',
         //   'type' => 'color-picker',
         //   'default' => ''
         // );

         return $args;
      }

}
add_action( 'widgets_init', create_function('', 'return register_widget("today_top_news");') );
