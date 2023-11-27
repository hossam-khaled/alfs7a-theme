jQuery(document).ready(function($){

      $('.color-picker-field').wpColorPicker();



			var file_frame;

			$( document ).on( 'click', '#khafagy-upload-button',  function( event ){
          currentInput = $(this);
  				event.preventDefault();
  				if ( file_frame ) {
  					file_frame.open();
  					return;
  				}
  				file_frame = wp.media.frames.file_frame = wp.media({
  					title: jQuery( this ).data( 'uploader_title' ),
  					button: {
  						text: jQuery( this ).data( 'uploader_button_text' ),
  					},
  					multiple: false  // Set to true to allow multiple files to be selected
  				});
  				file_frame.on( 'select', function() {
  					attachment = file_frame.state().get('selection').first().toJSON();
  					currentInput.next('.khafagy-upload-input').attr('value',attachment.id );
            currentInput.parents('.the-input').find('.uploaded-media').remove();
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            var filename = attachment.url.split('/').pop();
            if ($.inArray( filename.split('.').pop().toLowerCase(), fileExtension) == -1) {
              currentInput.parents('.the-input').prepend('<span class="uploaded-media"><a href="' + attachment.url + '">'+ filename + '</a></span>');
            } else {
              currentInput.parents('.the-input').prepend('<span class="uploaded-media"><a href="' + attachment.url + '"><img src="' + attachment.url + '"></a></span>');
            }
            //console.log( attachment.url );
  					// Do something with attachment.id and/or attachment.url here
  				});
  				file_frame.open();
			});


      $(document).ajaxComplete(function() {
          $('.color-picker-field').wpColorPicker();
      });

      $('html').on('click', '.image-selector > span', function(){
        var selectedImage = $(this).attr('data-option');
        var parentDiv = $(this).parents('.image-selector');

        $(this).addClass('active').siblings().removeClass('active');
        parentDiv.find('input.selected_image').attr('value', selectedImage );

        // if ( selectedStyle == 'video' ) {
        //   parentDiv.find('.select-category-1, .select-category-2, .select-category-3').fadeOut();
        // } else {
        //   parentDiv.find('.select-category-1').fadeIn();
        // }
        //
        // if ( selectedStyle == 'small_and_title_3_blocks' ) {
        //   parentDiv.find('.select-category-2, .select-category-3').fadeIn();
        // } else {
        //   parentDiv.find('.select-category-2, .select-category-3').fadeOut();
        // }

      });

      $(document).on('click', '#remove-image', function() {
        root = $(this).parents('.single-option');
        root.find('.uploaded-media').remove();
        root.find(".khafagy-upload-input").attr('value','');
      });


});
