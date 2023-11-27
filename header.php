<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 global $data;
 global $khafagy_sections_builder;
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" dir="ltr" lang="ar">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" dir="ltr" lang="ar">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" dir="ltr" lang="ar">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html dir="ltr" lang="ar">
<!--<![endif]-->
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="cache-control" content="max-age=0" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="cache-control" content="no-store" />
  <meta http-equiv="expires" content="0" />
  <link rel="amphtml" href="<?php echo get_permalink() .'/?mobile_amp=1'; ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <?php wp_head(); ?>
  <?php echo $data['tracking_code']; ?>
</head>


<body <?php body_class(); ?> style="background-image:url('<?php  echo $data["body_background_img"] ?>');background-size:cover;background:<?php  echo $data["body_background"] ?>;">
<div class="overview"></div>

<?php if( $data["welcome_ads"] ) { ?>
  <div class="overview-ads">
    <span>X</span>
  </div>

  <div class="hk-welcome-ads">
    <?php
    if ( !empty( $data['welcome_banner_code'] ) ):
       echo $data['welcome_banner_code'];

    elseif ( !empty( $data['welcome_banner_src'] ) ):
      $image_src = $data['welcome_banner_src'];
      $link_start = $data['welcome_banner_link'] ? '<a href="'.check_link( $data['welcome_banner_link'] ).'" target="_blank">' : '';
      $link_end = $data['welcome_banner_link'] ? '</a>' : '';
      echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

    endif;
     ?>
  </div>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      setTimeout( function(){
        $('.hk-welcome-ads').fadeIn();
        $('.overview-ads').fadeIn();
      }, 3000);
      $( ".overview-ads" ).on( "click", function() {
        $('.hk-welcome-ads').fadeOut();
        $('.overview-ads').fadeOut();
      });
    });
  </script>
<?php } ?>
<div id="khy-header" class="clearfix <?php echo $data["layout"]; ?>" style="background-color:<?php  echo $data['header_background']; ?>;border-color:<?php  echo $data['header_border_color']; ?>">

    <?php if( $data["topbar_show"] ) { ?>

    <div class="topbar" style="background-color:<?php  echo $data["topbar_background"]; ?>;border-color:<?php  echo $data["topbar_border_color"]; ?>">
      <div class="container">
        <?php

        if( $data["topbar_menu"] ) {
          wp_nav_menu( array( 'container'=> 'ul', 'container_class'=>'nav', 'menu_class'=>'small-links', 'menu_id'=>'nav-menu', 'fallback_cb'=>'solo_wp_page_menu', 'theme_location' => 'small_links' ) );
        }

        if( $data["topbar_date"] ) {
          khafagy_today_date( array('hajri') );
        }
        if( $data["topbar_prayer"] ) {
          get_template_part( 'template-parts/single_prayer' );
        }
        if( $data["topbar_weather"] ) {
          get_template_part( 'template-parts/single_weather' );
        }

        if( $data["topbar_search"] ) {
          get_template_part( 'template-parts/search_box' );
        }
        if( $data["topbar_socials"] ) {
          // global $khafagy_icons_position;
          // $khafagy_icons_position = 'topbar';
          get_template_part( 'template-parts/social_icons' );
        }
        ?>

      </div>
    </div>
    <?php } ?>

      <div class="header-center">
        <div class="container">
          <div class="right-block">
            <a href="<?php bloginfo( 'url' ); ?>" class="logo-container" <?php $data['logo_center']; $data['logo_margin'] ?> >
              <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo khafagy_get_logo_src(); ?>">
            </a>
            <div class="search-navigation-icone">
              <div class="navigation-icone" style="background-color:<?php  echo $data["navigation_icone_background"]; ?>;"></div>
            </div>
            <div class="prayer-block icons">
              <!-- <div class="search" data-widget="search-box" style="background-color:<?php  echo $data["navigation_icone_background"]; ?>;"></div> -->
              <div class="prayer-icone " data-widget="prayer" style="background-color:<?php  echo $data["navigation_icone_background"]; ?>;"></div>
            </div>
          </div>
          <div class="left-block">
            <?php
              if ( empty( $data['header_banner_src'] ) ) {
                  if( $data["header_socials"] ) {
                    // global $khafagy_icons_position;
                    // $khafagy_icons_position = 'topbar';
                    get_template_part( 'template-parts/social_icons' );
                  }
                  if( $data["header_search"] ) echo '<div class="search-icone"></div>';
                  if( $data["header_search"] ) {
                    get_template_part( 'template-parts/search_box' );
                  }
                  if( $data["header_date"] ) {
                    khafagy_today_date( array('hajri','milady') );
                  }
              }
              if ( !empty( $data['header_banner_src'] ) ) {
                khafagy_get_banner('header_banner');
              }
            ?>
          </div>


        </div>
      </div>

      <nav role="navigation" class="main-menu">
        <div class="container">
          <style media="screen">
            #khy-header .main-menu .nav-menu li .sub-menu,
            #khy-header .main-menu .nav-menu,
            #khy-header .main-menu {
              background: <?php echo $data["nav_menu_background"] ?>;
              border-color: <?php echo $data["nav_menu_border"] ?>;
            }
            #khy-header .main-menu .nav-menu > li > a,
            #khy-header .main-menu .nav-menu li .sub-menu li a {
              color: <?php echo $data["nav_menu_color"] ?>;
              border-color: <?php echo $data["nav_menu_border"] ?>;
            }
            #khy-header .main-menu .nav-menu > li.active > a,
            #khy-header .main-menu .nav-menu > li > a:hover,
            #khy-header .main-menu .nav-menu > li.hover,
            #khy-header .main-menu .nav-menu li .sub-menu li:hover,
            #khy-header .main-menu .nav-menu li .sub-menu li:hover a,
            #khy-header .main-menu .nav-menu li .sub-menu li:hover:first-child ,
            #khy-header .main-menu .nav-menu > li.current-menu-item > a {
              background-color: <?php echo $data["nav_menu_background_hover"] ?>;
              border-color: <?php echo $data["nav_menu_border_hover"] ?>;
              color: <?php echo $data["nav_menu_color_hover"] ?>;
            }
          </style>
          <!-- <div class="closed"></div> -->
          <?php


            if( $data["topbar_search"] ) {
              get_template_part( 'template-parts/search_box' );
            }
            // global $khafagy_icons_position;
            // $khafagy_icons_position = 'topbar';
            get_template_part( 'template-parts/social_icons' );

            if( $data["nav_menu"] ) {
              wp_nav_menu( array('container'=> 'ul','container_class'=>'nav','menu_class'=>'nav-menu clearfix','menu_id'=>'nav-menu','fallback_cb'=>'solo_wp_page_menu','theme_location' => 'primary' ) );
            }

          ?>
        </div>
      </nav>
      <div id="widgets" class="clearfix">
          <?php

           the_widget( 'Prayer',
           array(
             'title'=>'',
           ),
           array(
             'before_title' => '',
             'after_title' => ''
           ));

           if( $data["topbar_search"] ) {
             get_template_part( 'template-parts/search_box' );
           }
          ?>


      </div>

