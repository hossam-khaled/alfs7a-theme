<?php
class Poll extends khafagy_widget {

      //WIDGET Args
      function widget($args, $instance) {
              extract($args, EXTR_SKIP);
              echo $before_widget;
              ?>
              <div class="polls-widget" style="background-color: <?php echo $instance['background_color'] ?>;">
                <?php
                //WIDGET Database Checks
                  $title = empty($instance['title']) ? ' ' : $instance['title'];
                  //if (!empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; }
                  $args = array(
                    'posts_per_page' => '1',
                    'post_type' => 'poll',
                    'no_found_rows' => true
                  );
                  $the_query = new WP_Query( $args );
                  if($the_query->have_posts()):
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                      $poll_total_answers_count = 0;
                      for( $i = 1; $i <= 4; $i++ ) {
                        $answer_count_name = '_poll_answer_count_'.$i;
                        $$answer_count_name = _get( $answer_count_name );
                        if( $$answer_count_name ) $poll_total_answers_count += $$answer_count_name;
                      } ?>
                      <div class="all-title-block">
                        <h3 class="main-title" style="background-color: <?php echo $instance['background_color_title'] ?>;">
                          <div class="block-title" style="color: <?php echo $instance['title_color'] ?>; border-color: <?php echo $instance['border_title_color'] ?>;">
                            <?php echo $title; ?>
                          </div>
                        </h3>
                        <h2 class="the-title" style="color: <?php echo $instance['color_text'] ?>;"><?php the_title(); ?></h2>
                      </div>
                      <div class="answers" style="background-color: <?php echo $instance['background_color'] ?>;">
                        <?php for( $i = 1; $i <= 4; $i++ ) {
                          $answer_name = '_poll_answer_'.$i;
                          $answe_text = _get( $answer_name ); ?>
                          <div class="answer" data-answer-ID="<?php echo $i; ?>" style="color: <?php echo $instance['color_text'] ?>;">
                            <i></i>
                            <b><?php echo $i; ?></b>
                            <?php echo $answe_text; ?>
                          </div>
                        <?php } ?>
                      </div>
                      <div class="total-n-button clearfix">
                        <div class="button submit-button" data-post-ID="<?php the_ID(); ?>" data-url="<?php echo site_url('/index.php'); ?>">
                          تصويت
                        </div>
                        <div class="total" style="color: <?php echo $instance['color_text'] ?>;">
                         اظهار النتائج <span class="total-votes-number"><? echo $poll_total_answers_count; ?></span>
                        </div>
                      </div>

                      <div class="bars">
                        <?php for( $i = 1; $i <= 4; $i++ ) {
                          $answer_count_name = '_poll_answer_count_'.$i;
                          if( !isset($$answer_count_name) || $poll_total_answers_count == 0  ) {
                            $count_percent = 0;
                          } else {
                            $count_percent = ( $$answer_count_name / $poll_total_answers_count ) * 100;
                          }
                          ?>
                          <div class="bar" date-count="">
                            <div class="fill" style="width:<?php echo $count_percent; ?>%;background:<?php echo $instance['color_bar_poll']; ?>">
                            </div>
                            <i><?php echo $i; ?></i>
                            <b><?php echo round($count_percent,2); ?>%</b>
                          </div>
                        <?php } ?>
                      </div>
                      <input type="hidden" class="already-reviewed" data-message="عفوا لقد قمت بأبداء رايك على نفس السؤال من قبل">
                      <input type="hidden" class="success" data-message="شكرا لك, تم اضافة اجابتك الى التصويت ">
                      <?php
                      break;
                    endwhile;
                  endif;
                wp_reset_postdata();
                unset($the_query);
              echo "</div>";
            echo $after_widget;
        }


       //WIDGET Admin Form
       function backend() {
         // widget settings
         $args['widget_name'] = ' تصويت';
         $args['description'] = 'تصويت';
         $args['extra_class'] = '';

         $args['options'][] = array(
           'label' => 'العنوان',
           'name' => 'title',
           'type' => 'input'
         );
         $args['options'][] = array(
           'label' => 'لون العنوان',
           'name' => 'title_color',
           'type' => 'color-picker',
           'default' => ''
         );
         $args['options'][] = array(
           'label' => 'لون البوردر اسفل للعنوان ',
           'name' => 'border_title_color',
           'type' => 'color-picker',
           'default' => ''
         );

         $args['options'][] = array(
           'label' => 'لون خلفية العنوان',
           'name' => 'background_color_title',
           'type' => 'color-picker',
           'default' => ''
         );
         $args['options'][] = array(
           'label' => 'لون الخلفية',
           'name' => 'background_color',
           'type' => 'color-picker',
           'default' => ''
         );
         $args['options'][] = array(
           'label' => 'لون النص',
           'name' => 'color_text',
           'type' => 'color-picker',
           'default' => ''
         );
         $args['options'][] = array(
           'label' => 'لون البار الخاص بنسبة التصويت',
           'name' => 'color_bar_poll',
           'type' => 'color-picker',
           'default' => ''
         );

         return $args;
      }

}
add_action( 'widgets_init', create_function('', 'return register_widget("Poll");') );
