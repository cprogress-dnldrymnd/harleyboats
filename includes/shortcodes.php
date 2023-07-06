<?php



class Shortcodes
{
	function contact_number()
	{
		$Theme_Options = new Theme_Options();
		return $Theme_Options->contact_number;
	}
	function email_address()
	{
		$Theme_Options = new Theme_Options();
		return $Theme_Options->email_address;
	}
	function post_title()
	{
		global $product_id_global;
		if ($product_id_global) {
			$alt_title = get__post_meta('alt_title');
		}
		else {
			$alt_title = get__post_meta_by_id($product_id_global, 'alt_title');
		}
		if ($alt_title) {
			return $alt_title;
		}
		else {
			if ($product_id_global) {
				return get_the_title($product_id_global);
			}
			else {
				return get_the_title();
			}
		}
	}

	function post_title_html()
	{
		$alt_title = carbon_get_the_post_meta('alt_title');
		if ($alt_title) {
			return '<h2 class="text-uppercase text-center">' . $alt_title . '</h2>';
		}
		else {
			return '<h2 class="text-uppercase text-center">' . get_the_title() . '</h2>';
		}
	}

	function button($atts, $content = null)
	{
		extract(
			shortcode_atts(
				array(
					'button_text' => '',
					'button_link' => '',
					'new_window'  => '',
					'button_type' => 'button-accent'
				),
				$atts
			)
		);
		$new_window = $new_window != 'false' ? 'target="_blank"' : '';
		$DisplayData = new DisplayData();
		if ($button_text) {
			return $DisplayData->button(
				array(
					'link_text'   => $button_text,
					'link'        => $button_link,
					'link_action' => $new_window,
					'class'       => 'button-accent'
				),
				false
			);
		}
	}

	function get_param($atts)
	{
		extract(
			shortcode_atts(
				array(
					'value' => '',
				),
				$atts
			)
		);
		if (isset($_GET[$value])) {
			return $_GET[$value];
		}
	}

	function svg($atts)
	{
		$SVG = new SVG;

		extract(
			shortcode_atts(
				array(
					'icon' => '',
				),
				$atts
			)
		);

		return $SVG->{$icon};
	}

	function site_logo()
	{
		$Theme_Options = new Theme_Options();
		return $Theme_Options->logo;
	}

	function contact_details()
	{
		$Theme_Options = new Theme_Options();
		ob_start(); ?>
		<ul class="contact-details white-color">
			<?php if ($Theme_Options->contact_number_text) { ?>
				<li>
					t: <?= $Theme_Options->contact_number ?>
				</li>
			<?php } ?>
			<?php if ($Theme_Options->email_address_text) { ?>
				<li>
					e: <?= $Theme_Options->email_address ?>
				</li>
			<?php } ?>
		</ul>
		<?php
		return ob_get_clean();
	}

	function woocommerce_icons()
	{
		$SVG = new SVG();
		ob_start();
		?>
		<div class="header-icons">
			<ul class="list-unstyled m-0 p-0 d-flex align-items-center">
				<li>
					<a href="#">
						<?= $SVG->user ?>
					</a>
				</li>
				<li>
					<a href="#">
						<?= $SVG->cart ?>
					</a>
				</li>
			</ul>
		</div>
		<?php
		return ob_get_clean();
	}

	function socials()
	{
		$Theme_Options = new Theme_Options();
		$SVG = new SVG();
		ob_start(); ?>
		<ul class="socials white-color d-flex align-items-center">
			<?php if ($Theme_Options->facebook) { ?>
				<li>
					<a href="<?= $Theme_Options->facebook ?>"> <?= $SVG->facebook ?> </a>
				</li>
			<?php } ?>

			<?php if ($Theme_Options->twitter) { ?>
				<li>
					<a href="<?= $Theme_Options->twitter ?>"> <?= $SVG->twitter ?> </a>
				</li>
			<?php } ?>

			<?php if ($Theme_Options->linkedin) { ?>
				<li>
					<a href="<?= $Theme_Options->twitter ?>"> <?= $SVG->linkedin ?> </a>
				</li>
			<?php } ?>
			<?php if ($Theme_Options->youtube) { ?>
				<li>
					<a href="<?= $Theme_Options->twitter ?>"> <?= $SVG->youtube ?> </a>
				</li>
			<?php } ?>
		</ul>
		<?php
		return ob_get_clean();
	}


