				<ul class="meta">
<?php if(!in_category('1')): /* Assumes Uncategorized is catID #1 */ ?>
					<li class="categories"><?php _e('Category:', 'simplish') ?> <?php the_category(', ') ?></li>
<?php endif; ?>
<?php if(get_the_tags() != ''): ?>
					<li class="tags"><?php the_tags(__('Tags: ', 'simplish')); ?></li>
<?php endif; ?>
					<li><a href="<?php comments_link(); ?>-heading"><?php comments_number(__('0 Comments', 'simplish'), __('1 Comment', 'simplish'), __('% Comments', 'simplish')); ?></a> &ndash; <?php comments_rss_link(__('Feed', 'simplish')); ?></li>
				</ul>
<!-- <?php trackback_rdf(); ?> -->
