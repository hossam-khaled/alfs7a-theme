<?php
// if( strpos($_SERVER['HTTP_HOST'], 'maljuraishi') === false ) {
//  die();
// }

/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */



/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */

add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):

	function twentyeleven_setup() {

		/* Make Twenty Eleven available for translation.
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Twenty Eleven, use a find and replace
		 * to change 'twentyeleven' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();



		// Grab Twenty Eleven's Ephemera widget.
		require_once ( get_template_directory() . '/inc/widgets.php' );
		// require_once ( get_template_directory() . '/inc/class-mobilize.php');
		require_once ( get_template_directory() . '/inc/page_options.php' );
		// require_once ( get_template_directory() . '/inc/form.class.php');
		require_once ( get_template_directory() . '/inc/theme.options.php');
		require_once ( get_template_directory() . '/inc/class-khafagy-post.php');
		// if ( is_admin() )
		//   require_once ( get_template_directory() . '/inc/desk/index.php');


		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );
		// register_nav_menu( 'tablet_menu', __( 'قائمة التابلت', 'twentyeleven' ) );
	  register_nav_menu( 'small_links', __( 'قائمة الروابط العلوية', 'twentyeleven' ) );



		// Add support for a variety of post formats
		add_theme_support( 'structured-post-formats', array(
	    'link', 'video'
	  ) );
	  add_theme_support( 'post-formats', array(
	      'aside', 'audio', 'chat', 'gallery', 'image', 'quote', 'status'
	  ) );


		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
		add_theme_support( 'post-thumbnails' );

	}
endif; // twentyeleven_setup
// var_dump(get_template_directory());
require_once ( get_template_directory() . '/admin/index.php');
require_once ( get_template_directory() . '/inc/class_khafagy_widget.php' );
require_once ( get_template_directory() . '/parts/comment_functions.php');
require_once ( get_template_directory() . '/parts/weather/weather.php');
require_once ( get_template_directory() . '/parts/prayer/prayer.php');
require_once ( get_template_directory() . '/parts/poll/poll.php');
// require_once ( get_template_directory() . '/inc/application_api.php');

function update_category_count() {
	global $data;
	$khafagy_panel_posts_count = $data['archive_posts_count'];
	$current_posts_count = get_option( 'posts_per_page' );
	if( $khafagy_panel_posts_count != $current_posts_count ) {
		update_option( 'posts_per_page', $khafagy_panel_posts_count );
	}
}
add_action('init', 'update_category_count');


function add_date_class() {
  global $hajri_date;
  require_once ( get_template_directory() . '/inc/uCal.class.php');
  $hajri_date = new uCal;
  $hajri_date->setLang("ar");
}
add_action('init', 'add_date_class');

function is_local_request() {
  if( strpos( get_bloginfo('url') , 'localhost') !== false || strpos( get_bloginfo('url') , 'khafagy.com') !== false ) return true;
  return false;
}

function add_my_scripts() {

			/* Desktop Styles */
			// if( is_desktop_request() ) {
      // }

			/* Mobile Styles */
			// if( is_mobile_request() ){
      //   wp_enqueue_style('main-stylesheet', get_template_directory_uri() . '/mobile/stylesheet-mobile.css');
      // }

			wp_enqueue_style('droidarabic-naskh', get_template_directory_uri() . '/css/font/droidarabicnaskh.css');
			wp_enqueue_style('droidarabic-kufi', get_template_directory_uri() . '/css/font/droidarabickufi.css');
			// wp_enqueue_style('Cairo', 'https://fonts.googleapis.com/css?family=Cairo');


			wp_enqueue_style('swiper-slider', get_template_directory_uri() . '/css/swiper.css');
			wp_enqueue_style('jf-font', get_template_directory_uri() . '/css/jf-font.css');
			wp_enqueue_style('helvetica', get_template_directory_uri() . '/css/helvetica.css');
      wp_enqueue_style('weather-font', get_template_directory_uri() . '/css/weather-font/weather.css');
			wp_enqueue_style('mCustomScrollbar', get_template_directory_uri() . '/css/jquery.mCustomScrollbar.css');
			wp_enqueue_style('main-stylesheet', get_template_directory_uri() . '/style.css', array(  ),  wp_get_theme()->get('Version') );

			// wp_enqueue_style( 'child-style', get_template_directory_uri() . '/css/style.css', array(  ),  wp_get_theme()->get('Version') );

			/* Load Scripts */
			// wp_deregister_script('jquery');
			// wp_register_script('jquery', get_template_directory_uri() ."/js/jquery/jquery.js", false, null);
			// wp_enqueue_script('jquery');
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script('jquery.validate', get_template_directory_uri() . '/js/jquery.validate.1.15.0.min.js', array('jquery'), null, true);
			wp_enqueue_script('swiper.jquery', get_template_directory_uri() . '/js/swiper.jquery.min.js', array('jquery'), null, false);
			wp_enqueue_script('jquery.popup', get_template_directory_uri() . '/js/jquery.popupwindow.js', array('jquery'), null, false);
			wp_enqueue_script('jquery.marquee', get_template_directory_uri() . '/js/jquery.marquee.min.js', array('jquery'), null, false);
			wp_enqueue_script('jquery.nicescroll', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.0/jquery.nicescroll.min.js', array('jquery'), null, false);
			wp_enqueue_script('google.recapatcha', 'https://www.google.com/recaptcha/api.js?hl=ar', array(), null, false);
			// wp_enqueue_script('child-custom', get_template_directory_uri() . '/js/child-custom.js', array('jquery'), null, false);

			wp_enqueue_script('html5', get_template_directory_uri() . '/js/html5.js', array('jquery'), null, true);
			wp_script_add_data( 'html5', 'conditional', '(gte IE 6)&(lte IE 8)' );

			wp_enqueue_script('selectivizr', get_template_directory_uri() . '/js/selectivizr-min.js', array('jquery'), null, true);
			wp_script_add_data( 'selectivizr', 'conditional', '(gte IE 6)&(lte IE 8)' );

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}


      // if( is_desktop_request() ) {
      // }
			wp_enqueue_script('jquery.mCustomScrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.min.js', array('jquery'), null, false);
			wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
			wp_localize_script('mobile.custom', 'ajax_var', array(
				'url' => admin_url('admin-ajax.php'),
				'nonce' => wp_create_nonce('ajax-nonce')
			));

			// if( is_mobile_request() ) {
			// 		wp_enqueue_script('custom-mobile', get_template_directory_uri() . '/mobile/js/custom-mobile.js', array('jquery'), null, true);
			// 		wp_localize_script('custom', 'ajax_var', array(
			// 			'url' => admin_url('admin-ajax.php'),
			// 			'nonce' => wp_create_nonce('ajax-nonce')
			// 		));
      // }

}
add_action( 'wp_enqueue_scripts', 'add_my_scripts' );

