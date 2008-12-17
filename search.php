<?php get_header(); ?>

		<div id="content" class="hfeed search-results">

		<?php if (have_posts()) : ?>

			<h1 class="archive-title">Results for <span class="archive-subtitle"><?php the_search_query() ?></span></h1>
		
			<?php while (have_posts()) : the_post();
			/*
			 * Search's hentry div doesn't include() either of
			 * hentry^(head,meta)^.php, because it's a different layout.
			 */
			?>
			<div id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<div class="entry-content">
					<?php the_excerpt() ?>
				</div>
			</div>

			<?php endwhile; ?>

			<div id="archivenav" class="navigation">
				<div class="prevlink"><?php next_posts_link('&laquo; Previous') ?></div>
				<div class="nextlink"><?php previous_posts_link('Next &raquo;') ?></div>
			</div>
	
		<?php else : ?>

			<h1 class="archive-title">No results for <span class="archive-subtitle"><?php the_search_query() ?></span></h1>
			<?php get_search_form(); ?>

		<?php endif; ?>
		
		</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
