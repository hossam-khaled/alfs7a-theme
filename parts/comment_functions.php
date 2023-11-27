<?php

  if ( ! function_exists( 'solo_comments_format' ) ) :

    function solo_comments_format( $comment, $args, $depth ) {
      global $data;
      $GLOBALS['comment'] = $comment;
      global $post;
      if ($comment->comment_approved == 0 ) return;
      switch ( $comment->comment_type ) :
        case 'pingbackx' :
        case 'trackbackx' :
        ?>
        <li class="post pingback">
          <p><?php _e( 'Pingback:', 'solo' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'solo' ), '<span class="edit-link">', '</span>' ); ?></p>
        <?php
            break;
          default :
        ?>

        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
          <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer class="comment-meta">
              <?php
                if (!isset($GLOBALS['comment_count']) ) {
                  $GLOBALS['comment_count'] = get_comments_number();
                } else {
                  $GLOBALS['comment_count']--;
                }

                $comment_counting = $GLOBALS['comment_count'];
                $standard = array("0","1","2","3","4","5","6","7","8","9");
                $east_arabic = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");

                $comment_counting = str_replace($standard , $east_arabic , $comment_counting);
              ?>
              <?php if( $data['post_comments_number_show'] == 1 ) { ?>
                <div class="comment-count">
                    <?php echo $comment_counting; ?>
                </div>
              <?php } ?>
              <div class="comment-author vcard">
                <?php if ( false /*($comment->comment_type == 'pingback') or ($comment->comment_type == 'trackback')*/){?>
                  <img alt="" src="<?php echo get_bloginfo( 'template_url' ); ?>/images/pingback_commentor.png" class="avatar avatar-40 photo" height="40" width="40" />
                <?php } ?>
                <?php //echo get_avatar( $comment, '40' ); ?>
                <span class="author-name"><?php echo get_comment_author() ?> <time><?php echo get_comment_date('d M Y . h:m a'); ?></time></span>
                <?php if ($comment->user_id == $post->post_author) { ?><span class="is-post-author"><?php _e( '(الكاتب)', 'solo' ); ?></span><?php  }  ?>
                <?php edit_comment_link( __( 'تعديل', 'solo' ), '<span class="edit-link">', '</span>' ); ?>
                <?php if ( $comment->comment_approved == '0') : ?><em class="comment-awaiting-moderation"><?php _e( 'شكرا لك, تعليقك بأنتظار الموافقة', 'solo' ); ?></em><?php endif; ?>
              </div><!-- .comment-author .vcard -->

            </footer>
            <div class="comment-content">
            <?php if (($comment->comment_type == 'pingback') or ($comment->comment_type == 'trackback')){?>
              <?php echo strip_tags(get_comment_text()); ?>
            <?php } else {?>
              <?php comment_text(); ?>
            <?php }?>
            </div>
            <?php if( $data['post_comments_reply_show'] == 1 ) { ?>
                <div class="reply">
                  <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'اضافة رد', 'solo' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            <?php } ?>

            <?php echo getPostLikeLink($comment->comment_ID); ?>
          </article><!-- #comment-## -->

        <?php
            break;
        endswitch;

    }
  endif; // ends check for twentyeleven_comment()


  function post_like() {
    $nonce = $_POST['nonce'];

      if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
          die ( 'Busted!');

    if($_POST['comment_review'] == 'like') {
      $meta_key = 'votes_like_count';
    } elseif($_POST['comment_review'] == 'hate') {
      $meta_key = 'votes_hate_count';
    } else {
      return;
    }

    if(isset($_POST['comment_review']))
    {
      $ip = $_SERVER['REMOTE_ADDR'];

      $comment_id = $_POST['comment_id'];
      $meta_count = get_comment_meta($comment_id, $meta_key, true);


      if(!hasAlreadyVoted($comment_id)) {

        update_comment_meta($comment_id, $meta_key, ++$meta_count);
        $standard = array("0","1","2","3","4","5","6","7","8","9");
        $east_arabic = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        $meta_count = str_replace($standard , $east_arabic , $meta_count);
        $meta_count = ($_POST['comment_review'] == 'like') ? '+'.$meta_count : '-'.$meta_count;
        die($meta_count);
      }
      else {
        die('already');
      }
    }
    exit;
  }
  add_action('wp_ajax_nopriv_post-like', 'post_like');
  add_action('wp_ajax_post-like', 'post_like');

  wp_enqueue_script('like_post', get_template_directory_uri().'/js/post-like.js', array('jquery'), '1.0', 1 );
  wp_localize_script('like_post', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajax-nonce')
  ));


  function hasAlreadyVoted($comment_id) {
    $comments = isset($_COOKIE["posts_ids"]) ? unserialize(base64_decode($_COOKIE["posts_ids"])) : array();
    if( in_array( $comment_id,(array) $comments ) )
    {
        return true;
    } else {
        $comments[] = $comment_id;
        $comments = base64_encode(serialize($comments));
        setcookie('posts_ids', $comments, time()+31536000);
        return false;
    }
    return false;
  }


  function getPostLikeLink($comment_id) {
    $themename = "Alweam";

    $likes = get_comment_meta($comment_id, "votes_like_count", true);
    $hates = get_comment_meta($comment_id, "votes_hate_count", true);
    if(empty($likes)){ $likes = 0; }
    if(empty($hates)){ $hates = 0; }


    $standard = array("0","1","2","3","4","5","6","7","8","9");
    $east_arabic = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");

    $likes = str_replace($standard , $east_arabic , $likes);
    $hates = str_replace($standard , $east_arabic , $hates);
    global $data;
    if( $data['post_comments_like_show'] == 1 ) {
        $output = '<ul class="comment-like">';
          $output .= '<input type="hidden" class="already-reviewed" data-message="عفوا لقد قمت بأبداء رأيك على نفس التعليق من قبل">';
          $output .= '<li class="count like">+'.$likes.'</li>';
          $output .= '<li class="button like-button"><a href="#" data-post_id="'.$comment_id.'" data-comment_review="like" class="like" title="'.__('اعجبنى', $themename).'"></a></li>';
          $output .= '<li class="button hate-button"><a href="#" data-post_id="'.$comment_id.'" data-comment_review="hate" class="hate"  title="'.__('لم يعجبنى', $themename).'"></a></li>';
          $output .= '<li class="count hate">-'.$hates.'</li>';
        $output .= '</ul>';
    }
    return $output;
  }
