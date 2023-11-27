<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
// if($_GET['mobile'] == 1) {
//   get_template_part( 'mobile/archive','mobile' );
//   die();
// }

get_header(); ?>

		<section id="archive"  class="content-area">
			<?php //var_dump(get_the_author_meta('user_nicename')); ?>
      <?php if ( is_author() ) : ?>
          <?php
  				// If a user has filled out their description, show a bio on their entries.
  				if ( get_the_author_meta( 'description' ) && $data['archive_author_bio_show'] == 1 ) : ?>
  				<div id="author-info">
            <?php
            $avatar = get_crop_avatar(array('width' => '120', 'height' => '120'));
            $email_avatar = get_the_author_meta( 'user_email' );
            if( $data['post_bottom_author_avatar_show'] == 1 ) {
              if ( empty( $avatar ) ) {
                ?>
                <div class="author-avatar">
                  <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 120 ) ); ?>
                </div><!-- #author-avatar -->
                <?php
              }else {
                ?>
                <div class="author-avatar">
                  <img alt="<?php the_author() ?>" src="<?php echo $avatar; ?>" title="<?php the_author() ?>">
                </div><!-- #author-avatar -->
                <?php
              }

            } ?>

  					<div class="author-description">
  						<h2><?php
                  if ($data['post_bottom_author_name_show'] == 1) {
                      printf( __( 'About %s', 'twentyeleven' ), get_the_author() );
                  } ?>
              </h2>
  						<?php
              if ($data['post_bottom_author_description_show'] == 1) {

                  the_author_meta( 'description' );
              }
              ?>
  					</div><!-- #author-description	-->

  				</div><!-- #author-info -->
  				<?php endif; ?>
			<?php endif; ?>


      <header class="clearfix read-title-block" style="background: <?php echo $data['archive_background_color'] ?>; border-color:<?php echo $data['archive_border_color'] ?>">
          <h1 class="block-title" style="color: <?php echo $data['archive_title_color'] ?>;background-color: <?php echo $data['archive_background_color_title'] ?>;">
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
					<?php elseif( is_search() ): ?>
					  <?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?>
					<?php elseif ( is_post_type_archive() ) : ?>
					  <?php post_type_archive_title(); ?>
          <?php else : ?>
						<?php //echo "كتابنا"; ?>
          	<?php _e( 'Blog Archives', 'twentyeleven' ); ?>
					<?php endif; ?>
          </h1>

           <!-- <div id="breadcrumbs">
            <?php //breadcrumbs(); ?>
           </div> -->

			</header>
      <?php
				if ( is_category() ) {
					if ( $data['archive_description_show'] == 1 ) {
					 // $categories1 = get_the_category( );
					 // global $post;
					 $cats = get_the_category($post->ID);
			     $parent = get_category($cats[0]);
					 // var_dump($parent);
					 if ( !empty( $parent->category_description ) ) { ?>
						 <p class="category-description"><?php echo $parent->category_description; ?></p>

				 <?php }
				 }
				}
       ?>

      <?php if ( have_posts() ) : ?>
        <div id="archive-block" class="clearfix section" role="main">

					<div id="khy-static-slider" class="section clearfix">
						<div class="static-slider">
							<div class="big-block">
									<?php
									$i=1;
										 while ( have_posts() ) : the_post();

												get_template_part( 'parts/static-slider/static', 'slider' );
											break;
											endwhile;

									?>
								</div>
								<div class="small-block">
									<?php
										// $i = 2;
											while ( have_posts() ) : the_post();

											$i++;
												get_template_part( 'parts/static-slider/static', 'slider-small' );
												if ( $i == 5 ) break;
											endwhile;
									?>
								</div>
						</div>
					</div>
          <div class="clearfix section-f">

            <?php
						// echo $i;
              while ( have_posts() ) : the_post();
							// $i = 5;

								if ( $i == 5 ) {
									 if( $data["archive_ads_1"] ) { ?>
								    <div class="archive_ads banner">
								      <?php
								      if ( !empty( $data['archive_banner_code_1'] ) ):
								         echo $data['archive_banner_code_1'];

								      elseif ( !empty( $data['archive_banner_src_1'] ) ):
								        $image_src = $data['archive_banner_src_1'];
								        $link_start = $data['archive_banner_link_1'] ? '<a href="'.check_link( $data['archive_banner_link_1'] ).'" target="_blank">' : '';
								        $link_end = $data['archive_banner_link_1'] ? '</a>' : '';
								        echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

								      endif;
								       ?>
								    </div>
								  <?php }
								}
								if ( $i == 10 ) {
									if( $data["archive_ads_2"] ) { ?>
									 <div class="archive_ads banner">
										 <?php
										 if ( !empty( $data['archive_banner_code_2'] ) ):
												echo $data['archive_banner_code_2'];

										 elseif ( !empty( $data['archive_banner_src_2'] ) ):
											 $image_src = $data['archive_banner_src_2'];
											 $link_start = $data['archive_banner_link_2'] ? '<a href="'.check_link( $data['archive_banner_link_2'] ).'" target="_blank">' : '';
											 $link_end = $data['archive_banner_link_2'] ? '</a>' : '';
											 echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

										 endif;
											?>
									 </div>
								 <?php }

								}
								get_template_part('parts/archive','block');
								// echo $i;
								$i++;
              endwhile;
            ?>
          </div>
        </div>

     <?php else : ?>
        <div class="archive-blockcontent-block clearfix" role="main">
          <article id="post-0" class="post no-results not-found">
  					<header class="entry-header">
  						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
  					</header><!-- .entry-header -->

  					<div class="entry-content">
  						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
  						<?php get_search_form(); ?>
  					</div><!-- .entry-content -->
  				</article><!-- #post-0 -->
        </div>
     <?php endif; ?>

      <div class="pagination">
       <?php paginate(); ?>
      </div>

		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_sidebar('left'); ?>

<?php get_footer(); ?>
