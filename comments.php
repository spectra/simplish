<?php // Do not delete these lines
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(__('Not labeled for individual sale.', 'simplish'));

	if(post_password_required()){ ?>
		<p class="nocomments">Enter post password to view comments.</p>
	<?php
		return;
	}
?>

<h5 id="comments-heading"><?php comments_number(__('0 Comments', 'simplish'), __('1 Comment', 'simplish'), __('% Comments', 'simplish'));?> <?php _e('on', 'simplish'); ?> <em><?php the_title(); ?></em></h5>
	<?php if('open' == $post->comment_status) : /* Comments open */ ?>
		<?php if(get_option('comment_registration') && !$user_ID): ?>
<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('Log in'); ?></a> <?php _e('to respond'); ?>
</p>
		<?php else: ?>
<p><a href="#respond"><?php _e('Respond', 'simplish'); ?></a></p>
		<?php endif; ?>
	<?php else: /* Comments closed. */ ?>
			<p class="nocomments"><?php _e('Closed', 'simplish'); ?></p>
	<?php endif; ?>

	<?php if(have_comments()): ?>
			<ol id="commentslist" class="comments">
				<?php wp_list_comments(); ?>
			</ol>
			<div id="commentsnav" class="navigation">
				<div class="prevlink"><?php previous_comments_link(__('&laquo; Older Comments', 'simplish')) ?></div>
				<div class="nextlink"><?php next_comments_link(__('Newer Comments &raquo;', 'simplish')) ?></div>
			</div>
	<?php endif; ?>


<?php if('open' == $post->comment_status): ?>

<?php if(!(get_option('comment_registration') && !$user_ID)): ?>

<?php comment_form(); ?>

<?php endif; // If registration required and not logged in ?>

<?php endif; // DO NOT REMOVE ?>
