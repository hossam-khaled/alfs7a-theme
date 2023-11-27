<?php

function khafagy_get_banner( $banner_name ) {
  global $data;
  $banner_code = $data[$banner_name."_code"];
  $banner_link = $data[$banner_name."_link"];
  $banner_src = $data[$banner_name."_src"];
  echo '<div class="banner">';
    if ( !empty($banner_code) ) {
      echo $banner_code;
    } else {
      $link_start = $banner_link ? '<a href="'.check_link($banner_link).'" target="_blank">' : '';
      $link_end = $banner_link ? '</a>' : '';
      echo $link_start.'<img src="'.$banner_src.'" />'.$link_end;
    }
  echo '</div>';
}

function khafagy_get_logo_src() {
	global $data;
  if ( !empty( $data["logo_src_retina"] ) ) {
    $logo_src = $data["logo_src_retina"];
  } elseif( !empty( $data["logo_src"] ) ) {
    $logo_src = $data["logo_src"];
  } else {
    $logo_src = get_template_directory_uri().'/images/logo.png';
  }
  return $logo_src;
}

function khafagy_get_footer_logo_src() {
	global $data;
  if ( !empty( $data["footer_logo_src_retina"] ) ) {
    $logo_src = $data["footer_logo_src_retina"];
  } elseif( !empty( $data["footer_logo_src"] ) ) {
    $logo_src = $data["footer_logo_src"];
  } else {
    $logo_src = get_template_directory_uri().'/images/logo.png';
  }
  return $logo_src;
}

function khafagy_display_fav_icons() {
	global $data;
	$icon_sizes = array(
		'16',
		'32',
		'128',
		'256',
	);
	foreach( $icon_sizes as $size ) {
		if( !isset( $data["fav_icon_{$size}"] ) ) continue;
		echo '<link rel="icon" href="'.$data["fav_icon_{$size}"].'" sizes="'.$size.'x'.$size.'">'." \n";
		echo '<link rel="shortcut icon" href="'.$data["fav_icon_{$size}"].'" sizes="'.$size.'x'.$size.'">'." \n";
	}
}
add_action( 'wp_head', 'khafagy_display_fav_icons' );

function khafagy_header_scripts() {
	global $data;
  echo $data['header_scripts'];
}
add_action( 'wp_head', 'khafagy_header_scripts' );


function khafagy_footer_scripts() {
	global $data;
  echo $data['footer_scripts'];
}
add_action( 'wp_footer', 'khafagy_footer_scripts' );


function khafagy_apply_css() {
	global $data;
  echo '<style>';

	if( $data['breakposts_show'] == 1 ) {
    ?>
    .immediate-news {
      display:block;
    }
    <?php
  }
	if( $data['postsscroller_show'] == 1 ) {
    ?>
    #world-now {
      display:block;
    }
    <?php
  }
  if( false && $data['logo_center'] == 1 ) {
    ?>
    #khy-header .header-center .logo-container {
      text-align:center;
      float:none;
      max-width:none;
    }
    #khy-header .header-center {
      float:none;
      width:auto;
      height: auto;
      margin-left:0;
    }
    <?php
  }
	if( $data['logo_margin'] > 15 ) {
    ?>
    #khy-header .header-center .logo-container {
      padding-top: <?php echo $data['logo_margin']; ?>px ;
      padding-bottom: <?php echo $data['logo_margin']; ?>px ;

    }
    <?php
  }
  if(  false && $data['banner_center'] == 1 && !empty( $data['header_banner_src'] ) ) {
    ?>
    #khy-header .header-center .banner {
      text-align:center;
      float:none;
      max-width:none;
    }
    #khy-header .header-center .left-block {
      width:100%;
    }
    <?php
  }
	if( false && $data['banner_margin'] > 15 ) {
    ?>
    #khy-header .header-center .banner {
      padding-top: <?php echo $data['banner_margin']; ?>px ;
      padding-bottom: <?php echo $data['banner_margin']; ?>px ;

    }
    <?php
  }
  echo '</style>';
}
add_action( 'wp_footer', 'khafagy_apply_css', 100 );


function get_social_media_array() {
	$social_array = array(
		array(
			'key' => 'twitter',
			'default_on' => '1'
		)
		,array(
			'key' => 'facebook',
			'default_on' => '1'
		)
		,array(
			'key' => 'instagram',
			'default_on' => '1'
		)
		// ,array(
		// 	'name' => 'Google plus',
		// 	'key' => 'google_plus',
		// 	'default_on' => '1'
		// )
		,array(
			'key' => 'youtube',
			'default_on' => '1'
		)
		,array(
			'key' => 'whatsapp',
			'default_on' => '1',
			//'share_only' => true
		)
		,array(
			'key' => 'telegram',
			'default_on' => '1'
		)
		,array(
			'key' => 'snapchat'
		)
		// ,array(
		// 	'name' => 'Android App',
		// 	'key' => 'android'
		// )
		// ,array(
		// 	'name' => 'iPhone App',
		// 	'key' => 'apple'
		// )
		,array(
			'key' => 'linkedin'
		)
		,array(
			'key' => 'pinterest',
		)
		,array(
			'key' => 'email'
		)
		,array(
			'key' => 'rss',
			// 'default_on' => '1'
		)
		,array(
			'key' => 'nabd',
		)
	);
	foreach ( $social_array as $key => $value ) {
		if( !isset( $value['name'] ) ) {
			$social_array["$key"]["name"] = ucfirst( $value['key'] );
		}
	}
	return $social_array;
}
