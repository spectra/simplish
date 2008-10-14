<?php get_header(); ?>

		<div id="content">

<?php if(have_posts()): ?>

<?php while(have_posts()): the_post(); ?>
			<div id="article-<?php the_ID(); ?>" class="hentry">
<?php include(TEMPLATEPATH . '/hentryhead.php'); ?>
				<br class="clear" />
				<div class="entry-content">
					<?php the_content('<span class="readmore">'.__('More&hellip;', 'simplish').'</span>'); ?>
				</div>
<?php include(TEMPLATEPATH . '/hentrymeta.php'); ?>
			</div><!--#article-num .hentry-->

<?php endwhile; ?>

			<div id="archivenav" class="navigation">
				<div class="prevlink"><?php next_posts_link('&laquo; Previous') ?></div>
				<div class="nextlink"><?php previous_posts_link('Next &raquo;') ?></div>
			</div>

<?php else : ?>

			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php include(TEMPLATEPATH . "/searchform.php"); ?>

<?php endif; ?>

		</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
