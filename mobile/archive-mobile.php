<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_template_part('mobile/header','mobile');

?>

        <section class="section">
          <h3 class="block-title">
            <?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
						<?php elseif ( is_category() ) : ?>
							<?php echo single_cat_title( '', false );?>
						<?php elseif ( is_author() ) : ?>
							<?php printf( __( 'Author Archives: %s', 'twentyeleven' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?>
						<?php elseif( is_tag() ): ?>
						  <?php printf( __( 'Tag Archives: %s', 'twentyeleven' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
						<?php else : ?>
            	<?php _e( 'Blog Archives', 'twentyeleven' ); ?>
						<?php endif; ?>
          </h3>
          <div id="main-posts">
             <div id="main-posts" class="medium-block">
               <div class="clearfix">
                 <?php
                  $i = 1;
                  global $query_string;
                  query_posts( $query_string . '&posts_per_page=60' );
                  if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        get_template_part( 'mobile/part/blocks','mobile');
                        if( $i % 2 == 0){ echo '</div><div class="clearfix">'; }
                        $i++;
                    endwhile;
                  endif;
                  ?>
                </div>
              </div>
          </div>
        </section>

<?php get_template_part('mobile/footer','mobile'); ?>
