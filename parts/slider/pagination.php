<?php global $khafagy_post;
global $hajri_date;?>
<a href="<?php the_permalink(); ?>" class="single-post" style="background-color:<?php echo $instance['bar_color']?>;">
  <div class="thumbnail-block">
    <?php $khafagy_post->thumbnail( array( 'width' => 303, 'height' => 210 ) ); ?>
  </div>
  <div class="inner">
    <div class="ditals">
      <?php //$khafagy_post->category(); ?>
    </div>
    <?php $khafagy_post->title(); ?>
    <div class="ditals">
      <?php $khafagy_post->date(); ?>
      <?php //$khafagy_post->comments_count(); ?>
    </div>
  </div>
</a>
