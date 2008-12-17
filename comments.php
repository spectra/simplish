<?php // Do not delete these lines
	if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die('Please do not load this page directly. Thanks!');

	if(post_password_required()){ ?>
		<p class="nocomments">Enter post password to view comments.</p>
	<?php
		return;
	}
?>

	<h5 id="comments-heading"><?php comments_number('0 Comments', '1 comment', '% Comments');?> on <em><?php the_title(); ?></em></h5>
	<?php if('open' == $post->comment_status) : /* Comments open */ ?>
		<?php if(get_option('comment_registration') && !$user_ID): ?>
			<p><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">Log in</a> to respond
			<?php if('open' == $post->ping_status): /* Trackbacks open */ ?>
				| <a href="<?php trackback_url(true); ?>" rel="trackback">Trackback</a>
			<?php endif; ?>
			</p>
		<?php else: ?>
			<p><a href="#respond">Respond</a>
			<?php if('open' == $post->ping_status): /* Trackbacks open */ ?>
				| <a href="<?php trackback_url(true); ?>" rel="trackback">Trackback</a>
			<?php endif; ?>
			</p>
		<?php endif; ?>
		
	<?php else: /* Comments closed. */ ?>
			<p class="nocomments">Closed</p>
	<?php endif; ?>

	<?php if(have_comments()): ?>
			<ol id="commentslist" class="comments">
				<?php wp_list_comments(); ?>
			</ol>
			<div id="commentsnav" class="navigation">
				<div class="prevlink"><?php previous_comments_link('&laquo; Older Comments') ?></div>
				<div class="nextlink"><?php next_comments_link('Newer Comments &raquo;') ?></div>
			</div>
	<?php endif; ?>


<?php if('open' == $post->comment_status): ?>

<?php if(!(get_option('comment_registration') && !$user_ID)): ?>

<div id="respond">

	<h4><?php comment_form_title('Respond', 'Respond to %s'); ?></h4>

	<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
	</div>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" class="comments" id="commentform" method="post">

	<fieldset>
	<legend>Comments</legend>
	<?php if($user_ID): ?>

		<p>
		[ Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>
		| <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out</a> ]
		</p>

	<?php else : ?>

		<p>
		<label>Name: <?php if($req) echo "<small>(required)</small>"; ?><br />
			<input name="author" id="author" value="<?php echo $comment_author; ?>" size="30" type="text" tabindex="1" />
		</label>
		</p>

		<p>
		<label>Email: <?php if($req) echo "<small>(required)</small>"; ?><br />
			<input name="email" id="email" value="<?php echo $comment_author_email; ?>" size="30" type="text" tabindex="2" />
			<small>(will not be published)</small>
		</label>
		</p>

		<p>
		<label>Url:<br />
			<input name="url" id="url" value="<?php echo $comment_author_url; ?>" size="30" type="text" tabindex="3" />
		</label>
		</p>

	<?php endif; ?>

	<!--<p><small><strong>XHTML:</strong> You can use these tags: <?php echo allowed_tags(); ?></small></p>-->

	<p>
		Comments:<br />
		<textarea name="comment" id="comment" cols="100%" rows="20" tabindex="4"></textarea></p>
	<p>
		<input name="submit" type="submit" id="submit" tabindex="5" value="Submit" />
		<?php comment_id_fields(); ?>
	</p>
	<?php do_action('comment_form', $post->ID); ?>
	</fieldset>
	</form>

</div>

<?php endif; // If registration required and not logged in ?>

<?php endif; // DO NOT REMOVE ?>
