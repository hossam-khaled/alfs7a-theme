<?php

function weater_cron( $times = 1 ){
  $cities = array(
    'alriyadh' => array( 'title' => 'الرياض', 'temperature' => '-' ),
    'jeddah' => array( 'title' => 'جدة', 'temperature' => '-' ),
    'mecca' => array( 'title' => 'مكة', 'temperature' => '-' ),
  );

  foreach( $cities as $key => $value  ) {
    // old key => 1757dab53ca1cb5a72e0be56ee359cce
    $temp_array = json_decode(JSONprocessURL( 'http://api.openweathermap.org/data/2.5/weather?appid=0419de7ded014a5930e7e6178159d4e0&q='.$key ) );
    if ( !isset( $temp_array->main->temp ) && $times <= 3 ) {
      $time++;
      return weater_cron($time);
    }
    $cities["$key"]['temperature'] = round( ($temp_array->main->temp - 273.15) , 0 );
    $cities["$key"]['icon'] = $temp_array->weather[0]->icon;
  }

  $cities = serialize($cities);
  update_option( 'cities_weather', $cities );

}
add_action( 'run_api_cron_hourly', 'weater_cron' );
// weater_cron();
