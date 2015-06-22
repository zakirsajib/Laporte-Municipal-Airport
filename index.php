<?php 
get_header();
?>


<div class="home-container row-fluid">
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	  
	  	<?php if ( have_posts() ) : ?>
	  		<div class="container">
	  		
	  		
	  		
			  	<?php while(have_posts()) : the_post();?>
			    	
			    	
			    	
			    	
			    	<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
			    		<?php the_excerpt();?>
			    		<?php wp_link_pages(); ?>
			    
				<?php endwhile;?>
				
				
			
		</div>	 <!-- container -->
			
			
			
		<?php else : ?>
			<?php get_template_part('not', 'found')?>
		<?php endif; // end have_posts() check ?>	
		
</div> <!-- end post-class -->

	
</div> <!-- end index-container -->

<?php get_footer();?>
