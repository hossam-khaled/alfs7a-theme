<?php
$term_list = wp_get_post_terms(get_the_ID(), 'extra_type');
$_alert_link_type = get_post_meta(get_the_ID(), '_alert_link_type', true);
$alert_word = get_post_meta(get_the_ID(), '_alert_word', true);
$alert_color = get_post_meta(get_the_ID(), '_alert_color', true);
$alert_word = $alert_word ? $alert_word : 'خبر عاجل';
$alert_class = $alert_color ? $alert_color : 'red';

global $khafagy_post;

if($_alert_link_type == 'without-link'){
  ?>
  <div class="immediate-news <?php echo $alert_class; ?>">
      <span class="title"><?php echo $alert_word; ?></span>
      <?php $khafagy_post->title(); ?>
  </div>
  <?php
} else {
  // $alert_link = is_mobile_request() ? get_permalink().'/?mobile=1' : get_permalink();
  ?>
  <a class="immediate-news <?php echo $alert_class; ?>" href="<?php the_permalink(); ?>" >
    <span class="title"><?php echo $alert_word; ?></span>
    <?php $khafagy_post->title(); ?>
  </a>
  <?php
}
