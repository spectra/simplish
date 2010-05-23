<?php

/* Width set equal to width in style.css:/^#content */
if(!isset($content_width))
	$content_width = 662;

/* Only define it if some child theme hasn't already */
if(!function_exists('sp_setup')){
	/* 
	 * Setup: textdomain, nav_menu support.
	 */
	function sp_setup()
	{
		/*
		 * Gettext i18n.
		 * load_theme_textdomain( $domain, $path )
		 * $path relative from / of URL space.
		 */
		load_theme_textdomain( 'simplish', TEMPLATEPATH . '/languages' );
		
		/* Generate default RSS/Atom feed links in output head. */
		add_theme_support('automatic-feed-links');

		/* Menu - wp_nav_menu() in sidebar.php - new in WP3. */
		register_nav_menus( array('sidebar' => __( 'Sidebar Menu', 'simplish' ), ) );
	}
}
/* The after_setup_theme hook fires before the theme init hook. */
add_action('after_setup_theme', 'sp_setup');

/* Widget Sidebar */
function sp_widgets_init()
{
	register_sidebar();
}
add_action('widgets_init', 'sp_widgets_init');

/*
 * Zero the default gallery shortcode style, so it isn't injected into output body.
 * Simplish gallery styles are in style.css.
 *
 * @return string The emptied gallery style filter
 */
function sp_zero_gallery_css($css){
	return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
}
add_filter('gallery_style', 'sp_zero_gallery_css');	

/*
 * hCard producers based on blog.txt,
 * http://www.plaintxt.org/themes/blogtxt/
 */
if(!function_exists('sp_admin_hcard')){
	/* 
	 * Echo hCard for blog admin, with URL.
	 * Currently unused: Gets site admin on
	 * MU, where only blog owner is wanted.
	 * See http://mu.wordpress.org/forums/topic.php?id=7476
	 */
	function sp_admin_hcard()
	{
		global $wpdb, $admin_info;

		$admin_info = get_userdata(1);
		echo '<span class="vcard"><a class="url fn n" href="' .
			$admin_info->user_url .
			'"><span class="given-name">' .
			$admin_info->first_name .
			'</span> <span class="family-name">' .
			$admin_info->last_name .
			'</span></a></span>';
	}
}

if(!function_exists('sp_byline_hcard')){
	/* Echo hCard for post author, with URL of author's archive. */
	function sp_byline_hcard()
	{
		global $wpdb, $authordata;

		echo '<span class="entry-author author vcard"><a class="url fn" href="' .
			get_author_posts_url($authordata->ID, $authordata->user_nicename) .
			'" title="' . __('More posts by', 'simplish') . ' ' .
			$authordata->display_name .
			'">' .
			get_the_author() .
			'</a></span>';
	}
}

if(!function_exists('sp_author_hcard')){
	/*
	 * Echo hCard for post author, with (from author's profile):
	 * display name, avatar image for email addr, bio info, URL.
	 * Takes integer option for img square size in pixels.
	 * Default size from wp's get_avatar() is 96.
	 */
	function sp_author_hcard($size)
	{
		global $wpdb, $authordata;

		$email = get_the_author_meta('email');
		$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar($email, $size) );
		$note = '';
		if(isset($authordata->user_description)){
			$note = '<span class="note">' .
			apply_filters('archive_meta', $authordata->user_description) .
			'</span>';
		}
		echo '<span class="author vcard">' .
			$avatar .
			'<a class="url fn" rel="me" title="' .
			get_the_author() . ' ' . __('home page', 'simplish') . '" href="' . get_the_author_meta('url') . '">'
			. get_the_author() .
			'</a>' .
			$note .
			'</span>';
	}
}
?>
