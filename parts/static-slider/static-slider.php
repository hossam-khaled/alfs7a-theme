<?php
global $khafagy_post;
global $hajri_date;?>
<a href="<?php the_permalink(); ?>" class="single-post">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 600, 'height' => 425 ) ); ?>
  </div>

  <div class="text">
    <?php $khafagy_post->title(); ?>
    <div class="details">
      <?php //$khafagy_post->category(); ?>
      <?php $khafagy_post->h_m_date(); ?>
      <?php $khafagy_post->comments_count(); ?>
      <?php $khafagy_post->views(); ?>
      <!-- <div class="views">
        المشاهدات : <?php //echo $khafagy_post->get_views(); ?>
      </div> -->
    </div>
  </div>
</a>
