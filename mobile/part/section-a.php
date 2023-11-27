<?php $category = get_post_first_cat(); ?>
<a href="<?php echo mobilize_link( get_permalink() ); ?>" class="single-post">
  <?php
    global $khafagy_post;
    $khafagy_post->thumbnail( array( 'width' => 350, 'height' => 250 ) );
  ?>
  <div class="text">
    <div class="details">
      <div class="category"><?php echo $category['title']; ?></div>
    </div>
    <h2 class="the-title"><?php the_title(); ?></h2>
  </div>
</a>