// register and include back-end javascripts
function admin_css() {
    wp_enqueue_style('admin-extra-style', get_template_directory_uri() . '/inc/admin-style.css');
}
add_action('admin_init', 'admin_css');

function admin_js() {
    wp_print_scripts( 'jquery' );
		wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script('admin-script', get_template_directory_uri() . '/js/custom-admin.js' , array('jquery','wp-color-picker'), null, true);
}
add_action('admin_footer', 'admin_js');

function admin_image_upload_scripts() {
	global $pagenow;
	if( $pagenow != 'profile.php' && $pagenow != 'widgets.php' && $pagenow != 'user-edit.php' ) return;
	wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_media();
}
add_action('admin_init', 'admin_image_upload_scripts');

function filter_wp_title( $title ) {
	global $page, $paged;
	if ( is_feed() ) return $title;
	$site_description = get_bloginfo( 'description' );
	$filtered_title = $title . ' ' . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';
	return $filtered_title;
}
add_filter( 'wp_title', 'filter_wp_title' );

/*
  mobile functions ( you must add them all )
*/
// function is_mobile_request() {
//   if( $_GET['mobile_amp'] ||  strpos( $_SERVER['HTTP_HOST'], 'amp.' ) !== false ) return true;
//   return false;
// }
//hossam
// function mobilize_link( $link ) {
// 	$sperator = strpos( $link , '?');
// 	return $link . $sperator . 'mobile_amp=1';
// }
// function is_mobile_request() {
//   if( $_GET['mobile_amp'] !== false ) return true;
//   return false;
// }

// function is_desktop_request() {
//   return !is_mobile_request();
// }
// mobile_comments
// function mobile_comments_url( $url ) {
//     if( is_mobile_request() && strpos( $url, 'wp-comments-post.php' ) !== false   ) // you probably don't want this in admin side
//         $url = str_replace( 'https://www.', 'https://mobile_amp.', $url );
//
//     return $url;
// }
//add_filter( 'site_url', 'mobile_comments_url' );

// mobile_redirect_after_comment
// function mobile_redirect_after_comment( $location ) {
//   if ( is_mobile_request() )
//     return str_replace( 'https://www.', 'https://mobile_amp.', $location );
//
//   return $location;
// }
//add_filter('comment_post_redirect', 'mobile_redirect_after_comment');

// function mobile_allowed_redirect_hosts($content){
// 	$content[] = 'mobile.kfj3.com';
//   $content[] = 'mobile.alkhafji.news';
// 	return $content;
// }
// add_filter( 'allowed_redirect_hosts' , 'mobile_allowed_redirect_hosts' , 10 );


