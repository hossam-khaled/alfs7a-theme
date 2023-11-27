<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
function of_options() {
		//Access the WordPress Categories via an Array
		$of_categories 		= array();
		$of_categories_obj 	= get_categories();
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");
		foreach ($of_categories_obj as $of_cat) {

		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;

			}

		$cities = khy_kas_cities();
		foreach ( $cities as $key => $value) {
			$name = $value['name'];
			$cities_array["$key"] = $name;
		}
		$cities_1 = array_unshift($cities_array, "أختر المدينه");

		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");

		//Testing
		$of_options_select 	= array("one","two","three","four","five");
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			),
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();

		if ( is_dir($alt_stylesheet_path) )
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) )
		    {
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false )
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) {
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }
		    }
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post");



/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

/* General settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "اعدادات عامة",
	"type" 		=> "heading",
	"class" => "general-settings"
);


$of_options[] = array( 	"name" 		=> "اعدادات عامة",
	"type" 		=> "box",
	"class" => "general-settings"
);
$of_options[] = array( 	"name" 		=> "اختار توقيت الصلاة حسب المدينة",
	"desc" 		=> "A list of all the categories being used on the site.",
	"id" 		=> "cities",
	"std" 		=> "اختار توقيت الصلاة حسب المدينة",
	"type" 		=> "select",
	"options" 	=> $cities_array
);

$of_options[] = array( 	"name" 		=> "اختر قسم عاجل",
	"desc" 		=> "",
	"id" 		=> "break_news_cat",
	"std" 		=> "",
	"type" 		=> "select",
	"options" 	=> $of_categories
);

$of_options[] = array( 	"name" 		=> "اختر قسم المقالات",
	"desc" 		=> "",
	"id" 		=> "articles_categorie",
	"std" 		=> "",
	"type" 		=> "select",
	"options" 	=> $of_categories
);

$of_options[] = array( 	"name" 		=> "رمز الموقع الذى يظهر بنافذة المتصفح",
	"desc" 		=> "",
	"id" 		=> "fav_icon_16",
	"std" 		=> "",
	"type" 		=> "media"
);
$of_options[] = array( 	"name" 		=> "الصورة الافتراضية للمستخدمين",
	"desc" 		=> "",
	"id" 		=> "default_avatar",
	"std" 		=> "",
	"type" 		=> "media"
);

$of_options[] = array( 	"name" 		=> "اعدادات الشعار",
	"type" 		=> "box",
);
// $of_options[] = array( 	"name" 		=> "الشعار يعرض",
// 	"desc" 		=> "",
// 	"id" 		=> "logo_type",
// 	"std" 		=> "logo",
// 	"mod"		=> "min",
// 	"type" 		=> "radio",
// 	"options" => array( "name" => "اسم الموقع بشكل نص" , "logo" => "شعار الموقع فى شكل صورة" )
// );
$of_options[] = array( 	"name" 		=> "شعار الموقع",
	"desc" 		=> "",
	"id" 		=> "logo_src",
	"std" 		=> "",
	"type" 		=> "media"
);
$of_options[] = array( 	"name" 		=> "شعار الموقع بجودة ريتنا (ضعف الحجم)",
	"desc" 		=> "",
	"id" 		=> "logo_src_retina",
	"std" 		=> "",
	"type" 		=> "media"
);
$of_options[] = array( 	"name" 		=> "المساحة اعلى و اسفل الشعار",
	"desc" 		=> "",
	"id" 		=> "logo_margin",
	"std" 		=> "0",
	"min" 		=> "15",
	"max" 		=> "100",
	"type" 		=> "sliderui"
);
// $of_options[] = array( 	"name" 		=> "توسيط الشعار",
// 	"desc" 		=> "",
// 	"id" 		=> "logo_center",
// 	"std" 		=> 0,
// 	"type" 		=> "switch"
// );
$of_options[] = array( 	"name" 		=> "شعار 2030",
	"desc" 		=> "",
	"id" 		=> "logo_src_2030",
	"std" 		=> "",
	"type" 		=> "media"
);

$of_options[] = array( 	"name" 		=> "ايقونات ابل و اندرويد",
	"type" 		=> "box",
	"class" => "icon-settings"
);
$of_options[] = array( 	"name" 		=> "ايقونة الموقع بحجم"
	." 32x32",
	"desc" 		=> "",
	"id" 		=> "fav_icon_32",
	"std" 		=> "",
	"type" 		=> "media"
);
$of_options[] = array( 	"name" 		=> "ايقونة الموقع بحجم"
	." 128x128",
	"desc" 		=> "",
	"id" 		=> "fav_icon_128",
	"std" 		=> "",
	"type" 		=> "media"
);
$of_options[] = array( 	"name" 		=> "ايقونة الموقع بحجم"
	." 256x256",
	"desc" 		=> "",
	"id" 		=> "fav_icon_256",
	"std" 		=> "",
	"type" 		=> "media"
);


// $of_options[] = array( 	"name" 		=> "اعادات التاريخ",
// 	"type" 		=> "box",
// 	"class" => "date-settings"
// );
// $of_options[] = array( 	"name" 		=> "طريقة عرض التاريخ",
// 	"desc" 		=> "",
// 	"id" 		=> "date_format",
// 	"std" 		=> "milady",
// 	"mod"		=> "min",
// 	"type" 		=> "radio",
// 	"options" => array( "hajri" => "عرض التاريخ الهجرى" , "milady" => "عرض التاريخ الميلادى" )
// );


// $of_options[] = array( 	"name" 		=> "كود الاعلان داخل المقال",
// 	"type" 		=> "box",
// 	"class" => "logo-settings"
// );
// $of_options[] = array( 	"name" 		=> "كود اعلان جوجل داخل المقال",
// 	"desc" 		=> "يمكن استخدامها باكواد المتابعة, مثل جوجل اناليتكس",
// 	"id" 		=> "post_scripts",
// 	"std" 		=> "",
// 	"type" 		=> "textarea"
// );




/* adds settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "التحكم في الاعلانات",
	"type" 		=> "heading",
	"class" => "adds-settings"
);
$of_options[] = array( 	"name" 		=> "اكواد الهيدر",
	"type" 		=> "box",
	"class" => "logo-settings"
);
$of_options[] = array( 	"name" 		=> "اكواد جافاسكربت بالهيدر",
	"desc" 		=> "يمكن استخدامها باكواد المتابعة, مثل جوجل اناليتكس",
	"id" 		=> "header_scripts",
	"std" 		=> "",
	"type" 		=> "textarea"
);


$of_options[] = array( 	"name" 		=> "اكواد الفوتر",
	"type" 		=> "box",
	"class" => "logo-settings"
);
$of_options[] = array( 	"name" 		=> "اكواد جافاسكربت بالفوتر",
	"desc" 		=> "يمكن استخدامها باكواد المتابعة, مثل جوجل اناليتكس",
	"id" 		=> "footer_scripts",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "اعدادات الاعلان العلوى",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "header_banner_src",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "header_banner_link",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "header_banner_code",
	"std" 		=> "",
	"type" 		=> "textarea"
);
// $of_options[] = array( 	"name" 		=> "المساحة اعلى و اسفل العلان",
// 	"desc" 		=> "",
// 	"id" 		=> "banner_margin",
// 	"std" 		=> "0",
// 	"min" 		=> "15",
// 	"max" 		=> "100",
// 	"type" 		=> "sliderui"
// );
// $of_options[] = array( 	"name" 		=> "توسيط الاعلان",
// 	"desc" 		=> "",
// 	"id" 		=> "banner_center",
// 	"std" 		=> 0,
// 	"type" 		=> "switch"
// );

$of_options[] = array( 	"name" 		=> "اعدادات الاعلان الترحيبي",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار الاعلان الترحيبي",
	"desc" 		=> "",
	"id" 		=> "welcome_ads",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" ",
	"desc" 		=> "",
	"id" 		=> "welcome_banner_src",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "welcome_banner_link",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "welcome_banner_code",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "اعدادات الاعلان اسفل الهيدير في جميع الصفحات بالموقع",
	"type" 		=> "box",
);

$of_options[] = array( 	"name" 		=> "اظهار الاعلان اسفل الهيدير 1",
	"desc" 		=> "",
	"id" 		=> "button_header_ads_1",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "button_header_banner_src_1",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "button_header_banner_link_1",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "button_header_banner_code_1",
	"std" 		=> "",
	"type" 		=> "textarea"
);
$of_options[] = array( 	"name" 		=> "اظهار الاعلان اسفل الهيدير 2",
	"desc" 		=> "",
	"id" 		=> "button_header_ads_2",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "button_header_banner_src_2",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "button_header_banner_link_2",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "button_header_banner_code_2",
	"std" 		=> "",
	"type" 		=> "textarea"
);
$of_options[] = array( 	"name" 		=> "اعدادات الاعلان في صفحه الارشيف الخاص بالقسم",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار الاعلان في صفحه الارشيف 1",
	"desc" 		=> "",
	"id" 		=> "archive_ads_1",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "archive_banner_src_1",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "archive_banner_link_1",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "archive_banner_code_1",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "اظهار الاعلان في صفحه الارشيف 2",
	"desc" 		=> "",
	"id" 		=> "archive_ads_2",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "archive_banner_src_2",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "archive_banner_link_2",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "archive_banner_code_2",
	"std" 		=> "",
	"type" 		=> "textarea"
);
$of_options[] = array( 	"name" 		=> "اعدادات الاعلان في صفحه الخبر",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار الاعلان اعلي الخبر",
	"desc" 		=> "",
	"id" 		=> "top_singular_ads",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "top_singular_banner_src",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "top_singular_banner_link",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "top_singular_banner_code",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "اظهار الاعلان داخل المقال",
	"desc" 		=> "",
	"id" 		=> "singular_post_ads",
	"std" 		=> 1,
	"type" 		=> "switch"
);
// $of_options[] = array( 	"name" 		=> "صورة الاعلان".
// 	" 728x90",
// 	"desc" 		=> "",
// 	"id" 		=> "top_singular_banner_src",
// 	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
// 	"type" 		=> "media",
// );
// $of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
// 	"desc" 		=> "",
// 	"id" 		=> "top_singular_banner_link",
// 	"std" 		=> "",
// 	"type" 		=> "text"
// );
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "singular_post_banner_code",
	"std" 		=> "",
	"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "اظهار الاعلان اسفل المقال",
	"desc" 		=> "",
	"id" 		=> "button_singular_ads",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "صورة الاعلان".
	" 728x90",
	"desc" 		=> "",
	"id" 		=> "button_singular_banner_src",
	"std" 		=> get_template_directory_uri().'/images/banner1.jpg',
	"type" 		=> "media",
);
$of_options[] = array( 	"name" 		=> "رابط الموقع الخاص بالمعلن",
	"desc" 		=> "",
	"id" 		=> "button_singular_banner_link",
	"std" 		=> "",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "او ادخل الكود هنا",
	"desc" 		=> "",
	"id" 		=> "button_singular_banner_code",
	"std" 		=> "",
	"type" 		=> "textarea"
);
/* اعدادات المظهر*/
/*---------------------------------------*/

