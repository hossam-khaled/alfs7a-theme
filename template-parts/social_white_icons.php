<?php
global $data;
global $khafagy_icons_position;
if ( function_exists('get_social_media_array') ) { ?>
<div class="social-icons">
  <?php
  $social_media_websites = get_social_media_array();
	foreach ( (array) $social_media_websites as $value ) {
    if( isset( $value['share_only'] ) ) continue;
    $key = $value['key'];
    $show_icon = $data[$khafagy_icons_position."_".$key."_show"];
    $link = isset($data["$key"."_link"]) && !empty($data["$key"."_link"]) ? check_link($data["$key"."_link"]) : '' ;
    $link = ( $key == 'email' ) ? 'mailto:'.$link : $link;
    if( !isset($show_icon) || $show_icon != 1 ) continue;
    ?>
    <a class="<?php echo $key; ?>" href="<?php echo $link; ?>"><img src="<?php echo get_template_directory_uri().'/images/socials1/white/'.$key.'.png'; ?>"></a>
  <?php } ?>
</div>
<?php } ?>