// function mobile_switch() {
//   //echo $_SERVER["SERVER_NAME"];
// 	die();
//   if( $_GET['contact_us'] ) {
//     //echo 'ff';
//     get_template_part( 'template','contact' );
//  }
//   if( is_mobile_request() ) :
//      if( is_front_page() ) {
//        get_template_part( 'mobile/frontpage','mobile' );
//         die();
//      }elseif( is_archive() || is_search() ) {
//         get_template_part( 'mobile/archive','mobile' );
//         die();
//      } elseif( is_single() ){
//         get_template_part( 'mobile/single','mobile' );
//         die();
//      }
//   endif;
//
// }
// add_action( 'get_header', 'mobile_switch'  );

// class Mobile_Menu_Walker extends Walker_Nav_Menu {
//
// 	// Don't start the top level
//
// 	// Don't print top-level elements
// 	function start_el(&$output, $item, $depth=0, $args=array()) {
// 		//var_dump($item);
// 		$classes = implode(' ', (array) $item->classes);
//     echo '<li class="'.$classes.'"><a href="'.$item->url.'?mobile_amp=1">'.$item->title.'</a></li>'."\n";
// 	}
//
// 	function end_el(&$output, $item, $depth=0, $args=array()) {
// 		parent::end_el($output, $item, $depth, $args);
// 	}
// }


function the_widgets_init() {

	register_sidebar( array(
		'name' => __( 'الصفحة الرئيسية العرض الكامل بدون كنتينير ', 'twentyeleven' ),
		'id' => 'full-width-without-container-'.khy_get_child_theme_name(),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="block-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'الصفحة الرئيسية العرض الكامل ', 'twentyeleven' ),
		'id' => 'full-width-'.khy_get_child_theme_name(),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="block-title">',
		'after_title' => '</h3>',
	) );

  register_sidebar( array(
		'name' => __( 'الصفحة الرئيسية', 'twentyeleven' ),
		'id' => 'main-content-'.khy_get_child_theme_name(),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="block-title">',
		'after_title' => '</h3>',
	) );

  register_sidebar( array(
		'name' => __( 'شريط جانبى بالصفحة الرئيسية', 'twentyeleven' ),
		'id' => 'sidebar-1-'.khy_get_child_theme_name(),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title block-title">',
		'after_title' => '</h3>',
	) );

	// register_sidebar( array(
	// 	'name' => __( 'شريط جانبى للصفحات الداخلية', 'twentyeleven' ),
	// 	'id' => 'sidebar-1-inner-'.khy_get_child_theme_name(),
	// 	'description' => __( 'The sidebar for the optional Showcase Template', 'twentyeleven' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => "</aside>",
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );
  // require_once ( get_template_directory() . '/inc/khafagy_register_sidebar.php');
}
add_action( 'widgets_init', 'the_widgets_init' );

function curPageURL( $without_get = false ) {
  $pageURL = 'http';
  if ($without_get) {
    $required_script = strtok($_SERVER["REQUEST_URI"], '?');
  } else {
    $required_script = $_SERVER["REQUEST_URI"];
  }
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$required_script;
  } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$required_script;
  }
  return $pageURL;
}

// convert user non link inputs to link
function check_link($link){
  if(empty($link)){ return; }
  $string = parse_url($link);
  if (empty($string['scheme'])) $link = "http://".$link;
  return $link;
}

// get custom length excerpts
function the_new_excerpt( $args = array ('count' => 40 ,'allowed_tags' => '' ) ) {
	global $post;
	if( !is_array( $args ) ) $args = array( 'count' => $args );
	extract($args);
	$content = !empty($post->post_excerpt) ? strip_shortcodes($post->post_excerpt) : strip_shortcodes($post->post_content);
	$content = ( $allowed_tags == 'all' ) ? $content : strip_tags($content, $allowed_tags);
	$content = explode(' ', str_replace(array("\r\n", "\r", "\n"), "", $content, $allowed_tags ) );

	$tot = count($content);
	$output = implode(' ', array_slice($content, 0, $args['count']));
	$output = ( $tot > $args['count'] ) ? $output." ..." : $output;

	echo force_balance_tags($output);
}

$get_the_id = get_the_ID();

function the_second_title(){
  return get_post_meta( $get_the_id, '_second_title', true );
}
/*
   _author_name
   ترانا meta-author-name
*/
function khy_author_name(){
	global $post;
	$post_id = !empty($id) ? $id : $post->ID ;
	$author_name = get_post_meta( $post_id, '_author_name', true );
	if ( !empty( $author_name ) ) {
		return $author_name;
	}else {
		return get_the_author();
		// return string $authordata->display_name;
	}
}
// apply_filters( 'the_author', khy_author_name());

function khy_post_name(){
	global $post;
	$post_id = !empty($id) ? $id : $post->ID ;
	$post_name = get_post_meta( $post_id, '_post_name', true );
	if ( !empty( $post_name ) ) {
		return $post_name;
	}else {
		return bloginfo('name');
	}
}

