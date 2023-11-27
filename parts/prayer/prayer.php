<?php
function get_next_prayer() {
  global $data;
  require_once ( get_template_directory() . '/inc/PrayTime.php');

  $cities = khy_kas_cities();
  $selected_city = $data["cities"];

  $prayTime = new PrayTime();
  $prayTime->setCalcMethod($prayTime->Makkah);
  $prayer_times = $prayTime->getPrayerTimes(time(), $cities["$selected_city"]['latitude'] , $cities["$selected_city"]['longitude'], 2);
  unset( $prayer_times[4] );
  $prayer_times = array_values( $prayer_times );
  $salah_times = array();
  $current_time = current_time( 'timestamp' );


  $times = array(
    'Fajr' => 'الفجر',
    'Sunrise' => 'الشروق',
    'Dhuhr' => 'الظهر',
    'Asr' => 'العصر',
    'Maghrib' => 'المغرب',
    'Isha' => 'العشاء',
  );
  $i = 0;

  foreach ( $times as $key => $name ) {
    $prayer_time = strtotime( $prayer_times["$i"] );
    $the_time = str_replace( array( 'am','pm' ), array( 'ص','م' ) , date( 'h:i a', $prayer_time ) );
    $current_prayer = array(
      'name' => $name,
      'time' => $the_time
    );
    if( $current_time <  $prayer_time ) {
      return $current_prayer;
    }
    $i++;
  }
  return $current_prayer;

}
