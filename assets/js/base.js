jQuery(document).ready(function($) {
	"use strict";

	/* Superfish
	==============================*/
	$("ul.sf-menu").superfish();

	/* Gallery PrettyPhoto
	==============================*/
		$(".gallery a").prettyPhoto();

	/* Mobile Menu
	==============================*/

	$(".main-mobile-menu .show-menu").click(function(){
		$(this).parent().find(".mobile-main-menu").slideToggle();
		return false;
	});

	var _curMenu = $(".main-mobile-menu .current-menu-item > a").html();
	$(".main-mobile-menu .placeholder").html(_curMenu);

	$(".top-mobile-menu .show-menu").click(function(){
		$(this).parent().find(".mobile-top-menu").slideToggle();
		return false;
	});

	/* Floating Menu
	==============================*/
	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			if($("#wpadminbar").length > 0 ){
				$(".main-menu.floating-menu").addClass("float-admin");
			}
			$(".main-menu.floating-menu").addClass("float");
		} else {
			if($("#wpadminbar").length > 0 ){
				$(".main-menu.floating-menu").removeClass("float-admin");
			}
			$(".main-menu.floating-menu").removeClass("float");
		}
	});

	/* Tooltip
	=============================*/
	$("ul.social-menu a, .author-block a").tooltip({placement:'bottom'});
	$(".flickr_badge_image a img, .post-author-info .author-name a, .post-thumb a").tooltip({placement:'top'});

	/* Tab
	=============================*/
	$('.bt-tab').each(function(){
		$(this).find('.nav a:first').tab('show');
	});
	$('.bt-tab .nav a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	/* Accordion
	=============================*/
	$('.collapse').on("show", function(){
		$(this).siblings().find(".accordion-toggle").addClass("active-accordion");
	});

	$('.collapse').on("hide", function(){
		$(this).siblings().find(".accordion-toggle").removeClass("active-accordion");
	});


	/* Slider and Carousel
	=============================*/
	$(window).load(function(){
		$('.carousel').flexslider({
			animation: "slide",
			itemWidth: 265,
			itemMargin: 20,
			controlNav: false,
			slideshow: false,
			minItems: 1,
			maxItems: 4,
			move: 1
		});

		$('.slider').flexslider({
			animation: "slide",
			directionNav: false,
			animationLoop: true,
			slideshow: false,
			smoothHeight: true,
			slideshowSpeed: 7000,
			animationSpeed: 600
		});

		$(".featured-image-slider").flexslider({
			animation: "slide",
			controlNav: false
		});
	});

	/* Widget Title
	=============================*/
	/*var elements = $(".widget-title span");
		for (var i=0; i<elements.length; i++){
			elements[i].innerHTML = elements[i].innerHTML.replace(/(\w+)/, "<span class='first-word'>$1</span>")
	} */


	/* Tag Cloud
	============================*/
	$(".tagcloud a, .post-single .post-tags a").prepend("<i class='icon-tag'></i>");
	$("#respond h3#reply-title").prepend("<i class='icon-plus-sign-alt'></i> ");

	/* Widget List
	============================*/
	$(".widget_recent_entries li, .widget_pages li, .widget_archive li").prepend("<i class='icon-file-alt'></i> ");
	$(".widget_recent_comments li").prepend("<i class='icon-comment'></i> ");
	$(".widget_meta li").prepend("<i class='icon-hand-up'></i> ");		

	/* News Ticker
	===========================*/
	if ($("#js-news").length > 0) { // Since v1.0.2 
		$('#js-news').ticker({
			ajaxFeed: false,	// Populate jQuery News Ticker via a feed
			feedUrl: false,		// The URL of the feed
			feedType: 'xml',	// Currently only XML
			htmlFeed: true,		// Populate jQuery News Ticker via HTML
			debugMode: false,	// Show some helpful errors in the console or as alerts
			controls: false,
			titleText: '',		// To remove the title set this to an empty String
			displayType: 'fade',	// Animation type - current options are 'reveal' or 'fade'
			direction: 'ltr',		// Ticker direction - current options are 'ltr' or 'rtl'
			pauseOnItems: 3000,		// The pause on a news item before being replaced
			fadeInSpeed: 600,		// Speed of fade in animation
			fadeOutSpeed: 300		// Speed of fade out animation
		});	
	}
});