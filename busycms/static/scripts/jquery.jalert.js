//------------------------------------
//	JQUERY.JALERT.JS
//	Author: 	Will Blackmore
//	Requires:	jquery 1.4.2
//	Version:	0.6
//------------------------------------

/////////////////	OPTIONS
//
//	icon:			The little icon used, see icons.css for full list of icons
//					default: alert
//
//	type:			There are 3 types
//						auto: opens and then hides after a delay
//						question: opens and has two buttons
//						statement: opens and has a single button
//					default: auto
//
//	delay:			When type = auto, the time taken before the alert closes
//					default: 2 seconds
//	
//	title:			The title of the alert box
//					default: Alert
//
//	message:		The content of the alert
//					default: This is an alert
//
//	follow:			Do we keep the alert at the top of the content?
//					default: true
//
//	yesText:		Text for the yes button
//					default: yes
//
//	noText:			Text for the no button
//					default: no
//
//	okText:			Text for the single ok button
//					default: ok
//
//	beforeOpen:		Function called before the alert is shown
//
//	onOpen:			Function called once the alert is fully opened
//
//	beforeClose:	Function called before the alert begins to close
//
//	onClose:		Function called once the alert is fully closed
//
//	onYes:			Function called when yes button is clicked
//
//	onNo:			Function called when no button is clicked
//
//	onOk:			Function called when OK button is clicked
//
//	id:				Shouldn't ever need to change this
//					default: alert
//
/////////////////

(function($){

	var alertActive = false;
	var $this = null;
        
	jQuery.fn.jAlert = function (settings){	
		return this.click(function(){
			$.jAlert(settings,$(this));
			return false;
		});
	}
	
	jQuery.jAlert = function (settings,$this){
		if( !$this ) $this = this;

		// Default options
		var defaults = {
			icon:			'alert',
			type:			'auto',
			delay:			2000,
			title:			'Alert',
			message:		'This is an alert',
			follow:			true,
			yesText:		'Yes',
			noText:			'No',
			okText:			'OK',
			beforeOpen:		function(){},
			onOpen:			function(){},
			beforeClose:	function(){},
			onClose:		function(){},
			onYes:			function(){},
			onNo:			function(){},
			onOk:			function(){},
			id:				'alert'
		};
		
		var options = $.extend(defaults, settings);

		function createAlert(){

			// Before we open
			options.beforeOpen.call($this);

			// Make sure there are no other alerts active
			if( alertActive == true ) return false;
			alertActive = true;

			// Auto alert content
			title = '<h3>' + options.title + '</h3>';
			message = '<p>' + options.message + '</p>';
			
			// Buttons for question and statement
			buttons = '';
	
			if( options.type == 'question' ){
				buttons = '<a href="#" id="jAlert_yes" class="button tick-16">' + options.yesText + '</a><a href="#" id="jAlert_no" class="button cross-16">' + options.noText + '</a>';
			}else if( options.type == 'statement' ){
				buttons = '<a href="#" id="jAlert_ok" class="button tick-16">' + options.okText + '</a>';
			}
	
			html = '<div><div id="alert_box">' + title + message + buttons + '</div><span class="top"></span><span class="bottom"></span></div>';
	
			// Build jAlert HTML
			$('<div/>', {
				'id'	:	options.id,
				'class'	:	options.icon,
				'html'	:	html
			}).appendTo('#content');
	
			// Animate
			var $jA = $('#' + options.id);
			var $jAd = $('#alert_box');
			var $jAs = $('#' + options.id + ' span');
			
			// Fade in alert background
			$jA.fadeIn('fast');
			
			// Find some metrics
			w = $jAd.outerWidth();
			h = $jAd.outerHeight();
			
			// Are we following the user down the page?
			if( options.follow == true ){
			
				offset = window.pageYOffset;
				
				if(offset > 160) $jA.children('div:first').css({top:window.pageYOffset - 160});
			
			}
			
			$jAd.css({width:( w - 70 ), top:'-' + h + 'px', marginLeft: '-' + Math.round( w / 2 ) + 'px' }).addClass(options.icon);
			
			$jAs.css({width:( w + 10 ), marginLeft: '-' + Math.round( ( w / 2 ) + 5 ) + 'px' });
			
			$jAd.animate({top:0},600,'easeInOutExpo',function(){
				options.onOpen.call($this);
				
				// Do we automatically close?
				if( options.type == 'auto' ) setTimeout($.jAlert.close,options.delay);
			});
		}
		
		createAlert();
		
		// Buttons
		$('#' + options.id + ' a').click(function(){
			btn = $(this).attr('id');

			if( btn == 'jAlert_yes' ){
				options.onYes.call($this);
				$.jAlert.close();
			}else if( btn == 'jAlert_no' ){
				options.onNo.call($this);
				$.jAlert.close();
			}else if( btn == 'jAlert_ok' ){
				options.onOk.call($this);
				$.jAlert.close();
			}
			
			return false;			
		});

		// Close alert, public function
		jQuery.jAlert.close = function () {

			options.beforeClose.call($this);

			$('#' + options.id + ' #alert_box').stop([]).animate({top:'-' + h + 'px'},600,'easeInOutExpo',function(){
				$('#' + options.id).fadeOut('fast',function(){
					$(this).remove();
					alertActive = false;
					options.onClose.call($this);
				});
			});

		}

	}

})(jQuery);