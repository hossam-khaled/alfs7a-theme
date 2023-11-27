<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$theme_name = khy_get_child_theme_name();
?>


<div id="sidebar">
    <!-- Upper sidebars -->

     <?php
     if( is_front_page() ){
        dynamic_sidebar( 'sidebar-1-'.$theme_name );
     } else {
        // dynamic_sidebar( 'sidebar-1-inner-'.$theme_name );
     }
    ?>

</div>
