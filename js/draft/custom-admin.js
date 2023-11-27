jQuery(document).ready(function($){

      $('html').on('click', '.select-style div', function(){
        var selectedStyle = $(this).attr('data-option');
        var parentDiv = $(this).parents('.widget');

        $(this).addClass('active').siblings().removeClass('active');
        parentDiv.find('input.selected_style').attr('value', selectedStyle );


        if ( selectedStyle == 'posts_slider_2_blocks' ) {
          parentDiv.find('.select-category-2,.select-color-01, .select-color-2,.select-bar-color-01, .select-bar-color-2,.select-block-color-01, .select-block-color-2').fadeIn();
          parentDiv.find('.select-category-3,.select-color-3').fadeOut();
        } else if( selectedStyle == 'posts_slider_3_blocks' ){
          parentDiv.find('.select-category-3,.select-color-3,.select-bar-color-3,.select-block-color-3,.select-category-2,.select-color-01,.select-bar-color-01,.select-block-color-01, .select-color-2,.select-bar-color-2,.select-block-color-2').fadeIn();
        } else {
          parentDiv.find('.select-category-2,.select-category-3,.select-color-01,.select-color-2,.select-color-3,.select-bar-color-01,.select-bar-color-2,.select-bar-color-3,.select-block-color-01,.select-block-color-2,.select-block-color-3').fadeOut();
        }


      });

      $('.widget-color-picker').wpColorPicker();


});
