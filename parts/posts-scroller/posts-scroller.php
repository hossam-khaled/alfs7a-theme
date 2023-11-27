<?php
global $data;
global $khafagy_post;
$args = array(
  'posts_per_page' => 12,
  'no_found_rows' => true
);
$the_query = new WP_Query( $args );
if( $the_query->have_posts() ) {
?>

  <script type="text/javascript">
    // jQuery(document).ready(function($){
    //   khafagy_post_scroller_timer = parseInt( <?php echo $data["postsscroller_speed"]; ?> * 1000 );
    //   $('#world-now .left').click(function(){
    //      khafagy_post_scroller_prev();
    //      clearInterval(khafagy_post_scroller_interval);
    //      khafagy_post_scroller_interval  = setInterval(function(){ khafagy_post_scroller_next() }, khafagy_post_scroller_timer);
    //      return false;
    //   });
    //
    //   $('#world-now .right').click(function(){
    //      khafagy_post_scroller_next();
    //      clearInterval(khafagy_post_scroller_interval);
    //      khafagy_post_scroller_interval  = setInterval(function(){ khafagy_post_scroller_next() }, khafagy_post_scroller_timer);
    //      return false;
    //   });
    //
    //   function khafagy_post_scroller_prev(){
    //     $('#world-now .news a:last').hide().prependTo($('#world-now .news')).slideDown();
    //   }
    //   function khafagy_post_scroller_next(){
    //     $('#world-now .news a:first').slideUp( function () { $(this).appendTo($('#world-now .news')).show(); });
    //   }
    //   khafagy_post_scroller_interval  = setInterval(function(){ khafagy_post_scroller_next () }, khafagy_post_scroller_timer);
    // });
  </script>

  <script type="text/javascript">
    jQuery(document).ready(function($){
      // scroll left to right
      $('#world-now .news ').marquee({
        speed: <?php if ( empty( $data['postsscroller_speed'] ) ) { echo "5000"; }else { echo $data['postsscroller_speed']; } ?>,
        gap: 3,
        delayBeforeStart: 35,
        direction: 'right',
        duplicated: true,
        pauseOnHover: true,
        allowCss3Support: false
      });

    });
  </script>

<div id="world-now" style="background-color:<?php  echo $data['postsscroller_background'] ?>;">
  <?php if( !empty( $data["postsscroller_title"] ) ) { ?>
    <div class="title"><h4 style="background-color:<?php  echo $data['postsscroller_background_title'] ?>; color:<?php  echo $data['postsscroller_color_title'] ?>;"><?php echo $data["postsscroller_title"]; ?></h4></div>
  <?php } ?>
  <div class="news">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <a href="<?php the_permalink();?>" class="warning <?php echo $alert_class; ?>">
        <?php //$khafagy_post->date(); ?>
        <b><?php echo $term_list[0]->name; ?></b>
        <?php $khafagy_post->title(); ?>
      </a>
    <?php endwhile; ?>
  </div>
  <div class="controls">
    <a href="#" class="right"></a>
    <a href="#" class="left"></a>
  </div>
</div>
<?php }
