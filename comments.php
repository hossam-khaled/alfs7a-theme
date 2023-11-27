<?php
/**
 * The template for displaying Comments.
 *
 * Display current comments & comments form
 */
?>
	<div id="comments" class="clearfix">
	<?php
  $num_comments = get_comments_number(); // get_comments_number returns only a numeric value

  $standard = array("0","1","2","3","4","5","6","7","8","9");
  $east_arabic = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");

  $num_comments = str_replace($standard , $east_arabic , $num_comments);

  ?>
  <h3 class="main-title">
   التعليقات (<?php echo $num_comments; ?>)
   <a href="#" class="add-a-comment scroll-to" data-target="respond">أضف تعليق</a>
  </h3>

  <?php if ( post_password_required() ) : ?>
	<hr />
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'solo' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
	endif;

	if ( have_comments() ) :
  ?>

<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :?>
		 <p class="nocomments">التعليقات مغلقة</p>
<?php endif; ?>

<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$comments_settings = array( 'fields' => apply_filters( 'comment_form_default_fields', array(
	'author' =>         '<p class="comment-form-author">' .
											'<label for="author">' . __( 'Name' ) . '</label> ' .
											( $req ? '<span class="required">*</span>' : '' ) .
											'<input id="author" name="author" type="text" value="' .
											esc_attr( ( !empty( $commenter['comment_author'] ) ? $commenter['comment_author'] : 'زائر'  ) ) . '" size="30" title="'. __( 'Name' ) .' (اختيارى)" tabindex="1"' . $aria_req . ' />' .
											'</p><!-- #form-section-author .form-section -->',

	// 'email' =>          '', '<p class="comment-form-email">' .
	// 										'<label for="email">' . __( 'Email' ) . '</label> ' .
	// 										( $req ? '<span class="required">*</span>' : '' ) .
	// 										'<input class="required defaultInvalid email" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" title="'. __( 'Email' ) .'" tabindex="2"' . $aria_req . ' />' .
	// 										'</p><!-- #form-section-email .form-section -->',

	'url' =>            ''

	) ),

 'comment_field' =>   '<p class="comment-form-comment">' .
											'<label for="comment">' . __( 'التعليق' ) . '</label>' .
											'<textarea class="required defaultInvalid" id="comment" name="comment" cols="45" rows="8" title="'. __( 'كتابة التعليق' ) .'" tabindex="4" aria-required="true"></textarea>' .
											'</p><!-- #form-section-comment .form-section -->',


	'must_log_in' => '<p class="must-log-in">' . sprintf( __( 'يجب ان تقوم بـ <a href="%s">تسجيل الدخول</a> لكى تصيف تعليق' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'انت مسجل بأسم <a href="%s">%s</a>. <a href="%s" title="Log out of this account">تسجيل خروج</a></p>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ),
	'comment_notes_before' => '<p class="comment-notes">' . __( 'بريدك الالكترونى لن نقوم بأستخدامه.' ) . ( $req ? __( ' الحقول المطلوبه عليها علامة <span class="required">*</span>' ) : '' ) . '</p>',
	'comment_notes_after' => '<dl class="form-allowed-tags"><dt>' . __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:' ) . '</dt> <dd><code>' . allowed_tags() . '</code></dd></dl>',
	'id_form' => 'commentform',
	'id_submit' => 'submit',
	'title_reply' => __( '<span>أضف تعليق</span>' ),
	'title_reply_to' => __( 'اترك تعليق على %s' ),
	'cancel_reply_link' => __( 'الغاء الرد' ),
	'label_submit' => __( 'أضافة تعليق' ),
	);
	?>


	<?php comment_form($comments_settings, $post->ID); ?>

  <div class="display-comments">

    <ol class="commentlist">
    <?php
    	wp_list_comments( array('callback' => 'solo_comments_format' ) );
    ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    	<nav class="comments-navigation clearfix">
    		<?php paginate_comments_links(array('type' => 'list','next_text' => '&raquo;','prev_text' => '&laquo;')); ?>
    	</nav>
    <?php endif; ?>

  </div>



</div><!-- #comments -->