function is_video_post($id = '') {
    global $post;
    $post_id = !empty($id) ? $id : $post->ID ;
    $value = get_post_meta($post_id, '_video_url', true);
    if ( empty($value) ) return false;
    return true;
}


function extract_video_id($meta) {
    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $meta, $matches)) {
          return  $matches[1];
    }
}

#get author last 5 posts
function get_related_author_posts() {
    global $authordata, $post;

    $authors_posts = get_posts( array( 'author' => $authordata->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

    $output = '<ul class="ulholder">';
    foreach ( $authors_posts as $authors_post ) {
        $output .= '<li class="liholder"><a class="urlholder" href="' . get_permalink( $authors_post->ID ) . '">' . apply_filters( 'the_title', $authors_post->post_title, $authors_post->ID ) . '</a></li>';
    }
    $output .= '</ul>';

    return $output;
}
/* start avatar */
function add_custom_user_profile_fields( $user ) {
?>
    <h3><?php _e('صورة المستخدم', 'your_textdomain'); ?></h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="address"><?php _e('صورة المستخدم', 'your_textdomain'); ?>
            </label></th>
            <td>
                <input type="text" class="upload-input" name="khafagy_author_imgurl" id="khafagy_author_imgurl" value="<?php echo esc_attr( get_the_author_meta( 'khafagy_author_imgurl', $user->ID ) ); ?>" class="regular-text" />
								<input type="button" value="رفع" class="image_upload_button"><br />
                <span class="description"><?php _e('قم برفع الصورة الخاصة بك', 'your_textdomain'); ?></span>
            </td>
        </tr>
    </table>
<?php }

function save_custom_user_profile_fields( $user_id ) {
  if ( !current_user_can( 'edit_user', $user_id ) )
      return FALSE;
  update_usermeta( $user_id, 'khafagy_author_imgurl', $_POST['khafagy_author_imgurl'] );
}
add_action( 'show_user_profile', 'add_custom_user_profile_fields' );
add_action( 'edit_user_profile', 'add_custom_user_profile_fields' );
add_action( 'personal_options_update', 'save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_custom_user_profile_fields' );

function get_crop_avatar( $args = array('width' => '99', 'height'=>'99' ) ) {
	global $blog_id;
	$user_id = isset( $args['user_ID'] ) ? $args['user_ID'] : get_the_author_meta('ID');
	$khafagy_author_imgurl = get_user_meta( $user_id, 'khafagy_author_imgurl', true );


	// fix network error
	if( isset( $blog_id ) && $blog_id > 0 ) {
		$imageParts = explode('/uploads/' , $khafagy_author_imgurl);
		if( isset( $imageParts[1] ) ) {
			$khafagy_author_imgurl = network_site_url() . '/wp-content/uploads/' . $imageParts[1];
		}
	}

	if( $khafagy_author_imgurl ) {
		if( $width == '100%' ) {
			return $khafagy_author_imgurl;
		}
		return get_template_directory_uri().'/timthumb/?src='.$khafagy_author_imgurl.'&w='.$args['width'].'&h='.$args['height'];
	}
	return false;

}

function load_admin_things() {
  wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_admin_things' );
/* end avatar */

function paginate() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('paged','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'type' => 'list',
		'next_text' => '&raquo;',
		'prev_text' => '&laquo;',
    'end_size' => 7
		);

	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => preg_replace("/ /","+",get_query_var( 's' )) );
	echo paginate_links( $pagination );
}

function new_avatar($avatar_defaults){
  $new_avatar = get_stylesheet_directory_uri() . '/images/pingback_commentor.png';
  $avatar_defaults[$new_avatar] = "Default";
  return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'new_avatar' );


function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit) {
    array_pop($words);
    return implode(' ', $words).' ...';
  } else {
    return $string;
  }
}

function khafagy_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'khafagy_page_menu_args' );

function embedUploaderCode() {
?>
    <script type="text/javascript">
		jQuery(document).ready(function($) {
			// Uploading files
			var file_frame;

			$('.image_upload_button').on('click', function( event ){

				var currentInput = $(this);
				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					file_frame.open();
					return;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: jQuery( this ).data( 'uploader_title' ),
					button: {
						text: jQuery( this ).data( 'uploader_button_text' ),
					},
					multiple: false  // Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					//console.log( attachment );
					currentInput.prev('.upload-input').attr('value',attachment.url );
					// Do something with attachment.id and/or attachment.url here
				});

				// Finally, open the modal
				file_frame.open();
			});
    });
    </script>
<?php
}
add_action('admin_head', 'embedUploaderCode');

function JSONprocessURL($url){
    $url=str_replace('&amp;','&',$url);
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $xml = curl_exec ($ch);
    curl_close ($ch);
    return $xml;
}

