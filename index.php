<?php get_header(); ?>

		<div id="content" role="main">

<?php if(have_posts()): ?>

<?php while(have_posts()): the_post(); ?>
			<div id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php get_template_part('hentryhead') ?>
				<br class="clear" />
				<div class="entry-content">
					<?php the_content('<span class="readmore">'.__('More&hellip;', 'simplish').'</span>'); ?>
				</div>
<?php get_template_part('hentrymeta') ?>
			</div><!--#article-num .hentry-->

<?php endwhile; ?>

<?php get_template_part('prevnextnav') ?>

<?php else : ?>

<h2 class="center"><?php _e('Not Found', 'simplish'); ?></h2>
			<?php get_search_form(); ?>

<?php endif; ?>

		</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
