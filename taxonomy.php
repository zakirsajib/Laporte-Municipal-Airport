<?php get_header();?>

<div class="home-container row-fluid">
	  <div class="container">
	  <h1><?php single_cat_title(); ?></h1>
	  <hr>
	  <?php while(have_posts()) : the_post();?>
	    		<h2><a href="<?php the_permalink()?>"><?php the_title()?></a></h2>
	    		<?php the_excerpt();?>
	  <?php endwhile;?>	
	  </div
</div>
<?php get_footer();?>