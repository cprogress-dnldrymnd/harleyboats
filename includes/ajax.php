<?php
/*
add_action('wp_ajax_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ql_woocommerce_ajax_add_to_cart', 'ql_woocommerce_ajax_add_to_cart');
function ql_woocommerce_ajax_add_to_cart()
{
$product_id = apply_filters('ql_woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
$variation_id = absint($_POST['variation_id']);
$passed_validation = apply_filters('ql_woocommerce_add_to_cart_validation', true, $product_id, $quantity);
$product_status = get_post_status($product_id);
if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {
do_action('ql_woocommerce_ajax_added_to_cart', $product_id);
if ('yes' === get_option('ql_woocommerce_cart_redirect_after_add')) {
wc_add_to_cart_message(array($product_id => $quantity), true);
}
WC_AJAX::get_refreshed_fragments();
}
else {
$data = array(
'error'       => true,
'product_url' => apply_filters('ql_woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
);
echo wp_send_json($data);
}
wp_die();
}
*/

add_action('wp_ajax_nopriv_archive_ajax', 'archive_ajax'); // for not logged in users
add_action('wp_ajax_archive_ajax', 'archive_ajax');
function archive_ajax()
{
	$DisplayData = new DisplayData();
	$taxonomy = $_POST['taxonomy'];
	$terms = $_POST['terms'];
	$s = $_POST['s'];
	$offset = $_POST['offset'];
	$terms_category = $_POST['terms_category'];
	$post_types = $_POST['post_types'];
	$posts_per_page = get_option('posts_per_page');
	$is_search = $_POST['is_search'];
	;
	if ($is_search) {
		$class = 'col-lg-4';
		if ($post_types) {
			$post_type = explode(',', $post_types);
		}
		else {
			$post_type = 'any';
		}
	}
	else {
		$class = 'col-xl-3 col-lg-4';

		$post_type = $_POST['post_type'];
	}
	$args = array(
		'post_type'      => $post_type,
		'posts_per_page' => $posts_per_page,
		'post_status'    => 'publish'
	);

	if ($offset) {
		$args['offset'] = $offset;
	}

	if ($terms || $terms_category) {
		if ($taxonomy != 'category') {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $terms . $terms_category,
				),
			);
		}
		else {
			$args['cat'] = $terms . $terms_category;
		}
	}

	if ($s) {
		$args['s'] = $s;
	}

	$the_query = new WP_Query($args);

	$count = $the_query->found_posts;
	echo hide_load_more($count, $offset, $posts_per_page);
	?>
	<?php if (!$offset) { ?>
		<div class="row gy-3 product-holder product-grid post-box-PostSlider">
		<?php } ?>
	<?php
	if ($the_query->have_posts()) {
		while ($the_query->have_posts()) {
			$the_query->the_post();
			?>
			<div class="<?= $class ?> col-sm-6 post-item">
				<div class="swiper-slide product-box">
					<div class="inner background-white d-block ">
						<a href="<?= get_permalink() ?>" class="box-link"></a>
						<div class="image-holder position-relative">
							<?php
							$DisplayData->image(
								array(
									'image_id'    => get_post_thumbnail_id(),
									'size'        => 'medium',
									'placeholder' => true
								),
								'position-relative image-cover-transform'
							);
							if ($is_search) {
								if (get_post_type() == 'post') {
									$post_type_val = 'blog';
								}
								else {
									$post_type_val = get_post_type();

								}

								if (get_post_type() == 'post') {
									$button_text = 'Read more';
								}
								else if (get_post_type() == 'webinars') {
									$button_text = 'Watch webinar';
								}
								else if (get_post_type() == 'product') {
									$button_text = 'View product';
								}
								else if (get_post_type() == 'page') {
									$button_text = 'View page';
								}
								else if (get_post_type() == 'events') {
									$button_text = 'View events';
								}
								echo '<span class="badge"> ' . $post_type_val . ' </span>';
							}
							?>
						</div>

						<?php
						$DisplayData->heading(
							array(
								'heading' => get_the_title(),
								'tag'     => 'h4'
							)
						);
						?>
						<div class="bottom-box">
							<?php if (get_post_type() == 'post') { ?>
								<div class="meta-box d-flex">
									<span class="date">
										<?= get_the_date('d/m/Y', get_the_ID()) ?>
									</span>
									<div class="bull">&bull;</div>
									<span class="author">
										<?php
										$author_id = get_post_field('post_author', get_the_ID());
										$author_name = get_the_author_meta('display_name', $author_id);
										?>
										<?= $author_name ?>
									</span>
								</div>
							<?php } ?>

							<div class="link-box">
								<a href="<?= get_permalink() ?>" class="link-underline fw-medium">
									<?= $button_text ? $button_text : 'Read more' ?>
								</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		<?php }
	}
	else {
		?>
	<h2>No Results Found</h2>
	<?php
	}
	wp_reset_postdata();
	?>
	<?php if (!$offset) { ?>
		</div>
	<?php } ?>