// hourly cron
function schedule_api_cron_hourly(){
  $timestamp = wp_next_scheduled( 'run_api_cron_hourly' );

  if( $timestamp == false ){
    wp_schedule_event( time(), 'hourly', 'run_api_cron_hourly' );
  }
}
schedule_api_cron_hourly();
/*
	_views
		ترانا  post_views_count

		maljuraishi->	post_views_count
*/
function the_views( $post_ID = '' ){
  $count = get_views($post_ID);
  echo $count;
}

function get_views( $post_ID ) {
  $count_key = 'post_views_count';
  $post_ID = $post_ID ? $post_ID : get_the_ID();
  $count =  get_post_meta($post_ID, $count_key, true);
  if(empty($count)){
        $count = 0;
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
  }
  return $count;
}

function update_views( $post_ID ){
  $count_key = 'post_views_count';
  $count =  get_post_meta($post_ID, $count_key, true);
  if(empty($count)){
        $count = 0;
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
  }
  $count++;
  update_post_meta($post_ID, $count_key, $count);
  return $count;
}

function increase_views($content = ''){
	global $post;
	if( is_single() && ! empty( $post->ID ) ) {
			if ( $post->ID == get_the_ID() ) {
					update_views ( get_the_ID() );
			}
	}
	return $content;
}
add_action( 'the_content', 'increase_views' );



function register_custom_types() {

		$post_types = array(

			// array(
			// 	'single_name' => 'news',
			// 	'multi_name' => 'news',
			// 	'arabic_single_name' => 'الأخبار',
			// 	'arabic_multi_name' => 'الأخبار'
			// ),
			// array(
			// 	'single_name' => 'report',
			// 	'multi_name' => 'report',
			// 	'arabic_single_name' => 'التحقيقات والتقارير',
			// 	'arabic_multi_name' => 'التحقيقات والتقارير'
			// ),
			// array(
			// 	'single_name' => 'article',
			// 	'multi_name' => 'articles',
			// 	'arabic_single_name' => 'مقال',
			// 	'arabic_multi_name' => 'المقالات'
			// ),
			// array(
			// 	'single_name' => 'research',
			// 	'multi_name' => 'research',
			// 	'arabic_single_name' => 'الأبحاث',
			// 	'arabic_multi_name' => 'الأبحاث'
			// ),
			// array(
			// 	'single_name' => 'gallery',
			// 	'multi_name' => 'gallery',
			// 	'arabic_single_name' => 'معرض الصور',
			// 	'arabic_multi_name' => 'معرض الصور'
			// ),
			// array(
			// 	'single_name' => 'video',
			// 	'multi_name' => 'videos',
			// 	'arabic_single_name' => 'الفيديو',
			// 	'arabic_multi_name' => 'الفيديو'
			// ),
			// array(
			// 	'single_name' => 'advertising',
			// 	'multi_name' => 'advertising',
			// 	'arabic_single_name' => 'الاعلانات',
			// 	'arabic_multi_name' => 'الاعلانات'
			// ),
			// array(
			// 	'single_name' => 'society',
			// 	'multi_name' => 'society',
			// 	'arabic_single_name' => 'المجتمع',
			// 	'arabic_multi_name' => 'المجتمع'
			// ),
			array(
				'single_name' => 'poll',
				'multi_name' => 'poll',
				'arabic_single_name' => 'تصويت',
				'arabic_multi_name' => 'التصويت'
			),
			// array(
			// 	'single_name' => 'service',
			// 	'multi_name' => 'services',
			// 	'arabic_single_name' => 'خدمات',
			// 	'arabic_multi_name' => 'الخدمات'
			// ),

			// array(
			// 	'single_name' => 'audio',
			// 	'multi_name' => 'audios',
			// 	'arabic_single_name' => 'الصوتيات',
			// 	'arabic_multi_name' => 'الصوتيات'
			// ),
		);

		foreach( $post_types as $type ) {
			$labels = array(
				'name'               => _x( $type['arabic_multi_name'], 'your-plugin-textdomain' ),
				'singular_name'      => _x( $type['arabic_single_name'], 'your-plugin-textdomain' ),
				'menu_name'          => _x( $type['arabic_multi_name'], 'your-plugin-textdomain' ),
				'name_admin_bar'     => _x( $type['arabic_multi_name'], 'your-plugin-textdomain' ),
				'add_new'            => _x( 'أضافة '. $type['arabic_single_name'], 'your-plugin-textdomain' ),
				'add_new_item'       => __( 'أضافة '.$type['arabic_single_name'], 'your-plugin-textdomain' ),
				'new_item'           => __( 'أضافة '.$type['arabic_single_name'], 'your-plugin-textdomain' ),
				'edit_item'          => __( 'تعديل '.$type['arabic_single_name'], 'your-plugin-textdomain' ),
				'view_item'          => __( 'مشاهدة  '.$type['arabic_single_name'], 'your-plugin-textdomain' ),
				'all_items'          => __( 'كل '.$type['arabic_multi_name'], 'your-plugin-textdomain' ),
				'search_items'       => __( 'البحث في '.$type['arabic_multi_name'], 'your-plugin-textdomain' ),
				'parent_item_colon'  => __( 'الاب ', 'your-plugin-textdomain' ),
				'not_found'          => __( 'لا يوجد '.$type['arabic_multi_name'].' found.', 'your-plugin-textdomain' ),
				'not_found_in_trash' => __( 'لا يوجد '.$type['arabic_multi_name'].' found in Trash.', 'your-plugin-textdomain' )
			);

			$supports = array(
				'title',
				'editor',
				'thumbnail',
				'comments'
			);

			// if( $type['single_name'] != 'slider' ) {
			// 	$supports[] = 'editor';
			// }

			$args = array(
				'labels'             => $labels,
		    'description'        => __( 'Description.', 'your-plugin-textdomain' ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => $type['multi_name'] ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => null,
				'supports'           => $supports
			);

			register_post_type( $type['multi_name'] , $args );

			$labels = array(
				'name'              => _x( ' اقسام ' . $type['arabic_multi_name'], 'taxonomy general name', 'textdomain' ),
				'singular_name'     => _x( $type['arabic_multi_name'].' category', 'taxonomy singular name', 'textdomain' ),
				'search_items'      => __( 'البحث في الاقسام', 'textdomain' ),
				'all_items'         => __( 'كل الاقسام', 'textdomain' ),
				'parent_item'       => __( 'الاب', 'textdomain' ),
				'parent_item_colon' => __( 'الاب:', 'textdomain' ),
				'edit_item'         => __( 'تعديل القسم', 'textdomain' ),
				'update_item'       => __( 'تعديل القسم', 'textdomain' ),
				'add_new_item'      => __( 'أضافة قسم جديد', 'textdomain' ),
				'new_item_name'     => __( 'أضافة قسم جديد', 'textdomain' ),
				'menu_name'         => __( ' اقسام ' . $type['arabic_multi_name'], 'textdomain' ),
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $type['multi_name'].'_cat' , 'with_front' => false ),
			);

			register_taxonomy( $type['single_name'].'_category', array( $type['multi_name'] ), $args );
		}



}
add_action( 'init', 'register_custom_types',0, 1 );

