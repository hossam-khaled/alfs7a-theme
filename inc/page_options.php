<?php
/**
 * create portfolio custom meta box
 */
function add_all_meta_box() {

  add_meta_box(
  'post_options', // $id
  'خصائص الخبر', // $title
  'show_custom_meta_box', // $callback
  'post', // $page
  'normal', // $context
  'high'); // $priority

  add_meta_box(
  'poll_options', // $id
  'الاسئلة', // $title
  'show_custom_meta_box', // $callback
  'poll', // $page
  'normal', // $context
  'high'); // $priority

  add_meta_box(
  'articles_options', // $id
  'خصائص الخبر', // $title
  'show_custom_meta_box', // $callback
  'articles', // $page
  'normal', // $context
  'high'); // $priority


}
add_action('add_meta_boxes', 'add_all_meta_box');

$GLOBALS['inputs_array'] = array(
   '_post_size',
   '_author_name',
   'meta-author-name',
   '_post_name',
   '_views',
   'post_views_count',
   '_alert_link_type',
   '_second_title',
   '_video_url',
   '_history_post',
   '_alert_word',
   '_alert_color'
);
for( $i = 1; $i <= 4; $i++ ) {
  $GLOBALS['inputs_array'][] = '_poll_answer_'.$i;
}



function show_custom_meta_box() {
  global $post,$inputs_array;


  foreach((array) $inputs_array as $value){
    $$value = get_post_meta($post->ID, $value, true);
  }

  $colors = array(
    'red' => 'احمر',
    'green' => 'اخضر',
    'blue' => 'ازرق',
    'gray' => 'رمادى',
  );
  ?>


  <input type="hidden" name="custom_meta_box_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)) ?>" />
  <input type="hidden" name="gamageer_saved_before" value="1" />
  <?php

  ?>
    <?php if($post->post_type == 'poll'): ?>
      <?php for( $i = 1; $i <= 4; $i++ ) {
        $answer_name = '_poll_answer_'.$i;
        ?>
        <div class="field-container">
          <label>اجابة <?php echo $i; ?></label>
          <div class="field">
            <input type="text" name="<?php echo $answer_name; ?>" value="<?php echo $$answer_name; ?>" >
          </div>
        </div>
      <?php } ?>
      <?php
      // var_dump($post);
      ?>
    <?php elseif($post->post_type == 'articles'): ?>
      <?php
      $meta_value = get_post_meta( get_the_ID(), 'meta-author-name', true );
      ?>
      <div class="field-container">
        <label>اسم الكاتب</label>
        <div class="field">
          <input type="text" name="meta-author-name" value="<?php echo $meta_value; ?>" >
        </div>
        <p>اسم الكاتب الذى يظهر اعلى الخبر</p>
      </div>
      <div class="field-container">
        <label>اسم الصحيفة او المدينة</label>
        <div class="field">
          <input type="text" name="_post_name" value="<?php echo $_post_name; ?>" >
        </div>
        <p>اكتب المدينه الخاصه بالحدث</p>
      </div>
    <?php elseif($post->post_type == 'post'): ?>
      <div class="field-container">
        <label>اسم الصحيفه</label>
        <div class="field">
          <input type="text" name="_post_name" value="<?php echo $_post_name; ?>" >
        </div>
        <p>تغير اسم الصحيفه او صفحة الخبر</p>
      </div>
      <div class="field-container">
        <label>اسم الكاتب</label>
        <div class="field">
          <input type="text" name="_author_name" value="<?php echo $_author_name; ?>" >
        </div>
        <p>اسم الكاتب الذى يظهر اعلى الخبر</p>
      </div>
      <!-- <div class="field-container">
        <label>اسم الكاتب</label>
        <div class="field">
          <select class="" name="_author_name">
             <option value="">أختر كاتب</option>
            <?php

            $users = get_users();
            foreach ($users as $user)
            {
              if ($user->roles[0] == 'administrator' || $user->roles[0] == 'author') {
                echo "<option ". selected($user->display_name,$_author_name) ." value='" .$user->display_name. "'>" .$user->display_name. "</option>";

              }
            }
            ?>
          </select>

        </div>

        <p>اختر اسم الكاتب الخاص بك</p>
      </div> -->
      <div class="field-container">
        <label>العنوان الثانوى</label>
        <div class="field">
          <input type="text" name="_second_title" value="<?php echo $_second_title; ?>" >
        </div>
      </div>
      <div class="field-container">
        <label>رابط الفديو بيوتيوب</label>
        <div class="field">
          <input type="text" name="_video_url" value="<?php echo $_video_url; ?>" >
        </div>
        <p>ضع رابط الفديو من موقع يوتيوب</p>
      </div>
      <div class="field-container">
        <label>عدد المشاهدات</label>
        <div class="field">
          <input type="text" name="post_views_count" value="<?php echo $post_views_count; ?>" >
        </div>
        <p>عدد مشاهدات الموضوع</p>
      </div>
      <div class="field-container">
        <label>نوع الرابط</label>
        <div class="field">
          <select name="_alert_link_type" >
           <option <?php  if($_alert_link_type == 'without-link'){ echo 'selected="selected"'; } ?> value="without-link">بدون رابط للموضوع</option>
           <option <?php  if($_alert_link_type == 'with-link'){ echo 'selected="selected"'; } ?> value="with-link">برابط للموضوع</option>
          </select>
        </div>
        <p>خاص بالمواضيع العاجلة, اختار ما اذا كان عنوان الموضوع العاجل يؤدى للموضوع ام لا</p>
      </div>
      <div class="field-container">
        <label>استبدل كلمة عاجل بـ</label>
        <div class="field">
          <input type="text" name="_alert_word" value="<?php echo $_alert_word; ?>" >
        </div>
      </div>
      <div class="field-container">
        <label>لون عاجل</label>
        <div class="field">
          <select name="_alert_color">
           <?php foreach( $colors as $key => $value ): ?>
            <option <?php selected($key,$_alert_color); ?> value="<?php echo $key?>"><?php echo $value; ?></option>
           <?php endforeach; ?>
          </select>
        </div>
      </div>
    <?php endif;
}

