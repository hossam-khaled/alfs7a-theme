<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 global $data;
?>


  </div><!-- #content -->
</div><!-- .container -->

<footer id="khy-footer" class="<?php echo $data["layout"]; ?>" role="contentinfo" style="background-color:<?php  echo $data["footer_background"]; ?>" >
  <div class="inner">
    <div class="container">

        <?php if( $data["top_footer_menu_show"] ) { ?>
          <div class="top-footer" style="background-color:<?php  echo $data["top_footer_background"]; ?>">
            <?php
            if( $data["top_footer_date"] ) {
              khafagy_today_date( array('hajri','milady') );
            }
            if( $data["top_footer_prayer"] ) {
              get_template_part( 'template-parts/single_prayer' );
            }
            if( $data["top_footer_weather"] ) {
              get_template_part( 'template-parts/single_weather' );
            }
            if( $data["top_footer_search"] ) {
              get_template_part( 'template-parts/search_box' );
            }
            if( $data["top_footer_socials"] ) {
              // global $khafagy_icons_position;
              // $khafagy_icons_position = 'footer';
              get_template_part( 'template-parts/social_icons' );
            }

            ?>
          </div>
        <?php } ?>

        <div class="upper-footer clearfix">
          <?php
            if( $data["footer_layout"] == 'half-box') {
              get_template_part( 'template-parts/half_footer' );
            }
            if( $data["footer_layout"] == 'third-box') {
              get_template_part( 'template-parts/third_footer' );
            }
          ?>
        </div>
      </div>

      <div class="sub-footer clearfix"  style="background-color:<?php  echo $data["sub_footer_background"]; ?>">
        <div class="container">

            <div class="copyrights">
              <?php
                if ( $data["footer_copyright_show"] ) {
                  echo $data["footer_copyright_text"];
                }
               ?>
            </div>
<!--             <div class="khafagy-logo clearfix">
              <div class="name">تصميم و تطوير <a href="https://bonyan-tech.com/" target="_blank" title="بنيان | لتقنية المعلومات , تطوير مواقع, تطوير تطبيقات">بنيان</a></div>
              <div class="logo">
                <a href="https://bonyan-tech.com/" target="_blank" title="بنيان | لتقنية المعلومات , تطوير مواقع, تطوير تطبيقات">بنيان</a>
              </div>
           </div> -->
          </div>

    </div>
  </div>
</footer><!-- #colophon -->


<?php wp_footer(); ?>
<?php echo nl2br($data['footer_custom_code']);?>


<!--
 <?php //echo get_num_queries(); ?> queries in <?php //timer_stop(1); ?> seconds.
-->

</body>
</html>
