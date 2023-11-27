<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 700, 'height' => 498 ) ); ?>
  </div>
  <div class="text">
    <div class="details">
      <?php // $khafagy_post->date_time(); ?>
      <?php $khafagy_post->category(); ?>
    </div>
    <?php $khafagy_post->title(); ?>
  </div>
</a>