$of_options[] = array( 	"name" 		=> "اعدادات المظهر",
	"type" 		=> "heading",
	"class" => "style-settings"
);

$of_options[] = array( 	"name" 		=> " اعدادات الوان الهيدر",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "الخلفيه الخاصه للهيدر",
	"desc" 		=> "Pick a background color for the header (default: #fff).",
	"id" 		=> "header_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "الخلفيه الخاصه بايكونه القائمة",
	"desc" 		=> "Pick a background color for the header icone (default: #000).",
	"id" 		=> "navigation_icone_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "Header Border bottom Color",
	"desc" 		=> "Pick a background color for the header (default: #fff).",
	"id" 		=> "header_border_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "الخلفيه الخاصه بالبار العلوي",
	"desc" 		=> "Pick a background color for the topbar.",
	"id" 		=> "topbar_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون البوردر للبار العلوي",
	"desc" 		=> "Pick a background color for the topbar.",
	"id" 		=> "topbar_border_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون الخط داخل الشريط العلوي",
	"desc" 		=> "Pick a background color for the topbar",
	"id" 		=> "topbar_font_color",
	"std" 		=> "",
	"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "اعدادات القائمة",
	"type" 		=> "box"
);

$of_options[] = array( 	"name" 		=> "اظهار القائمة",
	"desc" 		=> "",
	"id" 		=> "nav_menu",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "لون الخلفيه للقائمة",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "nav_menu_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون البوردر",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "nav_menu_border",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون العنوان",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "nav_menu_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون الخلفيه للقائمة عند الهافر ",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "nav_menu_background_hover",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون البوردر عند الهافر",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "nav_menu_border_hover",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون العنوان عند الهافر",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "nav_menu_color_hover",
	"std" 		=> "",
	"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "اعدادات الوان الفوتر",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "Footer Background Color",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "footer_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "Top Footer Background Color",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "top_footer_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "Sub Footer Background Color",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "sub_footer_background",
	"std" 		=> "",
	"type" 		=> "color"
);

