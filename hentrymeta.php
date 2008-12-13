				<ul class="meta">
<?php if(!in_category('1')): /* Assumes Uncategorized is catID #1 */ ?>
					<li class="categories"><?php _e('Category:', 'simplish') ?> <?php the_category(', ') ?></li>
<?php endif; ?>
<?php if(get_the_tags() != ''): ?>
					<li class="tags"><?php the_tags(); ?></li>
<?php endif; ?>
					<li><a href="<?php comments_link(); ?>-heading"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a> - <?php comments_rss_link('Feed'); ?></li>
				</ul>
<!-- <?php trackback_rdf(); ?> -->
