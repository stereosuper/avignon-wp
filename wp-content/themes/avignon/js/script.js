///////////////
// variables //
///////////////

var burger = $("#hamburger-menu"), 
	nav = $("nav"), 
	body = $("body"), 
	htmlTag = $("html"),
	header = $("header"), 
	mask = $("#mask"),
	txtMenu = burger.find('.txt-menu'),
	blocTop = $('#bloc-top'),
	blocTxtHome = $("#bloc-txt-home"),
	blocTopHeight = blocTop.height(),
	headerHeight = header.innerHeight(),
	arianne = $('[data-scroll="arianne"'),
	secondMenu = $('[data-scroll="submenu"'),
	myScroll;


window.requestAnimFrame = (function(){
	return  window.requestAnimationFrame   || 
			window.webkitRequestAnimationFrame || 
			window.mozRequestAnimationFrame    || 
			window.oRequestAnimationFrame      || 
			window.msRequestAnimationFrame     || 
			function(callback){ window.setTimeout(callback, 1000/60); };
})();

/*filterInt = function(value){
	value.replace('px','');
  	if(/^(\-|\+)?([0-9]+|Infinity)$/.test(value)) 
  		return Number(value);
  	return 0;
}*/



function fixedElements(){
	if(body.width() > 767){

		if(myScroll > blocTopHeight - headerHeight){

			header.addClass('scrolled');
			if(arianne.length) arianne.addClass('fixed');
			if(secondMenu.length && body.width() > 979) secondMenu.addClass('fixed');

		}else{

			header.removeClass('scrolled');
			if(arianne.length) arianne.removeClass('fixed');
			if(secondMenu.length) secondMenu.removeClass('fixed');

		}

	}else{

		if(myScroll > 50){

			header.addClass('scrolled');
			if(arianne.length) arianne.addClass('fixed');

		}else{

			header.removeClass('scrolled');
			if(arianne.length) arianne.removeClass('fixed');

		} 
	}

	if(body.width() <= 979 && secondMenu.length){
		secondMenu.removeClass('fixed');
	}
}

function parallax(){
	$('#bg-top').css('top', myScroll/10 - 100 + 'px');
}

function scrollPage(){
	myScroll = $(document).scrollTop();

	fixedElements();

	if($('#bg-top').length)
		parallax();

	requestAnimFrame(scrollPage);
}


function openCloseMenu(){
	if(nav.hasClass("open")){
		TweenMax.set(burger, {className:"-=on"});
		TweenMax.set(nav, {className:"-=open"});
		TweenMax.set(body, {className:"-=pushed"});
		TweenMax.set(header, {className:"-=pushed"});
		TweenMax.to(mask, 0.3, {display: "none", opacity: "0", ease:Cubic.easeInOut});
		txtMenu.html('Menu');
	}else{
		TweenMax.set(burger, {className:"+=on"});
		TweenMax.set(nav, {className:"+=open"});
		TweenMax.set(body, {className:"+=pushed"});
		TweenMax.set(header, {className:"+=pushed"});
		TweenMax.to(mask, 0.3, {display: "block", opacity: "1", ease:Cubic.easeInOut});
		txtMenu.html('Close');
	}
}



$(function(){

	/* GENERAL */

		isMobile.any ? htmlTag.addClass('mobile') : htmlTag.addClass('no-mobile');

		$(".imgLiquidFill").imgLiquid();

		scrollPage();

		burger.on("click", function(e){
			openCloseMenu();
			e.preventDefault();
		});

		mask.on("click", function(e){
			openCloseMenu();
			e.preventDefault();
		});


	/* HOME */

		$("#btn-study").click(function(e) {
			$("html, body").animate({ scrollTop: $("#zone-left-study").offset().top-headerHeight}, 500);
			e.preventDefault();
		}).hover(
			function(){
				blocTxtHome.addClass("hover-btn-study");
			}, function(){
				blocTxtHome.removeClass("hover-btn-study");
			}
		);

		$("#btn-live").click(function(e){
			$("html, body").animate({ scrollTop: $("#live-top").offset().top-headerHeight}, 500);
			e.preventDefault();
		}).hover(
			function(){
				blocTxtHome.addClass("hover-btn-live");
			}, function(){
				blocTxtHome.removeClass("hover-btn-live");
			}
		);


	/* SOUS PAGES */

		/*if($('.gf_page_steps').length){
			$('.gf_page_steps').wrap('<div id="wrapSteps"></div>');
		}*/

		$('[data-click="back"]').on('click', function(e){
			e.preventDefault();
			history.back();
		});

});

$(window).load(function(){ 

	/* HOME */

		if(body.hasClass('home')){
			var blocLogoHome = $("#bloc-logo-home"),
				tw1 = TweenMax.to(blocLogoHome, 0.6, {opacity: "1", y: "20px", z: "1px"}),
				tw2 = TweenMax.to(blocLogoHome, 1.2, {y: "-20px", z: "1px"}),
				tw3 = TweenMax.to(blocLogoHome, 0.4, {opacity: "0", y: "-100px", z: "1px"}),
				tlBlocTop = new TimelineMax({ease:Quad.easeInOut}).add(tw1).add(tw2).add(tw3);

			tlBlocTop.to([blocTxtHome, $("#logo-institut-avignon")], 0.2, {opacity: "1", y: "0px", z: "1px", ease:Sine.easeOut, delay: 0.6});
		}

});


////////////
// scroll //
////////////

$(document).scroll(function() {

});

////////////
// resize //
////////////

$(window).resize(function() {

});