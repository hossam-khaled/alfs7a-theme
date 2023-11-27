<?php
//Twitter widget follow
class Tweet_Follow_Widget extends khafagy_widget {
        //WIDGET Args
        function widget($args, $instance) {
              extract($args, EXTR_SKIP);
              echo $before_widget;
              //WIDGET Database Checks
              $title = empty($instance['title']) ? ' ' : apply_filters('widget_tweet_title', $instance['title']);
              if (!empty( $instance['title'] ) && (strlen($instance['title']) > 1 )) {
                ?>
                <div class="read-title-block">
                  <?php echo $before_title . $title . $after_title; ?>
                </div>
                <?php
              }else {
                ?>
                  <div class="read-title-block">
                    <h3 class="block-title"> تابعنا من خلال تويتر </h3>
                  </div>
                <?php
              }
              echo '<div class="widget-twitter section no-background">';
              ?>

                <a href="<?php echo $instance['twitter_link'] ?>" class="twitter-follow-button" data-show-count="false">Follow @adwaalwatan</a>
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
              <?php
              echo '</div>';
            echo $after_widget;
        }

        //WIDGET Admin Form
        function backend() {
          // widget settings
          $args['widget_name'] = ' الاشتراك في  تويتر';
          $args['description'] = 'Twitters Follow Widget';
          $args['extra_class'] = 'widget-tweet-follow';

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
add_action( 'widgets_init', create_function('', 'return register_widget("Tweet_Follow_Widget");') );
