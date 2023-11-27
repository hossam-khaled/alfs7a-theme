<!-- Block B -->
<?php global $khafagy_post; ?>
<article class="single-post clearfix">
  <?php $khafagy_post->thumbnail( array( 'width' => 350, 'height' => 250 ) ); ?>
  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title($before = '', $after = '', FALSE); ?>" class="title">
    <h2 class="the-title"><?php echo string_limit_words(get_the_title($before = '', $after = '', FALSE), 15); ?></h2>
  </a>
</article>
<!-- Block B End -->
