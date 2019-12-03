$(document).ready(function(){
	'use strict';
	var swiper;
	if( $(".swiper-container").length ){
		swiper = new Swiper('.swiper-container',{
			effect: "slide",
			loop: true,
			navigation:{ nextEl: ".slide_next_btn", prevEl: ".slide_prev_btn" },
			autoplay: { delay: 3000 },
			on:{ slideChange: function(){
				$(".main_visual").removeClass("bounce");
				setTimeout(function() { 
						$(".main_visual").addClass("bounce")  }, 200); }
			},
		});

	}


	/* snb */
	$(".snb_btn").on("click",function(){
		$(".snb").fadeIn(100);
		$(".snb_wrap").addClass("on");
	});
	$(".snb_close").on("click",function(){
		$(".snb").fadeOut(100);
		$(".snb_wrap").removeClass("on")
	});
	$(".like_btn").on("click",function(){
		if( $(this).hasClass("on")){
			$(this).removeClass("on")

		}else{
			$(this).addClass("on")
		}
	});
	/* 팝업 */
	$(".pop_call").on("click",function(){
		var name = $(this).attr("data-pop");
		$(".popup."+name).fadeIn();
		$(".mask").fadeIn(); 	
		$("html").addClass("scroll_no");
		$(".snb").removeClass("snb_on");
		swiper.update();
	});
	$(".pop_close").on("click",function(){
		$(".popup").fadeOut();
		$("html").removeClass("scroll_no");
	});
	/* 회원정보수정 태그 */
	$(".tag_arrow").on("click",function(){
		$(this).toggleClass("open")
		$(".tag_type").slideToggle();
	});
	$(".tab_menu button").on("click",function(){
		$(".tab_menu button").removeClass("on");
		$(this).addClass("on");
		var idx = $(this).index();
		$(this).parent().next(".tab_con").children("div").hide().eq(idx).fadeIn();
	});
	/* 아코디언콘텐츠 - 공지사항, 문의 */
	$(".slide_top").on("click",function(){
		/*
		if( $(this).closest(".del_body").length){
			return false;
		}else{			
			$(this).toggleClass("on");
			$(this).next().slideToggle();
		}
		*/
	});
	/* 글쓰기 이미지삭제 */
	$(".img_del").on("click",function(){
		$(this).parent(".added_img").remove();
	});
	/* 임시보관함 */
	$(".temp_pop .revise_btn").on("click",function(){
		$(".temp_pop .pop_body").toggleClass("del_body");
		$(".pop_body .slide_top").removeClass("on");
		$(".pop_body .slide_bot").slideUp();
	});
	$(".temp_pop .temp_del_btn").on("click",function(){
		$(this).closest("li").fadeOut(500, function(){
			$(this).remove();
		});
	});
	/* 검색 */
	$(".sc_option .option_btn").on("click",function(){
		$(".sc_option").toggleClass("on");
	});
});


