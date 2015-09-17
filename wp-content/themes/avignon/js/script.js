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
	arianne = $('[data-scroll="arianne"]'),
	secondMenu = $('[data-scroll="submenu"]'),
	main = $('[data-scroll="submenu"] + .main'),
	myScroll,
	scrollMenu = false;


window.requestAnimFrame = (function(){
	return  window.requestAnimationFrame   || 
			window.webkitRequestAnimationFrame || 
			window.mozRequestAnimationFrame    || 
			window.oRequestAnimationFrame      || 
			window.msRequestAnimationFrame     || 
			function(callback){ window.setTimeout(callback, 1000/60); };
})();

filterInt = function(value){
  if(/^(\-|\+)?([0-9]+|Infinity)$/.test(value)) return Number(value);
  return 0;
}



function fixedElements(){
	var secondMenuHeight = secondMenu.height() + 70, 
		mainHeight = main.height(), 
		bodyWidth = body.width();

	if(bodyWidth > 767){

		if(myScroll > blocTopHeight - headerHeight){
			header.addClass('scrolled');

			if(!htmlTag.hasClass('lt-ie9')){
				if(arianne.length && (mainHeight > secondMenuHeight || bodyWidth < 979)) arianne.addClass('fixed');
				if(secondMenu.length && bodyWidth > 979 && mainHeight > secondMenuHeight) secondMenu.addClass('fixed');
			}
		}else{
			if(!scrollMenu) header.removeClass('scrolled');

			if(!htmlTag.hasClass('lt-ie9')){
				if(arianne.length) arianne.removeClass('fixed');
				if(secondMenu.length) secondMenu.removeClass('fixed');	
			}
		}

	}else{

		if(myScroll > 50){
			header.addClass('scrolled');
			if(arianne.length && mainHeight > secondMenuHeight && !htmlTag.hasClass('lt-ie9')) arianne.addClass('fixed');
		}else{
			if(!scrollMenu) header.removeClass('scrolled');
			if(arianne.length && !htmlTag.hasClass('lt-ie9')) arianne.removeClass('fixed');
		} 
	}

	if(bodyWidth <= 979 && secondMenu.length && !htmlTag.hasClass('lt-ie9')){
		secondMenu.removeClass('fixed');
	}
}

function parallax(){
	$('#bg-top').css('top', myScroll/10 - 100 + 'px');
	if(blocTop.find('.college').length) blocTop.find('.college').find('img').css('opacity', 1-myScroll/150);
	if($('#btn-down-study.on').length) $('#btn-down-study.on').css('opacity', 1-myScroll/150);
}

function scrollPage(){
	myScroll = $(document).scrollTop();

	if($(window).height() > 600) fixedElements();

	if($('#bg-top').length) parallax();

	requestAnimFrame(scrollPage);
}


function setScrollMenu(){
	var containers = $('html, body, #content'), 
		content = $('body').find('#content'),
		wrapper = $('#wrapper'),
		scrollTopW = $(window).scrollTop();

	function bodyVisible(){
		containers.css('height', 'auto');
		content.css('overflow', 'auto');
		nav.css('overflow', 'hidden');
	}

	if($(window).height() <= $('#menu-main').height()){
		if(nav.hasClass('open')){
			scrollMenu = true;
			containers.css('height', '100%');
			wrapper.css('margin-top', '-' + scrollTopW + 'px');
			content.css('overflow', 'hidden');
			nav.css('overflow', 'auto');
		}else{
			bodyVisible();
			scrollMenu = false;
			scrollTopW = filterInt(wrapper.css('margin-top').replace('-', '').replace('px', ''));
			wrapper.css('margin-top', 0);
			$("html, body").animate({ scrollTop: scrollTopW }, 0);
		}
	}else{
		bodyVisible();
	}
}

function openCloseMenu(){
	burger.toggleClass('on');
	nav.toggleClass('open');
	body.toggleClass('pushed');
	header.toggleClass('pushed');
	nav.hasClass("open") ? txtMenu.html('Close') : txtMenu.html('Menu');

	setScrollMenu();

	mask.fadeToggle(300);
}



$(function(){

	/* GENERAL */

		isMobile.any ? htmlTag.addClass('mobile') : htmlTag.addClass('no-mobile');

		try{Typekit.load();}catch(e){}

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

		$("#btn-study").click(function(e){
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

		$('#btn-down-study').on('click', function(e){
			$("html, body").animate({ scrollTop: $("#zone-left-study").offset().top-headerHeight}, 500);
			e.preventDefault();
		});


	/* SOUS PAGES */

		$('[data-click="back"]').on('click', function(e){
			e.preventDefault();
			history.back();
		});


	/* GRAVITY */

		if($('.gf_page_steps').length){
			$('.gf_page_steps').wrap('<div id="wrapSteps"></div>');

			// remove &nbsp; in steps generated by f*cking gravity
			var i = 0, steps = $('.gf_step'), stepsLength = steps.length; 
			for(i; i<stepsLength; i++){
				steps.eq(i).html( steps.eq(i).html().replace(/&nbsp;/g,'') );
			}
		}

		if($('.browse').length){
			var browse = $('.browse'), inputFile = browse.find('input[type=file]'), img, txt = 'Browse...';
			
			if(!browse.find('#upload').length){
				if(browse.hasClass('fr')) txt = 'Parcourir...';
				browse.find('.ginput_container').append('<input type="button" value="'+txt+'" id="upload">');

				browse.prepend('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
				img = browse.find('#uploadImg');
			}
			
			browse.on('click', '#upload', function(){
				inputFile.click();
			});

			inputFile.on('change', function(e){
				browse.find('label').html( inputFile.val() );

				var i = 0;
				for(i; i < e.originalEvent.srcElement.files.length; i++) {
					var file = e.originalEvent.srcElement.files[i], 
						reader = new FileReader();

					reader.onloadend = function() {
						img.attr('src', reader.result);
					}
					reader.readAsDataURL(file);

					img.removeClass('hidden');
				}
			});
		}

});


$(window).load(function(){ 

	/* HOME */

		if(body.hasClass('home')){
			
			// Anim header
			if(!htmlTag.hasClass('lt-ie9')){
				function appearBtn(){
					$('#btn-down-study').addClass('on');
				}

				var blocLogoHome = $("#bloc-logo-home"),
					tw1 = TweenMax.to(blocLogoHome, 0.5, {opacity: "1", y: "30px", z: "1px"}),
					tw2 = TweenMax.to(blocLogoHome, 1, {y: "-20px", z: "1px"}),
					tw3 = TweenMax.to(blocLogoHome, 0.4, {opacity: "0", y: "-120px", z: "1px"}),
					tlBlocTop = new TimelineMax({ease:Quad.easeInOut}).add(tw1).add(tw2).add(tw3);

				tlBlocTop.to([blocTxtHome, $("#logo-institut-avignon")], 0.2, {opacity: "1", y: "0px", z: "1px", ease:Sine.easeOut, delay: 0.5, onComplete: appearBtn});
			}
			
			// Scroll Reveal
			window.sr = new scrollReveal( {
				easing: 'ease-in-out',
				over: '0.5s',
				move: '50px',
				scale: { direction: 'up', power: '0%' },
				reset: true,
				vFactor: '0.50',
				wait: '0.5s',
				delay: 'onload',
			} );

			// Twitter
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

			//Fb - Useless because loaded in fb comments plugin
			/*(function(d, s, id){
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "http://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=932551300139293";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));*/
			
		}

});


$(window).resize(function() {
	setScrollMenu();
});