<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post clearfix">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 71, 'height' => 71 ) ); ?>
  </div>
  <div class="text">
    <?php $khafagy_post->title(); ?>
    <div class="title-name"><?php echo khy_author_name(); ?></div>

  </div>
</a>