	function address()
	{
		ob_start();
		$Theme_Options = new Theme_Options();

		?>
		<div class="address">
			<h3 class="mb-3">
				<strong>Where to find us</strong>
			</h3>
			<div class="details">
				<?= wpautop($Theme_Options->address) ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	function opening_times()
	{
		ob_start();
		$Theme_Options = new Theme_Options();

		?>
		<div class="address">
			<h3 class="mb-3">
				<strong>Opening Times</strong>
			</h3>
			<div class="details">
				<?= wpautop($Theme_Options->opening_times) ?>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	function site_url()
	{
		return get_site_url();
	}

	function webinar_box()
	{
		$Theme_Options = new Theme_Options();

		$video = get__post_meta('video');
		$minutes = get__post_meta('minutes');
		$video_id = preg_match('#(?<=(?:v|i)=)[a-zA-Z0-9-_]+|(?<=(?:v|i)\/)[^&?\n]+|(?<=embed\/)[^"&?\n]+|(?<=‌​(?:v|i)=)[^&?\n]+|(?<=youtu.be\/)[^&?\n]+#', $video, $matches);
		$image = get_the_post_thumbnail_url(get_the_ID(), 'large') ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'http://img.youtube.com/vi/' . $matches[0] . '/hqdefault.jpg';
		ob_start();
		?>
		<div class="webinar-box">
			<a class="image-box position-relative d-block" href="<?= $video ? $video : get_permalink() ?>" <?= $video ? 'data-fancybox' : '' ?>>
				<img src="<?= $image ?>" alt="">
				<div class="elementor-custom-embed-play" role="button" aria-label="Play Video" tabindex="0">
					<svg aria-hidden="true" class="e-font-icon-svg e-eicon-play" viewBox="0 0 1000 1000"
						xmlns="http://www.w3.org/2000/svg">
						<path
							d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z">
						</path>
					</svg> <span class="elementor-screen-only">Play Video</span>
				</div>
			</a>
			<div class="content-box p-4 content-margin">
				<div class="heading-box">
					<h4><?= get_the_title() ?></h4>
				</div>
				<?php if ($minutes) { ?>
					<div class="time-box">
						<span class="d-flex icon align-items-center">
							<span class="elementor-icon-list-icon me-3">
								<svg aria-hidden="true" class="e-font-icon-svg e-far-clock" viewBox="0 0 512 512"
									xmlns="http://www.w3.org/2000/svg">
									<path fill: var(--accent-color);
										d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z">
									</path>
								</svg> </span>
							<span class="elementor-icon-list-text"><?= $minutes ?> Minutes</span>
						</span>
					</div>
				<?php } ?>
				<div class="button-box button-accent">
					<a class="w-100" href="<?= $video ? $video : get_permalink() ?>" <?= $video ? 'data-fancybox' : '' ?>>PLAY</a>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}

	function webinar_date_time()
	{
		ob_start();
		$date = get__post_meta('date');
		$time = get__post_meta('time');
		if ($date && $time) {
			?>

			<div class="webinar-date">
				<span class="date">
					<?= date('D j M', strtotime($date)); ?> //
				</span>
				<br>
				<span class="time">
					<?= date('g:i a', strtotime($time)); ?>

				</span>

			</div>
			<?php
			return ob_get_clean();

		}
	}

	function login_link()
	{
		if (is_user_logged_in()) {
			$login_link = 'https://www.coptrzacademy-usp.io/';
			$login_text = 'Login';
		}
		else {
			$login_link = '/login';
			$login_text = 'Login';
		}
		return '<a class="px-0" style="text-decoration: underline" href="' . $login_link . '" >' . $login_text . '</a>';

	}


	function login_button()
	{
		if (is_user_logged_in()) {
			$login_link = 'https://www.coptrzacademy-usp.io/';
			$login_text = 'LOG IN';
		}
		else {
			$login_link = '/login';
			$login_text = 'LOG IN';
		}
		return '<div class="button-box button-white"><a class="px-0" style="text-decoration: underline" href="' . $login_link . '" >' . $login_text . '</a></div>';

	}


}
$Shortcodes = new Shortcodes;
add_shortcode('contact_number', array($Shortcodes, 'contact_number'));
add_shortcode('email_address', array($Shortcodes, 'email_address'));
//add_shortcode('button', array($Shortcodes, 'button'));
add_shortcode('accordion', array($Shortcodes, 'accordion'));
add_shortcode('post_title', array($Shortcodes, 'post_title'));
add_shortcode('post_title_html', array($Shortcodes, 'post_title_html'));
add_shortcode('get_param', array($Shortcodes, 'get_param'));
add_shortcode('svg', array($Shortcodes, 'svg'));
add_shortcode('site_logo', array($Shortcodes, 'site_logo'));
add_shortcode('contact_details', array($Shortcodes, 'contact_details'));
add_shortcode('socials', array($Shortcodes, 'socials'));
add_shortcode('woocommerce_icons', array($Shortcodes, 'woocommerce_icons'));
add_shortcode('address', array($Shortcodes, 'address'));
add_shortcode('opening_times', array($Shortcodes, 'opening_times'));
add_shortcode('site_url', array($Shortcodes, 'site_url'));
add_shortcode('webinar_box', array($Shortcodes, 'webinar_box'));
add_shortcode('webinar_date_time', array($Shortcodes, 'webinar_date_time'));
add_shortcode('login_link', array($Shortcodes, 'login_link'));
add_shortcode('login_button', array($Shortcodes, 'login_button'));


function add_to_cart_form_shortcode($atts)
{
	if (empty($atts)) {
		return '';
	}

	if (!isset($atts['id']) && !isset($atts['sku'])) {
		return '';
	}

	$args = array(
		'posts_per_page'      => 1,
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
	);

	if (isset($atts['sku'])) {
		$args['meta_query'][] = array(
			'key'     => '_sku',
			'value'   => sanitize_text_field($atts['sku']),
			'compare' => '=',
		);

		$args['post_type'] = array('product', 'product_variation');
	}

	if (isset($atts['id'])) {
		$args['p'] = absint($atts['id']);
	}

	$single_product = new WP_Query($args);

	$preselected_id = '0';


	if (isset($atts['sku']) && $single_product->have_posts() && 'product_variation' === $single_product->post->post_type) {

		$variation = new WC_Product_Variation($single_product->post->ID);
		$attributes = $variation->get_attributes();


		$preselected_id = $single_product->post->ID;


		$args = array(
			'posts_per_page'      => 1,
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
			'p'                   => $single_product->post->post_parent,
		);

		$single_product = new WP_Query($args);
		?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				var $variations_form = $('[data-product-page-preselected-id="<?php echo esc_attr($preselected_id); ?>"]').find('form.variations_form');
				<?php foreach ($attributes as $attr => $value) { ?>
					$variations_form.find('select[name="<?php echo esc_attr($attr); ?>"]').val('<?php echo esc_js($value); ?>');
				<?php } ?>
			});
		</script>
		<?php
	}

