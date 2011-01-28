<?php get_header(); ?>

		<div id="content" role="main">

<?php if(have_posts()): ?>

<?php while(have_posts()): the_post();
		get_template_part('format', get_post_format());
endwhile; ?>

<?php get_template_part('prevnextnav') ?>

<?php else : ?>

<h2 class="center"><?php _e('Not Found', 'simplish'); ?></h2>
			<?php get_search_form(); ?>

<?php endif; ?>

		</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
