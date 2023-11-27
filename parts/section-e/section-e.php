<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 689, 'height' => 437 ) ); ?>
  </div>
  <div class="text">
    <?php $khafagy_post->title(); ?>
    <div class="details">
      <?php $khafagy_post->date_time(); ?>
    </div>
  </div>
</a>