function my_admin_init() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_style('jquery.ui.theme', get_template_directory_uri() . '/css/ui-lightness/jquery-ui-1.10.2.custom.min.css');
}
add_action('admin_init', 'my_admin_init');

function my_admin_footer() {
	?>
	<script type="text/javascript">

  jQuery(document).ready(function($){



  // Uploading files
  var file_frame;

  jQuery('.upload_image_button').on('click', function( event ){

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
add_action('admin_footer', 'my_admin_footer');


function checkbox_proccess($list){
   if(!empty($list)){
        if(is_array($list) && count($list) >= 1){
          $list = implode(",",$list);
        }
    }
    return $list;
}

// Save the Data
function save_custom_meta($post_id) {
	global $inputs_array;
	// verify nonce
	if(empty($_POST['custom_meta_box_nonce'])){
    $_POST['custom_meta_box_nonce'] = '';
  }
  if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
		return $post_id;

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;

	// check permissions
	if ('page' == $_POST['post_type']) {
		  if (!current_user_can('edit_page', $post_id))
			return $post_id;
	} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}

  // loop through fields and save the data
	foreach ($inputs_array as $value) {

    $old = get_post_meta($post_id, $value, true);

    if(!empty($_POST[$value])){
      $new = trim(checkbox_proccess($_POST[$value]));
    } else {
      $new ='';
    }

		if ($new && $new != $old) {
			update_post_meta($post_id, $value, $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $value, $old);
		}
	} // enf foreach

	// save taxonomies
	//$post = get_post($post_id);
	//$category = $_POST['category'];
	//wp_set_object_terms( $post_id, $category, 'category' );
}
add_action('save_post', 'save_custom_meta');
