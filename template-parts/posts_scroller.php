<?php
global $data;
$args = array(
  'posts_per_page' => 12,
  'no_found_rows' => true
);
$the_query = new WP_Query( $args );
if( $the_query->have_posts() ) {
?>
<script type="text/javascript">
  jQuery(document).ready(function($){
    khafagy_post_scroller_timer = parseInt( <?php echo $data["postsscroller_speed"]; ?> * 1000 );
    $('#posts-scroller .left').click(function(){
       khafagy_post_scroller_prev();
       clearInterval(khafagy_post_scroller_interval);
       khafagy_post_scroller_interval  = setInterval(function(){ khafagy_post_scroller_next() }, khafagy_post_scroller_timer);
       return false;
    });

    $('#posts-scroller .right').click(function(){
       khafagy_post_scroller_next();
       clearInterval(khafagy_post_scroller_interval);
       khafagy_post_scroller_interval  = setInterval(function(){ khafagy_post_scroller_next() }, khafagy_post_scroller_timer);
       return false;
    });

    function khafagy_post_scroller_prev(){
      $('#posts-scroller .news a:last').hide().prependTo($('#posts-scroller .news')).slideDown();
    }
    function khafagy_post_scroller_next(){
      $('#posts-scroller .news a:first').slideUp( function () { $(this).appendTo($('#posts-scroller .news')).show(); });
    }
    khafagy_post_scroller_interval  = setInterval(function(){ khafagy_post_scroller_next () }, khafagy_post_scroller_timer);
  });
</script>
<div id="posts-scroller">
  <?php if( !empty( $data["postsscroller_title"] ) ) { ?>
    <div class="title"><?php echo $data["postsscroller_title"]; ?></div>
  <?php } ?>
  <div class="news">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <a href="<?php the_permalink();?>" class="warning <?php echo $alert_class; ?>">
        <b><?php echo $term_list[0]->name; ?></b> <?php the_title(); ?>
      </a>
    <?php endwhile; ?>
  </div>
  <div class="controls">
    <a href="#" class="right"></a>
    <a href="#" class="left"></a>
  </div>
</div>
<?php }
