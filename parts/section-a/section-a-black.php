<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="text">
    <?php $khafagy_post->title(); ?>
    <div class="details">
      <?php $khafagy_post->time(); ?>
      <?php $khafagy_post->views(); ?>
      <?php $khafagy_post->comments_count(); ?>
    </div>
  </div>
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 360, 'height' => 180 ) ); ?>
  </div>
</a>
