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
	wp_enqueue_script('coptz-js', assets_dir . 'javascripts/main.js');

}

add_action('wp_enqueue_scripts', 'enqueue_scripts'); // Register this fxn and allow Wordpress to call it automatcally in the header



/*-----------------------------------------------------------------------------------*/
/* Require Files
/*-----------------------------------------------------------------------------------*/
require_once('includes/_required_files.php');

function action_woocommerce_before_main_content()
{
	echo '<section class="product-loop md-padding" ><div class="container">';
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


/* This snippet removes the action that inserts thumbnails to products in teh loop
 * and re-adds the function customized with our wrapper in it.
 * It applies to all archives with products.
 *
 * @original plugin: WooCommerce
 */

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

/**
 * WooCommerce Loop Product Thumbs
 **/

if (!function_exists('woocommerce_template_loop_product_thumbnail')) {

	function woocommerce_template_loop_product_thumbnail()
	{
		echo woocommerce_get_product_thumbnail();
	}
}


/**
 * WooCommerce Product Thumbnail
 **/
if (!function_exists('woocommerce_get_product_thumbnail')) {

	function woocommerce_get_product_thumbnail($size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0)
	{
		global $post, $woocommerce;

		if (!$placeholder_width)
			$placeholder_width = $woocommerce->get_image_size('shop_catalog_image_width');
		if (!$placeholder_height)
			$placeholder_height = $woocommerce->get_image_size('shop_catalog_image_height');

		$output = '<div class="imagewrapper">';

		if (has_post_thumbnail()) {

			$output .= get_the_post_thumbnail($post->ID, $size);

		}
		else {

			$output .= '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';

		}

		$output .= '</div>';

		return $output;
	}
}