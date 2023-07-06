<?php
function action_open_header()
{
	echo '<header id="header">';
}
add_action('open_header', 'action_open_header');

function action_close_header()
{
	echo '</header>';
}

add_action('close_header', 'action_close_header');

function action_open_footer()
{
	echo '<footer>';
}
add_action('open_footer', 'action_open_footer');

function action_close_footer()
{
	echo '</footer>';
}

add_action('close_footer', 'action_close_footer');

function action_after_open_main()
{
	if (is_single() || is_page()) {
		$title = get_the_title();
	}
	else if (is_search()) {
		$title = 'Search';
	}
	else if (is_shop()) {
		$title = 'Shop';
	}
	else {
		$title = get_the_archive_title();
	}


	echo '<div class="page-title d-none" role="banner"> <h1>' . $title . '</h1> </div>';
}

add_action('after_open_main', 'action_after_open_main');

//Allow shortcode in menu
add_filter('wp_nav_menu_items', 'do_shortcode');


add_filter('wpcf7_autop_or_not', '__return_false');