$( document ).ready(function() {
	
	var added = 0;
	
//***START OF A BOTTLE***	

//add bottle
	$(".bottle").click(function() {
		
//if more than 5 bottles warn me and kill this
		if(added>5) {
			if( $('.alerts_box').css("display") === "none" ){
				$('.purchase_b').css('display','block');
				$('.alerts_box').slideDown();
				$('.alerts_box').delay(3000).slideUp( function(){
					$('.purchase_b').css('display','none');
				});
				
			}
			return false;
		}
		
		else {		
			added = added+1;
			
			var $addthis = $( this ).clone().css( "opacity", "0" );
			$addthis.appendTo("#bottles form").animate({ opacity: "1" });

			$addthis.find('.remove_button').delay(600).animate({ opacity: "1" });
			 
			//add button tick
			$(this).find('.add_button').css("background", "url(assets/images/added.png)");
			$(this).find('.add_button').css("opacity", "1");
			
			setTimeout(function(){
				$('.add_button').css("opacity", "0");
				$('.add_button').css("background", "url(assets/images/add.png)");
			},1500);
			
			//show bottles if mobile     
			//var isMobile = window.matchMedia("only screen and (max-width: 360px)");
	
			//if (isMobile.matches) {	
//			
//				$('.bottles_fixed').fadeIn();
//				$('.fixed_fix').css("margin-bottom", "190px");
//				
//				setTimeout(function(){
//				$('.bottles_fixed').fadeOut();
//				$('.fixed_fix').css("margin-bottom", "-101px");
//				},1500);	
//						
//			}
			
			if ($("#bottles").height() === 200 ) {
            	$( "#bottles" ).animate({height: "260px"});
				$('.fixed_fix').animate({marginBottom: "200px"});
			}
			
		}				
	});
	
//***END OF A BOTTLE***

//remove bottles
	$( document ).on('click', '.remove_button', function() {			
		added = added-1;
		
		$(this).closest('.bottle').remove();//.animate( { opacity:'0' }, function() { $(this).remove(); });
		
		if (added<1) {
            	$( "#bottles" ).animate({height: "200px"});
				$('.fixed_fix').animate({marginBottom: "140px"});
		}
		
	});
	
});


