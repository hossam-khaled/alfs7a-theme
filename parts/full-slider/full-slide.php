<?php
  global $khafagy_post;
  global $hajri_date;
?>
<div class="swiper-slide">
  <a href="<?php the_permalink(); ?>" class="single-post" style="background-image:url('<?php echo get_the_post_thumbnail_url( get_the_ID() , 'full' ) ?>')">
    <div class="thumbnail-block">
      <?php $khafagy_post->thumbnail( array( 'width' => 1900, 'height' => 650 ) ); ?>
    </div>
    <div class="inner">
      <?php $khafagy_post->title(); ?>
      <?php $khafagy_post->excerpt( array( 'count' => 40 ) ); ?>
      <div class="more">
        شاهد المزيد
      </div>
    </div>
  </a>
</div>
</a>
