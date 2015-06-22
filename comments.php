<?php
	// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="no-comments"><?php echo __('This post is password protected. Enter the password to view comments.', 'wptheme'); ?></p>
	<?php
		return;
	}
?>
	



<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<div class="clearfix"></div>
	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
	<div class="clearfix"></div>
	
	<div class="comment-heading">
		<h1 class="entry-title-events">Comments</h1>
	</div>
	
		
	<div class="clearfix"></div>	
	
	<ol class="commentlist">
	<?php
			$args = array('type' =>'comment','callback' => 'mytheme_comment');
			wp_list_comments($args);
	?>
			
	</ol>
	<div class="clearfix"></div>
	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	<div class="clearfix"></div>


<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>
	<?php endif; ?>
	
<?php endif; ?>






<?php if ( comments_open() ) : ?>

<hr>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>
	
	
	
	<?php if ( is_user_logged_in() ) :?>
	
	<div id="respond">
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		
		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
			
			
		<div class="clearfix"></div>
		
       	<textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
       	<br/>
       	<input name="submit" id="submit-login" class="btn" tabindex="5" value="Submit Comment" type="submit">
       	<input name="comment_post_ID" value="1" type="hidden">
       	<?php comment_id_fields(); ?>
		<?php do_action('comment_form', $post->ID); ?>

   </form>
    </div>   		
	<?php else : ?>
	       
       	<?php comment_id_fields();		
		do_action('comment_form', $post->ID);
		$comments_args = array('comment_notes_after'=>''); // Disable html markup
		comment_form($comments_args); // default wordpress comments box?>
	<?php endif; ?>
       
	

	<?php endif; // If registration required and not logged in ?>
	


<?php endif; ?>