// function register_custom_types() {
//
//   $labels = array(
//     'name'               => 'التصويت',
//     'singular_name'      => 'تصويت',
//     'add_new'            => 'اضافة تصويت',
//     'add_new_item'       => 'اضافة تصويت جديد',
//     'edit_item'          => 'تعديل التصويت',
//     'new_item'           => 'تصويت جديد',
//     'all_items'          => 'كل التصويتات',
//     'view_item'          => 'مشاهدة التصويت',
//     'search_items'       => 'البحث فى التصويتات',
//     'not_found'          => 'لا يوجد تصويت',
//     'not_found_in_trash' => 'لا يوجد تصويتات بالسلة',
//     'parent_item_colon'  => '',
//     'menu_name'          => 'التصويتات'
//   );
//
//   $args = array(
//     'labels'             => $labels,
//     'public'             => true,
//     'publicly_queryable' => true,
//     'show_ui'            => true,
//     'show_in_menu'       => true,
//     'query_var'          => true,
//     'rewrite'            => array( 'slug' => 'polls' ),
//     'capability_type'    => 'post',
//     'has_archive'        => true,
//     'hierarchical'       => false,
//     'menu_position'      => null,
//     'supports'           => array( 'title', 'thumbnail', 'comments' )
//   );
//   register_post_type( 'poll', $args );
//
// }
// add_action( 'init', 'register_custom_types' );


function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'الأخبار';
    $submenu['edit.php'][5][0] = 'كل الأخبار';
    $submenu['edit.php'][10][0] = 'أضافة خبر';
    $submenu['edit.php'][16][0] = 'الأوسمة';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'الأخبار';
    $labels->singular_name = 'الأخبار';
    $labels->add_new = 'أضافة خبر';
    $labels->add_new_item = 'أضافة خبر';
    $labels->edit_item = 'تعديل الخبر';
    $labels->new_item = 'الأخبار';
    $labels->view_item = 'مشاهدة الأخبار';
    $labels->search_items = 'البحث بالأخبار';
    $labels->not_found = 'لا يوجد اخبار';
    $labels->not_found_in_trash = 'لا يوجد اخبار بالسلة';
    $labels->all_items = 'كل الأخبار';
    $labels->menu_name = 'الأخبار';
    $labels->name_admin_bar = 'الأخبار';
}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );


function _get( $key, $id='' ){
  if ( empty($id) ) $id = get_the_ID();
  return get_post_meta($id, $key, true);
}

