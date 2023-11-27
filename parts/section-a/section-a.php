<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 360, 'height' => 220 ) ); ?>
  </div>
  <div class="text">
    <?php $khafagy_post->title(); ?>
     <div class="details">
       <?php $khafagy_post->comments_number(); ?>
       <?php $khafagy_post->views(); ?>
     </div>
   </div>
</a>