<?php

		die();
}

function hide_load_more($count, $offset, $posts_per_page)
{
	if ($count == ($offset + $posts_per_page) || $count < ($offset + $posts_per_page) || $count < $posts_per_page + 1) {
		return '<style>.load-more {display: none} </style>';
	}
}

add_action('wp_ajax_nopriv_product_modal_ajax', 'product_modal_ajax'); // for not logged in users
add_action('wp_ajax_product_modal_ajax', 'product_modal_ajax');
function product_modal_ajax()
{
	$SVG = new SVG;
	$GetData = new GetData();
	$Modules = new Modules;
	$product_id = $_POST['product_id'];
	$type = 'modal';
	$product = wc_get_product($product_id);
	$name = $product->get_name();
	$main_image = $product->get_image_id() ? $product->get_image_id() : get__theme_option('placeholder_image');
	$images = $product->get_gallery_image_ids();
	$type = $product->get_type();

	?>
<div class="product-modal-backdrop d-block d-lg-none product-modal-trigger close-button"></div>
<div class="product-modal-header">
	<div class="container background-white">
		<div class="inner d-flex justify-content-between align-items-center">
			<h2 class="m-0 fw-bold"><?= $name ?> </h2>
			<button type="button" class="product-modal-trigger d-flex close-button align-items-center">
				<span class="close-text">CLOSE</span>
				<span class="close-icon background-body d-flex justify-content-center"><?= $SVG->close ?></span>
			</button>
		</div>
	</div>
</div>
<div class="product-modal-body">
	<div class="product-modal-backdrop d-none d-lg-block product-modal-trigger close-button"></div>
	<div class="container position-relative">
		<div class="inner">
			<?php
			include(get_stylesheet_directory() . '/template-parts/woocommerce/product-details/product-details.php');
			include(get_stylesheet_directory() . '/template-parts/woocommerce/product-details/product-featured-video.php');
			include(get_stylesheet_directory() . '/template-parts/woocommerce/product-details/product-specifications.php');
			$Modules->modules_section($product_id);
			?>
		</div>
	</div>
</div>
<div class="product-modal-footer d-none d-xl-block">
	<div class="container background-white">

		<?= $GetData->add_to_cart($product_id) ?>
	</div>
</div>
<?php
		if ($type == 'variable') {
			$variations = $product->get_available_variations();

			?>
	<script>
		<?php foreach ($variations as $variation) { ?>
			<?php foreach ($variation['attributes'] as $attribute) { ?>
				var $variation_name = '<?= $attribute ?>';

			<?php } ?>
			var $variation_id = '<?= $variation['variation_id']; ?>';


			jQuery('.variations_form option[value="' + $variation_name + '"]').attr('id', $variation_id);

			jQuery('.variations_form select').change(function (e) {
				$val = jQuery(this).find(':selected').attr('id')
				jQuery('.ajax_add_to_cart').attr('data-product_id', $val);

			});
		<?php } ?>
	</script>
<?php } ?>

<?php
		die();
}