<?php

//Prayer widget
class Prayer extends khafagy_widget {
        //WIDGET Args
        function widget($args, $instance) {
            global $data;
            global $hajri_date;
            global $hajri_current;
            extract($args, EXTR_SKIP);
            echo $before_widget;
            //WIDGET Database Checks
            $title = empty($instance['title']) ? ' ' : $instance['title'];
            //if (!empty( $title ) && (strlen($title) > 1 )) { echo $before_title . $title . $after_title; }
            require_once ( get_template_directory() . '/inc/PrayTime.php');
            $hajri_date->setLang("ar");
            $hajri_current = $hajri_date->date("l, jS F Y", current_time('timestamp') ). 'هـ';
            $selected_city = $instance["selected_city"];

            if (empty($selected_city)) {
              $selected_city = $data["cities"];
            }
            $cities = khy_kas_cities();

            $prayTime = new PrayTime();
            $prayTime->setCalcMethod($prayTime->Makkah);
            $times = $prayTime->getPrayerTimes(time(), $cities["$selected_city"]['latitude'] , $cities["$selected_city"]['longitude'], 3);
            $salah_times = array();

            $timeNames = array(
              'Fajr',
              'Sunrise',
              'Dhuhr',
              'Asr',
              'Sunset',
              'Maghrib',
              'Isha'
            );

            foreach ( $timeNames as $key => $name ) {
              $salah_times["$name"] = $times["$key"];
            }
              $background = $instance['background_color'];
              $prayer_single= $instance['background_color_single'];
              $image_src = wp_get_attachment_image_src( $prayer_single['image'], 'full' );
              $background_color = wp_get_attachment_image_src( $background['image'], 'full' );
              $big_background_color_single= ( $prayer_single['color'] . " " . "url(" . $image_src[0] . ") " . " " . $prayer_single['position'] ." " . $prayer_single['repeat'] ) ;
              if ( !empty( $background_color[0] ) ) {
                $image = 'url(' . $background_color[0] . ')';
              }
            ?>

            <div class="prayer" style="background-color: <?php echo $background['color']; ?>;background-position: <?php echo $background['position']; ?>;background-repeat: <?php echo $background[repeat]; ?>;background-size:<?php echo ($background[size]); ?>;background-image: <?php echo $image; ?>;" >
            <div id="prayer-anchor"></div>
            <div class="clearfix title-note">
              <div class="main-title">
                مواقيت الصلاة
              </div>
              <div class="thumbnail"></div>

              <h2 class="note">مواقيت الصلاه بحسب التوقيت المحلى لمدينة <?php echo " ".$cities["$selected_city"]['name']." "; ?> ليوم <?php echo $hajri_current; ?></h2>
            </div>
            <div class="clearfix prayer-single-color" >
              <?php
              $d = new uCal;
              $times = array(
                'Fajr' => 'الفجر',
                'Sunrise' => 'الشروق',
                'Dhuhr' => 'الظهر',
                'Asr' => 'العصر',
                'Maghrib' => 'المغرب',
                'Isha' => 'العشاء'
              );

              $hajri_date->setLang("ar");
              $hajri_current = $hajri_date->date("l, jS F Y", current_time('timestamp') ). 'هـ';

              $i = 1;
              foreach ( $times as $key => $value) {
                if ( !empty( $image_src[0] ) ) {
                  $single_image = 'url(' . $image_src[0] . ')';
                }
              ?>
              <div class="single single-bg-<?php echo $key; ?>" style="background-color: <?php echo $prayer_single[color]; ?>;background-position: <?php echo $prayer_single[position]; ?>;background-repeat: <?php echo $prayer_single[repeat]; ?>;background-size:<?php echo ($prayer_single[size]); ?>;background-image: <?php echo $single_image; ?>;">
                <div class="name"><?php echo $value; ?> </div>
                <div class="icon-prayer "></div>
                <div class="time">
                  <?php echo str_replace( array( 'am','pm' ), array( 'ص','م' ) , date( 'h:i a', strtotime($salah_times["$key"]) )  ); ?>
                </div>
              </div>
              <?php
                if( $i % 3 == 0 ) echo '</div><div class="clearfix prayer-single-color" style="Background:'. $big_background_color_single . '; background-size:' . ($prayer_single['size']) . ';">';
                $i++;
              } ?>
            </div>
            <!-- <div class="note">
              مواقيت الصلاه بحسب التوقيت المحلى لمدينة الرياض ليوم <?php echo $hajri_current; ?>
            </div> -->
            </div>
            <?php
            echo $after_widget;
        }


        //WIDGET Admin Form
        function backend() {

          $cities = khy_kas_cities();
          foreach ($cities as $key => $value) {
            $cities_array[] = array(
              'label' => $value['name'],
              'name' => $key
            );
          }

          //var_dump($categories_array);
          // widget settings
          $args['widget_name'] = ' مواقيت الصلاة';
          $args['description'] = '';
          $args['extra_class'] = '';

          $args['options'][] = array(
            'label' => 'اختر المدينة',
            'name' => 'selected_city',
            'type' => 'select',
            'values' => $cities_array
          );
          $args['options'][] = array(
            'label' => 'الخلفية',
            'name' => 'background_color',
            'type' => 'background',
            'default' => ''
          );
          $args['options'][] = array(
            'label' => 'الخلفية البار',
            'name' => 'background_color_single',
            'type' => 'background', //color-picker
            'default' => ''
          );

          return $args;
       }

}
add_action( 'widgets_init', create_function('', 'return register_widget("Prayer");') );
