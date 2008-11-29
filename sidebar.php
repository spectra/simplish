		<div id="sidebar">
			<ul>
			<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
				<li id="search" class="search">
				<?php include(TEMPLATEPATH . '/searchform.php'); ?>
				</li>

				<?php wp_list_pages('title_li=<h2 class="sidebar-title">' . __( 'Pages', 'simplish' ) . '</h2>' ); ?>

				<li id="categories"><h2 class="sidebar-title"><?php _e( 'Categories', 'simplish' ) ?></h2>
					<ul>
					<?php wp_list_cats('sort_column=name&optioncount=0&hierarchical=1'); ?>
					</ul>
				</li>

				<li id="archives"><h2 class="sidebar-title"><?php _e( 'Archives', 'simplish' ) ?></h2>
					<ul>
					<?php wp_get_archives('type=monthly&show_post_count=0'); ?>
					</ul>
				</li>

				<?php get_links_list(); ?>

				<li id="syndicate"><h2 class="sidebar-title"><?php _e( 'Syndicate', 'simplish' ) ?></h2>
					<ul>
						<li>
						<a href="<?php bloginfo('rss2_url'); ?>" title="<?php bloginfo('name'); ?> Articles RSS" rel="alternate" type="application/rss+xml"><?php _e( 'Articles Feed', 'simplish' ) ?></a>
						</li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php bloginfo('name'); ?> Comments RSS" rel="alternate" type="application/rss+xml"><?php _e( 'Comments Feed', 'simplish' ) ?></a></li>
					</ul>
				</li>

				<li id="meta"><h2 class="sidebar-title"><?php _e( 'Meta', 'simplish' ) ?></h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</li>
			<?php endif; ?>
			</ul>
		</div><!-- #sidebar -->
