jQuery(document).ready(function() {

	jQuery(".comment-like a").click(function(){
		heart = jQuery(this);

		post_id = heart.data("post_id");
		comment_review = heart.data("comment_review");

    ajaxUrl = ajax_var.url;
    // if ( jQuery(this).parents('#comments-block').hasClass('mobile') ) {
    //   ajaxUrl = ajaxUrl.replace("www.", "mobile.");
    // }

		jQuery.ajax({
			type: "post",
			url: ajaxUrl,
			data: "action=post-like&nonce="+ajax_var.nonce+"&comment_review="+comment_review+"&comment_id="+post_id,
			success: function(count){
				if(count != "already")
				{
					heart.addClass("voted");
					heart.parents('.comment-like').find(".count."+comment_review).text(count);
				} else {
          var errorMessage = heart.parents('.comment-like').find('.already-reviewed').data("message");
          alert(errorMessage);
        }
			}
		});

		return false;
	});
});
