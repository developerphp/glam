//Modal plugin
(function($){
$.fn.modal = function(options) {
	var defaults = {  
		theme: "light",  
		width: undefined,
		height: undefined,
		layout: undefined,
		url: undefined,
		content: undefined,
		padding: undefined,
		animation: "flipInX"
	};  
	if( $("#overlays .modal").length>0 ) {
		$("#overlays .modal").remove();
	}
	var options = $.extend(defaults, options); 
	
	$("#overlays").addClass("dark").append('<div class="modal"><div class="wrapper"></div></div>');
	var modal = $("#overlays .modal");
	var wrapper = $("#overlays .modal .wrapper");
	
	if(defaults.url==undefined) {
		wrapper.html( this.html() );
	} else {
		wrapper.load(defaults.url);
	}
	
	if(defaults.content!=undefined) {
		wrapper.html(defaults.content);
	}
	
	if(defaults.theme!="light") {
		modal.addClass(defaults.theme);
	}
	
	if(defaults.animation!=false) {
		modal.addClass("animated " + defaults.animation);
	}
	
	if(defaults.layout=="elastic") {
		var si = "%";
		if(defaults.width==undefined) {
			modal.css("width", "90%").css("margin-left", "-45%");
		}
		if(defaults.height==undefined) {
			modal.css("height", "70%").css("margin-top", "-35%");
		}
		
	} else {
		var si = "px";
	}
	
	if(defaults.width!=undefined) {
		var width = defaults.width + si;
		var marginLeft = -(defaults.width / 2) + si;
		modal.css("width", width).css("margin-left", marginLeft);
	}
	if(defaults.height!=undefined) {
		var height = defaults.height + si;
		var marginTop = -(defaults.height / 2) + si;
		modal.css("height", height).css("margin-top", marginTop);
	}
	
	if(defaults.padding!=undefined) {
		wrapper.css("margin", defaults.padding)
	}
	
	
	modal.live("tap", function() {
		return false;
	});
	
	$("#overlays.dark .modal .hide").live("tap", function() {
		remove(modal);
	});
	
	$(document).keyup(function(e) {
		if(e.which == 27) {
			remove(modal);
		}
	});
	
	function remove(modal) {
		modal.remove();
		$("#overlays").removeClass();
		$(document).unbind("keyup");	
	}
	
	
	
}
})(jQuery);