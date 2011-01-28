<?php /* Default aka standard (aka nil?) post format */ ?>
			<div id="article-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php get_template_part('hentryhead') ?>
				<br class="clear" />
				<div class="entry-content">
					<?php the_content(sp_readmore_text()); ?>
					<?php wp_link_pages( array( 'before' => '<div class="pgnum-link">' . __( 'Pages:', 'simplish' ), 'after' => '</div>' ) ); ?>
				</div>
<?php get_template_part('hentrymeta') ?>
			</div><!--#article-num .hentry-->
