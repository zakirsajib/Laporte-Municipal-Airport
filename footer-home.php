<?php global $data; ?>

<div class="footer-home row-fluid">
		<div class="footer-inner container">
		  	<div class="span4 links offset3">
		  		<?php if ( is_active_sidebar( 'f_h_sidebar_one' ) ) : ?>
		        	<?php dynamic_sidebar( 'f_h_sidebar_one' );  ?>
		        <?php endif;?>
		  	</div>
		  	<div class="span5 deals">
		  		<?php if ( is_active_sidebar( 'f_h_sidebar_two' ) ) : ?>
		        	<?php dynamic_sidebar( 'f_h_sidebar_two' );  ?>
		        <?php endif;?>
		        
		        
		        <?php $footer_copyright = $data['footer_copyright']; ?>
		        
		        <?php if($footer_copyright == 1):?>
		        	<div class="clearfix"></div>
		        	<div class="copyright">
		        		<p><?php echo $data['footer_text']; ?></p>
		        	</div>
		        <?php endif;?>
		  	</div>
		 </div> <!-- end footer inner -->
</div> <!-- end footer home -->
<?php get_template_part('js/custom', 'script');?>
<?php echo $data['space_body']; ?>
<?php echo $data['google_analytics']; ?>
<?php wp_footer();?>
</body>
</html>