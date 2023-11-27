<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$categories = get_the_category();
$category_link = get_category_link($categories[0] );
$category_name = $categories[0]->name;

global $hajri_date;
global $data;

?>

<article id="single" <?php post_class('clearfix'); ?>>

  <header class="entry-header">

    <?php dynamic_sidebar('mobile_post_above'); ?>

    <div class="title-block clearfix">
      <h2 class="small-title"><?php echo the_second_title(); ?></h2>
      <h1 class="main-title"><?php the_title(); ?></h1>
    </div>

    <div class="post-image thumbnail clearfix">
        <?php if ( is_video_post() ): ?>
          <div class="the-video">
              <?php
               $video_id = extract_video_id(get_post_meta(get_the_ID(), '_video_url', true));
               //echo '<iframe class="player" src="https://www.youtube.com/embed/'.$video_id.'?rel=0&wmode=transparent&autoplay=1" frameborder="0" allowfullscreen></iframe>';
              ?>
              <amp-youtube data-videoid="<?php echo $video_id; ?>" layout="responsive"  width="480" height="270"></amp-youtube>

          </div>
        <?php else: ?>
          <?php
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
          ?>

          <amp-img src="<?php echo $large_image_url[0]; ?>" width="990" height="700" layout="responsive" alt="<?php echo the_title_attribute(array('echo' => 0)); ?>"> </amp-img>
        <?php endif; ?>
    </div>


    <div class="tools-box">
      <div class="font-control">
       <a class="increase" title="تكبير الخط"></a>
       <a class="reset" title="الحجم الاصلى"></a>
       <a class="decrease" title="تصغير الخط"></a>
      </div>



      <div class="share-icons jquery-share" date-url="<?php echo str_replace( 'http://www.', '', wp_get_shortlink() ); ?>" date-title=" | <?php the_title_attribute(); ?>">
        <?php if ( $data['post_top_facebook_show'] == 1 ) { ?>
           <div href="#" class="facebook"></div>
        <?php } ?>
        <?php if ( $data['post_top_twitter_show'] == 1 ) { ?>
           <div href="#" class="twitter"></div>
        <?php } ?>
        <?php if ( $data['post_top_glup_show'] == 1 ) { ?>
           <div href="#" class="gplus"></div>
        <?php } ?>
        <?php if ( $data['post_top_telegram_show'] == 1 ) { ?>
           <div href="#" class="telegram"></div>
        <?php } ?>
        <?php if ( $data['post_top_whatsapp_show'] == 1 ) { ?>
           <div href="#" class="whatsapp"></div>
        <?php } ?>
        <?php if ( $data['post_top_linkedin_show'] == 1 ) { ?>
           <div href="#" class="linkedin"></div>
        <?php } ?>
        <?php if ( $data['post_top_pinterest_show'] == 1 ) { ?>
           <div href="#" class="pinterest"></div>
        <?php } ?>
        <?php if ( $data['post_top_email_show'] == 1 ) { ?>
           <div href="#" class="email"></div>
        <?php } ?>

      </div>
    </div>

    <div class="banners">
      <?php dynamic_sidebar('mobile-below-thumbnail-banner'); ?>
    </div>


	</header><!-- .entry-header -->

  <div class="author-views-comments">
    <?php if ( 'post' == get_post_type() ) : ?>
    		<?php
          if ( $author_name = _get('_author_name') ) {
          	  echo '<div class="news-author-name">'.$author_name.'</div>';
          }
        ?>
		<?php endif; ?>

    <div class="views-comments">
      <time class="date" datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
    </div>
  </div>
  <!-- <amp-font
    layout="nodisplay"
    font-family="Cairo"
    timeout="3000"
    on-error-remove-class="my-font-loading"
    on-error-add-class="my-font-missing">
  </amp-font>
  <amp-ad
    width="300"
    height="200"
    type="doubleclick"
    data-aax_size="300x250"
    data-aax_pubname="test123"
    data-aax_src="302"
    data-slot="/4119129/doesnt-exist">
  </amp-ad> -->
	<div class="entry-content clearfix">
    <?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
    <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
  </div><!-- .entry-content -->

  <div class="banners">
    <?php dynamic_sidebar('mobile-posts-banner'); ?>
  </div>

  <footer class="entry-meta">


    <?php // $tag_list = get_the_tag_list( '', __( '', 'twentyeleven' ) );
     // if(! empty($tag_list) ) { ?>
  		<!-- <div class="tags clearfix">
        <div class="title">الوسم</div>
        <div class="tags-list"><?php // echo $tag_list; ?></div>
      </div> -->
    <?php // } ?>

	</footer><!-- .entry-meta -->



  <div id="comments-block" class="<?php if( is_mobile_request() ) echo 'mobile'; ?> comments clearfix">
   <?php //comments_template( '', true ); ?>
   <a class="gocomment" href="<?php echo get_permalink(); ?>#comments">اضافة تعليق</a>
  </div>



	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
