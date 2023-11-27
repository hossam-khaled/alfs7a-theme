/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance!
 */
jQuery(document).ready(function($){

	//(un)fold options in a checkbox-group
  	jQuery('.fld').click(function() {
    	var $fold='.f_'+this.id;
    	$($fold).slideToggle('normal', "swing");
  	});

  	//Color picker
  	$('.of-color').wpColorPicker();

	//hides warning if js is enabled
	$('#js-warning').hide();

	//Tabify Options
	$('.group').hide();

	// Display last current tab
	if ($.cookie("of_current_opt") === null) {
		$('.group:first').fadeIn('fast');
		$('#of-nav li:first').addClass('current');
	} else {
    setTimeout( function() {
			// $(element).parent().prev().find('strong').text( element.value );
      var hooks = $('#hooks').html();
      hooks = jQuery.parseJSON(hooks);
      console.log(hooks);
      // var hooks1 = JSON.parse(hooks);
      // console.log(hooks1);
      $.each(hooks, function(key, value) {

        if ($.cookie("of_current_opt") == '#of-option-'+ value) {

          $('.group#of-option-' + value).fadeIn();
          $('#of-nav li.' + value).addClass('current');
        }

      });
		}, 500);

	}

	//Current Menu Class
	$('#of-nav li a').click(function(evt){
	// event.preventDefault();

		$('#of-nav li').removeClass('current');
		$(this).parent().addClass('current');

		var clicked_group = $(this).attr('href');

		$.cookie('of_current_opt', clicked_group, { expires: 7, path: '/' });

		$('.group').hide();

		$(clicked_group).fadeIn('fast');
		return false;

	});

	//Expand Options
	var flip = 0;

	$('#expand_options').click(function(){
		if(flip == 0){
			flip = 1;
			$('#of_container #of-nav').hide();
			$('#of_container #content').width(755);
			$('#of_container .group').add('#of_container .group h2').show();

			$(this).removeClass('expand');
			$(this).addClass('close');
			$(this).text('Close');

		} else {
			flip = 0;
			$('#of_container #of-nav').show();
			$('#of_container #content').width(595);
			$('#of_container .group').add('#of_container .group h2').hide();
			$('#of_container .group:first').show();
			$('#of_container #of-nav li').removeClass('current');
			$('#of_container #of-nav li:first').addClass('current');

			$(this).removeClass('close');
			$(this).addClass('expand');
			$(this).text('Expand');

		}

	});

	//Update Message popup
	$.fn.center = function () {
		this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
		this.css("left", 250 );
		return this;
	}


	$('#of-popup-save').center();
	$('#of-popup-reset').center();
	$('#of-popup-fail').center();

	$(window).scroll(function() {
		$('#of-popup-save').center();
		$('#of-popup-reset').center();
		$('#of-popup-fail').center();
	});


	//Masked Inputs (images as radio buttons)
	$('.of-radio-img-img').click(function(){
		$(this).parent().parent().find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).addClass('of-radio-img-selected');
	});
	$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide();

	//Masked Inputs (background images as radio buttons)
	$('.of-radio-tile-img').click(function(){
		$(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
		$(this).addClass('of-radio-tile-selected');
	});
	$('.of-radio-tile-label').hide();
	$('.of-radio-tile-img').show();
	$('.of-radio-tile-radio').hide();

	// Style Select
	(function ($) {
	styleSelect = {
		init: function () {
		$('.select_wrapper').each(function () {
			$(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
		});
		$('.select').on('change', function () {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		$('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
			$(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
		});
		}
	};
	$(document).ready(function () {
		styleSelect.init()
	})
	})(jQuery);


	/** Aquagraphite Slider MOD */

	//Hide (Collapse) the toggle containers on load
	$(".slide_body").hide();

	//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	$(".slide_edit_button").on( 'click', function(){
		/*
		//display as an accordion
		$(".slide_header").removeClass("active");
		$(".slide_body").slideUp("fast");
		*/
		//toggle for each
		$(this).parent().toggleClass("active").next().slideToggle("fast");
		return false; //Prevent the browser jump to the link anchor
	});

	// Update slide title upon typing
	function update_slider_title(e) {
		var element = e;
		if ( this.timer ) {
			clearTimeout( element.timer );
		}
		this.timer = setTimeout( function() {
			$(element).parent().prev().find('strong').text( element.value );
		}, 100);
		return true;
	}

	$('.of-slider-title').on('keyup', function(){
		update_slider_title(this);
	});


	//Remove individual slide
	$('.slide_delete_button').on('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this slide?");
		if (agree) {
			var $trash = $(this).parents('li');
			//$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
			$trash.animate({
					opacity: 0.25,
					height: 0,
				}, 500, function() {
					$(this).remove();
			});
			return false; //Prevent the browser jump to the link anchor
		} else {
		return false;
		}
	});

	//Add new slide
	$(".slide_add_button").on('click', function(){
		var slidesContainer = $(this).prev();
		var sliderId = slidesContainer.attr('id');

		var numArr = $('#'+sliderId +' li').find('.order').map(function() {
			var str = this.id;
			str = str.replace(/\D/g,'');
			str = parseFloat(str);
			return str;
		}).get();

		var maxNum = Math.max.apply(Math, numArr);
		if (maxNum < 1 ) { maxNum = 0};
		var newNum = maxNum + 1;

		var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="upload slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '">Upload</span><span class="button remove-image hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

		slidesContainer.append(newSlide);
		var nSlide = slidesContainer.find('.temphide');
		nSlide.fadeIn('fast', function() {
			$(this).removeClass('temphide');
		});

		optionsframework_file_bindings(); // re-initialise upload image..

		return false; //prevent jumps, as always..
	});

	//Sort slides
	jQuery('.slider').find('ul').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).sortable({
			placeholder: "placeholder",
			opacity: 0.6,
			handle: ".slide_header",
			cancel: "a"
		});
	});


	/**	Sorter (Layout Manager) */
	jQuery('.sorter').each( function() {
		var id = jQuery(this).attr('id');
		$('#'+ id).find('ul').sortable({
			items: 'li',
			placeholder: "placeholder",
			connectWith: '.sortlist_' + id,
			opacity: 0.6,
			update: function() {
				$(this).find('.position').each( function() {

					var listID = $(this).parent().attr('id');
					var parentID = $(this).parent().parent().attr('id');
					parentID = parentID.replace(id + '_', '')
					var optionID = $(this).parent().parent().parent().attr('id');
					$(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');

				});
			}
		});
	});

  /**	Display tags (Section Builder) */

  // $(document).scroll(function () {
  //     var y = $(document).scrollTop();
  //     header = $(".options-tabs");
  //     header.css({ width : header.width() });
  //
  //     if (y >= 150) {
  //         header.addClass('fixed');
  //     } else {
  //         header.removeClass('fixed');
  //     }
  // });

  $(document).on( 'click', '.options-tabs .selector > div', function(){
    var tabIndex = $(this).index();
    $(this).addClass('active').siblings().removeClass('active');
    $('.options-tabs .panel').eq( tabIndex ).siblings().hide( 'blind' , '', 400, function() {
        $('.options-tabs .panel').eq( tabIndex ).show('blind' , '', 400);
    } );
  });









  /**	Category manager */
	$(document).on( 'click', '.categories-manager .add-button',function(){

        var form = $('.categories-manager .form');
        var cat_name = form.find('.cat_name').val();
        var has_fake_news = form.find('.fake-news-check:checked').length > 0;
        var fake_news_count = form.find('.fake-news-count').val();

        if ( cat_name == '' ) {
          alert('تاكد من ادخال اسم القسم بشكل صحيح');
        }

        if ( has_fake_news && ( fake_news_count == '' || fake_news_count == '0' || !$.isNumeric( fake_news_count ) )  ) {
          alert('تاكد من ادخال عدد الاخبار بشكل صحيح');
        }

        var nonce = $('#security').val();
        var data = {
          action: 'khafagy_builder_ajax',
          type: 'new_category',
          cat_name: cat_name,
          security: nonce,
          async: false,
        };

        if( has_fake_news ) {
          data.has_fake_news = 1;
          data.fake_new_count = fake_news_count;
        }

        return $.post(ajaxurl, data, function( result ) {
          result = JSON.parse( result )
          if ( result.hasOwnProperty("cat_ID") ) {
            var category = $(".categories-manager .categories-list .category:first-child").clone().removeClass('hidden');
            category.attr('data-category-id', result.cat_ID );
            category.find('.category-name').text( cat_name );
            category.find('.cat_name').val( cat_name );
            category.find('.default_category').prop('checked', false);
            category.find('.inputs').hide();
            category.prependTo( $(".categories-manager .categories-list") );
            form.find('.fake-news-count, .cat_name').val('');
            form.find('.fake-news-check').prop('checked', false);
          } else if ( result.hasOwnProperty("error") && result.error == 'exists' ) {
            alert('عفوا, يوجد قسم بنفس المسمى حاليا');
          } else if ( result.hasOwnProperty("error") ) {
            alert( result.error );
          }
      });
	});


  function update_category( element ) {
    var category = element.parents('.category');
    var cat_ID = category.attr('data-category-id');
    var new_name = category.find('.cat_name').val();
    var default_checkbox = category.find('.default_category:checked');
    var is_default_category = default_checkbox.length > 0;

    if( new_name == '' ) {
      alert('رجاء ادخال اسم القسم');
      return false;
    }

    var nonce = $('#security').val();
    var data = {
      action: 'khafagy_builder_ajax',
      type: 'update_category',
      cat_name: new_name,
      cat_ID: cat_ID,
      security: nonce,
      async: false,
    };

    if( is_default_category ) {
      data.is_default_category = 1;
    }


    return $.post(ajaxurl, data, function( result ) {
      result = JSON.parse( result )
      if ( result.hasOwnProperty("cat_ID") ) {
        category.find('.category-name').text( new_name ).effect('highlight', 1500);
        if( is_default_category ) {
          $('.categories-manager .categories-list .category .default_category').not( default_checkbox ).prop('checked', false);
        }
      } else if ( result.hasOwnProperty("error") && result.error == 'exists' ) {
        alert('عفوا, يوجد قسم بنفس المسمى حاليا');
      } else if ( result.hasOwnProperty("error") && result.error == 'invalid_id' ) {
        alert('خطأ برقم القسم');
      } else if ( result.hasOwnProperty("error") ) {
        alert( result.error );
      }
    });
  }


  $(document).on( 'click', '.categories-manager .categories-list .category .save',function(){
      update_category( $(this) );
  });

  $(document).on( 'keyup' , ".categories-manager .categories-list .category .cat_name", function (e) {
    if (e.keyCode == 13) {
      update_category( $(this) );
    }
  });


  $(document).on( 'click', '.categories-manager .categories-list .category .delete',function(){
	    var answer = confirm("هل انت متأكد من رغبتك فى الحذف, علما بانه لا يمكن التراجع فى الحذف");
      if ( answer ) {
        var category = $(this).parents('.category');
        var cat_ID = category.attr('data-category-id');
        var nonce = $('#security').val();
        var data = {
          action: 'khafagy_builder_ajax',
          type: 'delete_category',
          cat_ID: cat_ID,
          security: nonce,
          async: false,
        };

        return $.post(ajaxurl, data, function( result ) {
            result = JSON.parse( result )
            if ( result.hasOwnProperty("deleted") ) {
              category.hide('blind',400, function(){
                  category.remove();
              });
            } else if ( result.hasOwnProperty("error") && result.error == 'default' ) {
              alert("لا يمكن حذف القسم الافتراضى");
              category.find('.category-name').effect('highlight', 1500);
            }  else if ( result.hasOwnProperty("error") ) {
              alert( result.error );
            }
        });
      }
	});


  $(document).on( 'click', '.categories-manager .categories-list .category .edit',function(){
      var category = $(this).parents('.category');
      $('.categories-list .category').not( category ).find('.inputs').hide( 'blind', 500 );
      category.find('.inputs').toggle( 'blind', 500 );
	});


  /**	Wizard */
  $(document).on( 'click', '#of_container .quick_wizard .options > div', function(){
    $(this).addClass('active').siblings().removeClass('active');
  });


  $(document).on( 'click', '#of_container .quick_wizard .start-button', function(){
    var selected = $(this).parents('.quick_wizard').find('.options > .active').attr('data-id');
    var nonce = $('#security').val();
    var data = {
      action: 'khafagy_builder_ajax',
      type: 'quick_wizard',
      selected: selected,
      security: nonce,
      async: false,
    };

    return $.post(ajaxurl, data, function( result ) {
      result = JSON.parse( result )
      if ( result.hasOwnProperty("success") ) {
        console.log( result );
      } else if ( result.hasOwnProperty("error") ) {
        alert( result.error );
      }
    });
  });






  // /**	activate container (Section Builder) */
	// $(document).on( 'click', '#sections_panel .activate-container',function(){
  //       //alert( 'ok' );
  //       $(this).hide();
  //       $(this).parents('.sections-container::before').hide();
  //       $(this).parents('.sections-container').find('.section').each( function(){
  //         $(this).animate({'opacity' : 1 });
  //       });
  //     	convertSections();
	// });


	/**	Ajax Backup & Restore MOD */
	//backup button
	$('#of_backup_button').on('click', function(){

		var answer = confirm("Click OK to backup your current saved options.")

		if (answer){

			var clickedObject = $(this);
			var clickedID = $(this).attr('id');

			var nonce = $('#security').val();

			var data = {
				action: 'of_ajax_post_action',
				type: 'backup_options',
				security: nonce
			};

			$.post(ajaxurl, data, function(response) {

				//check nonce
				if(response==-1){ //failed

					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();
					}, 2000);
				}

				else {

					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				}

			});

		}

	return false;

	});

	//restore button
	$('#of_restore_button').on('click', function(){

		var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")

		if (answer){

			var clickedObject = $(this);
			var clickedID = $(this).attr('id');

			var nonce = $('#security').val();

			var data = {
				action: 'of_ajax_post_action',
				type: 'restore_options',
				security: nonce
			};

			$.post(ajaxurl, data, function(response) {

				//check nonce
				if(response==-1){ //failed

					var fail_popup = $('#of-popup-fail');
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();
					}, 2000);
				}

				else {

					var success_popup = $('#of-popup-save');
					success_popup.fadeIn();
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				}

			});

		}

	return false;

	});

	/**	Ajax Transfer (Import/Export) Option */
	$('#of_import_button').on('click', function(){

		var answer = confirm("Click OK to import options.")

		if (answer){

			var clickedObject = $(this);
			var clickedID = $(this).attr('id');

			var nonce = $('#security').val();

			var import_data = $('#export_data').val();

			var data = {
				action: 'of_ajax_post_action',
				type: 'import_options',
				security: nonce,
				data: import_data
			};

			$.post(ajaxurl, data, function(response) {
				var fail_popup = $('#of-popup-fail');
				var success_popup = $('#of-popup-save');

				//check nonce
				if(response==-1){ //failed
					fail_popup.fadeIn();
					window.setTimeout(function(){
						fail_popup.fadeOut();
					}, 2000);
				}
				else
				{
					success_popup.fadeIn();
          console.log( response );
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				}

			});

		}

	   return false;

	});



  $(window).bind('keydown', function(event) {
      if (event.ctrlKey || event.metaKey) {
          if( String.fromCharCode(event.which).toLowerCase() == 's' ) {
            event.preventDefault();
            save_options();
          }
      }
  });

  /** AJAX Save Options */
  $('#of_save').on('click',function() {
      return save_options();
  });

  function toggle_save_animation() {
    if ( ! $('.of_save').hasClass('loading') ) {
      $('.of_save').animate({ 'padding-left' : ( parseInt( $('.of_save').css('padding-left') ) + 30 ) + 'px' }, 'fast' ).addClass('loading');
    } else {
      $('.of_save').animate({ 'padding-left' : ( parseInt( $('.of_save').css('padding-left') ) - 30 ) + 'px' }, 'fast').removeClass('loading');
    }
  }


  function save_options() {

    if ( $('.of_save').hasClass('loading') ) {
      return false;
    }

    //show loading effect
    toggle_save_animation();



		var nonce = $('#security').val();

		//$('.ajax-loading-img').fadeIn();

		//get serialized data from all our option fields
		var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').not('#sections_panel *').serialize();

		var data = {
			type: 'save',
			action: 'of_ajax_post_action',
			security: nonce,
			data: serializedReturn
		};

		$.post(ajaxurl, data, function(response) {
			var success = $('#of-popup-save');
			var fail = $('#of-popup-fail');
			//var loading = $('.ajax-loading-img');
			//loading.fadeOut();

      toggle_save_animation()

			if (response==1) {
				success.fadeIn();
        location.reload(); /* For development */
			} else {
				fail.fadeIn();
			}

			window.setTimeout(function(){
				success.fadeOut();
				fail.fadeOut();
			}, 2000);
		});

  }


	/* AJAX Options Reset */
	$('#of_reset').click(function() {

		//confirm reset
		var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

		//ajax reset
		if (answer){

			var nonce = $('#security').val();

			$('.ajax-reset-loading-img').fadeIn();

			var data = {

				type: 'reset',
				action: 'of_ajax_post_action',
				security: nonce,
			};

			$.post(ajaxurl, data, function(response) {
				var success = $('#of-popup-reset');
				var fail = $('#of-popup-fail');
				var loading = $('.ajax-reset-loading-img');
				loading.fadeOut();

				if (response==1)
				{
					success.fadeIn();
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				}
				else
				{
					fail.fadeIn();
					window.setTimeout(function(){
						fail.fadeOut();
					}, 2000);
				}


			});

		}

	return false;

	});


	/**	Tipsy @since v1.3 */
	if (jQuery().tipsy) {
		$('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
			fade: true,
			gravity: 's',
			opacity: 0.7,
		});
	}


	/**
	  * JQuery UI Slider function
	  * Dependencies 	 : jquery, jquery-ui-slider
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	jQuery('.smof_sliderui').each(function() {

		var obj   = jQuery(this);
		var sId   = "#" + obj.data('id');
		var val   = parseInt(obj.data('val'));
		var min   = parseInt(obj.data('min'));
		var max   = parseInt(obj.data('max'));
		var step  = parseInt(obj.data('step'));

		//slider init
		obj.slider({
			value: val,
			min: min,
			max: max,
			step: step,
			range: "min",
			slide: function( event, ui ) {
				jQuery(sId).val( ui.value );
			}
		});

	});


	/**
	  * Switch
	  * Dependencies 	 : jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	$(".switch-options").click(function(){
		var parent = $(this);
		var $fold='.f_'+parent.data('id');

    if ( parent.hasClass('selected') ) {
        parent.removeClass('selected');
        $('.main_checkbox',parent).attr('checked', false);
        $($fold).slideUp('normal', "swing");
    } else {
        parent.addClass('selected');
        $('.main_checkbox',parent).attr('checked', true);
        $($fold).slideDown('normal', "swing");
    }
	});

  // if( $('.cb-disable').width() < $('.cb-enable').width() ) {
  //   $('.cb-disable').css({ width: $('.cb-enable').width() });
  // } else {
  //   $('.cb-enable').css({ width: $('.cb-disable').width() });
  // }

	//disable text select(for modern chrome, safari and firefox is done via CSS)
	if ( ($.browser.msie && $.browser.version < 10) || $.browser.opera ) {
		$('.switch-options').find().attr('unselectable', 'on');
	}


	/**
	  * Google Fonts
	  * Dependencies 	 : google.com, jquery
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 03.17.2013
	  */
	function GoogleFontSelect( slctr, mainID ){

		var _selected = $(slctr).val(); 						//get current value - selected and saved
		var _linkclass = 'style_link_'+ mainID;
		var _previewer = mainID +'_ggf_previewer';

		if( _selected ){ //if var exists and isset

			//Check if selected is not equal with "Select a font" and execute the script.
			if ( _selected !== 'none' && _selected !== 'Select a font' ) {

				//remove other elements crested in <head>
				$( '.'+ _linkclass ).remove();

				//replace spaces with "+" sign
				var the_font = _selected.replace(/\s+/g, '+');

				//add reference to google font family
				$('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');

				//show in the preview box the font
				$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );

			}else{

				//if selected is not a font remove style "font-family" at preview box
				$('.'+ _previewer ).css('font-family', '' );

			}

		}

	}

	//init for each element
	jQuery( '.google_font_select' ).each(function(){
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});

	//init when value is changed
	jQuery( '.google_font_select' ).change(function(){
		var mainID = jQuery(this).attr('id');
		GoogleFontSelect( this, mainID );
	});


	/**
	  * Media Uploader
	  * Dependencies 	 : jquery, wp media uploader
	  * Feature added by : Smartik - http://smartik.ws/
	  * Date 			 : 05.28.2013
	  */
	function optionsframework_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}

		// Create the media frame.
		frame = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),

			// Customize the submit button.
			button: {
				// Set the text of the button.
				text: $el.data('update'),
				// Tell the button not to close the modal, since we're
				// going to refresh the page when the image is selected.
				close: false
			}
		});

		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			frame.close();
			selector.find('.upload').val(attachment.attributes.url);
			if ( attachment.attributes.type == 'image' ) {
				selector.find('.screenshot').empty().hide().append('<img class="of-option-image" src="' + attachment.attributes.url + '">').slideDown('fast');
			}
			selector.find('.media_upload_button').unbind();
			selector.find('.remove-image').show().removeClass('hide');//show "Remove" button
			selector.find('.of-background-properties').slideDown();
			optionsframework_file_bindings();
		});

		// Finally, open the modal.
		frame.open();
	}

	function optionsframework_remove_file(selector) {
		selector.find('.remove-image').hide().addClass('hide');//hide "Remove" button
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind();
		// We don't display the upload button if .upload-notice is present
		// This means the user doesn't have the WordPress 3.5 Media Library Support
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.media_upload_button').remove();
		}
		optionsframework_file_bindings();
	}

	function optionsframework_file_bindings() {
		$('.remove-image, .remove-file').on('click', function() {
			optionsframework_remove_file( $(this).parents('.section-upload, .section-media, .slide_body') );
        });

        $('.media_upload_button').unbind('click').click( function( event ) {
        	optionsframework_add_file(event, $(this).parents('.section-upload, .section-media, .slide_body'));
        });
    }

    optionsframework_file_bindings();




}); //end doc ready
