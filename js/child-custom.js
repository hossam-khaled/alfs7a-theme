jQuery(document).ready(function($){
  // $('#loading-wrapper').fadeOut(1000,function() {
  //   $(this).remove();
  // });
  /* niceScroll */
  // $(".section-top").niceScroll({
  //   cursorcolor: "#075b72",
  //   background: "#2f2f2f",
  //   cursorborder: "0",
  //   cursorborderradius :'0',
  //   autohidemode: false,
  //   cursorwidth: '12px',
  //   railalign:'left'
  // });

  // $('#khy-header .icons div').click(function(){
  //   var NavHeight = $(window).height() - 133;
  //   $( '#header-navigation' ).css({'height' : NavHeight });
  //   $(this).toggleClass('active').siblings().removeClass('active');
  //   var widgetName = $(this).attr('data-widget');
  //   $('#widgets .' + widgetName).stop(true,true).animate({'height':'toggle'}).siblings().stop(true,true).animate({'height':'hide'});
  //   return false;
  // });
  //
  // $('.single .add-comment').click(function() {
  //   $(this).toggleClass('close');
  //   $('#comments').stop(true,true).animate({'height':'toggle'});
  // })
  // $( "#khy-header .header-center .search-icone" ).on( "click", function() {
  //   $(this).toggleClass('close');
  //   $( "#khy-header .header-center .search-box" ).stop(true,true).animate({'width':'toggle'});
  // });

  // $("#widgets .khy-weather .tabs a").click(function(){
  //   var currentTab = $(this).attr('data-id');
  //   $(this).parents('.weather').find('.city').removeClass('visible');
  //   $(this).parents('.weather').find( '.' + currentTab  ).addClass('visible');
  //   $(this).addClass('active').siblings().removeClass('active');
  //   return false;
  // });
  //
  // $("#widgets .exchange .tabs a").click(function(){
  //   var currentTab = $(this).attr('data-id');
  //   $(this).parents('.exchange').find('.single-currency').removeClass('visible');
  //   $(this).parents('.exchange').find( '.' + currentTab  ).addClass('visible');
  //   $(this).addClass('active').siblings().removeClass('active');
  //   return false;
  // });


  let i = 1;
  $('.lode-more').click(function() {

    // if (i === 1) {
    //   $('.hidden-block:first').fadeIn(500);
    //   // i++;
    //   console.log(i);
    // }
    //
    // if (i === 2) {
    //   $('.hidden-block:last-child').fadeIn(500);
    //     // i = 3;
    // }
    //
    // if (i == 3){
    //   $(this).remove();
    // }
    switch(i) {
      case 1:
        $('.hidden-block:first').fadeIn(2000);
        break;
      case 2:
        $('.hidden-block:nth-of-type(2)').fadeIn(2000);
        break;
      case 3:
        $('.hidden-block:last-child').fadeIn(2000);
        $(this).remove();
        break;


    }
    i++;
  })
});
