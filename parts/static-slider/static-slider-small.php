<?php global $khafagy_post;
global $hajri_date;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 296, 'height' => 211 ) ); ?>
  </div>
  <div class="text">
    <?php $khafagy_post->title(); ?>
    <div class="details">
      <?php //$khafagy_post->category(); ?>
      <?php $khafagy_post->h_m_date(); ?>
    </div>
  </div>
</a>
