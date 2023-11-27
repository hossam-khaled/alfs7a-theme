<?php
//Twitter widget tweet
class Solo_Tweet_Widget extends khafagy_widget {
        //WIDGET Args
        function widget($args, $instance) {
            extract($args, EXTR_SKIP);
            echo $before_widget;
            //WIDGET Database Checks
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_tweet_title', $instance['title']);
            if (!empty( $instance['title'] ) && (strlen($instance['title']) > 1 )) { ?>
              <div class="read-title-block">
                <?php echo $before_title . $title . $after_title; ?>
              </div>
            <?php
            }else {
              ?>
                <div class="read-title-block">
                  <h3 class="block-title"> التغريدات </h3>
                </div>
              <?php
            }
            echo '<div class="widget-twitter-1">';
            ?>
              <a class="twitter-timeline" height='400' href="<?php echo $instance['twitter_link'] ?>">Tweets by adwaalwatan</a>
               <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            <?php
            echo '</div>';
            echo $after_widget;
        }
       //WIDGET Admin Form
       function backend() {

         // widget settings
         $args['widget_name'] = 'احدث تغريدات تويتر';
         $args['description'] = '';
         $args['extra_class'] = '';

         $args['options'][] = array(
           'label' => 'العنوان',
           'name' => 'title',
           'type' => 'input'
         );
         $args['options'][] = array(
           'label' => 'لينك تويتر',
           'name' => 'twitter_link',
           'type' => 'input'
         );
         return $args;
      }

}
add_action( 'widgets_init', create_function('', 'return register_widget("Solo_Tweet_Widget");') );
