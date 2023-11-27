<?php global $hajri_date;?>
<?php global $khafagy_post;?>
<a href="<?php the_permalink(); ?>" class="single-post clearfix">
  <div class="text">
    <div class="details">
      <time class="date" datetime="<?php echo esc_attr(get_the_date( 'c' )); ?>" pubdate>
        <?php echo $hajri_date->date("jS F Y",get_the_time('U')).' هـ -  '.$hajri_date->date("jS F Y",get_the_time('U'),0).' م'; ?>
      </time>
    </div>
    <?php $khafagy_post->title(); ?>
  </div>
</a>