/* Header settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "اعدادات الهيدر",
	"type" 		=> "heading",
	"class" => "header-settings"
);

$of_options[] = array( 	"name" 		=> "أعدادات عامة للهيدر",
	"type" 		=> "box"
);

$of_options[] = array( 	"name" 		=> "اظهار تاريخ اليوم",
	"desc" 		=> "",
	"id" 		=> "header_date",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار شريط البحث",
	"desc" 		=> "",
	"id" 		=> "header_search",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار مواقع التواصل",
	"desc" 		=> "",
	"id" 		=> "header_socials",
	"std" 		=> 1,
	"type" 		=> "switch"
);




$of_options[] = array( 	"name" 		=> "اعدادات الشريط العلوى",
	"type" 		=> "box"
);
$of_options[] = array( 	"name" 		=> "اظهار الشريط",
	"desc" 		=> "",
	"id" 		=> "topbar_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار تاريخ اليوم",
	"desc" 		=> "",
	"id" 		=> "topbar_date",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار موعد الصلاة القادمه",
	"desc" 		=> "",
	"id" 		=> "topbar_prayer",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار درجة حرارة اليوم",
	"desc" 		=> "",
	"id" 		=> "topbar_weather",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> " اظهار القائمةالفرعيه",
	"desc" 		=> "",
	"id" 		=> "topbar_menu",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار شريط البحث",
	"desc" 		=> "",
	"id" 		=> "topbar_search",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار مواقع التواصل",
	"desc" 		=> "",
	"id" 		=> "topbar_socials",
	"std" 		=> 1,
	"type" 		=> "switch"
);

// if ( function_exists('get_social_media_array') ) {
// 	$of_options[] = array( 	"name" 		=> "ايقونات التواصل بالهيدر",
// 		"type" 		=> "box",
// 		"class" => "logo-settings"
// 	);
// 	$social_media_websites = get_social_media_array();
// 	foreach ( (array) $social_media_websites as $value ) {
// 		$of_options[] = array( 	"name" 		=> "اظهار ايقونة"
// 			." ".$value['name'],
// 			"desc" 		=> "",
// 			"id" 		=> "topbar_".$value['key']."_show",
// 			"std" 		=> ( ( isset($value['default_on']) && $value['default_on'] == '1' ) ? 1 : 0 ),
// 			"type" 		=> "switch"
// 		);
// 	}
// }

$of_options[] = array( 	"name" 		=> "اعدادات شريط احدث الموضوعات",
	"type" 		=> "box"
);
$of_options[] = array( 	"name" 		=> "اظهار شريط احدث الموضوعات",
	"desc" 		=> "",
	"id" 		=> "postsscroller_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "عنوان الشريط",
	"desc" 		=> "",
	"id" 		=> "postsscroller_title",
	"std" 		=> "احدث الموضوعات",
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "لون الخلفيه للشريط",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "postsscroller_background",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون الخلفيه للعنوان",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "postsscroller_background_title",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون العنوان",
	"desc" 		=> "Pick a background color for the footer (default: #fff).",
	"id" 		=> "postsscroller_color_title",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "سرعة تحرك الموضوعات",
	"desc" 		=> "",
	"id" 		=> "postsscroller_speed",
	"std" 		=> "15",
	"min" 		=> "10",
	"max" 		=> "25",
	"type" 		=> "sliderui"
);
// $of_options[] = array( 	"name" 		=> "اظهار الخبار ثم الخبر التالي",
// 	"desc" 		=> "",
// 	"id" 		=> "postsscroller_one_by_one",
// 	"std" 		=> 1,
// 	"type" 		=> "switch"
// );
// $of_options[] = array( 	"name" 		=> "اظهار خميع الاخبار بشكل افقي",
// 	"desc" 		=> "",
// 	"id" 		=> "postsscroller_show_all",
// 	"std" 		=> 1,
// 	"type" 		=> "switch"
// );

$of_options[] = array( 	"name" 		=> "اعدادات شريط عاجل",
	"type" 		=> "box"
);
$of_options[] = array( 	"name" 		=> "اظهار شريط عاجل عند وجود موضوعات عاجلة",
	"desc" 		=> "",
	"id" 		=> "breakposts_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);

$of_options[] = array( 	"name" 		=> "عدد الاخبار العاجلة",
	"desc" 		=> "",
	"id" 		=> "breakposts_number",
	"std" 		=> 1,
	"type" 		=> "text"
);


/* Footer settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "اعدادات الفوتر",
	"type" 		=> "heading",
	"class" => "footer-settings"
);
$of_options[] = array( 	"name" 		=> " التقسيم الخاص بالفوتر",
	"type" 		=> "box",
);
$url = get_template_directory_uri() . '/images/admin-imge/';
$of_options[] = array( 	"name" 		=> "Main Layout",
	"desc" 		=> "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
	"id" 			=> "footer_layout",
	"std" 		=> "half-box",
	"type" 		=> "images",
	"options" => array(
							'third-box' 	=> $url . '3cr.png',
							'half-box' 	=> $url . '4col.png',
						)
);


// $of_options[] = array( 	"name" 		=> "اعدادات الشعار",
// 	"type" 		=> "box",
// );
// $of_options[] = array( 	"name" 		=> "الشعار يعرض",
// 	"desc" 		=> "",
// 	"id" 		=> "logo_type",
// 	"std" 		=> "logo",
// 	"mod"		=> "min",
// 	"type" 		=> "radio",
// 	"options" => array( "name" => "اسم الموقع بشكل نص" , "logo" => "شعار الموقع فى شكل صورة" )
// );
// $of_options[] = array( 	"name" 		=> "شعار الموقع",
// 	"desc" 		=> "",
// 	"id" 		=> "footer_logo_src",
// 	"std" 		=> "",
// 	"type" 		=> "media"
// );
// $of_options[] = array( 	"name" 		=> "شعار الموقع بجودة ريتنا (ضعف الحجم)",
// 	"desc" 		=> "",
// 	"id" 		=> "footer_logo_src_retina",
// 	"std" 		=> "",
// 	"type" 		=> "media"
// );

$of_options[] = array( 	"name" 		=> "أعدادات عامة للفوتر",
	"type" 		=> "box"
);

$of_options[] = array( 	"name" 		=> "اظهار تاريخ اليوم",
	"desc" 		=> "",
	"id" 		=> "footer_date",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار شريط البحث",
	"desc" 		=> "",
	"id" 		=> "footer_search",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار مواقع التواصل",
	"desc" 		=> "",
	"id" 		=> "footer_socials",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار اخلاء المسؤولية",
	"desc" 		=> "",
	"id" 		=> "footer_legal_note_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);

$of_options[] = array( 	"name" 		=> "نص اخلاء المسؤولية",
	"desc" 		=> "",
	"id" 		=> "footer_legal_note_text",
	"std" 		=> "جميع التعليقات و الردود المطروحة لا تعبر عن رأى الموقع ولكن تعبر عن رأى كاتبها, و الموقع لا يتحمل اى مسؤولية تجاه تلك التعليقات و الردود",
	"type" 		=> "textarea"
);

$of_options[] = array( 	"name" 		=> "اعدادات الجزء العلوى للفوتر",
	"type" 		=> "box",
);
// $of_options[] = array( 	"name" 		=> "اظهار الجزء العلوى للفوتر",
// 	"desc" 		=> "",
// 	"id" 		=> "show_top_footer",
// 	"std" 		=> 1,
// 	"type" 		=> "switch"
// );
$of_options[] = array( 	"name" 		=> "اظهار الشريط",
	"desc" 		=> "",
	"id" 		=> "top_footer_menu_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> " أظهار وقت الصلاه",
	"desc" 		=> "",
	"id" 		=> "top_footer_prayer",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> " أظهار درجت الحراره",
	"desc" 		=> "",
	"id" 		=> "top_footer_weather",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار البحث",
	"desc" 		=> "",
	"id" 		=> "top_footer_search",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> " أظهار التاريخ",
	"desc" 		=> "",
	"id" 		=> "top_footer_date",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار ايقونات التواصل",
	"desc" 		=> "",
	"id" 		=> "top_footer_socials",
	"std" 		=> 1,
	"type" 		=> "switch"
);



$of_options[] = array( 	"name" 		=> "اعدادات الجزء السفلى بالفوتر",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار حقوق الملكية",
	"desc" 		=> "",
	"id" 		=> "footer_copyright_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "نص حقوق الملكية",
	"desc" 		=> "",
	"id" 		=> "footer_copyright_text",
	"std" 		=> "جميع الحقوق محفوظة. لا يجوز النسخ او النقل دون اذن كتابى مسبق",
	"type" 		=> "textarea"
);

// if ( function_exists('get_social_media_array') ) {
// 	$of_options[] = array( 	"name" 		=> "التحكم بايقونات التواصل",
// 		"type" 		=> "box",
// 	);
//
// 	$social_media_websites = get_social_media_array();
// 	foreach ( (array) $social_media_websites as $value ) {
// 		$of_options[] = array( 	"name" 		=> "اظهار ايقونة"
// 			." ".$value['name'],
// 			"desc" 		=> "",
// 			"id" 		=> "footer_".$value['key']."_show",
// 			"std" 		=> ( ( isset($value['default_on']) && $value['default_on'] == '1' ) ? 1 : 0 ),
// 			"type" 		=> "switch"
// 		);
// 	}
// }

/* Header settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "اعدادات عرض الاقسام",
	"type" 		=> "heading",
	"class" => "archive-settings"
);

$of_options[] = array( 	"name" 		=> "اعدادات ظهور المواضيع فى الاقسام",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "عدد الموضوع فى صفحه القسم",
	"desc" 		=> "",
	"id" 		=> "archive_posts_count",
	"std" 		=> 10,
	"type" 		=> "text"
);
$of_options[] = array( 	"name" 		=> "تغير لون عنوان القسم",
	"desc" 		=> "",
	"id" 		=> "archive_title_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "تغير لون خلفية عنوان القسم",
	"desc" 		=> "",
	"id" 		=> "archive_background_color_title",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "تغير خلفيه عنوان القسم",
	"desc" 		=> "",
	"id" 		=> "archive_background_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "تغير لون البوردر عنوان القسم",
	"desc" 		=> "",
	"id" 		=> "archive_border_color",
	"std" 		=> "",
	"type" 		=> "color"
);

$of_options[] = array( 	"name" 		=> "اعدادات خصائص الموضوع بالاقسام",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار اسم الكاتب",
	"desc" 		=> "",
	"id" 		=> "archive_author_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار تاريخ الموضوع",
	"desc" 		=> "",
	"id" 		=> "archive_date_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار عدد المشاهدات الموضوع",
	"desc" 		=> "",
	"id" 		=> "archive_views_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار قسم الموضوع",
	"desc" 		=> "",
	"id" 		=> "archive_category_show",
	"std" 		=> 0,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار عدد التعليقات بالموضوع",
	"desc" 		=> "",
	"id" 		=> "archive_comments_show",
	"std" 		=> 0,
	"type" 		=> "switch"
);

$of_options[] = array( 	"name" 		=> "اعدادات صفحة القسم",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار وصف القسم",
	"desc" 		=> "",
	"id" 		=> "archive_description_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
// $of_options[] = array( 	"name" 		=> "اظهار ايقونة"
// 	." RSS",
// 	"desc" 		=> "",
// 	"id" 		=> "archive_rss_show",
// 	"std" 		=> 1,
// 	"type" 		=> "switch"
// );

$of_options[] = array( 	"name" 		=> "اعدادات صفحة الكاتب",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار نبذة عن الكاتب و صورتة بصفحة الكاتب",
	"desc" 		=> "",
	"id" 		=> "archive_author_bio_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$post_bottom_options = array(
	"author_name" => "اسم الكاتب",
	"author_description" => "نبذة عن الكاتب",
	"author_avatar" => "صورة الكاتب",

);
foreach ( $post_bottom_options as $key => $value ) {
	$of_options[] = array( 	"name" 		=> "اظهار"
	." $value",
		"desc" 		=> "",
		"id" 		=> "post_bottom_{$key}_show",
		"std" 		=> 1,
		"type" 		=> "switch"
	);
}

/* Post settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "اعدادات صفحة الموضوع",
	"type" 		=> "heading",
	"class" => "post-settings"
);
$of_options[] = array( 	"name" 		=> "اعدادات عامة للموضوع",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار صورة الموضوع",
	"desc" 		=> "",
	"id" 		=> "post_featured_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "اظهار فيديو الموضوع",
	"desc" 		=> "",
	"id" 		=> "post_video_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "توسيط العنوان للموضوع",
	"desc" 		=> "",
	"id" 		=> "post_title_center",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "لون العنوان",
	"desc" 		=> "Pick a background color for the header (default: #000).",
	"id" 		=> "post_title_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "محاذات الموضوع",
	"desc" 		=> "",
	"id" 		=> "post_content_justify",
	"std" 		=> 1,
	"type" 		=> "switch"
);

$of_options[] = array( 	"name" 		=> "اعدادات الادوات اعلى الموضوع",
	"type" 		=> "box",
);
$post_top_options = array(
	"date" => "التاريخ",
	"views" => "المشاهدات",
	"comments" => "عدد التعليقات",
	"print" => "الطباعة",
	"font" => "التحكم بحجم الخط",
	"shortlink" => "الرابط المختصر",
	"facebook" => "المشاركة بفيسبوك",
	"twitter" => "المشاركة بتويتر",
	// "glup" => "المشاركة بجوجل بلس",
	"telegram" => "المشاركة بتليجرام",
	"whatsapp" => "المشاركة بواتساب",
	// "linkedin" => "المشاركة بلينكد ان",
	// "pinterest" => "المشاركة ببنتريست",
	// "email" => "المشاركة بالبريد",
);
foreach ( $post_top_options as $key => $value ) {
	$of_options[] = array( 	"name" 		=> "اظهار"
	." $value",
		"desc" 		=> "",
		"id" 		=> "post_top_{$key}_show",
		"std" 		=> 1,
		"type" 		=> "switch"
	);
}

$of_options[] = array( 	"name" 		=> "اعدادات الادوات اسفل الموضوع",
	"type" 		=> "box",
);
$post_bottom_options = array(
	"author_block_small" => "بيانات الكاتب في الموضوعات",
	"articles_related_post" => "بيانات الكاتب في المقالات",
	"tags" => "الكلمات الدليلية",

);
foreach ( $post_bottom_options as $key => $value ) {
	$of_options[] = array( 	"name" 		=> "اظهار"
	." $value",
		"desc" 		=> "",
		"id" 		=> "post_bottom_{$key}_show",
		"std" 		=> 1,
		"type" 		=> "switch"
	);
}

$of_options[] = array( 	"name" 		=> "اعدادات التعليقات",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار التعليقات",
	"desc" 		=> "",
	"id" 		=> "post_comments_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "تفعيل نظام الاعجاب بالتعليقات",
	"desc" 		=> "",
	"id" 		=> "post_comments_like_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "أظهار الترقيم بالتعليقات",
	"desc" 		=> "",
	"id" 		=> "post_comments_number_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "تفعيل الرد على التعليقات",
	"desc" 		=> "",
	"id" 		=> "post_comments_reply_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);


$of_options[] = array( 	"name" 		=> "اعدادات اقرأ ايضا اسفل الموضوع",
	"type" 		=> "box",
);
$of_options[] = array( 	"name" 		=> "اظهار اقرأ ايضا",
	"desc" 		=> "",
	"id" 		=> "post_related_show",
	"std" 		=> 1,
	"type" 		=> "switch"
);
$of_options[] = array( 	"name" 		=> "لون خلفيه البار",
	"desc" 		=> "Pick a background color for the header (default: #fff).",
	"id" 		=> "post_related_bar_background_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> " لون خلفيه العنوان",
	"desc" 		=> "Pick a background color for the header (default: #fff).",
	"id" 		=> "post_related_title_background_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون العنوان",
	"desc" 		=> "Pick a background color for the header (default: #fff).",
	"id" 		=> "post_related_title_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "لون البوردر",
	"desc" 		=> "Pick a background color for the header (default: #fff).",
	"id" 		=> "post_related_border_color",
	"std" 		=> "",
	"type" 		=> "color"
);
$of_options[] = array( 	"name" 		=> "عدد المقالات المعروضة",
	"desc" 		=> "",
	"id" 		=> "post_related_count",
	"std" 		=> "4",
	"type" 		=> "text"
);



/* Social settings */
/*---------------------------------------*/
$of_options[] = array( 	"name" 		=> "اعدادات مواقع التواصل",
	"type" 		=> "heading",
	"class" => "social-settings"
);
if ( function_exists('get_social_media_array') ) {
	$of_options[] = array( 	"name" 		=> "روابط مواقع التواصل",
		"type" 		=> "box",
	);
	$social_media_websites = get_social_media_array();
	foreach ( (array) $social_media_websites as $value ) {
		if( isset( $value['share_only'] ) ) continue;

		$of_options[] = array( 	"name" 		=> "اظهار ايقونة"
			." ".$value['name'],
			"desc" 		=> "",
			"id" 		=> $value['key']."_show",
			"std" 		=> ( ( isset($value['default_on']) && $value['default_on'] == '1' ) ? 1 : 0 ),
			"type" 		=> "switch"
		);

		$of_options[] = array( 	"name" 		=>
		( $value['key'] == "email" ? "البريد الالكترونى" : "رابط"." ".$value['name']),
			"desc" 		=> "",
			"id" 		=> $value['key']."_link",
			"std" 		=> "",
			"type" 		=> "text"
		);
	}
}




