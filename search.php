<?php  
get_header();
?>


		<?php
			global $wp_query;
			if( is_search() ) {
				$args = array( 'posts_per_page' => 4, 'paged' => $paged );
				$args = array_merge( $args, $wp_query->query );
				query_posts( $args );
			}?>

<div class="home-container row-fluid">
	<div class="container">
			
		<?php if ( have_posts() ) : ?>
			<div class="post-title animated bounceInDown" style="animation-duration: 0.5s; animation-delay: 1s;">
				<h1>Search Results for: <span class="keyword">"<?php echo get_search_query();?>"</span></h1>
			</div>

		
				
		<?php while (have_posts()) : the_post(); ?>
		
					<div class="entry-content">
						<h1 class="title1"><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
						<?php $content = wpautop(get_the_content($post->ID));?>
							<?php if($content):?>
								<?php the_excerpt();?>
							<?php else:?>
								<h1 class="warning">No contents found yet! Please write some.</h1>
							<?php endif;?>	
					</div>
		<?php endwhile; ?>	
		
		
		<!--
			<div class="full-width" id="pagination">
					wp_paginate function could be call here
			</div>
		-->
		</div>
	</div>




		<?php else:?>

		<div class="container">		
			<div class="entry-content">
				<h1 class="title1"><?php _e( 'Nothing Found', '' ); ?></h1>
				<h2 class="title2"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyten' ); ?></h2>	
			</div>
		</div>
		<?php endif; ?>					
		


<?php wp_reset_query();?>



</div>

<?php get_footer();?>