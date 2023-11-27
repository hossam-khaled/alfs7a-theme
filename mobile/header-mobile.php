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
<html ⚡ dir="ltr" lang="ar">
<!--<![endif]-->
<head>
<style>
  .banners{
    margin:auto;
  }
</style>
<?php
 $the_template_directory = get_template_directory_uri();
?>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1">

<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="cache-control" content="no-store" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="canonical" href="<?php echo get_permalink(); ?>">
<meta name="mainurl" content="<?php bloginfo( 'url' ); ?>">
<meta name="google-site-verification" content="CaJFs10y5bLJwrBLDBnsJAVlZQ9Tp8L0X-FMu385Eto" />
<meta name="description" content="This is the AMP Boilerplate.">
<link rel="preload" as="script" href="https://cdn.ampproject.org/v0.js">
<script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-font" src="https://cdn.ampproject.org/v0/amp-font-0.1.js"></script>

<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>



<?php if( is_front_page() ):?>
  <link rel="canonical" href="<?php bloginfo( 'url' ); ?>" >
<?php elseif( is_single() ): ?>
  <link rel="canonical" href="<?php echo get_permalink(); ?>" >
<?php else: ?>
  <link rel="canonical" href="<?php echo curPageURL(true); ?>" >
<?php endif; ?>




<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-35360281-4', 'auto');
    ga('send', 'pageview');
    ga('require', 'displayfeatures');

</script>
<!-- Import other AMP Extensions here -->
<style amp-custom>
  <?php $font = $data['body_font']; ?>
  body {
    font-size: <?php echo $font[size]; ?>;
    font-weight: <?php echo $font[style]; ?>;
    font-style: <?php echo $font[style]; ?>;
    font-family: <?php echo $font[face]; ?>;
    color: <?php echo $font[color]; ?>;
  }
  #header {
    padding: 0;
    z-index: 100000;
    width: 100%;
    overflow: hidden;
    height: 70px;
    margin-bottom: 10px;
    background: #1d539d;
  }
  #header .logo {
    margin-right: 15px;
    position: relative;
    overflow: hidden;
    z-index: 100;
    height: 70px;
    line-height: 70px;
    max-width: 165px;
    display: block;
    float: right;
  }
  #header .logo i-amphtml-sizer {
    padding: 1px !important;
  }
  #header .logo .i-amphtml-fill-content {
    height: auto;
    position: relative;
    width: auto;
    display: inline-block !important;
  }
  .gocomment {
    display: block;
    font-family: "JF Flat Regular", serif, arial;
    font-size: 15px;
    width: 80px;
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #2d2d2d;
    color: #fff;
    margin: 15px auto;
    text-align: center;
    line-height: 1;
  }
  #single .title-block .main-title {
    margin-bottom: 10px;
    padding: 0 10px;
    font-size: 25px;
    line-height: 1.7;
  }
  #single .entry-content {
    margin-bottom: 15px;
    line-height: 1.7em;
    font-size: 18px;
    text-align: justify;
    color: #4e4e4e;
    padding: 10px 15px;
    background-color: #fff;
  }
  #header-navigation .tablet-menu > ul > li > a:hover {
    background-color: <?php  echo $data['amp_mine_background_haver']; ?>;
  }
</style>
<style
  amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}
</style>
<noscript><style  amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>

</head>




<body <?php body_class(); ?> style="background-image:url('<?php  echo $data["body_background_img"] ?>');background-size:cover;background:<?php  echo $data["body_background"] ?>;">




  <div id="header" class="clearfix" style="background-color:<?php  echo $data['amp_header_background']; ?>;">

     <div class="logo">
      <a href="<?php bloginfo( 'url' ); ?>">
        <amp-img src="<?php echo khafagy_get_logo_src(); ?>" width="1280" height="720" layout="responsive" alt="<?php bloginfo( 'name' ); ?>"> </amp-img>
      </a>
     </div>
     <div class="inner-header">
       <div class="tools">
         <a href="#" class="menu-toggle menu" style="background-color:<?php echo $data['amp_mine_icon_background']; ?>;"><img src="<?php echo get_template_directory_uri().'/mobile/images/mobile-menu.png'; ?>" title="<?php bloginfo( 'name' ); ?>" /></a>
       </div>
     </div>
  </div><!-- #branding -->
  <nav id="header-navigation" role="navigation" class="clearfix" style="background-color:<?php  echo $data['amp_mine_background']; ?>;">
      <div class="follow clearfix">
        <?php
          if( $data["topbar_socials"] ) {
            global $khafagy_icons_position;
            $khafagy_icons_position = 'topbar';
            get_template_part( 'template-parts/social_icons' );
          }
       ?>
      </div>
      <div class="tablet-menu" >
        <?php wp_nav_menu( array('container'=> 'ul','container_class'=>'nav','menu_class'=>'nav-menu clearfix','menu_id'=>'nav-menu','fallback_cb'=>'solo_wp_page_menu','theme_location' => 'primary' ) ); ?>
      </div>

    </nav><!-- #access -->

  <div class="container">
    <div class="banners">
      <?php dynamic_sidebar( 'mobile-header-banner' ); ?>
    </div>

    <div id="page" class="hfeed clearfix <?php if( is_single() || is_page() ) echo 'single'; ?>">
