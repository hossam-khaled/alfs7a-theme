<div class="swiper-holder">
<div class="slider-container">
  <div id="slider">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php
        global $khafagy_post;
        $the_query = new WP_Query( array(
          'cat' => '23',
          'posts_per_page'=>'5',
          'ignore_sticky_posts' => '1',
          'no_found_rows' => true
        ));
        $category = get_post_first_cat();
        ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php $GLOBALS['the_featured_posts'][] = get_the_ID(); ?>
          <div class="swiper-slide">
            <a href="<?php the_permalink(); ?>">
              <article class="single-post clearfix">
                <?php $khafagy_post->thumbnail( array( 'width' => 1170, 'height' => 632 ) ); ?>
                <div  class="content">
                  <time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>" pubdate><?php echo get_the_date('d M Y'); ?></time>
                  <h2 class="the-title"><?php the_title();?></h2>
                  <div class="area"><?php echo $category['title']; ?></div>
                </div>
              </article>
            </a>
          </div>
        <?php endwhile;?>
      </div>
    </div>

    <div class="pagination">
      <?php
      $i = 1;
      while ( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="swiper-pagination-bullet">
          <?php echo $i  ?>
        </div>
        <?php
        $i++;
      endwhile;
      ?>
  </div>
</div>
</div>
</div>
