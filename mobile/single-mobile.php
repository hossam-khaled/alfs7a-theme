<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
global $post;
get_template_part('mobile/header','mobile');  ?>

  		<?php while ( have_posts() ) : the_post(); ?>
  			<?php get_template_part( 'mobile/content','mobile'); ?>
  		<?php endwhile; // end of the loop. ?>


<?php get_template_part('mobile/footer','mobile'); ?>
