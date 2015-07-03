$( document ).ready(function() {
	
	var added = 0;
	
//***START OF A BOTTLE***	

//add bottle
	$("#b_add01").click(function() {
		
//if more than 5 bottles warn me and kill this
		if(added>5) {
			
			var $addalert = $('<div id="alert1" class="alert alert-danger" role="alert">Zaten 6 tane ekledin bebişim.</div>');
			
			$('#alert_box').append($addalert);
			
			$($addalert).hide().slideDown();
			
			$('#alert_box #alert1').delay(1500).slideUp( function(){
  				$(this).remove();
			});
			
			return false;
		}
		
		else {		
			added = added+1;
			
			var $addthis = $('<div class="bottle_added"><div class="remove_button"></div><img src="assets/images/added01.png" /><div class="bottle_desc"><strong>01 SPACE LEMONADE</strong><span>JUICE</span></div></div>');
			
			$('.bottles').append($addthis);
			$($addthis).appendTo("#bottles");
						
			$($addthis).hide().fadeIn( function() { 
				$('.remove_button').animate({opacity: "1"}); 
			});
			
			//add button tick
			$('#b_add01').css("background", "url(assets/images/added.png)");
			$('#b_add01').css("opacity", "1");
			
			setTimeout(function(){
			$('.add_button').css("opacity", "0");
			$('#b_add01').css("background", "url(assets/images/add.png)");
			},1500);
			
			//added bottles expand if mobile     
			var isMobile = window.matchMedia("only screen and (max-width: 360px)");
	
			if (isMobile.matches) {	
			
				$('.bottles_fixed').fadeIn();
				$('.fixed_fix').css("margin-bottom", "190px");
				
				setTimeout(function(){
				$('.bottles_fixed').fadeOut();
				$('.fixed_fix').css("margin-bottom", "-101px");
				},1500);	
						
			}
			
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
		//$('.results').html(added);//print var		
		$(this).closest('.bottle_added').remove();//.animate( { opacity:'0' }, function() { $(this).remove(); });
		
		if (added<1) {
            	$( "#bottles" ).animate({height: "200px"});
				$('.fixed_fix').animate({marginBottom: "140px"});
		}
		
	});	
});