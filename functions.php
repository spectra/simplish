<?php

/* Width set equal to width in style.css:/^#content */
$GLOBALS['content_width'] = 662;

/* Widget Sidebar */
if(function_exists('register_sidebars'))
	register_sidebar();

/*
 * hCard producers based on blog.txt,
 * http://www.plaintxt.org/themes/blogtxt/
 */

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

/* Echo hCard for post author, with URL of author's archive. */
function sp_byline_hcard()
{
	global $wpdb, $authordata;

	echo '<span class="entry-author author vcard"><a class="url fn" href="' .
		get_author_link(false, $authordata->ID, $authordata->user_nicename) .
		'" title="More posts by ' .
		$authordata->display_name .
		'">' .
		get_the_author() .
		'</a></span>';
}

/*
 * Echo hCard for post author, with (from author's profile):
 * display name, avatar image for email addr, bio info, URL.
 * Takes integer option for img square size in pixels.
 * Default size from wp's get_avatar() is 96.
 */
function sp_author_hcard($size)
{
	global $wpdb, $authordata;

	$email = get_the_author_email();
	$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar($email, $size) );
	if($authordata->user_description !=''){
		$note = '<span class="note">' .
		apply_filters('archive_meta', $authordata->user_description) .
		'</span>';
	}
	echo '<span class="author vcard">' .
		$avatar .
		'<a class="url fn" rel="me" title="' .
		get_the_author() . ' home page" href="' . get_the_author_url() . '">'
		. get_the_author() .
		'</a>' .
		$note .
		'</span>';
}

/*
 * Filter wp's [gallery] shortcode.
 * Returns a set of gallery divs.
 * Requires support in (and see) style.css.
 * Based on blog.txt,
 * http://www.plaintxt.org/themes/blogtxt/
 */
function sp_vallery($attr)
{
	global $post;

	if(isset($attr['orderby'])){
		$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
		if(!$attr['orderby'])
			unset($attr['orderby']);
	}

	extract(shortcode_atts(array(
		'orderby' => 'menu_order ASC, ID ASC',
		'id' => $post->ID,
		'itemtag' => 'dl',
		'icontag' => 'dt',
		'captiontag' => 'dd',
		'columns' => 3,
		'size' => 'thumbnail',
	), $attr));

	$id = intval($id);
	$orderby = addslashes($orderby);
	$attachments = get_children("post_parent=$id&post_type=attachment&post_mime_type=image&orderby={$orderby}");

	if(empty($attachments))
		return null;

	if(is_feed()){
		$output = "\n";
		foreach($attachments as $id => $attachment)
			$output .= wp_get_attachment_link( $id, $size, true ) . "\n";
		return $output;
	}

	$listtag = tag_escape($listtag);
	$itemtag = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns = intval($columns);
	$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$output = apply_filters( 'gallery_style', "\n" . '<div class="gallery">', 9 ); // Available filter: gallery_style

	foreach($attachments as $id => $attachment){
		$img_lnk = get_attachment_link($id);
		$img_src = wp_get_attachment_image_src( $id, $size );
		$img_src = $img_src[0];
		$img_alt = $attachment->post_title;
		$img_rel = apply_filters( 'gallery_img_rel', 'attachment' ); // Available filter: gallery_img_rel
		$img_class = apply_filters( 'gallery_img_class', 'gallery-image' ); // Available filter: gallery_img_class

		$output .= "\n\t" . '<' . $itemtag . ' class="gallery-item gallery-columns-' . $columns .'">';
		$output .= "\n\t\t" . '<' . $icontag . ' class="gallery-icon"><a href="' . $img_lnk . '" title="' . $img_alt . '" rel="' . $img_rel . '"><img src="' . $img_src . '" alt="' . $img_alt . '" class="' . $img_class . ' attachment-' . $size . '" /></a></' . $icontag . '>';

		if($captiontag && trim($attachment->post_excerpt)){
			$output .= "\n\t\t" .
			'<' . $captiontag . ' class="gallery-caption">' .
			$attachment->post_excerpt .
			'</' . $captiontag . '>';
		}

		$output .= "\n\t" . '</' . $itemtag . '>';
		if($columns > 0 && ++$i % $columns == 0 && $i != count($attachments))
			$output .= "\n</div>\n" . '<div class="gallery">';
	}
	$output .= "\n</div>\n";

	return $output;
}

add_filter('post_gallery', 'sp_vallery', $attr);

/* i18n. Gettext support is incomplete. */
load_theme_textdomain('simplish');

?>
