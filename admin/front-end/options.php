<div class="wrap" id="of_container">

	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save">Options Updated</div>
	</div>

	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset">Options Reset</div>
	</div>

	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail">Error!</div>
	</div>

	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >

		<!-- <div id="header">

			<div class="logo">
				<h2><?php echo THEMENAME; ?></h2>
				<span><?php echo ('v'. THEMEVERSION); ?></span>
			</div>

			<div id="js-warning">Warning- This options panel will not work properly without javascript!</div>
			<div class="icon-option"></div>
			<div class="clear"></div>

    </div> -->



		<div id="main">
			<div id="of-nav">
				<div class="logo"></div>
				<div class="title">الإعدادات</div>
				<ul><?php echo $options_machine->Menu ?></ul>
			</div>
			<div id="content">
				<div class="info_bar">
					<a href="<?php bloginfo('url'); ?>" target="_blank" class="of_button of_review" >أستعراض الموقع</a>
					<button id="of_save" type="button" class="of_button of_save">
						حفظ
						<div class="loader spin-loader"></div>
					</button>
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
				</div><!--.info_bar-->
				<div class="clearfix">
					<?php echo $options_machine->Inputs /* Settings */ ?>
				</div>
				<div class="info_bar">
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
					<!-- <button id ="of_save" type="button" class="of_button of_save">
						حفظ
						<div class="loader spin-loader"></div>
					</button> -->
					<button id ="of_reset" type="button" class="of_button of_reset" >أستعادة الاعدادات الاصلية</button>
					<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
				</div><!--.info_bar-->
		  </div>
			<div class="clear"></div>

		</div>




	</form>

	<div style="clear:both;"></div>

</div><!--wrap-->
