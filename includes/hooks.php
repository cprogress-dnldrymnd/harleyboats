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
	else {
		$title = get_the_archive_title();
	}

	echo '<div class="page-title" role="banner"> <h1>' . $title . '</h1> </div>';
}

add_action('after_open_main', 'action_after_open_main');



//Allow shortcode in menu
add_filter('wp_nav_menu_items', 'do_shortcode');


function se_logout_redirect($redirect_to, $requested_redirect_to, $user)
{
	$requested_redirect_to = get_permalink(get_option('woocommerce_myaccount_page_id'));

	return $requested_redirect_to;
}
add_filter('logout_redirect', 'se_logout_redirect', 10, 3);


function action_wp_head()
{
	$page_header_scripts = get__post_meta('page_header_scripts');
	$page_custom_css = get__post_meta('page_custom_css');

	if ($page_header_scripts) {
		echo $page_header_scripts;
	}
	if ($page_custom_css) {
		echo '<style id="page-custom-css">' . $page_custom_css . '</style>';
	}
}

add_action('wp_head', 'action_wp_head');


function action_admin_head()
{
	if (isset($_GET['post'])) {
		$id = $_GET['post'];
		$template = get_post_meta($id, '_wp_page_template', true);
		$post_type = get_post_type($id);
		if ($template == 'templates/modules.php') {
			?>

			<style>
				.edit-post-header-toolbar {
					display: none !important;
				}

				.edit-post-sidebar__panel-tabs ul li:last-child {
					display: none;
				}

				.block-editor-block-list__layout {
					display: none !important;
				}

				.editor-post-text-editor {
					display: none !important;
				}

				.components-dropdown-menu__menu .components-menu-group:first-child {
					display: none;
				}
			</style>
		<?php } ?>

		<script>
			jQuery(document).ready(function ($) {
				setTimeout(function () {
					jQuery('body').removeClass('is-fullscreen-mode');
				});
			});
		</script>
<?php } ?>
<?php
}

add_action('admin_head', 'action_admin_head');

function action_body_scripts()
{
	$page_body_scripts = get__post_meta('page_body_scripts');
	$body_scripts = get__theme_option('body_scripts');
	if ($page_body_scripts) {
		echo $page_body_scripts;
	}

	if ($body_scripts) {
		echo $body_scripts;
	}
}

add_action('body_scripts', 'action_body_scripts');



add_filter('body_class', 'action_body_class');
function action_body_class($classes)
{
	$hero_banner_type = get__post_meta_by_id(get_the_ID(), 'hero_banner_type');
	$page_theme = get__post_meta_by_id(get_the_ID(), 'page_theme');
	$header_type = get__post_meta('header_type');
	if (!is_404()) {

		if ($hero_banner_type) {
			$classes[] = 'hero-banner-' . $hero_banner_type;
		}
		if ($page_theme) {
			$classes[] = $page_theme;
		}
		if ($header_type) {
			$classes[] = 'header-' . $header_type;
		}
	}
	else {
		$classes[] = 'background-black';
	}

	return $classes;
}


add_filter('wpcf7_autop_or_not', '__return_false');


function action_wp_footer()
{
	$page_footer_scripts = get__post_meta('page_footer_scripts');

	if ($page_footer_scripts) {
		echo $page_footer_scripts;
	}
	?>
	<?php
}
add_action('wp_footer', 'action_wp_footer');