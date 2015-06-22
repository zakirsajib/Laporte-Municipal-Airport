<!-- Custom Script generated from theme options -->
<?php global $data; ?>
<script>
$j = jQuery.noConflict();		
		$j( document ).ready(function() {					
				$j("#slides1").responsiveSlides({
					auto:<?php echo $data['autoplay_slideshow']?>,
			        pager: <?php echo $data['pagination_slideshow']?>,
			        nav: <?php echo $data['navigation_slideshow']?>,
			        timeout:<?php echo $data['timeout_slideshow']?>,
			        speed:<?php echo $data['speed_slideshow']?>
			     });
});
</script>