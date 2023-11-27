<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 global $data;
 global $khafagy_post;

 $categories = get_the_category();
 $category_link = get_category_link($categories[0] );
 $category_name = $categories[0]->name;
 $_categorie_IDs = array();
 // var_dump();
 foreach($categories as $category){
   $_categorie_IDs[] = $category->term_id;
 }
 global $uCal;

get_header();

while ( have_posts() ) : the_post();
?>
	<div id="breadcrumbs">
		<?php breadcrumbs(); ?>
	</div>
  <div class="cat-title">
    <?php echo $category_name ?>
  </div>
	<div id="single" class="content-area">



   	<div id="primary">
			<div id="post-content"  role="main">

        <?php if( $data["top_singular_ads"] ) { ?>
          <div class="top_singular_ads banner">
            <?php
            if ( !empty( $data['top_singular_banner_code'] ) ):
               echo $data['top_singular_banner_code'];

            elseif ( !empty( $data['top_singular_banner_src'] ) ):
              $image_src = $data['top_singular_banner_src'];
              $link_start = $data['top_singular_banner_link'] ? '<a href="'.check_link( $data['top_singular_banner_link'] ).'" target="_blank">' : '';
              $link_end = $data['top_singular_banner_link'] ? '</a>' : '';
              echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

            endif;
             ?>
          </div>
        <?php } ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
          <header class="entry-header">

							<div class="title-block clearfix">
				 	       <?php $khafagy_post->the_second_title(); ?>

                <style media="screen">
                  <?php if ( $data['post_title_center'] == 1 ) { ?>
                    #single .title-block .main-title {
                      text-align: center;
                    }
                  <?php } ?>
                  <?php if ( $data['post_content_justify'] == 1 ) { ?>
                    #single .entry-content {
                      text-align: justify;
                    }
                  <?php } ?>
                </style>
			           <h1 class="main-title" style="color: <?php echo $data['post_title_color']; ?>"><?php the_title(); ?></h1>

							</div>
             <?php if( is_single() ) { ?>
                <?php if( $video_id = extract_video_id( get_post_meta(get_the_ID(), '_video_url', true) ) /*in_array( '657', $_categorie_IDs ) */) { ?>
									<?php if ( $data['post_video_show'] == 1 ) { ?>
                    <div class="the-video">
                      <?php
                       echo '<iframe class="player" src="http://www.youtube.com/embed/'.$video_id.'?rel=0&wmode=transparent&autoplay=1&showinfo=0" frameborder="0" allowfullscreen></iframe>';
                      ?>
                    </div>
									<?php } ?>
                <?php } else { ?>
									<?php if ( $data['post_featured_show'] == 1 ) { ?>
                    <div class="post-image thumbnail clearfix">
                        <a href="<?php the_permalink() ?>">
                          <?php
	echo get_the_post_thumbnail();
	//$khafagy_post->thumbnail( array( 'width' => '100%', 'height' => 90 ) ); ?>
                          <?php //echo '<img alt="'.the_title_attribute(array('echo' => 0)).'" class="the-image" title="'.the_title_attribute(array('echo' => 0)).'" src="'. $khafagy_post->get_thumbnail( array( 'width' => 100, 'height' => 500 ) ).'" />'; ?>
                        </a>
												<?php
												if( $featured_image = get_post(get_post_thumbnail_id()) ) {
												  echo '<div class="image-title">'.$featured_image->post_excerpt.'</div>';
												}
												?>

                    </div>
										<?php } ?>
                <?php } ?>
								<div class="tools-box">

                  <?php if ( $data['post_top_print_show'] == 1 ) { ?>

  							    <a class="print" title="طباعة" href="javascript:window.print();"></a>

                  <?php } ?>
                  <?php if ( $data['post_top_shortlink_show'] == 1 ) { ?>
  									<div id="post-shortlink" class="shortlink" onclick="selectText('post-shortlink')">
  										<?php echo wp_get_shortlink(); ?>
  									</div>
                  <?php } ?>

                  <div class="views-comments">
                    <div class="right-block">
                      <?php if ( $data['post_top_date_show'] == 1 ) { ?>
                        <?php  $khafagy_post->human_time(); ?>
                        <?php
                        if ( $khafagy_post->get_views() >= 10000) {
                          echo "<div class='fire-img'>";
                          echo '<img src="'.get_stylesheet_directory_uri().'/images/views.png" />';
                          echo "</div>";
                        }
                        ?>
                      <?php } ?>
                    </div>

                    <div class="left-block">

                      <?php if ( $data['post_top_font_show'] == 1 ) { ?>
                        <div class="font-control">
                          <a class="increase" title="تكبير الخط"></a>
                          <a class="reset" title="الحجم الاصلى"></a>
                          <a class="decrease" title="تصغير الخط"></a>
                        </div>

                      <?php } ?>

                      <?php if ( $data['post_top_views_show'] == 1 ) { ?>
                        <div class="views">
                          <?php echo $khafagy_post->get_views(); ?>
                        </div>
                      <?php } ?>
                      <?php if ( $data['post_top_comments_show'] == 1 ) {
                        $khafagy_post->comments_number();
                      } ?>
                    </div>
                  </div>

							  </div>

            <?php } ?>
        	</header><!-- .entry-header -->
          <?php if ( $data['post_bottom_author_block_small_show'] == 1 && !in_array( $data['articles_categorie'], $_categorie_IDs )) { ?>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="author-views-comments">
              <div class="authorimg">
                <?php
                  if (empty( get_crop_avatar() )) {
                    echo "<img alt='". khy_author_name()."' src='". khafagy_get_logo_src()."' />";
                  }else {
                    echo "<img alt='". khy_author_name()."' src='".get_crop_avatar( array('width' => '70', 'height' => '70') )."' />";
                  }
                 ?>
              </div>
              <div class="authorditals">
                <div class="post-name">
                  <?php echo khy_post_name(); ?>
                </div>
                <div class="author-name" >
                  <?php echo khy_author_name(); ?>
                </div>
              </div>
            </a>
          <?php } ?>



          <?php if( in_array( $data['articles_categorie'], $_categorie_IDs ) /*&&  $data['articles_related_post'] == 1*/ ) {
             $avatar = get_crop_avatar(array('width' => '101', 'height' => '101'));
             ?>
             <div class="articles-authorbox">
               <?php if( $data['post_bottom_author_avatar_show'] == 1 ) { ?>
                 <div class="authorimg">
                   <?php if ( empty( $avatar ) ){
                     echo '<img src="'. $khafagy_post->get_thumbnail( array('width' => '101', 'height' => '101') ).'" />';

                   }else {
                     ?>
                     <img src="<?php echo $avatar; ?>">
                     <?php
                   } ?>
                 </div>
               <?php } ?>
               <?php if( $data['post_bottom_author_name_show'] == 1 ) { ?>
                 <div class="author_name">
                   <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo khy_author_name(); ?></a>
                 </div>
               <?php } ?>
               <div class="authorposts">
                 <?php echo get_related_author_posts(); ?>
               </div>
             </div>
           <?php } ?>

        	<div class="entry-content clearfix">
            <?php
            if ( 'post' == get_post_type() ) {
              $author_name = get_post_meta(get_the_ID(), '_author_name', true);
              if (!empty($author_name) && ( in_array( '514', $_categorie_IDs ) || in_array( '6723' , $_categorie_IDs ) ) ) {
                ?>
                <div class="author">
                  <div class="thumbnail"><?php echo '<img alt="'.the_title_attribute(array('echo' => 0)).'" class="the-image" title="'.the_title_attribute(array('echo' => 0)).'" src="'.get_croped_image( get_the_ID() ).'" />'; ?></div>
                  <div class="author-name"><?php echo $author_name; ?></div>
                </div>
                <?php
              }
            }
            ?>

            <?php the_content(); ?>

        		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
            <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
          </div><!-- .entry-content -->
          <!-- ADS -->
          <?php if( $data["button_singular_ads"] ) { ?>
            <div class="button_singular_ads banner">
              <?php
              if ( !empty( $data['button_singular_banner_code'] ) ):
                 echo $data['button_singular_banner_code'];

              elseif ( !empty( $data['button_singular_banner_src'] ) ):
                $image_src = $data['button_singular_banner_src'];
                $link_start = $data['button_singular_banner_link'] ? '<a href="'.check_link( $data['button_singular_banner_link'] ).'" target="_blank">' : '';
                $link_end = $data['button_singular_banner_link'] ? '</a>' : '';
                echo $link_start.'<img src="'. $image_src .'" />'.$link_end;

              endif;
               ?>
            </div>
          <?php } ?>

					<?php if( is_single() ) {?>
        	<footer class="entry-meta">
								<?php $tag_list = get_the_tag_list( '', __( '', 'twentyeleven' ) ); ?>
								<?php if( !empty($tag_list) && $data['post_bottom_tags_show'] == 1 ) { ?>
								<div class="tags clearfix">
									<!-- <div class="title">الكلمات الدليلية</div> -->
									<div class="tags-list"><?php echo $tag_list; ?></div>
								</div>
								<?php } ?>
                <input type="hidden" class="the_counter_info" data-post-id="<?php the_ID(); ?>" data-url="<?php echo esc_url( home_url( '/' ) ); ?>" />


        	</footer><!-- .entry-meta -->
          <div class="share-icons jquery-share" date-url="<?php echo str_replace( 'http://www.', '', wp_get_shortlink() ); ?>" date-title="<?php echo get_the_title(); ?>"> <!--bloginfo('name') . ' | ' . -->
            <?php if ( $data['post_top_facebook_show'] == 1 ) { ?>
               <div href="#" class="facebook"></div>
            <?php } ?>
            <?php if ( $data['post_top_twitter_show'] == 1 ) { ?>
               <div href="#" class="twitter"></div>
            <?php } ?>
            <?php if ( $data['post_top_telegram_show'] == 1 ) { ?>
               <div href="#" class="telegram"></div>
            <?php } ?>
            <?php if ( $data['post_top_whatsapp_show'] == 1 ) { ?>
               <div href="#" class="whatsapp"></div>
            <?php } ?>
            <?php if ( false && $data['post_top_linkedin_show'] == 1 ) { ?>
               <div href="#" class="linkedin"></div>
            <?php } ?>
            <?php if ( false && $data['post_top_pinterest_show'] == 1 ) { ?>
               <div href="#" class="pinterest"></div>
            <?php } ?>
            <?php if ( false && $data['post_top_email_show'] == 1 ) { ?>
               <div href="#" class="email"></div>
            <?php } ?>

          </div>
					<?php } ?>

        </article><!-- #post-<?php the_ID(); ?> -->





				<?php if( is_single() ) { ?>

					<?php
					$args = array(
					  'post_type' => $post->post_type,
					  'post__not_in' => array($post->ID),
					  'posts_per_page' => $data['post_related_count'],
					  'no_found_rows' => true
					);

					$cat_array = array();
					foreach( (array) get_the_category() as $category) {
						 $cat_array[] = $category->cat_ID;
					}

					$post_tags = wp_get_post_tags( get_the_ID() );

					if ( $post_tags ) {
					  $tag_ids = array();
					  foreach( $post_tags as $individual_tag ){
							$tag_ids[] = $individual_tag->term_id;
						}
						$args['tag__in'] = $tag_ids;
					} else {
						$args['category__in'] = $cat_array;
					}

					$the_query = new WP_Query( $args );
					if($the_query->have_posts() && $data['post_related_show'] == 1 ) {
					?>

	        <div class="bordered-block related-posts clearfix">
						<div class="clearfix read-title-block" style="border-color:<?php  echo $data["post_related_border_color"]; ?>;background:<?php  echo $data["post_related_bar_background_color"]; ?>">
							<div class="block-title" style="background-color:<?php  echo $data["post_related_title_background_color"]; ?>;color:<?php  echo $data["post_related_title_color"]; ?>"> اخبار متعلقة</div>
						</div>
						<div class="row-block section-a section background-block">
								<?php
								$i = 1;
								while ( $the_query->have_posts() ) : $the_query->the_post();
									echo '<div class="fourth">';
									  get_template_part('parts/section-a/section','a');
									echo '</div>';
									$i++;
								endwhile;
								wp_reset_postdata();
								unset($the_query);
								?>
						</div>
	        </div>
				<?php } ?>

        <?php if ( $data['post_comments_show'] == 1 ) { ?>
          <!-- <div class="add-comment">
            <span class="add"> أضفة تعليق</span>
            <span class="remove">أغلاق التعليق</span>

          </div> -->
	        <div class="comments">
	         <?php comments_template( '', true ); ?>
	        </div>

			<?php }
      } ?>

			</div><!-- #content -->
		</div><!-- #primary -->
  </div>

<?php endwhile; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
