<div class="khy-weather">
  <?php
  $cities  = get_option('cities_weather');
  if ( !is_array($cities) ) { $cities = unserialize($cities); }
  $i = 1;
  foreach( $cities as $key => $value ) { ?>
  <div class="city tab-<?php echo $i; ?> <?php if( $i == 1 ) echo ' visible'; ?>">
    <div class="weather-body clearfix">
      <div class="icon i<?php echo $value['icon']; ?>"></div>
      <div class="city-name"><?php echo $value['title']; ?></div>
      <div class="temperature"><?php echo $value['temperature']; ?>°C</div>
    </div>
  </div>
  <?php break; $i++;
  } ?>
</div>
