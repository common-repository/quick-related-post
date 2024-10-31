jQuery(document).ready(function($)
	{
		$(document).on('click', '.tab-nav li', function()
			{
				$(".active").removeClass("active");
				$(this).addClass("active");
				
				var nav = $(this).attr("nav");
				console.log(nav);
				$(".options li.tab-box").css("display","none");
				$(".box"+nav).css("display","block");
		
			})
	});	