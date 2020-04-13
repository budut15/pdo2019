

$(document).on('nifty.ready', function() {
    var $imgHolder 	= $('#demo-bg-list');
    var $bgBtn 		= $imgHolder.find('.demo-chg-bg');
    var $target 	= $('#bg-overlay');
    /*var $user 	= $('#username');
    var $pass 	= $('#password');

    $user.on('keyup', function(event){
		if(event.keyCode == 13){
			//MyAjaxRequest('valid_nip','include/process.php?NIP=','NIP');
			$pass.focus();
		}
	});*/
    $bgBtn.on('click', function(e){
        e.preventDefault();
        e.stopPropagation();


        var $el = $(this);
        if ($el.hasClass('active') || $imgHolder.hasClass('disabled'))return;
        if ($el.hasClass('bg-trans')) {
            $target.css('background-image','none').removeClass('bg-img');
            $imgHolder.removeClass('disabled');
            $bgBtn.removeClass('active');
            $el.addClass('active');

            return;
        }

        $imgHolder.addClass('disabled');
        var url = $el.attr('src').replace('/thumbs','');

        $('<img/>').attr('src' , url).on('load', function(){
            $target.css('background-image', 'url("' + url + '")').addClass('bg-img');
            $imgHolder.removeClass('disabled');
            $bgBtn.removeClass('active');
            $el.addClass('active');

            $(this).remove();
        })

    });



});
