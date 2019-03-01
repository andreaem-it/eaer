//JERRO CUSTOM FUNCTIONS


/*
------------------------------------------------
PAGE LOADER
------------------------------------------------
*/
$(window).load(function() { 
	$('#preloader').fadeOut(2000);
	$('body').delay(1000).css({'overflow':'visible'});
	$('.scroll-arrow').addClass('animated fadeInUp');
})

/*
------------------------------------------------
HEADER SCROLL DOWN ARROW ICON
------------------------------------------------
*/

$(window).scroll(function(){
	var fromtop = $(document).scrollTop();       // pixels from top of screen
	$('.scroll-arrow').addClass('animated fadeOutUp'); // use a better formula for better fading
});


$(document).ready(function(){


/*
------------------------------------------------
SERVICES BOX PICTOGRAM ANIMATION
------------------------------------------------
*/


$( '.services-desc' ).hide();

$( '.services-box').hover(
	function() {
		$(this).find( '.icon-container .pictogram' ).transition({ rotate: '360deg' });
		$(this).find( '.icon-container h3' ).addClass('animated bounce');
		$(this).find( '.services-desc' ).show('slow');
	}, function() {
		$(this).find( '.icon-container .pictogram' ).transition({ rotate: '0deg' });
		$(this).find( '.icon-container h3' ).removeClass('animated bounce')
		$(this).find( '.services-desc' ).hide('slow');
	}
);


/*
------------------------------------------------
HEADER JERRO CARUSEL
http://www.owlgraphic.com/owlcarousel/
------------------------------------------------
*/
 
$('#header-carusel').owlCarousel({
 
	navigation: false,
	navigationText: ['<span class="sprite carusel-left"></span>','<span class="sprite carusel-right"></span>'],
	singleItem: true,
	slideSpeed : 1000,
	paginationSpeed : 1000,
	autoPlay: true,
	responsive:	true,
	goToFirst : true,
	goToFirstSpeed : 1000,
	baseClass : 'owl-carousel',
	theme : 'jerro-carusel-theme',
	transitionStyle: 'goDown' //fade, fadeUp, goDown
 
});


/*
------------------------------------------------
FAVORITE CARUSEL
http://www.owlgraphic.com/owlcarousel/
------------------------------------------------
*/


$('#favorite-carusel').owlCarousel({

	 // Most important owl features
	items : 4,
	itemsDesktop : [1199,3],
	itemsDesktopSmall : [970,2],
	itemsTablet: [750,1],
	itemsMobile : false,
	singleItem : false,
	 
	//Basic Speeds
	slideSpeed : 1000,
	paginationSpeed : 1000,
	 
	//Autoplay
	autoPlay : false,
	stopOnHover : false,
	goToFirst : true,
	goToFirstSpeed : 1000,
	 
	// Navigation
	navigation:true,
	navigationText : ['<span class="sprite carusel-left"></span>','<span class="sprite carusel-right"></span>'],
	goToFirstNav : true,
	scrollPerPage : false,
	 
	//Pagination
	pagination : true,
	paginationNumbers: false,
	 
	// Responsive
	responsive: true,
	responsiveRefreshRate : 200,
	 
	// CSS Styles
	baseClass : 'owl-carousel',
	theme : 'jerro-carusel-theme',
	 
});



/*
------------------------------------------------
TWITTER FEEDS
http://www.owlgraphic.com/owlcarousel/
https://github.com/sonnyt/Tweetie
------------------------------------------------
*/

$('#entries-carusel').twittie({
	dateFormat: '%b / %d / %Y',
	template: '<div class="item entry tweet"><h2 class="avatar">{{avatar}}</h2><blockquote>{{tweet}}</<blockquote><div class="date">{{date}}</div></div>',
	count: 3
});



/*
------------------------------------------------
TEXT ROTATING
https://github.com/peachananr/simple-text-rotator
------------------------------------------------
*/
$('.rotate-flipCube').textrotator({
  animation: 'flipCube', // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
  separator: ':', // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
  speed: 2000 // How many milliseconds until the next word show.
});

$('.rotate-flip').textrotator({
  animation: 'flip',
  separator: ':',
  speed: 2000
});

$('.rotate-flipUp').textrotator({
  animation: 'flipUp',
  separator: ':',
  speed: 2000
});

$('.rotate-flipCubeUp').textrotator({
  animation: 'flipCubeUp',
  separator: ':',
  speed: 2000
});

$('.rotate-spin').textrotator({
  animation: 'spin',
  separator: ':',
  speed: 2000
});

$('.rotate-fade').textrotator({
  animation: 'fade',
  separator: ':',
  speed: 2000
});


/*
------------------------------------------------
SKILLS CHARTS
http://anthonyterrien.com/knob/
------------------------------------------------
*/


$('.skill').each(function () {

	var $this = $(this);
	var myVal = $this.attr("rel");
	// alert(myVal);
	$this.knob({
		'draw' : function () { 
			$(this.i).val(this.cv + '%')
		},
		'fontWeight': '300',
		'readOnly' : true,
		'font' : 'Dosis',
		'linecap' : 'round',
		'inputColor' : '#4d4d4d',
		'fgColor' : '#AECA2E',
		'width' : '150',
		'height' : '150',
		'cursor' : false,
		'thickness' : .1
   });



   $({
	   value: 0
   }).animate({

	   value: myVal
   }, {
	   duration: 2000,
	   easing: 'swing',
	   step: function () {
		   $this.val(Math.ceil(this.value)).trigger('change');

	   }
   })

});


/*
------------------------------------------------
NIVO LIGHTBOX - FAVORITES AND PORTFOLIO
http://dev7studios.com/nivo-lightbox
------------------------------------------------
*/

$('#favorite-carusel a, #portfolio-grid-1 a').nivoLightbox({
	effect: 'fall', // The effect to use when showing the lightbox (fade, fadeScale, slideLeft, slideRight, slideUp, slideDown, fall
	theme: 'jerro', // The lightbox theme to use
	keyboardNav: true, // Enable/Disable keyboard navigation (left/right/escape)
	onInit: function(){}, // Callback when lightbox has loaded
	beforeShowLightbox: function(){}, // Callback before the lightbox is shown
	afterShowLightbox: function(lightbox){}, // Callback after the lightbox is shown
	beforeHideLightbox: function(){}, // Callback before the lightbox is hidden
	afterHideLightbox: function(){}, // Callback after the lightbox is hidden
	onPrev: function(element){}, // Callback when the lightbox gallery goes to previous item
	onNext: function(element){}, // Callback when the lightbox gallery goes to next item
	errorMessage: 'The requested content cannot be loaded. Please try again later.' // Error message when content can't be loaded
});


/*
------------------------------------------------
QUICK POST HOVER ANIMATION
------------------------------------------------
*/


$( '.quick-post .img').hover(
	function() {
		$(this).find( 'img' ).addClass('animated rotateOutDownLeft');
	}, function() {
		$(this).find( 'img' ).removeClass('animated rotateOutDownLeft');
	}
);



/*
------------------------------------------------
SINGLE POST - WINDOW
------------------------------------------------
*/

// sets min-height of single-post window
$('.single-post').css("min-height", ($( window ).height()-60));


/*
------------------------------------------------
PORTFOLIO MIXITUP
http://mixitup.io/
------------------------------------------------
*/

$('#portfolio-grid-1').mixitup({
	targetSelector: '.mix-1',
	filterSelector: '.filter-1',
	sortSelector: '.sort-1',
	buttonEvent: 'click',
	effects: ['fade'],
	listEffects: null,
	easing: 'smooth',
	layoutMode: 'grid',
	targetDisplayGrid: 'inline-block',
	targetDisplayList: 'block',
	gridClass: '',
	listClass: '',
	transitionSpeed: 600,
	showOnLoad: 'all',
	sortOnLoad: false,
	multiFilter: false,
	filterLogic: 'or',
	resizeContainer: true,
	minHeight: 0,
	failClass: 'fail',
	perspectiveDistance: '3000',
	perspectiveOrigin: '50% 50%',
	animateGridList: true,
	onMixLoad: null,
	onMixStart: null,
	onMixEnd: null
});


$('#portfolio-grid-2').mixitup({
	targetSelector: '.mix-2',
	filterSelector: '.filter-2',
	sortSelector: '.sort-2',
	buttonEvent: 'click',
	effects: ['fade'],
	listEffects: null,
	easing: 'smooth',
	layoutMode: 'grid',
	targetDisplayGrid: 'inline-block',
	targetDisplayList: 'block',
	gridClass: '',
	listClass: '',
	transitionSpeed: 600,
	showOnLoad: 'all',
	sortOnLoad: false,
	multiFilter: false,
	filterLogic: 'or',
	resizeContainer: true,
	minHeight: 0,
	failClass: 'fail',
	perspectiveDistance: '3000',
	perspectiveOrigin: '50% 50%',
	animateGridList: true,
	onMixLoad: null,
	onMixStart: null,
	onMixEnd: null
});

$('#portfolio-grid-2').jerroZoom();

/*
------------------------------------------------
GMAP 3
http://gmap3.net/
------------------------------------------------
*/


//MAP NAVIGATION
$('.address-button').click(function () {
	var lat = $(this).data('lat'),
		lng = $(this).data('lng');
	$('#jerro-map-canvas').gmap3('get').panTo(new google.maps.LatLng(lat, lng));
	$('.map-navigation').find('.address-button').removeClass('active');
	$(this).addClass('active');
});



//MAP
var startPosition = new google.maps.LatLng(-37.818777,144.963225);

$('#jerro-map-canvas').gmap3({
	map: {
		options: {
			center: startPosition,
			zoom: 16,
			scrollwheel: false,
		}
	},
	marker: {
		values: [{
					latLng: [-37.8182,144.964984],
					options: {  icon: 'images/marker_2.png' },
					data:'Here is my workshop'
				}, {
					latLng: [-37.81887,144.95874],
					options: {  icon: 'images/marker_1.png' },
					data:'Here is my office'
				}, {
					latLng: [-37.819718,144.972119],
					options: {  icon: 'images/marker_3.png' },
					data:'Here you can relax and find inspiration'
				}],
		options: {
			draggable: false,
		},
		events:{
			mouseover: function(marker, event, context){
			var map = $(this).gmap3("get"),
			infowindow = $(this).gmap3({get:{name:"infowindow"}});
				if (infowindow){
					infowindow.open(map, marker);
					infowindow.setContent(context.data);
				} else {
					$(this).gmap3({
					infowindow:{
					anchor:marker,
					options:{content: context.data}
					}
					});
				}
			},
			mouseout: function(){
			var infowindow = $(this).gmap3({get:{name:"infowindow"}});
				if (infowindow){
					infowindow.close();
				}
			}
		}
	}
});

/*
------------------------------------------------
TOOLTIPS - BOOTSTRAP
------------------------------------------------
*/

$('.title a').tooltip();



/*
------------------------------------------------
STICKY MENU (FIXED)
http://stickyjs.com/
------------------------------------------------
*/

$('#main-navigation').sticky({ topSpacing: 0 });


/*
------------------------------------------------
SMOOTH SCROLLING - SCROLL TO SOMETHING
------------------------------------------------
*/

$('#main-menu a[href^="#"], .contact-button a, .scroll-arrow a').click(function(event) {
	var id = $(this).attr("href");
	var offset = 50;
	var target = $(id).offset().top - offset;
	$('html, body').animate({scrollTop:target}, 1500, 'easeInOutQuart');
	event.preventDefault();
});


/*
------------------------------------------------
CONTACT FORM
------------------------------------------------
*/

$('#send_message').click(function(e){
			
	//stop the form from being submitted
	e.preventDefault();
	
	/* declare the variables, var error is the variable that we use on the end
	to determine if there was an error or not */
	var error = false;
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var email = $('#email').val();
	var subject = $('#subject').val();
	var message = $('#message').val();
	
	/* in the next section we do the checking by using VARIABLE.length
	where VARIABLE is the variable we are checking (like name, email),
	length is a javascript function to get the number of characters.
	And as you can see if the num of characters is 0 we set the error
	variable to true and show the name_error div with the fadeIn effect. 
	if it's not 0 then we fadeOut the div( that's if the div is shown and
	the error is fixed it fadesOut. 
	
	The only difference from these checks is the email checking, we have
	email.indexOf('@') which checks if there is @ in the email input field.
	This javascript function will return -1 if no occurence have been found.*/
	if(fname.length == 0){
		var error = true;
		$('#formFirstName').removeClass('success').fadeOut(500);
		$('#formFirstName').addClass('error').fadeIn(500);
	}else{
		$('#formFirstName').removeClass('error').fadeOut(500);
		$('#formFirstName').addClass('success').fadeIn(500);
	}
	if(lname.length == 0){
		var error = true;
		$('#formLastName').removeClass('success').fadeOut(500);
		$('#formLastName').addClass('error').fadeIn(500);
	}else{
		$('#formLastName').removeClass('error').fadeOut(500);
		$('#formLastName').addClass('success').fadeIn(500);
	}
	if(email.length == 0 || email.indexOf('@') == '-1'){
		var error = true;
		$('#formEmail').removeClass('success').fadeOut(500);
		$('#formEmail').addClass('error').fadeIn(500);
	}else{
		$('#formEmail').removeClass('error').fadeOut(500);
		$('#formEmail').addClass('success').fadeIn(500);
	}
	if(subject.length == 0){
		var error = true;
		$('#formSubject').removeClass('success').fadeOut(500);
		$('#formSubject').addClass('error').fadeIn(500);
	}else{
		$('#formSubject').removeClass('error').fadeOut(500);
		$('#formSubject').addClass('success').fadeIn(500);
	}
	if(message.length == 0){
		var error = true;
		$('#formMessage').removeClass('success').fadeOut(500);
		$('#formMessage').addClass('error').fadeIn(500);
	}else{
		$('#formMessage').removeClass('error').fadeOut(500);
		$('#formMessage').addClass('success').fadeIn(500);
	}
	
	//now when the validation is done we check if the error variable is false (no errors)
	if(error == false){
		ohSnap('Contact form is correct. Now sending message...', 'success');
		//disable the submit button to avoid spamming
		//and change the button text to Sending...
		$('#send_message').attr({'disabled' : 'true', 'value' : 'Sending...' });
		
		/* using the jquery's post(ajax) function and a lifesaver
		function serialize() which gets all the data from the form
		we submit it to send_email.php */
		$.post("modules/send_email.php", $("#contact_form").serialize(),function(result){
			//and after the ajax request ends we check the text returned
			if(result == 'sent'){
				//if the mail is sent remove the submit paragraph
				 $('#cf_submit_p').remove();
				//and show the mail success div with fadeIn
				$('#mail_success').fadeIn(500);
				$('#contact_form').fadeOut(500);
			}else{
				//show the mail failed div
				$('#mail_fail').fadeIn(500);
				//reenable the submit button by removing attribute disabled and change the text back to Send The Message
				$('#send_message').removeAttr('disabled').attr('value', 'Send The Message');
			}
		});
	}else{
		ohSnap('Please complete the form correctly!', 'danger');
	}
});


/*
------------------------------------------------
FOOTER FLICKR
http://www.gethifi.com/blog/a-jquery-flickr-feed-plugin
------------------------------------------------
*/

$('.flickr-grid').jflickrfeed({
	limit: 6,
	qstrings: {
		id: '48681156@N03' //GET USER ID http://idgettr.com/
	},
	itemTemplate: '<li class="flickr"><a href="{{image}}" data-toggle="tooltip" data-placement="bottom" title="{{title}}"><img src="{{image_s}}"/></a></li>'
}, function(data) {
	$('.flickr a').tooltip();
});



/*
------------------------------------------------
FOOTER SOCIAL ICONS HOVER EFFECT
------------------------------------------------
*/


$( '.social ul li').hover(
	function() {
		$(this).addClass('animated wobble');
	}, function() {
		$(this).removeClass('animated wobble');
	}
);



/*
------------------------------------------------
SCROLL TO TOP BUTTON
------------------------------------------------
*/


// hide #back-top first
$("#back-top").hide();

// fade in #back-top
$(function () {
	$(window).scroll(function () {
		if ($(this).scrollTop() > 500) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#back-top').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 1500);
		return false;
	});
});


});     




