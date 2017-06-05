(function( $ ) {
	'use strict';
		
	$(function(){
		$('.wpce-colorpicker').wpColorPicker();
    });
    
	$(function(){
		$("#wpce_shortcode").focus(function() {
			var $this = $(this);
			$this.select();
			// Chrome debug
			$this.mouseup(function() {
        	// Prevent further mouseup intervention
        	$this.unbind("mouseup");
        	return false;
		});
    });
    
});

})( jQuery );
