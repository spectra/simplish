		<div id="sidebar">
			<ul>
			<?php if (!dynamic_sidebar(1)): //If no widget sidebar, output default sidebar. ?>
				<li id="search" class="search">
				<?php get_search_form(); ?>
				</li>
				
				<li><h2 class="sidebar-title"><?php _e('Navigation', 'simplish') ?></h2>
					<?php /* wp_nav_menu falls back to wp_page_menu if user has no menu setup/assigned. */
					wp_nav_menu( array(
										 'sort_column' => 'menu_order',
										 'container_class' => 'pagenav',
										 'theme_location' => 'sidebar'
										 )
								  );
					?>
				</li>

				<li id="categories"><h2 class="sidebar-title"><?php _e('Categories', 'simplish') ?></h2>
					<ul>
					<?php wp_list_categories('sort_column=name&optioncount=0&hierarchical=1&title_li='); ?>
					</ul>
				</li>

				<li id="archives"><h2 class="sidebar-title"><?php _e('Archives', 'simplish') ?></h2>
					<ul>
					<?php wp_get_archives('type=monthly&show_post_count=0'); ?>
					</ul>
				</li>

				<?php wp_list_bookmarks(); ?>

				<li id="syndicate"><h2 class="sidebar-title"><?php _e('Syndicate', 'simplish') ?></h2>
					<ul>
						<li>
						<a href="<?php bloginfo('rss2_url'); ?>" title="<?php bloginfo('name'); ?> <?php _e('Articles RSS', 'simplish'); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'Articles Feed', 'simplish' ) ?></a>
						</li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php bloginfo('name'); ?> <?php _e('Comments RSS', 'simplish'); ?>" rel="alternate" type="application/rss+xml"><?php _e( 'Comments Feed', 'simplish' ) ?></a></li>
					</ul>
				</li>

				<li id="meta"><h2 class="sidebar-title"><?php _e('Meta', 'simplish') ?></h2>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</li>
			<?php endif; ?>
			</ul>
		</div><!-- #sidebar -->
