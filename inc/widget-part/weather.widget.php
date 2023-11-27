<?php
//Weather widget
class Weather extends khafagy_widget {

        //WIDGET Args
        function widget($args, $instance) {
                extract($args, EXTR_SKIP);
                echo $before_widget;
                //WIDGET Database Checks
                $title = empty($instance['title']) ? ' ' : $instance['title'];

                $cities  = get_option('cities_weather');
                if ( !is_array($cities) ) {
                  $cities = unserialize($cities);
                }

                //hossam
                $background = $instance['background_weather'];
                $image_src = wp_get_attachment_image_src( $background[image], 'full' );
                $i = 1;
                foreach( $cities as $key => $value ) {

                ?>
                <div class="khy-weather" style="background-color: <?php echo $background[color]; ?>;background-position: <?php echo $background[position]; ?>;background-repeat: <?php echo $background[repeat]; ?>;background-size:<?php echo ($background[size]); ?>;background-image: url("<?php echo $image_src[0]; ?>");">
                    <div id="weather-anchor"></div>
                    <!-- <div class="main-title">
                      <div class="block-title" style="color:<?php echo $instance['title_color'] ?>; border-color: <?php echo $instance['border_title_color'] ?>;">
                        <?php echo $title; ?>
                      </div>
                    </div> -->
                    <div class="city tab-<?php echo $i; ?> <?php if( $i == 1 ) echo ' visible'; ?>">
                      <div class="city-name" style="color:<?php echo $instance['title_color'] ?>; border-color: <?php echo $instance['border_title_color'] ?>;"><span>مدينة </span> <?php echo $value['title']; ?></div>
                      <div class="temperature"><?php echo $value['temperature']; ?>°c</div>
                      <div class="icon i<?php echo $value['icon']; ?>"></div>
                    </div>
                    <?php
                    $i++;
                    break;
                    }
                    ?>
                    <div class="tabs">
                      <?php $i = 1; ?>
                      <?php foreach( $cities as $key => $value ) { ?>
                        <div class="single <?php if($i % 2 == 0) echo 'odd'; ?>" href="#" data-id="tab-<?php echo $i; ?>">
                          <div class="city-name"> <?php echo $value['title']; ?></div>
                          <div class="tempreture">
                            <?php echo $value['temperature']; ?>°
                            <i class="i<?php echo $value['icon']; ?>"></i>
                          </div>

                        </div>
                      <?php
                      $i++;
                      }
                      ?>
                    </div>
                </div>
                <?php
                echo $after_widget;
        }

          //WIDGET Admin Form
          function backend() {
            // widget settings
            $args['widget_name'] = '  حالة الطقس';
            $args['description'] = ' حالة الطقس';
            $args['extra_class'] = '';

            // $args['options'][] = array(
            //   'label' => 'العنوان',
            //   'name' => 'title',
            //   'type' => 'input'
            // );

            $args['options'][] = array(
              'label' => 'لون الخلفية',
              'name' => 'background_weather',
              'type' => 'background',
              'default' => ''
            );

            $args['options'][] = array(
              'label' => 'لون خلفيه العنوان',
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

            return $args;
         }

}
add_action( 'widgets_init', create_function('', 'return register_widget("Weather");') );
