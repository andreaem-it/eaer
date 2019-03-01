function init_slide_menu(){

				windowsize = $(window).width();
					setClickMenu(windowsize);

				$( window ).resize(function() {
					windowsize = $(window).width();

					setClickMenu(windowsize);

				});

	function setClickMenu(windowsize){

					if(windowsize < 750){
						$( '.dropdown-toggle' ).attr('data-toggle', 'dropdown');
					}else{
						$( '.dropdown-toggle' ).attr('data-toggle', '');
						$( '.dropdown' ).removeClass(function() {
						return $( this ).prev().attr( "dropdown" );
						});
						

					}
					
	}

}