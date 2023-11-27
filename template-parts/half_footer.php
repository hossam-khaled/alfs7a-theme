<?php  global $data; ?>
<div class="half">
  <?php
    wp_nav_menu( array('container'=> 'ul','container_class'=>'nav','menu_class'=>'nav-menu','menu_id'=>'nav-menu','fallback_cb'=>'solo_wp_page_menu','theme_location' => 'primary','depth' => -1 ) );
  ?>
</div>
<div class="half last">
  <div class="clearfix">

      <a href="<?php bloginfo( 'url' ); ?>" class="logo-container 2" <?php $data['logo_center']; $data['logo_margin'] ?> >
        <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo khafagy_get_logo_src(); ?>">
      </a>

    <?php
    if( $data["footer_date"] ) {
       khafagy_today_date( array('hajri','milady') );
     }
     if( $data["footer_search"] ) {
       get_template_part( 'template-parts/search_box' );
     }
     if( $data["footer_socials"] ) {
       // global $khafagy_icons_position;
       // $khafagy_icons_position = 'footer';
       get_template_part( 'template-parts/social_icons' );
     }
    ?>
  </div>
  <?php if ( $data["footer_legal_note_show"] ) {?>
    <div class="description">
      <?php echo $data["footer_legal_note_text"]; ?>
    </div>
  <?php  } ?>
</div>
