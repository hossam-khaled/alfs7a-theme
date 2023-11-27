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



  </div><!-- #span12 -->
</div>

<div class="clearfix"></div>

  <div class="container">
   <a class="full-version-link" href="<?php bloginfo( 'url' ); ?>/?no_mobile=1">شاهد النسخة الكاملة للموقع</a>
  </div>

  <div id="footer" class="clearfix" data-role="footer">
    <div class="container">
      <div class="copyrights">
       <div class="clearfix">
        جميع التعليقات و الردود المطروحة لا تعبر عن رأي (<?php bloginfo('name'); ?>) بل تعبر عن رأي كاتبها.
       </div>
      </div>
      <div class="legal-and-logo">
       <div class="legal">
        <?php echo date('Y');?> جميع الحقوق محفوظة, <?php bloginfo('name'); ?>
       </div>
       <div class="develop clearfix">
        <div class="name">تصميم و تطوير <a href="https://bonyan-tech.com/" target="_blank" title="خفاجى | لتقنية المعلومات , تطوير مواقع, تطوير تطبيقات">خفاجى</a></div>
        <div class="logo">
          <a href="https://bonyan-tech.com/" target="_blank" title="خفاجى | لتقنية المعلومات , تطوير مواقع, تطوير تطبيقات"><img alt="خفاجى | لتقنية المعلومات , تطوير مواقع, تطوير تطبيقات" src="<?php echo get_template_directory_uri().'/mobile/images/mobile-logo-khafagy.png'; ?>" /></a>
        </div>
       </div>

      </div>
    </div>

  </div>

  <?php wp_footer(); ?>

  </body>
</html>
