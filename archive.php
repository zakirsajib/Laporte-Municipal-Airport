<?php get_header();?>

<div class="home-container row-fluid">
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	  <div class="container">
	  	<?php while(have_posts()) : the_post();?>
	  		<h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
	    	<?php the_excerpt();?>
	  	<?php endwhile;?>
	  	<?php 
		// pagination
		defaulttheme_content_nav( 'nav-below' ); ?>
	  </div>
	  </div>	
</div>


<?php get_footer();?>