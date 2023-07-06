<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
$DisplayData = new DisplayData;
?>
<?php if (is_shop()) { ?>
	<?php
	get_template_part('template-parts/woocommerce/archive', 'banner');
	get_template_part('template-parts/global/vendor-slider');
	?>


	<?php
	$post_is_global = true;
	include(locate_template('/template-parts/modules/_cta.php'));
	?>
	<?= product_slider(true); ?>

	<section class="two-columns two-columns-v2 xl-padding-bottom">
		<div class="container">
			<div class="row-holder">
				<div class="row gx-7 background-white">
					<div class="col-lg-6 col-image">
						<div class="column-holder h-100">
							<div class="image-box h-100">
								<img src="<?= content_url() ?>/uploads/2022/12/police-drone.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-lg-6 d-flex align-items-center">
						<div class="column-holder column-text content-margin pt-3 pb-3">
							<div class="heading-box ">
								<span class="prefix">COPTRZ ACADEMY</span>
								<h2>
									<strong> Expertly created e-learning drone courses </strong>
								</h2>
							</div>
							<div class="description-box">
								<p>
									Studying with us gives you the qualifications, tools and continual development you need
									to be the best drone operator in your industry.
								</p>
							</div>

							<div class="button-group-box d-flex flex-wrap">
								<div class="button-box button-accent">
									<a href="https://coptrz.com/product-category/e-learning-courses/">EXPLORE COURSE</a>
								</div>
								<div class="button-box button-bordered d-none">
									<a href="">FIND OUT MORE</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php }
else { ?>
	<?php
	get_template_part('template-parts/woocommerce/archive', 'banner');
	if (is_product_category()) {
		echo product_slider_category(true);
	}
	else {
		echo product_slider(false);
	}
	get_template_part('template-parts/woocommerce/archive', 'modules');
?>
<?php } ?>
<!--
<section class="archive-product">
	<div class="container">
		<?php
		if (woocommerce_product_loop()) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action('woocommerce_before_shop_loop');

			woocommerce_product_loop_start();

			if (wc_get_loop_prop('total')) {
				while (have_posts()) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 */
					do_action('woocommerce_shop_loop');

					wc_get_template_part('content', 'product');
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action('woocommerce_after_shop_loop');
		}
		else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action('woocommerce_no_products_found');
		}

		/**
		 * Hook: woocommerce_after_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action('woocommerce_sidebar');
		
		?>
	</div>
</section>-->

<?php get_footer('shop');