</div><!-- #khy-header -->
<div class="container">
  <?php
    if( $data["postsscroller_show"] ) {
      get_template_part( 'parts/posts-scroller/posts','scroller' );
    }
 ?>
 <?php if( $data["button_header_ads_1"] ) { ?>
   <div class="button_header_ads banner">
     <?php
     if ( !empty( $data['button_header_banner_code_1'] ) ):
        echo $data['button_header_banner_code_1'];

     elseif ( !empty( $data['button_header_banner_src_1'] ) ):
       $image_src = $data['button_header_banner_src_1'];
       $link_start = $data['button_header_banner_link_1'] ? '<a href="'.check_link( $data['button_header_banner_link_1'] ).'" target="_blank">' : '';
       $link_end = $data['button_header_banner_link_1'] ? '</a>' : '';
       echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

     endif;
      ?>
   </div>
 <?php } ?>
 <?php if( $data["button_header_ads_2"] ) { ?>
   <div class="button_header_ads banner">
     <?php
     if ( !empty( $data['button_header_banner_code_2'] ) ):
        echo $data['button_header_banner_code_2'];

     elseif ( !empty( $data['button_header_banner_src_2'] ) ):
       $image_src = $data['button_header_banner_src_2'];
       $link_start = $data['button_header_banner_link_2'] ? '<a href="'.check_link( $data['button_header_banner_link_2'] ).'" target="_blank">' : '';
       $link_end = $data['button_header_banner_link_2'] ? '</a>' : '';
       echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

     endif;
      ?>
   </div>
 <?php } ?>
</div>
  <?php if ( !is_active_sidebar( 'full-width-without-container-'.khy_get_child_theme_name() ) ) { ?>
    <div class="container">
  <?php } ?>
  <div id="content" class="clearfix">
    <?php if ( is_active_sidebar( 'full-width-without-container-'.khy_get_child_theme_name() ) )  { ?>
      <div class="container">
    <?php } ?>
          <?php if( $data["breakposts_show"] && !empty($data['break_news_cat']) ) { ?>
            <div class="clearfix" >
              <!--عاجل -->
              <?php
                $args = array(
                  'posts_per_page' => $data['breakposts_number'],
                  'cat' => $data['break_news_cat'],
                  'ignore_sticky_posts' => 1,
                  'no_found_rows' => true,
                );
                $the_query = new WP_Query( $args );
                  while ( $the_query->have_posts() ) : $the_query->the_post();
                    get_template_part( 'parts/break-news/break', 'news' );
                  endwhile;
                wp_reset_postdata();
              ?>
            </div>
          <?php } ?>