// $of_options[] = array( 	"name" 		=> "المظهر العام للموقع",
// 	"type" 		=> "box",
// );
// $url = get_template_directory_uri() . '/images/admin-imge/';
// $of_options[] = array( 	"name" 		=> "Header And Footer Layout",
// 	"desc" 		=> "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
// 	"id" 			=> "layout",
// 	"std" 		=> "2c-l-fixed.css",
// 	"type" 		=> "images",
// 	"options" => array(
// 							'full-width' 	=> $url . '1col.png',
// 							'box-width' 		=> $url . '3cm.png',
// 							// 'float-left' 	=> $url . '2cr.png',
// 							// 'float-right' 	=> $url . '2cl.png',
//
// 						)
// );
// $of_options[] = array( 	"name" 		=> "Body Background Image",
// 	"desc" 		=> "",
// 	"id" 		=> "body_background_img",
// 	"std" 		=> "",
// 	"type" 		=> "media"
// );
// $of_options[] = array( 	"name" 		=> "Body Background Color",
// 	"desc" 		=> "Pick a background color for the theme (default: #fff).",
// 	"id" 		=> "body_background",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// );
//
//
// $of_options[] = array( 	"name" 		=> "Body Font",
// 	"desc" 		=> "Specify the body font properties",
// 	"id" 		=> "body_font",
// 	"std" 		=> array('size' => '12px','face' => 'selact','style' => 'normal','color' => '#000000'),
// 	"type" 		=> "typography"
// );
// $of_options[] = array( 	"name" 		=> "Home Page Layout",
// 	"desc" 		=> "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
// 	"id" 			=> "homepage_layout",
// 	"std" 		=> "2c-l-fixed.css",
// 	"type" 		=> "images",
// 	"options" => array(
//
// 							'third-box' 	=> $url . '3cr.png',
// 							'half-box' 	=> $url . '4col.png',
// 						)
// );

