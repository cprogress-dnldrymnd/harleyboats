<?php
/*if (!session_id()) {
	session_start();
}*/
/*-----------------------------------------------------------------------------------*/
/* Define the version so we can easily replace it throughout the theme
/*-----------------------------------------------------------------------------------*/
define('coptz', 1.0);
define('theme_dir', get_template_directory_uri() . '/');
define('assets_dir', theme_dir . 'assets/');
define('image_dir', assets_dir . 'images/');
define('vendor_dir', assets_dir . 'vendors/');
/*-----------------------------------------------------------------------------------*/
/* After Theme Setup
/*-----------------------------------------------------------------------------------*/
function action_after_setup_theme()
{
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	//add_theme_support('wc-product-gallery-zoom');
	//add_theme_support('wc-product-gallery-lightbox');
	//add_theme_support('wc-product-gallery-slider');

	global $modules_section, $theme_settings;
	$modules_section = array(
		array(
			'id'    => 'templates',
			'label' => 'Templates'
		),
		array(
			'id'    => 'tabs_center_content',
			'label' => 'Tabs Center Content'
		),

		array(
			'id'    => 'logo_slider',
			'label' => 'Logo Slider'
		),

		array(
			'id'    => 'featured_product_slider',
			'label' => 'Featured Product Slider'
		),

		array(
			'id'    => 'parallax_image',
			'label' => 'Parallax Image'
		),
		array(
			'id'    => 'scrolling_section',
			'label' => 'Scrolling Section'
		),
		array(
			'id'    => 'cta',
			'label' => 'CTA'
		),

		array(
			'id'    => 'customer_reviews',
			'label' => 'Customer Reviews'
		),
		array(
			'id'    => 'two_columns',
			'label' => 'Two Columns'
		),
		array(
			'id'    => 'two_columns_v2',
			'label' => 'Two Columns V2'
		),
		array(
			'id'    => 'two_columns_v3',
			'label' => 'Two Columns v3'
		),
		array(
			'id'    => 'accordion',
			'label' => 'Accordion'
		),
		array(
			'id'    => 'contact_form',
			'label' => 'Contact Form'
		),
		array(
			'id'    => 'slider',
			'label' => 'Slider'
		),

		array(
			'id'    => 'vendor',
			'label' => 'Vendor'
		),

	);

	$theme_settings = array(
		array(
			'id'    => 'general_settings',
			'label' => 'General Settings'
		),
		array(
			'id'    => 'after_banner',
			'label' => 'After Banner'
		),
		array(
			'id'    => 'before_footer',
			'label' => 'Before Footer'
		),
		array(
			'id'    => 'brand_details',
			'label' => 'Brand Details'
		),
		array(
			'id'    => 'header_settings',
			'label' => 'Header Settings'
		),
		array(
			'id'    => 'footer_settings',
			'label' => 'Footer Settings'
		),
	);

}
add_action('after_setup_theme', 'action_after_setup_theme');

/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
	require_once('includes/post-meta.php');
}
function get__post_meta($value)
{
	if (function_exists('carbon_get_the_post_meta')) {
		return carbon_get_the_post_meta($value);
	}
	else {
		return 'Error: Carbonfield not activated';
	}
}

function get__term_meta($term_id, $value)
{
	if (function_exists('carbon_get_term_meta')) {
		return carbon_get_term_meta($term_id, $value);
	}
	else {
		return 'Error: Carbonfield not activated';
	}
}

function get__post_meta_by_id($id, $value)
{
	if (function_exists('carbon_get_post_meta')) {
		return carbon_get_post_meta($id, $value);
	}
	else {
		return 'Error: Carbonfield not activated';
	}
}
function get__theme_option($value)
{
	if (function_exists('carbon_get_theme_option')) {
		return carbon_get_theme_option($value);
	}
	else {
		return 'Error: Carbonfield not activated';
	}
}