// hide update for non administrators account
if ( !current_user_can( 'edit_users' ) ) {
  add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
  add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

function khy_get_child_theme_name() {
	$theme_info = wp_get_theme();
  $theme_name = $theme_info->get('Name');
	return $theme_name;
}


function breadcrumbs() {

  $delimiter = '&#8592;';
  $name = 'الرئيسية'; //text for the 'Home' link
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';

  if ( !is_home() && !is_front_page() || is_paged() ) {

    echo '<div id="crumbs">';

    global $post;
    $home = get_bloginfo('url');

    ?>
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
      <a href="<?php echo $home; ?>" itemprop="url">
        <span itemprop="title"><?php echo $name; ?></span>
      </a>
    </div>
    <?php
      echo ' ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) {
      ?>
      <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="<?php echo get_category_link( $parentCat->term_id ); ?>" itemprop="url">
          <span itemprop="title"><?php echo $parentCat->name; ?></span>
        </a>
      </div>
      <?php
      echo ' '.$delimiter . ' ';
      }
      ?>
      <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="<?php echo get_category_link( $thisCat->term_id ); ?>" itemprop="url">
          <span itemprop="title"><?php echo $thisCat->name; ?></span>
        </a>
      </div>
      <?php

    } elseif ( is_search() ) {
      echo $currentBefore . 'نتائج البحث لـ &#39;' . get_search_query() . '&#39;' . $currentAfter;

    } elseif ( is_tag() ) {
      ?>
      <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="<?php echo get_tag_link( get_query_var('tag_id') ); ?>" itemprop="url">
          <span itemprop="title"><?php single_tag_title(); ?></span>
        </a>
      </div>
      <?php

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      ?>
      <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
        <a href="<?php echo get_author_posts_url( $userdata->ID ); ?>" itemprop="url">
          <span itemprop="title"><?php echo 'أنت الأن تتصفح موضوعات الكاتب ' . $userdata->display_name; ?></span>
        </a>
      </div>
      <?php

    } elseif ( is_404() ) {
      echo $currentBefore . 'خطأ 404' . $currentAfter;
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() && !is_attachment() ) {
        $categories = get_the_category();
        $category_link = get_category_link($categories[0] );
        $category_name = $categories[0]->name;
        ?>
        <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
          <a href="<?php echo $category_link; ?>" itemprop="url">
            <span itemprop="title"><?php echo $category_name; ?></span>
          </a>
        </div>
      <?php
      echo ' '.$delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    }

    echo '</div>';

  }
}


// create new gallery shortcode
function create_galery(){
    global $post;
    $return = "";

    $return .= '<div class="images-gallery">';
            $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');

            	if($images = get_posts(array(
            		'post_parent'    => $post->ID,
            		'post_type'      => 'attachment',
            		'post_status'    => null,
            		'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC',
                'posts_per_page' => -1,
                'exclude'        => $post_thumbnail_id
            	))) {

              		//main image
                  $largeAttImg   = wp_get_attachment_image_src($images[0]->ID,'large');
                  $return .= '<div class="main-image">
                                <div class="loading"></div>
                                <img alt="'.the_title_attribute(array('echo' => 0)).'" title="'.the_title_attribute(array('echo' => 0)).'" src="'.$largeAttImg[0].'" />
                              </div>';

                  $return .= '<div class="image-thumbnails"><div class="row-fluid">';
                  $i = 1;
                  foreach($images as $image) {
                    $attimg   = wp_get_attachment_image_src($image->ID,'nems_post');
              			$largeAttImg   = wp_get_attachment_image_src($image->ID,'large');
                    $return .= '<div class="thumbnail-image span3"><img data-large="'.$largeAttImg[0].'" src="'.$largeAttImg[0].'" /></div>';
                		if($i % 4 == 0){
                      $return .= '</div>';
                      $return .= '<div class="row-fluid">';
                     }
                     $i++;
                  }
              		$return .= '</div></div>';
            	}
    $return .= '</div>';

    return $return;
}
// remove_shortcode('gallery');
// add_shortcode('gallery', 'create_galery');


// get red of any empty content inside shortcodes
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

function twitter_cards() {
  global $post;
	global $data;
  if ( is_single() ) {

  ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo $data['twitter_id']; ?>">
    <meta name="twitter:creator" content="<?php echo $data['twitter_id']; ?>">
    <meta name="twitter:title" content="<?php the_title_attribute(); ?>">
    <meta name="twitter:description" content="<?php echo string_limit_words( strip_tags( $post->post_content ) ,50) ?>">
    <?php
    if( has_post_thumbnail($post->ID) ) {
      $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
      $large_image_url = $large_image_url[0];
      ?>
        <meta name="twitter:image" content="<?php echo $large_image_url; ?>">
      <?php
    }
  }
}
add_action('wp_head', 'twitter_cards');

class fixImageMargins{
    public $xs = 0; //change this to change the amount of extra spacing

