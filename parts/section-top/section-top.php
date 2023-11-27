<?php
    global $khafagy_post;
?>
<a href="<?php the_permalink(); ?>" class="single-post clearfix">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 110, 'height' => 81 ) ); ?>
  </div>
  <div class="text">
    <div class="details">
      <?php $khafagy_post->category(); ?>
      <?php $khafagy_post->views(); ?>
      <!-- <div class="views">
        المشاهدات : <?php //echo $khafagy_post->get_views(); ?>
      </div> -->
    </div>
    <?php $khafagy_post->title(); ?>

</div>
</a>
