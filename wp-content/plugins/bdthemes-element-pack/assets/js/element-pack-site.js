jQuery(document).ready(function($) {
	"use strict";
	var bdt_offcanvas = $('body').find('.elementor-widget-bdt-offcanvas');
	if (bdt_offcanvas) {
		$('body').wrapInner('<div class="bdt-offcanvas-content" />');
	}

	
	$(".parallax-scene").each(function(){
		try{
		 	var elem=$(this).next(".has-bdt-parallax")[0];
		 	$(this).prependTo(elem);		
		 	var parallax = new Parallax(this);
		}catch(e){
			console.log(e.message);
		}
	});
	
});