	$single_product->is_single = true;
	ob_start();
	global $wp_query;

	$previous_wp_query = $wp_query;

	$wp_query = $single_product;

	wp_enqueue_script('wc-single-product');
	while ($single_product->have_posts()) {
		$single_product->the_post()
			?>
		<div class="single-product" data-product-page-preselected-id="<?php echo esc_attr($preselected_id); ?>">
			<?php woocommerce_template_single_add_to_cart(); ?>
		</div>
		<?php
	}

	$wp_query = $previous_wp_query;

	wp_reset_postdata();
	return '<div class="woocommerce">' . ob_get_clean() . '</div>';
}
add_shortcode('add_to_cart_form', 'add_to_cart_form_shortcode');


function catch_that_image()
{
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];

	return $first_img;
}
function query_products()
{

	$args = array(

		'posts_per_page' => -1,

		'post_type'      => array('post'),

		'post_status'    => 'any',

	);
	$products = new WP_Query($args);
	echo '<ol>';

	while ($products->have_posts()) {
		$products->the_post();
		if (catch_that_image()) {
			$image = attachment_url_to_postid(catch_that_image());
			$post_thumb = get_the_post_thumbnail_url(get_the_ID());

			if (!$post_thumb) {
				if ($image) {
					echo '<li class="mb-3"> <a href="' . get_permalink() . '">';

					echo '<br>';


					echo get_the_title();

					echo '<br>';

					echo wp_get_attachment_image($image);

					set_post_thumbnail(get_the_ID(), $image);

					echo '</a><hr></li>';
				}
			}
		}
	}

	echo '</ul>';

	wp_reset_postdata();

	return;
}


add_shortcode('query_products', 'query_products');