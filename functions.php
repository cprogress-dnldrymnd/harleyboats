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
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');

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
	//wp_enqueue_style('coptz-swiper-css', vendor_dir . 'swiper/swiper-bundle.min.css');
	//wp_enqueue_style('coptz-data-fancybox-css', vendor_dir . 'fancybox/jquery.fancybox.min.css');
	wp_enqueue_style('coptz-style', theme_dir . 'style.css');

	wp_enqueue_script('jquery');
	wp_enqueue_script('coptz-bootstrap-js', vendor_dir . 'bootstrap/bootstrap.min.js');
	//wp_enqueue_script('coptz-swiper-js', vendor_dir . 'swiper/swiper-bundle.min.js');
	//wp_enqueue_script('coptz-main-fontawesome-js', vendor_dir . 'fontawesome/all.min.js');
	//wp_enqueue_script('coptz-aos-js', vendor_dir . 'aos/aos.js');
	//wp_enqueue_script('coptz-js', assets_dir . 'javascripts/main.js');

}

add_action('wp_enqueue_scripts', 'enqueue_scripts'); // Register this fxn and allow Wordpress to call it automatcally in the header



/*-----------------------------------------------------------------------------------*/
/* Require Files
/*-----------------------------------------------------------------------------------*/
require_once('includes/_required_files.php');

function action_woocommerce_before_main_content()
{
	echo '<section class="product-loop md-padding" ><div class="container"><div class="heading-box"><h2> Used Boats </h2></div>';
}


add_action('woocommerce_before_main_content', 'action_woocommerce_before_main_content');

function action_woocommerce_after_main_content()
{
	echo '</div></section>';
}


add_action('woocommerce_after_main_content', 'action_woocommerce_after_main_content');


remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


add_action('woocommerce_after_shop_loop_item', 'bbloomer_view_product_button', 10);

function bbloomer_view_product_button()
{
	global $product;
	$link = $product->get_permalink();
	echo '<a href="' . $link . '" class="button addtocartbutton">View Product</a>';
}
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);



/**
 * Shop/archives: wrap the product image/thumbnail in a div.
 * 
 * The product image itself is hooked in at priority 10 using woocommerce_template_loop_product_thumbnail(),
 * so priority 9 and 11 are used to open and close the div.
 */
add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '<div class="image-box">';
}, 9);
add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '</div>';
}, 11);


/**
 * Add a custom product data tab
 */
add_filter('woocommerce_product_tabs', 'woo_enquire_tab');
function woo_enquire_tab($tabs)
{

	// Adds the new tab

	$tabs['test_tab'] = array(
		'title'    => __('Enquire', 'woocommerce'),
		'priority' => 50,
		'callback' => 'woo_enquire_tab_content'
	);

	return $tabs;

}
function woo_enquire_tab_content()
{

	// The new tab content

	echo '<h3 class="mb-4">Enquire Now</h3>';
	echo do_shortcode( '[contact-form-7 id="53" title="Product Enquire"]' );

}