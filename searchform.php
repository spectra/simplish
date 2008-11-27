<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
	<div>
		<input id="s" name="s" type="text" value="<?php the_search_query() ?>" />
		<input id="searchsubmit" name="searchsubmit" type="submit" value="Search" />
	</div>
</form>
