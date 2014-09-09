jQuery(function(){

	$('.bbpl_button').click(function(e){
		e.preventDefault();
		if($(this).hasClass('liked')) return false;

		$(this).addClass('like-loading');
		var data = {
			action: 'like_this',
			user_id: $(this).data('user'),
			post_id: $(this).data('post')
		}

		var button = $(this),parent = button.parent('.bbpl_button_wrapper').parent('.bbpl_wrapper'),other_button=parent.children('.bbpul_button_wrapper').children('.bbpul_button');

		$.post(ajaxurl, data, function(response){
						 console.debug(response);
			if(response.substr(0, 1) != '!') {
				button.removeClass('like-loading');
				if(other_button.hasClass('liked')){
					other_button.removeClass('liked');
				}else{
					button.addClass('liked');
				}
				var likes_number =parent.children('.bbpl_number');
				if(likes_number) {
					likes_number.text('(' + response + ')');
				}
			}
		});

	});

	$('.bbpul_button').click(function(e){
		e.preventDefault();
		if($(this).hasClass('liked')) return false;

		$(this).addClass('like-loading');
		var data = {
			action: 'unlike_this',
			user_id: $(this).data('user'),
			post_id: $(this).data('post')
		}

		var button = $(this),parent = button.parent('.bbpul_button_wrapper').parent('.bbpl_wrapper'),other_button=parent.children('.bbpl_button_wrapper').children('.bbpl_button');

		$.post(ajaxurl, data, function(response){
						console.debug(response);
			if(response.substr(0, 1) != '!') {
				button.removeClass('like-loading');
				if(other_button.hasClass('liked')){
					other_button.removeClass('liked');
				}else{
					button.addClass('liked');
				}
				var likes_number = parent.children('.bbpl_number');
				if(likes_number) {
					likes_number.text('(' + response + ')');
				}
			}
		});

	});

	$("span.who_liked[title]").tooltip({
		position: 'center right'
	});

});