var isMobile = window.matchMedia("only screen and (max-width: 767px)");

$( document ).ready(function() {
	
	var $puthere = $('.swap').closest( '.row' );
	
	if (isMobile.matches) {	
	
		$('.swap').remove().clone().prependTo( $puthere );
		
		$('.menu_container').remove().clone().prependTo( document.body );	
			
	}
	
	$('#m_menu').click( function() {
	
		$('.menu_container').fadeIn();
		$( 'html' ).css( "overflow-y", "hidden");
		$( 'body' ).css( "width", "100%");
	});
	
	$( document ).on('click', '#m_close', function() {
	
		$('.menu_container').fadeOut();
		$( 'html' ).css( "overflow-y", "auto");
		$( 'body' ).css( "width", "auto");
	});


});

$( window ).resize(function() {
	
	var $puthere = $('.swap').closest( '.row' );
		
	if (isMobile.matches) {	
	
		$('.swap').remove().clone().prependTo( $puthere );	
	
		$('.menu_container').remove().clone().prependTo( document.body );

		$('.menu_container').css("display","none");
		$( 'html' ).css( "overflow", "auto");
		$( 'body' ).css( "width", "auto");
	}
	
	else{
		
		$('.swap').remove().clone().appendTo( $puthere );
		
		$('.menu_container').remove().clone().appendTo( 'header' );

		$('.menu_container').css("display","block");
		$( 'html' ).css( "overflow", "auto");
		$( 'body' ).css( "width", "auto");
	}
	
});