/*
======================================
JERRO CIRCLE GRID
======================================
*/

//Quick settings----------------------

var animation = "on";
var hover = "on";

//------------------------------------



//assign ID's to elements
$('.jerro-circle').each(function(i){
		$(this).attr('id', 'jc_'+(i+1));
});


//assign elements ID's to array
var myElements = $('.jerro-circle').map(function () { 
	return this.id;
}).get();

//hide all back-content elements
$( '.jerro-circle' ).find( '.back-content' ).transition({ opacity: 0 });


if(animation == "on"){
	setInterval(jerroCircleAnimation,6000);//main time interval
}

function jerroCircleAnimation(){

	var randomID = getID();//get random id

	newState();//firing newState function

	setTimeout(function() {//delayed firing baseState function
		baseState();
		removeClasses();
	}, 3000);

	function newState(){ //go to the new state function
		$('#'+randomID+' .back-content').removeClass('animated rotateOutDownLeft');// remove classes
		$('#'+randomID+' .front-content').removeClass('animated rotateInUpLeft');// remove classes

		$('#'+randomID+' .back-content').addClass('animated rotateInUpLeft');// show back-content
		$('#'+randomID+' .front-content').addClass('animated rotateOutDownLeft');// hide front-content
		$('#'+randomID).addClass(' now-used');
		//console.log(randomID+' = 1');
	}

	function baseState(){ //return to the base state function
		$('#'+randomID+' .back-content').removeClass('animated rotateInUpLeft');//  remove classes
		$('#'+randomID+' .front-content').removeClass('animated rotateOutDownLeft');//  remove classes

		$('#'+randomID+' .back-content').addClass('animated rotateOutDownLeft');// hide back-content
		$('#'+randomID+' .front-content').addClass('animated rotateInUpLeft');// show fron-content
		//console.log(randomID+' = 0');
	}

	function removeClasses(){
		
		setTimeout(function() {//delayed firing baseState function
		
		$('#'+randomID+' .back-content').removeClass('animated rotateOutDownLeft');// remove classes
		$('#'+randomID+' .front-content').removeClass('animated rotateInUpLeft');// remove classes
		$('#'+randomID).removeClass( 'now-used');
		}, 3000);
	}

	function getID(){//get random id from "myElements" array

		var random = myElements[Math.floor(Math.random()*myElements.length)]
		return random;
	}

}



//toggle on hover
if(hover == "on"){

	$( '.jerro-circle' ).hover(

		function () {
			if( $( this ).hasClass('now-used') == false){
				$( this ).find('.back-content').transition({ opacity: 1 });
				$( this ).find('.front-content').transition({ opacity: 0 });
			}
		},
		function () {
			if( $( this ).hasClass('now-used') == false){
				$( this ).find('.back-content').transition({ opacity: 0 });
				$( this ).find('.front-content').transition({ opacity: 1 });
			}
	});

}


