$j = jQuery.noConflict();		
		$j( document ).ready(function() {	
		  
				
				if ($j.browser.msie && $j.browser.version == 10) {
				  	$j("html").addClass("ie10");
				}
				
				$j('.wpcf7-submit').addClass('btn btn-large');				
});


$j(window).load(function() {});
