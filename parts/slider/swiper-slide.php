<?php
  global $khafagy_post;
  global $hajri_date;
?>
<div class="swiper-slide">
  <a href="<?php the_permalink(); ?>" class="single-post">
    <div class="thumbnail-block">
      <?php $khafagy_post->thumbnail( array( 'width' => 970, 'height' => 840 ) ); ?>
    </div>
    <div class="inner">
      <?php $khafagy_post->title(); ?>
      <div class="ditals">
        <?php $khafagy_post->category(); ?>
        <?php  $khafagy_post->date(); ?>
        <?php // $khafagy_post->comments_count(); ?>
        <div class="views">
          المشاهدات : <?php echo $khafagy_post->get_views(); ?>
        </div>
      </div>
    </div>
  </a>
</div>
</a>
