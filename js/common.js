// JavaScript Document
$(function(){
			//sript for custom fom elments
			$('.custom-form').jqTransform({imgPath:'../images/'});
		});
		
		(function($){
			$(window).load(function(){
				$("#content_1").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				});
			});
		})(jQuery);