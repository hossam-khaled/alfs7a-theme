<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post clearfix">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 141, 'height' => 91 ) ); ?>
  </div>
  <div class="text">
    <?php $khafagy_post->title(); ?>
    <div class="details">
      <?php $khafagy_post->date(); ?>
      <?php $khafagy_post->views(); ?>
      <!-- <div class="views">
        المشاهدات : <?php //echo $khafagy_post->get_views(); ?>
      </div> -->
    </div>
  </div>
</a>
