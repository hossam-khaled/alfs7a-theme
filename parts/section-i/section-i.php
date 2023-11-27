<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="text">
    <?php $khafagy_post->title(); ?>
  </div>
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 320, 'height' => 220 ) ); ?>
  </div>
  <div class="text">
    <?php $khafagy_post->excerpt( array( 'count' => 10 ) ); ?>
    <div class="details">
      <?php $khafagy_post->date_time(); ?>
    </div>
  </div>
</a>
