jQuery(document).ready(function($){

        $('#header .menu-toggle').click(function(){
          $('#header .icons li').removeClass('active');
          $('#widgets').children().stop(true,true).animate({'height':'hide'}).removeClass('active');
          $('#header-navigation').stop(true,true).animate({'height':'toggle'});
          return false;
        });


        $('#header .icons li').click(function(){
          $('#header-navigation').animate({'height':'hide'});
          $(this).toggleClass('active').siblings().removeClass('active');

          var widgetName = $(this).attr('data-widget');
          $('#widgets .' + widgetName).stop(true,true).animate({'height':'toggle'}).siblings().stop(true,true).animate({'height':'hide'});
          return false;
        });


        $('.jquery-share > div').on('click', function(event) {
          var postLink = $(this).parents('.jquery-share').attr('date-url');
          var postTitle = $(this).parents('.jquery-share').attr('date-title');
          if ( $(this).hasClass('facebook') ) {
            $.popupWindow('https://www.facebook.com/sharer.php?u=' + postLink, { height: 300, width: 700 });
          } else if ( $(this).hasClass('gplus') ) {
            $.popupWindow('https://plus.google.com/share?url=' + postLink, { height: 300, width: 700 });
          } else if ( $(this).hasClass('twitter') ) {
            $.popupWindow('https://twitter.com/share?url=' + postLink + '&text=' + postTitle, { height: 300, width: 700 });
          } else if ( $(this).hasClass('whatsapp') ) {
            $.popupWindow('whatsapp://send?text=' +  postTitle + ' ' + postLink , { height: 300, width: 700 });
          } else if ( $(this).hasClass('telegram') ) {
            $.popupWindow('tg://msg?text=' +  postTitle + ' ' + postLink, { height: 300, width: 700 });
          }
          event.preventDefault();
        });

        //slider-mobile

        $(document).find('.swiper-holder').each(function(){
          var Autoplay = 5000;
          if ( $(this).data('autoplay') == false ) {
            Autoplay = 0;
          }
          var swiper = new Swiper( $(this).find('.swiper-container') , {
              autoplayDisableOnInteraction: false,
              autoplay: Autoplay,
              nextButton: '.swiper-button-next',
              prevButton: '.swiper-button-prev',
              loop: true
          });
          var thumbnails = $(this).find('.pagination > *');
          thumbnails.eq(0).addClass('active');
          thumbnails.hover(function(){
              swiper.slideTo( ( $(this).index() + 1 ), 500);
          });
          swiper.on('onTransitionStart', function(swiper){
            var currentSlide = ( swiper.activeIndex - 1 ) % ( swiper.slides.length - 2 );
            thumbnails.eq( currentSlide ).addClass('active').siblings().removeClass('active');
          });
        });



        // Reset Font Size
       var originalFontSize = $('.entry-content').css('font-size');
       $(".font-control .reset").click(function(){
         $('.entry-content').css('font-size', originalFontSize);
       });
       // Increase Font Size
       $(".font-control .increase").click(function(){
         var currentFontSize = $('.entry-content').css('font-size');
         var currentFontSizeNum = parseFloat(currentFontSize, 10);
         var newFontSize = currentFontSizeNum*1.2;
         $('.entry-content').css('font-size', newFontSize);
         return false;
       });
       // Decrease Font Size
       $(".font-control .decrease").click(function(){
         var currentFontSize = $('.entry-content').css('font-size');
         var currentFontSizeNum = parseFloat(currentFontSize, 10);
         var newFontSize = currentFontSizeNum*0.8;
         $('.entry-content').css('font-size', newFontSize);
         return false;
       });

        $("#widgets .weather .tabs a").click(function(){
          var currentTab = $(this).attr('data-id');
          $(this).parents('.weather').find('.city').removeClass('visible');
          $(this).parents('.weather').find( '.' + currentTab  ).addClass('visible');
          $(this).addClass('active').siblings().removeClass('active');
          return false;
        });

        $("#widgets .exchange .tabs a").click(function(){
          var currentTab = $(this).attr('data-id');
          $(this).parents('.exchange').find('.single-currency').removeClass('visible');
          $(this).parents('.exchange').find( '.' + currentTab  ).addClass('visible');
          $(this).addClass('active').siblings().removeClass('active');
          return false;
        });


         // show the text area and inputs title
         $('input[title],textarea').each(function() {
            if($(this).val() === '') {
              $(this).val($(this).attr('title'));
            }
            $(this).focus(function() {
               if($(this).val() === $(this).attr('title')) {
                  $(this).val('').addClass('focused');
                  $(this).parent().addClass('focused');
               }
            });
            $(this).blur(function() {
               if($(this).val() === '') {
                  $(this).val($(this).attr('title')).removeClass('focused');
                  $(this).parent().removeClass('focused');
               }
            });
         });

        $('.scroll-to').click(function(){
          var divID = $(this).attr('data-target');
          $("html, body").animate({ scrollTop:$('#' + divID ).position().top }, "slow");
          return false;
        });
        $('#world-now .left').click(function(){
           tickprev();
           clearInterval(interval1);
           interval1  = setInterval(function(){ ticknext () }, 5000);
           return false;
        });

        $('#world-now .right').click(function(){
           ticknext();
           clearInterval(interval1);
           interval1  = setInterval(function(){ ticknext () }, 5000);
           return false;
        });

        function tickprev(){
          $('#world-now .news a:last').hide().prependTo($('#world-now .news')).slideDown();
        }
        function ticknext(){
          $('#world-now .news a:first').slideUp( function () { $(this).appendTo($('#world-now .news')).show(); });
        }
        interval1  = setInterval(function(){ ticknext () }, 5000);


});
