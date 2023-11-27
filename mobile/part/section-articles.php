<a href="<?php echo mobilize_link( get_permalink() ); ?>" class="single-post clearfix">
  <?php
    global $khafagy_post;
    $khafagy_post->thumbnail( array( 'width' => 350, 'height' => 250 ) );
  ?>
  <div class="text">
    <div class="title-name"><?php the_author(); ?></div>
    <h2 class="the-title"><?php the_title(); ?></h2>
  </div>
</a>
