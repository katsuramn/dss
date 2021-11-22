
////////////////////////////////////////////
// scroll
////////////////////////////////////////////
$(function() {
	$('a[href^="#"]').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length && target;
			var windowSize = $(window).width();
			if (target.length && windowSize > 640) {
				var sclpos = 0; //headerの高さいれる
				var targetOffset = target.offset().top - sclpos;
				$('html,body').animate({scrollTop: targetOffset},1000,"easieEaseInOutExpo");
			}
			else if ( windowSize < 640 ) {
				var sclpos = 70; //headerの高さいれる
				var targetOffset = target.offset().top - sclpos;
				$('html,body').animate({scrollTop: targetOffset},1000,"easieEaseInOutExpo");
			}
		}
	});
});


////////////////////////////////////////////
// menu
////////////////////////////////////////////

$(function(){
    var agent = navigator.userAgent;
    if(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1)
    {
		$(function(){
			$('#open_modal,.close_modal').click(function(){

/* 				var document.getElementById("wrapper").scrollTop = scrollHeight; */
				var scrollCount = $(window).scrollTop();
				var scrollClass = 'a' + scrollCount;
/* 				var scrollNegative = -1 * $(window).scrollTop(); */

				$('#open_modal,#navigation,#mask').fadeToggle(300);
/* 				$('#wrapper').css('top',scrollNegative); */
				$('#wrapper').toggleClass('fixed');

				if($('#wrapper').hasClass('fixed'))
				{
/* 					$('#siteid .logo').css('position','absolute'); */
					$('#open_modal').addClass(scrollClass);
				}
				else
				{
					var scrollGet = $('#open_modal').attr('class');
					var scrollTo = scrollGet.substr(1);

/* 					$('#siteid .logo').css('position','fixed'); */
					$('#open_modal').removeClass(scrollGet);
				}
				
				window.scrollTo(0,scrollTo);
				
				$('#open_nav').addClass(scrollCount);
				return false;
			});
		});
    }
    else{ $('#open_modal').css('display','none'); }
});