    public function __construct(){
        add_filter('img_caption_shortcode', array(&$this, 'fixme'), 10, 3);
    }
    public function fixme($x=null, $attr, $content){

        extract(shortcode_atts(array(
                'id'    => '',
                'align'    => 'alignnone',
                'width'    => '',
                'caption' => ''
            ), $attr));

        if ( 1 > (int) $width || empty($caption) ) {
            return $content;
        }

        if ( $id ) $id = 'id="' . $id . '" ';

    return '<div ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . ((int) $width + $this->xs) . 'px">'
    . $content . '<p class="wp-caption-text">' . $caption . '</p></div>';
    }
}
$fixImageMargins = new fixImageMargins();



// Disable responsive image support
add_filter( 'wp_get_attachment_image_attributes', function( $attr )
{
    if( isset( $attr['sizes'] ) )
        unset( $attr['sizes'] );

    if( isset( $attr['srcset'] ) )
        unset( $attr['srcset'] );

    return $attr;

 }, PHP_INT_MAX );
add_filter( 'wp_calculate_image_sizes', '__return_false',  PHP_INT_MAX );
add_filter( 'wp_calculate_image_srcset', '__return_false', PHP_INT_MAX );

function get_post_first_cat() {
  $categories = get_the_category();
  return array( 'title' => $categories[0]->name, 'link' => get_category_link( $categories[0] )  );
}

#remove img tag
function scrapeImage($text) {
	 $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
	 preg_match($pattern, $text, $link);
	 $link = $link[1];
	 $link = urldecode($link);
	 return $link;

}


add_action( 'load-widgets.php', 'my_custom_load' );

function my_custom_load() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}

function file_has_image_extension( $file ) {
	if ( preg_match( '/(\.jpg|\.jpeg|\.png|\.bmp|\.gif)$/i', $file ) ) {
   return true;
	}
	return false;
}

function khafagy_today_date( $args = array() ) {
	if( count($args) < 1 || !is_array( $args ) ) return false;
	global $hajri_date;
	$time = current_time( 'timestamp' );
	$hajri_date->setLang("ar");
	$count = count($args);
	$i = 1;
	echo '<div class="today-date">';
	echo date_i18n('l').', ';
	foreach( $args as $type ) {
		switch( $type ) {
			case 'hajri':
				echo $hajri_date->date("jS F Y",$time).' هجريا';
				break;
			case 'milady':
				echo date_i18n("j F Y",$time).' ميلاديا';
				break;
			break;
		}
		if( $count > 1 && $count > $i ) {
			echo ', ';
		} else {
			echo '. ';
		}
		$i++;
	}
	echo '</div>';
}

function khy_kas_cities() {
		$cities = array(
			'cairo' => array(
				'name' => 'القاهرة',
				'latitude' => '30.0444',
				'longitude' => '31.2357',
			),
			'Makkah' => array(
				'name' => 'مكة',
				'latitude' => '21.3891',
				'longitude' => '39.8579',
			),
			'Madina' => array(
				'name' => 'المدينة المنورة',
				'latitude' => '24.5247',
				'longitude' => '39.5692',
			),
			'Riyadh' => array(
				'name' => 'الرياض',
				'latitude' => '24.7136',
				'longitude' => '46.6753',
			),
			'Jeddah' => array(
				'name' => 'جــدة',
				'latitude' => '21.4858',
				'longitude' => '39.1925',
			),
			'Dammam' => array(
				'name' => 'الـدمـام',
				'latitude' => '26.4207',
				'longitude' => '50.0888',
			),
			'Hail' => array(
				'name' => 'حائل',
				'latitude' => '27.5114',
				'longitude' => '41.7208',
			),
			'Buraidah' => array(
				'name' => 'بـريـدة',
				'latitude' => '26.3592',
				'longitude' => '43.9818',
			),
			'Qatif' => array(
				'name' => 'القطيف',
				'latitude' => '26.5765',
				'longitude' => '49.9982',
			),
			'Najran' => array(
				'name' => 'نجران',
				'latitude' => '17.5656',
				'longitude' => '44.2289',
			),
			'Jizan' => array(
				'name' => 'جيزان',
				'latitude' => '16.8894',
				'longitude' => '42.5706',
			),
		);

			return $cities;
}

add_filter( 'the_content', 'prefix_insert_post_ads' );
function prefix_insert_post_ads( $content ) {
  global $data;

		if ( $data['singular_post_ads'] ) {
			$ad_code = '<div class="banner">';
			$ad_code .= $data['singular_post_banner_code'];
			$ad_code .= '</div>';
		}

    if ( is_single() ) {
        return prefix_insert_after_paragraph( $ad_code, 3, $content );
    }

    return $content;
}

function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {

        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }

        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }

        // if ( $paragraph_id == $index + 3 ) {
        //     $paragraphs[$index] .= $insertion;
        // }
    }

    return implode( '', $paragraphs );
}
