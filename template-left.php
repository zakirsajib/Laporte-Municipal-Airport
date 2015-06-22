<?php 

/*Template Name: Left Sidebar*/
get_header();
?>

<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php if ( have_posts() ) : ?>
			
			<?php if(has_post_thumbnail() ) : 
			  	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );?>
			    <div class="top-img-page" style="background :url('<?php echo $large_image_url[0]?>') no-repeat center center; -moz-background-size:cover;-webkit-background-size:cover; background-size:cover;"></div> <!-- end top-img -->
			 <?php else:?>
			  		<div class="top-img-page" style="background :url('http://placehold.it/1920x260') no-repeat center center; -moz-background-size:cover;-webkit-background-size:cover; background-size:cover;"></div>
			<?php endif;?>
			
			
			<div class="clearfix"></div>
			
			
			<div class="page-container row-fluid">
				<?php $breadcrumb = $data['breadcrumb'];
				if($breadcrumb == 1):?>
				<div class="container">
					<ul class="breadcrumb">
					      <li><a href="<?php echo home_url();?>">Home</a>  <span class="divider">/</span></li>
					      <li class="active"><?php the_title()?></li>
					</ul>
				</div>
				<?php endif;?>
				
				
				<div class="container">
				
					<div class="sidebar-left span3">
				    	<?php get_sidebar('left')?>
				    </div>
			
				<?php while(have_posts()) : the_post();?> 
					<div class="span8 offset1">
			        	<div class="entry-content"><?php the_content();?></div>
			        </div>
			    <?php endwhile;?>
				</div> <!-- end container -->
			</div> <!-- end page-container -->    
		    
		<?php else : ?>
				<div class="page-container row-fluid">
					<?php get_template_part('not', 'found')?>
				</div> <!-- end page-container -->
		<?php endif; // end have_posts() check ?>	
	</div>
<?php get_footer();?>