function get__post_thumbnail_id($post_id)
{
	if (get_post_thumbnail_id($post_id)) {
		return get_post_thumbnail_id($post_id);
	}
	else {
		return get__theme_option('placeholder_image');
	}
}


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/
function enqueue_scripts()
{
	wp_enqueue_style('coptz-swiper-css', vendor_dir . 'swiper/swiper-bundle.min.css');
	wp_enqueue_style('coptz-data-fancybox-css', vendor_dir . 'fancybox/jquery.fancybox.min.css');
	wp_enqueue_style('coptz-style', theme_dir . 'style.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('coptz-bootstrap-js', vendor_dir . 'bootstrap/bootstrap.min.js');
	wp_enqueue_script('coptz-swiper-js', vendor_dir . 'swiper/swiper-bundle.min.js');
	//wp_enqueue_script('coptz-main-fontawesome-js', vendor_dir . 'fontawesome/all.min.js');
	//wp_enqueue_script('coptz-aos-js', vendor_dir . 'aos/aos.js');
	if (is_front_page()) {
		wp_enqueue_script('coptz-gsap-js', vendor_dir . 'gsap/gsap.min.js');
	}
	wp_enqueue_script('coptz-data-fancybox-js', vendor_dir . 'fancybox/jquery.fancybox.min.js');
	wp_enqueue_script('coptz-js', assets_dir . 'javascripts/main.min.js');

	$Theme_Options = new Theme_Options();
	if ($Theme_Options->disable_gutenberg) {
		wp_dequeue_style('wp-block-library');
	}
}

add_action('wp_enqueue_scripts', 'enqueue_scripts'); // Register this fxn and allow Wordpress to call it automatcally in the header


function action_wp_footer()
{
	$page_footer_scripts = carbon_get_the_post_meta('page_footer_scripts');

	if ($page_footer_scripts) {
		echo $page_footer_scripts;
	}
	?>
	<?php
}
add_action('wp_footer', 'action_wp_footer');

/*-----------------------------------------------------------------------------------*/
/* Require Files
/*-----------------------------------------------------------------------------------*/
require_once('includes/_required_files.php');

/*-----------------------------------------------------------------------------------*/
/* Admin Settings
/*-----------------------------------------------------------------------------------*/
function action_admin_enqueue_scripts($hook)
{

	wp_enqueue_style('my_custom_script', get_template_directory_uri() . '/admin/css/admin-css.css', array(), '1.1');

	wp_enqueue_style('select_2_css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css', array(), '1.0');

	wp_enqueue_style('karla', 'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap', array(), '1.0');

	wp_enqueue_script('select_2_js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js', array(), '1.0');

	wp_enqueue_script('admin_js', get_template_directory_uri() . '/admin/js/admin-js.js', array(), '1.3');
}
add_action('admin_enqueue_scripts', 'action_admin_enqueue_scripts');


/*-----------------------------------------------------------------------------------*/
/* Code Miror
/*-----------------------------------------------------------------------------------*/
add_action('admin_enqueue_scripts', 'codemirror_enqueue_scripts');

function codemirror_enqueue_scripts($hook)
{
	$cm_settings = array(
		'ce_css'  => wp_enqueue_code_editor(array('type' => 'text/css', 'codemirror' => array('autoRefresh' => true))),
		'ce_html' => wp_enqueue_code_editor(array('type' => 'text/html', 'codemirror' => array('autoRefresh' => true)))
	);
	wp_localize_script('jquery', 'cm_settings', $cm_settings);

	wp_enqueue_style('wp-codemirror');
}

function get_date_diff($post_id)
{
	$datetime1 = new DateTime(get_the_date('', $post_id));
	$datetime2 = new DateTime(''); // current date
	$interval = $datetime1->diff($datetime2);
	$days_ago = $interval->format('%a');
	if ($days_ago == 0) {
		return 'Today at ' . get_the_time('', $post_id);
	}
	else if ($days_ago == 1) {
		return $interval->format('%a day ago');
	}
	else {
		return $interval->format('%a days ago');
	}
}

function get_time_diff($post_id)
{
	$time1 = strtotime('08:00:00');
	$time2 = strtotime('09:30:00');
	$difference = round(abs($time2 - $time1) / 3600, 2);
	return $difference;
}

/*
function my_update_posts() {
		//$myposts = get_posts('showposts=-1');//Retrieve the posts you are targeting
		$args = array(
				'post_type' => 'post',
				'numberposts' => -1
		);
		$myposts = get_posts($args);
		foreach ($myposts as $mypost){
				$mypost->post_title = $mypost->post_title.'';
				wp_update_post( $mypost );
		}
}
add_action( 'wp_loaded', 'my_update_posts' );*/