/*
------------------------------------------------
BEGIN - Run Only After Entire Page Has Loaded
------------------------------------------------
*/
$(window).bind("load", function() {


/*
------------------------------------------------
VIDEO
https://github.com/pupunzi/jquery.mb.YTPlayer

!!! UNCOMMENT BELOW LINES IF YOU WANT TO USE VIDEO HEADER
------------------------------------------------
*/

/*
//Video Player
$('.player').mb_YTPlayer({

	videoURL:'7VsUkQK9skk',
	containment:'#parallax-bg-1',
	autoPlay:true,
	mute:false,
	repeat:true,
	startAt:0,
	opacity:1,
	increaseVolumeBy: 10, // increment value; volume range is 1-100
	showControls:true	
});


//Video Controls
$( '.parallax-board').hover(
	function() {
		$(this).find( '.video-controls' ).removeClass('animated fadeOutDown');
		$(this).find( '.video-controls' ).addClass('animated fadeInUp');
	}, function() {
		$(this).find( '.video-controls' ).removeClass('animated fadeInUp');
		$(this).find( '.video-controls' ).addClass('animated fadeOutDown');
	}
);
*/



/*
------------------------------------------------
PEOPLE SAY / TWITTER CARUSEL
http://www.owlgraphic.com/owlcarousel/
------------------------------------------------
*/

	
$('#entries-carusel').owlCarousel({

	 // Most important owl features
	items : 1,
	singleItem : true,
	 
	//Basic Speeds
	slideSpeed : 1000,
	paginationSpeed : 1000,
	 
	//Autoplay
	autoPlay : true,
	stopOnHover : true,
	goToFirst : true,
	goToFirstSpeed : 1000,
	 
	// Navigation
	navigation:false,
	navigationText : ['<span class="sprite carusel-left"></span>','<span class="sprite carusel-right"></span>'],
	goToFirstNav : true,
	scrollPerPage : false,
	 
	//Pagination
	pagination : true,
	paginationNumbers: false,
	 
	// Responsive
	responsive: true,
	 
	// CSS Styles
	baseClass : "owl-carousel",
	theme : "jerro-carusel-theme",
	 
	//Auto height
	autoHeight : true,


});



/*
------------------------------------------------
SMOOTH SCROLLING
------------------------------------------------
*/

setMenuOffset();

function setMenuOffset(){

	var windowHeight = $( window ).height();// returns height of HTML document
	var headerHeight = $('#header').height();// returns height of #header
	var mainNavOffset = windowHeight-headerHeight;
	$('#parallax-bg-1').css("height", mainNavOffset);// sets new height of #parallax-bg-1
}


//When resizing browser window
$( window ).resize(function() {
	setMenuOffset();
});


$('body').scrollspy({ target: '#main-navigation', offset: 60 });//activate scrollspy 

});

/*
------------------------------------------------
END - Run Only After Entire Page Has Loaded
------------------------------------------------
*/
