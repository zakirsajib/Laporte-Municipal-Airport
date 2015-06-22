<?php 
get_header();
?>
<div class="home-container row-fluid">
	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="container">
	
	<?php while(have_posts()) : the_post();?>   
		
		
		<!-- change following as your theme demands -->
		
		POST TITLE: <?php the_title(); ?><br />
		AUTHOR: <?php the_author_posts_link(); ?><br />
		POSTED: <?php the_time(get_option( 'date_format' )) ?><br />
		<?php the_tags(); ?><br/>
		FILED AS: <?php the_category(', ') ?><br />
		COMMENT FEED: <?php post_comments_feed_link(); ?><br />
	 
        
        <?php if(has_post_thumbnail() ) : ?>
  				<?php the_post_thumbnail('feat_image', array('alt'=>get_the_title($post->ID),'class'=>"left", 'title'=>get_the_title($post->ID))); ?>
  		<?php else:?>
  				<img class="left" src="http://placehold.it/500x500" alt="default image" />
  		<?php endif;?>
                
        <?php the_content();?>
    <?php endwhile;?>	
    
    
    <?php 
	// pagination
	content_nav(); ?>
    
    
     <div class="comments-area row-fluid">
		<?php comments_template('', true ); ?>
	</div>    
    
    </div> <!-- end container -->
    </div>
</div>

<?php get_footer();?>


