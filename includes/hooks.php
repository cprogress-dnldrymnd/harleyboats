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

//Disable Gutenberg
function disable_gutenberg()
{
	$Theme_Options = new Theme_Options();
	if ($Theme_Options->disable_gutenberg) {
		add_filter('use_block_editor_for_post', '__return_false');
	}
}

add_action('init', 'disable_gutenberg');


//Allow shortcode in menu
add_filter('wp_nav_menu_items', 'do_shortcode');


function se_logout_redirect($redirect_to, $requested_redirect_to, $user)
{
	$requested_redirect_to = get_permalink(get_option('woocommerce_myaccount_page_id'));

	return $requested_redirect_to;
}
add_filter('logout_redirect', 'se_logout_redirect', 10, 3);


/*//Remove Editor
function remove_editor() {
if (isset($_GET['post'])) {
$id = $_GET['post'];
$template = get_post_meta($id, '_wp_page_template', true);
switch ($template) {
case 'templates/modules.php':
// the below removes 'editor' support for 'pages'
// if you want to remove for posts or custom post types as well
// add this line for posts:
// remove_post_type_support('post', 'editor');
// add this line for custom post types and replace 
// custom-post-type-name with the name of post type:
// remove_post_type_support('custom-post-type-name', 'editor');
remove_post_type_support('page', 'editor');
break;
default :
// Don't remove any other template.
break;
}
}
}
add_action('init', 'remove_editor');*/


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
	?>
	<script>
		var getUrlParameter = function getUrlParameter(sParam) {
			var sPageURL = window.location.search.substring(1),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
				}
			}
			return false;
		};

		function setCookie(cname, cvalue, exdays) {
			const d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			let expires = "expires=" + d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
			let name = cname + "=";
			let ca = document.cookie.split(';');
			for (let i = 0; i < ca.length; i++) {
				let c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}
	</script>
	<?php
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
		integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
		integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />
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

add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	}
	elseif (is_tag()) {
		$title = single_tag_title('', false);
	}
	elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	}
	elseif (is_tax()) { //for custom post types
		$title = sprintf(__('%1$s'), single_term_title('', false));
	}
	elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});



function modify_cpt_slug($args, $post_type)
{

	if ($post_type == 'solutions' || $post_type == 'careers' || $post_type == 'career-paths' || $post_type == 'events' || $post_type == 'webinars') {
		$args['rewrite'] = array('with_front' => false);
	}
	return $args;
}
add_filter('register_post_type_args', 'modify_cpt_slug', 10, 2);


function action_wp_footer_scripts()
{


	$ms_tag = get__post_meta('use_microsoft_ads_uet_tag');
	$linkedin_tag = get__post_meta('use_linkedin_insight_tag');
	if ($ms_tag) {
		?>
		<script>
			(function (w, d, t, r, u) { var f, n, i; w[u] = w[u] || [], f = function () { var o = { ti: "17167185" }; o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad") }, n = d.createElement(t), n.src = r, n.async = 1, n.onload = n.onreadystatechange = function () { var s = this.readyState; s && s !== "loaded" && s !== "complete" || (f(), n.onload = n.onreadystatechange = null) }, i = d.getElementsByTagName(t)[0], i.parentNode.insertBefore(n, i) })(window, document, "script", "//bat.bing.com/bat.js", "uetq");
		</script>
		<?php
	}
	if ($linkedin_tag) {
		?>
		<script type="text/javascript">
			_linkedin_partner_id = "498138";
			window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
			window._linkedin_data_partner_ids.push(_linkedin_partner_id);
		</script>
		<script type="text/javascript">
			(function () {
				var s = document.getElementsByTagName("script")[0];
				var b = document.createElement("script");
				b.type = "text/javascript"; b.async = true;
				b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
				s.parentNode.insertBefore(b, s);
			})();
		</script>
		<noscript>
			<img height="1" width="1" style="display:none;" alt=""
				src="https://px.ads.linkedin.com/collect/?pid=498138&fmt=gif" />
		</noscript>
		<?php
	}
	?>
	<script>
		jQuery(document).ready(function () {
			mega_menu();
			<?php if (is_user_logged_in()) { ?>
				<?php if (!isset($_GET['customer_type'])) { ?>
					customer_type_modal();
				<?php } ?>
			<?php } ?>
		});


		function mega_menu() {
			jQuery('li.mega-menu-item').on('open_panel', function () {
				jQuery('header').addClass('mega-menu-opened');
			});
			jQuery('li.mega-menu-item').on('close_panel', function () {
				jQuery('header').removeClass('mega-menu-opened');
			});
		}

		<?php if (is_user_logged_in()) { ?>
			function customer_type_modal() {
				if (jQuery('#customerType').length > 0) {
					var customerType = new bootstrap.Modal(document.getElementById('customerType'), {
						keyboard: false
					});
					setTimeout(function () {
						customerType.show();
					}, 1000);
				}
			}
		<?php } ?>
	</script>
	<?php
}

add_action('wp_footer_scripts', 'action_wp_footer_scripts');


function costumer_type_not_logged_in()
{
	if (isset($_GET['customer_type']) && !is_user_logged_in()) {
		$_SESSION['customer_type'] = $_GET['customer_type'];
	}
}

add_action('init', 'costumer_type_not_logged_in');
/**
 * Adds a submenu page under a custom post type parent.
 */
add_action('admin_menu', 'vendors_submenu');

function vendors_submenu()
{
	add_submenu_page(
		'edit.php?post_type=product',
		__('Vendors', 'textdomain'),
		__('Vendors', 'textdomain'),
		'manage_options',
		'/edit-tags.php?taxonomy=pa_vendors&post_type=product',
	);
}



function custom_login_redirect()
{

	return '/my-account';

}

add_filter('woocommerce_login_redirect', 'custom_login_redirect');