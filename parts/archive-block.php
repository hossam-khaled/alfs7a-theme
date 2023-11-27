<?php
   global $data;
   global $khafagy_post;
?>
<article class="single-post clearfix">
  <div class="thumbnail-block">
   <a href="<?php the_permalink(); ?>">
     <?php if ( !is_archive() || $data['archive_category_show'] == 1 ) { ?>
       <div class="details cat">
         <?php $khafagy_post->category(); ?>
       </div>
     <?php } ?>
     <?php $khafagy_post->thumbnail( array( 'width' => 350, 'height' => 215 ) ); ?>
     <div class="details position">
       <?php if ( !is_archive() || $data['archive_date_show'] == 1 ) { ?>
         <?php $khafagy_post->time(); ?>
        <?php } ?>
        <?php if ( !is_archive() || $data['archive_views_show'] == 1 ) { ?>
          <?php $khafagy_post->views(); ?>
        <?php } ?>
        <?php if ( !is_archive() || $data['archive_comments_show'] == 1 ) { ?>
           <?php $khafagy_post->comments_count(); ?>
       <?php } ?>

     </div>
   </a>
  </div>
  <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title($before = '', $after = '', FALSE); ?>" class="text">
     <?php $khafagy_post->title(); ?>
     <?php $khafagy_post->excerpt( array( 'count' => 35 ) ); ?>

     <div class="details">
       <?php if ( is_archive() && $data['archive_author_show'] == 1 ) { ?>
         <div class="auther-name"><?php echo khy_author_name(); ?></div>
        <?php } ?>
     </div>

  </a>
</article>
