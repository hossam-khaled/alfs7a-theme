jQuery(document).ready(function($){
  //<div id="fb-root"></div>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/ar_AR/sdk.js#xfbml=1&version=v2.10";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));



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



      $('.slider-section .share').on("click",function(event){
        $(this).parents('.swiper-slide').find('.share-icons').toggle();
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

      $("#header .nav-menu li").hover(function(){
        $(this).addClass('hover').children('ul').stop(true, true).animate({'height':'show'},400);
      },function(){
        $(this).removeClass('hover').children('ul').stop(true, true).animate({'height':'hide'},200);
      });

			$("#header .nav-menu li").css({'zIndex':'10000'});

      $('.scroll-to').click(function(){
        var divID = $(this).attr('data-target');
        $("html, body").animate({ scrollTop:$('#' + divID ).position().top }, "slow");
        return false;
      });


      $('.swiper-holder .single-post').click(function(){
        var link = $(this).attr('href');;
        if (link) window.location.href = link;
      });
      $(document).find('.swiper-holder').each(function(){
        var Autoplay = 5000;
        if ( $(this).data('autoplay') == false ) {
          Autoplay = 0;
        }
        var swiper = new Swiper( $(this).find('.swiper-container') , {
            autoplayDisableOnInteraction: false,
            autoplay: Autoplay,
            // direction: "vertical",
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            loop: true
        });
        // console.log(swiper);
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



      /*
       * add default invalid method to validate plugin ,
       * this will help if user submit a form without
       * changing default value on input
       */
      $.validator.addMethod("defaultInvalid", function(value, element){
          if (element.value == element.title) {
              return false;
          }
          return true;
      });


      // scroll left to right
      // $('#world-now .news').marquee({
      //   speed: 18,
      //   gap: 5,
      //   delayBeforeStart: 0,
      //   direction: 'right',
      //   duplicated: true,
      //   pauseOnHover: true,
      //   //allowCss3Support: false
      // });

      // image gallery
      $('.images-gallery .thumbnail-image').click(function(){
          CurrentImage = $(this);
          mainImageContainer = $('.images-gallery .main-image');
          mainImageContainer.find('.loading').show();

          var imageSrc =  CurrentImage.find('img').attr('data-large');

          $('<img src="'+ imageSrc + '">').load(function(){
            mainImageContainer.find('.loading').hide();
        		var image = mainImageContainer.find('img');
            image.fadeOut('fast', function () {
                image.attr('src', imageSrc);
                image.fadeIn();
            });
        	});

      });


      $('.polls-widget .answer').click(function(){
         $(this).siblings('.answer').removeClass('active');
         $(this).addClass('active');
         return false;
      });

      $(".polls-widget .submit-button").click(function(){

        if( $('.polls-widget .answer.active').length == 0 ) {
          alert('عفوا, يجب ان تختار احدى الاجابات السابقة');
          return false;
        }

        button = $(this);
        postUrl = button.attr('data-url');
        postID = button.attr('data-post-ID');
        answerID = $('.polls-widget .answer.active').attr('data-answer-ID');

    		$.ajax({
    			type: "POST",
    			url: postUrl,
    			data: { action: "poll-vote", nonce: "ajax_var.nonce", post_ID: postID, answer_ID: answerID },
    			success: function(count){
            if(count != "already")
    				{
    					button.addClass("voted");
              var countElement = button.parents('.polls-widget').find(".total-votes-number");
    					var newCount =  parseInt( countElement.text() ) + 1  ;
              var success = button.parents('.polls-widget').find('.success').data("message");

              countElement.text( newCount ).addClass('increased');
              alert( success );

    				} else {
              var errorMessage = button.parents('.polls-widget').find('.already-reviewed').data("message");
              alert(errorMessage);
            }
    			}
    		});

    		return false;
    	});


      $( "#sidebar .polls-widget .total-n-button .total" ).on( "click", function() {
            $( "#sidebar .polls-widget .bars" ).fadeToggle(1000) ;
          });
          //search navigation
      $( "#khy-header .main-menu .search-icone" ).on( "click", function() {
        $(this).toggleClass('close');
        $( "#khy-header .main-menu .search-box" ).stop(true,true).animate({'width':'toggle'});
      });


      $( "#khy-header .search-navigation-icone .navigation-icone" ).on( "click", function() {
        // $("#khy-header .main-menu .search-icone" ).fadeToggle(500);
        $('#khy-header .main-menu').toggleClass('open-menu');
        $('.overview').fadeToggle();
        // $('#khy-header .main-menu .search-box').fadeOut(500);
        // $("#khy-header .main-menu .search-icone").removeClass('close');
      });
      $( ".overview" ).on( "click", function() {
        // $("#khy-header .main-menu .search-icone" ).fadeToggle(500);
        $('#khy-header .main-menu').toggleClass('open-menu');
        $('.overview').fadeToggle();
      });
      $( "#khy-header .main-menu .closed" ).on( "click", function() {
        $('#khy-header .main-menu').toggleClass('open-menu');
        $('.overview').fadeToggle();
      });

      $( "#khy-header .search-navigation-icone .search-icone" ).on( "click", function() {
        $('#header-navigation .search-box').stop(true,true).animate({'width':'toggle'});
      });


      /* niceScroll */
      $(".section-top.child").niceScroll({
        cursorcolor: "#313131",
        background: "#e6e6e6",
        cursorborder: "0",
        cursorborderradius :'0',
        autohidemode: false,
        cursorwidth: '12px',
        railalign:'left'
      });

      $('#khy-header .icons div').click(function(){
        var NavHeight = $(window).height() - 133;
        $( '#header-navigation' ).css({'height' : NavHeight });
        $(this).toggleClass('active').siblings().removeClass('active');
        var widgetName = $(this).attr('data-widget');
        $('#widgets .' + widgetName).stop(true,true).animate({'height':'toggle'}).siblings().stop(true,true).animate({'height':'hide'});
        return false;
      });

      // $('.single .add-comment').click(function() {
      //   $(this).toggleClass('close');
      //   $('#comments').stop(true,true).animate({'height':'toggle'});
      // })
      $( "#khy-header .header-center .search-icone" ).on( "click", function() {
        $(this).toggleClass('close');
        $( "#khy-header .header-center .search-box" ).stop(true,true).animate({'width':'toggle'});
      });
});
