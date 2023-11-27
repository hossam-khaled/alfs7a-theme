<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 680, 'height' => 430 ) ); ?>
  </div>
  <div class="text">
    <div class="details">
      <?php $khafagy_post->date(); ?>
      <?php $khafagy_post->views(); ?>
    </div>
    <?php $khafagy_post->title(); ?>
    <?php $khafagy_post->excerpt( array( 'count' => 30 ) ); ?>
  </div>
</a>
