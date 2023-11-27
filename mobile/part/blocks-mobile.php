<?php $category = get_post_first_cat(); ?>
<a href="<?php echo mobilize_link( get_permalink() ); ?>" title="<?php echo get_the_title($before = '', $after = '', FALSE); ?>" class="single-post clearfix">
  <?php
    global $khafagy_post;
    $khafagy_post->thumbnail( array( 'width' => 350, 'height' => 250 ) );
  ?>
  <div class="text">
    <h2 class="the-title"><?php echo string_limit_words(get_the_title($before = '', $after = '', FALSE), 15); ?></h2>
    <time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>" pubdate><?php echo get_the_date('i:h a - d M Y'); ?></time>
  </div>
</a>
