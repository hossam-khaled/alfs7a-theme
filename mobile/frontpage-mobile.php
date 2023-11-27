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

get_template_part('mobile/header','mobile');

?>

  <!--عاجل -->
  <?php
  $i=1;
  $args = array(
    'posts_per_page' => '1',
    'cat' => '30',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => true
  );
  $the_query = new WP_Query( $args );
  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <?php get_template_part( 'parts/break', 'news' ); ?>

  <?php $i++ ?>
  <?php
    endwhile;
    wp_reset_postdata();
  ?>
  <!-- Strat world-now -->
  <?php get_template_part( 'parts/posts', 'scroller' ); ?>
  <!-- End world-now -->

  <?php get_template_part('mobile/slider','mobile'); ?>

  <div class="main-moment">
    <?php dynamic_sidebar('mobile-'.khy_get_child_theme_name()); ?>
  </div>

  <?php dynamic_sidebar( 'mobile-content' );?>


<?php get_template_part('mobile/footer','mobile'); ?>