// $of_options[] = array( 	"name" 		=> "Tracking Code",
// 	"desc" 		=> "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
// 	"id" 		=> "google_analytics",
// 	"std" 		=> "",
// 	"type" 		=> "textarea"
// );
//
// $of_options[] = array( 	"name" 		=> "Footer Text",
// 	"desc" 		=> "You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]",
// 	"id" 		=> "footer_text",
// 	"std" 		=> "Powered by [wp-link]. Built on the [theme-link].",
// 	"type" 		=> "textarea"
// );

// $of_options[] = array( 	"name" 		=> "Theme Stylesheet",
// 	"desc" 		=> "Select your themes alternative color scheme.",
// 	"id" 		=> "alt_stylesheet",
// 	"std" 		=> "default.css",
// 	"type" 		=> "select",
// 	"options" 	=> $alt_stylesheets
// );



// $of_options[] = array( 	"name" 		=> "Custom CSS",
// 	"desc" 		=> "Quickly add some CSS to your theme by adding it to this block.",
// 	"id" 		=> "custom_css",
// 	"std" 		=> "",
// 	"type" 		=> "textarea"
// );

// $of_options[] = array( 	"name" 		=> "Example Options",
// 	"type" 		=> "heading"
// );

// $of_options[] = array( 	"name" 		=> "Typography",
// 	"desc" 		=> "This is a typographic specific option.",
// 	"id" 		=> "typography",
// 	"std" 		=> array(
// 											'size'  => '12px',
// 											'face'  => 'verdana',
// 											'style' => 'bold italic',
// 											'color' => '#123456'
// 										),
// 	"type" 		=> "typography"
// );
//
// $of_options[] = array( 	"name" 		=> "Border",
// 	"desc" 		=> "This is a border specific option.",
// 	"id" 		=> "border",
// 	"std" 		=> array(
// 											'width' => '2',
// 											'style' => 'dotted',
// 											'color' => '#444444'
// 										),
// 	"type" 		=> "border"
// );
//
// $of_options[] = array( 	"name" 		=> "Colorpicker",
// 	"desc" 		=> "No color selected.",
// 	"id" 		=> "example_colorpicker",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// 	);
//
// $of_options[] = array( 	"name" 		=> "Colorpicker (default #2098a8)",
// 	"desc" 		=> "Color selected.",
// 	"id" 		=> "example_colorpicker_2",
// 	"std" 		=> "#2098a8",
// 	"type" 		=> "color"
// );
//
// $of_options[] = array( 	"name" 		=> "Input Text",
// 	"desc" 		=> "A text input field.",
// 	"id" 		=> "test_text",
// 	"std" 		=> "Default Value",
// 	"type" 		=> "text"
// );
//
// $of_options[] = array( 	"name" 		=> "Input Checkbox (false)",
// 	"desc" 		=> "Example checkbox with false selected.",
// 	"id" 		=> "example_checkbox_false",
// 	"std" 		=> 0,
// 	"type" 		=> "checkbox"
// );
//
// $of_options[] = array( 	"name" 		=> "Input Checkbox (true)",
// 	"desc" 		=> "Example checkbox with true selected.",
// 	"id" 		=> "example_checkbox_true",
// 	"std" 		=> 1,
// 	"type" 		=> "checkbox"
// );
//
// $of_options[] = array( 	"name" 		=> "Normal Select",
// 	"desc" 		=> "Normal Select Box.",
// 	"id" 		=> "example_select",
// 	"std" 		=> "three",
// 	"type" 		=> "select",
// 	"options" 	=> $of_options_select
// );
//
// $of_options[] = array( 	"name" 		=> "Mini Select",
// 	"desc" 		=> "A mini select box.",
// 	"id" 		=> "example_select_2",
// 	"std" 		=> "two",
// 	"type" 		=> "select",
// 	"mod" 		=> "mini",
// 	"options" 	=> $of_options_radio
// );
//
// $of_options[] = array( 	"name" 		=> "Google Font Select",
// 	"desc" 		=> "Some description. Note that this is a custom text added added from options file.",
// 	"id" 		=> "g_select",
// 	"std" 		=> "Select a font",
// 	"type" 		=> "select_google_font",
// 	"preview" 	=> array(
// 					"text" => "This is my preview text!", //this is the text from preview box
// 					"size" => "30px" //this is the text size from preview box
// 						),
// 	"options" 	=> array(
// 					"none" => "Select a font",//please, always use this key: "none"
// 					"Lato" => "Lato",
// 					"Loved by the King" => "Loved By the King",
// 					"Tangerine" => "Tangerine",
// 					"Terminal Dosis" => "Terminal Dosis"
// 						)
// );
//
// $of_options[] = array( 	"name" 		=> "Google Font Select2",
// 	"desc" 		=> "Some description.",
// 	"id" 		=> "g_select2",
// 	"std" 		=> "Select a font",
// 	"type" 		=> "select_google_font",
// 	"options" 	=> array(
// 					"none" => "Select a font",//please, always use this key: "none"
// 					"Lato" => "Lato",
// 					"Loved by the King" => "Loved By the King",
// 					"Tangerine" => "Tangerine",
// 					"Terminal Dosis" => "Terminal Dosis"
// 									)
// );
//
// $of_options[] = array( 	"name" 		=> "Input Radio (one)",
// 	"desc" 		=> "Radio select with default of 'one'.",
// 	"id" 		=> "example_radio",
// 	"std" 		=> "one",
// 	"type" 		=> "radio",
// 	"options" 	=> $of_options_radio
// );
//
// $url =  ADMIN_DIR . 'assets/images/';
// $of_options[] = array( 	"name" 		=> "Image Select",
// 	"desc" 		=> "Use radio buttons as images.",
// 	"id" 		=> "images",
// 	"std" 		=> "warning.css",
// 	"type" 		=> "images",
// 	"options" 	=> array(
// 											'warning.css' 	=> $url . 'warning.png',
// 											'accept.css' 	=> $url . 'accept.png',
// 											'wrench.css' 	=> $url . 'wrench.png'
// 										)
// );
//
// $of_options[] = array( 	"name" 		=> "Textarea",
// 	"desc" 		=> "Textarea description.",
// 	"id" 		=> "example_textarea",
// 	"std" 		=> "Default Text",
// 	"type" 		=> "textarea"
// );
//
// $of_options[] = array( 	"name" 		=> "Multicheck",
// 	"desc" 		=> "Multicheck description.",
// 	"id" 		=> "example_multicheck",
// 	"std" 		=> array("three","two"),
// 	"type" 		=> "multicheck",
// 	"options" 	=> $of_options_radio
// );
//
// $of_options[] = array( 	"name" 		=> "Select a Category",
// 	"desc" 		=> "A list of all the categories being used on the site.",
// 	"id" 		=> "example_category",
// 	"std" 		=> "Select a category:",
// 	"type" 		=> "select",
// 	"options" 	=> $of_categories
// );

