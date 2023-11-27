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
            <h3 class="main-title"><?php echo single_cat_title( '', false );?></h3>
            <div id="main-posts">
               <div class="clearfix">
               <?php
                global $query_string;
                query_posts( $query_string . '&posts_per_page=60' );
                $i = 1;
                if ( have_posts() ) :
                  while ( have_posts() ) : the_post();
                    get_template_part( 'mobile/blocks','mobile' );
                    if( $i % 2 == 0){ echo '</div><div class="clearfix">'; }
                    $i++;
            			endwhile;         
            		endif;
                ?>
                </div>
            </div>
          </section>

<?php get_template_part('mobile/footer','mobile'); ?>