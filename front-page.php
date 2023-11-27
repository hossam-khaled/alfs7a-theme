<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header();
global $data;
$theme_name = khy_get_child_theme_name();

?>

    <?php if ( is_active_sidebar( 'full-width-without-container-'.$theme_name ) ) { ?>
      </div>
      <style media="screen">
        #khy-header {
          margin-bottom: 0;
        }
      </style>
      <div class="clearfix without-container">
        <?php dynamic_sidebar('full-width-without-container-'.$theme_name); ?>
      </div>

      <div class="container">
    <?php } ?>
    <div class="clearfix full-width">
      <?php  dynamic_sidebar('full-width-'.$theme_name); ?>
    </div>

    <div id="primary" class="content-area hk-static">
      <?php dynamic_sidebar('main-content-'.$theme_name); ?>
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