//Advanced Settings
// $of_options[] = array( 	"name" 		=> "Advanced Settings",
// 	"type" 		=> "heading"
// );


// $of_options[] = array( 	"name" 		=> "اعدادات اخرى",
// 	"type" 		=> "box",
// 	"class" => "misc-settings"
// );
//
//
// $of_options[] = array( 	"name" 		=> "JQuery UI Slider example 1",
// 	"desc" 		=> "JQuery UI slider description.<br /> Min: 1, max: 500, step: 3, default value: 45",
// 	"id" 		=> "slider_example_1",
// 	"std" 		=> "45",
// 	"min" 		=> "1",
// 	"step"		=> "3",
// 	"max" 		=> "500",
// 	"type" 		=> "sliderui"
// );
//
// $of_options[] = array( 	"name" 		=> "JQuery UI Slider example 1 with steps(5)",
// 	"desc" 		=> "JQuery UI slider description.<br /> Min: 0, max: 300, step: 5, default value: 75",
// 	"id" 		=> "slider_example_2",
// 	"std" 		=> "75",
// 	"min" 		=> "0",
// 	"step"		=> "5",
// 	"max" 		=> "300",
// 	"type" 		=> "sliderui"
// );
//
// $of_options[] = array( 	"name" 		=> "JQuery UI Spinner",
// 	"desc" 		=> "JQuery UI spinner description.<br /> Min: 0, max: 300, step: 5, default value: 75",
// 	"id" 		=> "spinner_example_2",
// 	"std" 		=> "75",
// 	"min" 		=> "0",
// 	"step"		=> "5",
// 	"max" 		=> "300",
// 	"type" 		=> "spinner"
// );
//
// $of_options[] = array( 	"name" 		=> "Switch 1",
// 	"desc" 		=> "Switch OFF",
// 	"id" 		=> "switch_ex1",
// 	"std" 		=> 0,
// 	"type" 		=> "switch"
// );
//
// $of_options[] = array( 	"name" 		=> "Switch 2",
// 	"desc" 		=> "Switch ON",
// 	"id" 		=> "switch_ex2",
// 	"std" 		=> 1,
// 	"type" 		=> "switch"
// );
//
// $of_options[] = array( 	"name" 		=> "Switch 3",
// 	"desc" 		=> "Switch with custom labels",
// 	"id" 		=> "switch_ex3",
// 	"std" 		=> 0,
// 	"on" 		=> "Enable",
// 	"off" 		=> "Disable",
// 	"type" 		=> "switch"
// );
//
// $of_options[] = array( 	"name" 		=> "Switch 4",
// 	"desc" 		=> "Switch OFF with hidden options. ;)",
// 	"id" 		=> "switch_ex4",
// 	"std" 		=> 0,
// 	"folds"		=> 1,
// 	"type" 		=> "switch"
// );
//
// $of_options[] = array( 	"name" 		=> "Hidden option 1",
// 	"desc" 		=> "This is a sample hidden option controlled by a <strong>switch</strong> button",
// 	"id" 		=> "hidden_switch_ex1",
// 	"std" 		=> "Hi, I\'m just a text input - nr 1",
// 	"fold" 		=> "switch_ex4", /* the switch hook */
// 	"type" 		=> "text"
// );
//
// $of_options[] = array( 	"name" 		=> "Hidden option 2",
// 	"desc" 		=> "This is a sample hidden option controlled by a <strong>switch</strong> button",
// 	"id" 		=> "hidden_switch_ex2",
// 	"std" 		=> "Hi, I\'m just a text input - nr 2",
// 	"fold" 		=> "switch_ex4", /* the switch hook */
// 	"type" 		=> "text"
// );
//
//
// $of_options[] = array( 	"name" 		=> "Homepage Layout Manager",
// 	"desc" 		=> "Organize how you want the layout to appear on the homepage",
// 	"id" 		=> "homepage_blocks",
// 	"std" 		=> $of_options_homepage_blocks,
// 	"type" 		=> "sorter"
// );
//
// $of_options[] = array( 	"name" 		=> "Slider Options",
// 	"desc" 		=> "Unlimited slider with drag and drop sortings.",
// 	"id" 		=> "pingu_slider",
// 	"std" 		=> "",
// 	"type" 		=> "slider"
// );
//
// $of_options[] = array( 	"name" 		=> "Background Images",
// 	"desc" 		=> "Select a background pattern.",
// 	"id" 		=> "custom_bg",
// 	"std" 		=> $bg_images_url."bg0.png",
// 	"type" 		=> "tiles",
// 	"options" 	=> $bg_images,
// );
//
// $of_options[] = array( 	"name" 		=> "Typography",
// 	"desc" 		=> "Typography option with each property can be called individually.",
// 	"id" 		=> "custom_type",
// 	"std" 		=> array('size' => '12px','style' => 'bold italic'),
// 	"type" 		=> "typography"
// );
//
// $of_options[] = array( 	"name" 		=> "Folding Checkbox",
// 	"desc" 		=> "This checkbox will hide/show a couple of options group. Try it out!",
// 	"id" 		=> "offline",
// 	"std" 		=> 0,
// 	"folds" 	=> 1,
// 	"type" 		=> "checkbox"
// );
//
// $of_options[] = array( 	"name" 		=> "Hidden option 1",
// 	"desc" 		=> "This is a sample hidden option 1",
// 	"id" 		=> "hidden_option_1",
// 	"std" 		=> "Hi, I\'m just a text input",
// 	"fold" 		=> "offline", /* the checkbox hook */
// 	"type" 		=> "text"
// );
//
// $of_options[] = array( 	"name" 		=> "Hidden option 2",
// 	"desc" 		=> "This is a sample hidden option 2",
// 	"id" 		=> "hidden_option_2",
// 	"std" 		=> "Hi, I\'m just a text input",
// 	"fold" 		=> "offline", /* the checkbox hook */
// 	"type" 		=> "text"
// );
//
// $of_options[] = array( 	"name" 		=> "Hello there!",
// 	"desc" 		=> "",
// 	"id" 		=> "introduction_2",
// 	"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Grouped Options.</h3>
// 						You can group a bunch of options under a single heading by removing the 'name' value from the options array except for the first option in the group.",
// 	"icon" 		=> true,
// 	"type" 		=> "info"
// );
//
// 				$of_options[] = array( 	"name" 		=> "Some pretty colors for you",
// 					"desc" 		=> "Color 1.",
// 					"id" 		=> "example_colorpicker_3",
// 					"std" 		=> "#2098a8",
// 					"type" 		=> "color"
// 				);
//
// 				$of_options[] = array( 	"name" 		=> "",
// 					"desc" 		=> "Color 2.",
// 					"id" 		=> "example_colorpicker_4",
// 					"std" 		=> "#2098a8",
// 					"type" 		=> "color"
// 				);
//
// 				$of_options[] = array( 	"name" 		=> "",
// 					"desc" 		=> "Color 3.",
// 					"id" 		=> "example_colorpicker_5",
// 					"std" 		=> "#2098a8",
// 					"type" 		=> "color"
// 				);
//
// 				$of_options[] = array( 	"name" 		=> "",
// 					"desc" 		=> "Color 4.",
// 					"id" 		=> "example_colorpicker_6",
// 					"std" 		=> "#2098a8",
// 					"type" 		=> "color"
// 				);
/*---------------------------------------*/
// AMP Page style
//
// $of_options[] = array( 	"name" 		=> "AMP Page",
// 	"type" 		=> "heading",
// 	"class" => "amp-style-settings"
//
// );
//
// $of_options[] = array( 	"name" 		=> "اعدادات صفحه AMP",
// 	"type" 		=> "box",
// 	"class" => "misc-settings"
// );
// $of_options[] = array( 	"name" 		=> "الخلفيه الخاصه للهيدر",
// 	"desc" 		=> "Color 3.",
// 	"id" 		=> "amp_header_background",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// );
// $of_options[] = array( 	"name" 		=> "لون خلفيه ذر القائمة",
// 	"desc" 		=> "Color 3.",
// 	"id" 		=> "amp_mine_icon_background",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// );
// $of_options[] = array( 	"name" 		=> "لون خلفيه القائمة",
// 	"desc" 		=> "Color 3.",
// 	"id" 		=> "amp_mine_background",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// );
// $of_options[] = array( 	"name" 		=> "لون خلفيه القائمة عد الهفر",
// 	"desc" 		=> "Color 3.",
// 	"id" 		=> "amp_mine_background_haver",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// );
// $of_options[] = array( 	"name" 		=> "Body Background Image",
// 	"desc" 		=> "",
// 	"id" 		=> "amp_background_img",
// 	"std" 		=> "",
// 	"type" 		=> "media"
// );
// $of_options[] = array( 	"name" 		=> "Body Background Color",
// 	"desc" 		=> "Pick a background color for the theme (default: #fff).",
// 	"id" 		=> "amp_background",
// 	"std" 		=> "",
// 	"type" 		=> "color"
// );
//
// $of_options[] = array( 	"name" 		=> "Body Font",
// 	"desc" 		=> "Specify the body font properties",
// 	"id" 		=> "amp_font",
// 	"std" 		=> array('size' => '12px','face' => 'selact','style' => 'normal','color' => '#000000'),
// 	"type" 		=> "typography"
// );
//
// Backup Options
// ----------------------------------------
$of_options[] = array( 	"name" 		=> "نسخ احطياطي",
	"type" 		=> "heading",
	"icon"		=> ADMIN_IMAGES . "icon-slider.png"
);
$of_options[] = array( 	"name" 		=> "نسخ احطياطي",
	"type" 		=> "box",
	"class" => "misc-settings"
);


$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
	"id" 		=> "of_backup",
	"std" 		=> "",
	"type" 		=> "backup",
	"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
);

$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
	"id" 		=> "of_transfer",
	"std" 		=> "",
	"type" 		=> "transfer",
	"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
