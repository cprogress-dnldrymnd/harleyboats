<?php
class GetData
{
	function get_terms_details($taxonomy, $hide_empty = false, $order = 'ASC')
	{
		$terms = get_terms(
			array(
				'taxonomy'   => $taxonomy,
				'hide_empty' => $hide_empty,
				'orderby'    => 'id',
				'order'      => $order,
			)
		);
		if (!$terms)
			return;
		$term_array = array();
		foreach ($terms as $term) {
			$term_array[$term->term_id] = array(
				'name'        => $term->name,
				'description' => $term->description
			);
		}
		return $term_array;
	}
	function get_post_terms_id($taxonomy)
	{
		$terms = get_the_terms(get_the_ID(), $taxonomy);
		if (!$terms)
			return;
		$term_array = array();
		foreach ($terms as $term) {
			$term_array[$term->term_id] = $term->term;
		}
		return $term_array;
	}
	function get_post_terms($taxonomy)
	{
		$terms = get_post_terms_id($taxonomy);
		if (!$terms)
			return;
		ob_start();
		foreach ($terms as $key => $term) {
			?>
			<a class="button primary-button small" href="<?= get_term_link($key); ?>"><?= $term ?></a>
			<?php
		}
		return ob_get_clean();
	}
	function get_posts($post_type, $label = 'Select Post', $posts_per_page = -1, $post_status = 'publish')
	{
		$return = array();
		if ($label) {
			$return[''] = $label;
		}
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'post_status '   => $post_status
		);

		$posts = get_posts($args);
		foreach ($posts as $post_val) {
			$return[$post_val->ID] = $post_val->post_title;
		}

		return $return;
	}

	function get_posts_details($post_type, $posts_per_page = -1, $post_status = 'publish', $tax_query = false)
	{
		$args_wp = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'post_status '   => $post_status
		);

		if ($tax_query) {
			$args_wp['tax_query'][] = $tax_query;
		}

		$wp_query = new WP_Query($args_wp);
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$return[get_the_ID()] = array(
				'name'        => get_the_title(),
				'description' => get_the_content(),
				'thumbnail'   => get_post_thumbnail_id()
			);
		}
		wp_reset_postdata();

		return $return;
	}

	function get_posts_ids($post_type, $posts_per_page = -1, $post_status = 'publish', $tax_query = false)
	{
		$args_wp = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'post_status '   => $post_status
		);

		if ($tax_query) {
			$args_wp['tax_query'][] = $tax_query;
		}

		$wp_query = new WP_Query($args_wp);
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$return[get_the_ID()] = get_the_title();
		}
		wp_reset_postdata();

		return $return;
	}

	function get_image_alt($val)
	{
		$image_alt = get_post_meta($val, '_wp_attachment_image_alt', TRUE);
		$image_title = get_the_title($val);
		if ($image_alt) {
			$alt = $image_alt;
		}
		else {
			$alt = $image_title;
		}
		return $alt;
	}

	function get_contact_forms()
	{
		$return = array('Select Form');
		$args_wp = array(
			'post_type'      => 'wpcf7_contact_form',
			'posts_per_page' => -1,
			'post_status '   => 'publish'
		);
		$posts = get_posts($args_wp);
		foreach ($posts as $post_val) {
			$shortcode = '[contact-form-7 id="' . $post_val->ID . '" title="' . $post_val->post_title . '"]';
			$return[$shortcode] = $post_val->post_title;
		}
		wp_reset_postdata();
		return $return;
	}

	function get_contact_form_box($contact_form)
	{
		if ($contact_form) {
			ob_start();
			?>
			<div class="contact-form-box" data-aos="fade-up">
				<?= do_shortcode($contact_form) ?>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	function pagination($the_query)
	{
		$total_pages = $the_query->max_num_pages;
		$big = 999999999;
		if ($total_pages > 1) {
			$current_page = max(1, get_query_var('paged'));
			echo '<div class="pagination">';
			echo paginate_links(
				array(
					'prev_text' => '<span><i class="fas fa-chevron-left"></i></span>',
					'next_text' => '<span><i class="fas fa-chevron-right"></i></span>',
					'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'    => '?paged=%#%',
					'current'   => $current_page,
					'total'     => $total_pages,

				)
			);
			echo '</div>';
		}
	}

	function get_title()
	{
		if (is_tax()) {
			$term = get_queried_object();
			$args = array(
				'heading' => $term->name
			);
			return $this->get_heading($args);
		}
		else {
			$alt_title = carbon_get_the_post_meta('alt_title');

			if ($alt_title) {
				$args = array(
					'heading' => $alt_title
				);
				return $this->get_heading($args);
			}
			else {
				$args = array(
					'heading' => get_the_title()
				);
				return $this->get_heading($args);
			}
		}
	}

	function get_background_image($background, $size = 'full')
	{
		$background_url = wp_get_attachment_image_url($background, $size);
		if ($background_url) {
			return 'style="background-image: url(' . $background_url . ')"';
		}
	}

	function get_data_aos($data_aos)
	{
		if ($data_aos) {
			return 'data-aos="' . $data_aos . '"';
		}
	}

	function get_class($class)
	{
		if ($class) {
			return ' ' . $class;
		}
	}

	function get_attributes($class, $id, $template_class)
	{
		$attributes = '';
		$template_class_val = $template_class ? $template_class . ' has-edit' : '';
		if ($class) {
			$attributes .= 'class="' . $class . ' ' . $template_class_val . '"';
		}

		if ($id) {
			$attributes .= 'id="' . $id . '"';
		}

		return $attributes;
	}

	function product_price($product_id)
	{
		if (is_user_logged_in()) {
			$customer_type = carbon_get_user_meta(get_current_user_id(), 'customer_type');
		}
		else {
			$customer_type = 'business';
		}

		$product = wc_get_product($product_id);

		if ($product->get_price()) {


			if ($customer_type == 'consumer') {
				if ($product->get_type() == 'simple') {
					$price_val = $product->get_price() + ($product->get_price() * .2);
					$price = '£' . number_format($price_val, 2, '.', ',') . ' Incl. VAT';
				}
				else {
					$min = $product->get_variation_regular_price('min');
					$max = $product->get_variation_regular_price('max');

					if ($min == $max) {
						$price_val = $product->get_price() + ($min * .2);
						$price = '£' . number_format($price_val, 2, '.', ',') . ' Incl. VAT';
					}
					else {
						$price_val_min = number_format($min + ($min * .2), 2, '.', ',');
						$price_val_max = number_format($max + ($max * .2), 2, '.', ',');

						$price = '£' . $price_val_min . ' - £' . $price_val_max . ' Incl. VAT';
					}

				}
			}
			else {
				$price = $product->get_price_html();

			}
			if ($product->get_price() == '0.00') {
				$price = 'FREE';
			}
			return $price . $c;
		}
	}


	function product_price_cart($product_id, $quantity = false)
	{
		$customer_type = carbon_get_user_meta(get_current_user_id(), 'customer_type');
		$product = wc_get_product($product_id);

		if ($product->get_price()) {
			if ($quantity) {
				$price_x_qty = $product->get_price() * $quantity;
				$price_val = $price_x_qty + ($price_x_qty * .2);

			}
			else {
				$price_val = $product->get_price() + ($product->get_price() * .2);

			}
			$price = '<span class="woocommerce-Price-amount"> £' . number_format($price_val, 2, '.', ',') . '</span> Incl. VAT';
			return $price;
		}
	}

	function add_to_cart($product_id)
	{
		ob_start();
		$product = wc_get_product($product_id);
		$name = $product->get_name();
		$type = $product->get_type();
		$variation_radio = false;
		$variation_radio_value = false;
		$stock_status = $product->get_stock_status();
		$price = $this->product_price($product_id);

		if ($type == 'variable') {
			$count = count($product->get_children());
			if ($count == 2) {
				$variation_radio = true;
				$variation_radio_value = $product->get_children();
			}
		}
		if (is_product()) {
			$class1 = 'flex-column align-items-start';
			$class2 = 'col-12';
		}
		else {
			$class1 = 'justify-content-between align-items-center';
			$class2 = 'col-lg-6';
		}
		?>
		<?php if ($stock_status == 'instock') { ?>
			<div
				class="inner product-add-to-cart-holder product-<?= $type ?> <?= $product->is_sold_individually() ? 'sold-individually' : '' ?> <?= $product->is_downloadable('yes') ? 'downloadable' : '' ?>">
				<?php if ($price) { ?>
					<div
						class="row g-3 align-items-center justify-content-between <?= $variation_radio ? 'is-variation-radio' : 'is-not-variation-radio' ?>">
						<?php if ($variation_radio) { ?>
							<?php
							?>
							<div class="<?= $class2 ?>">
								<div class="column-holder">
									<?php if (is_product()) { ?>
										<div class="price-box">
											<?= $price ?>
										</div>
									<?php } ?>

									<div class="variation-radio d-inline-flex">
										<?php foreach ($variation_radio_value as $variation_radio_val) { ?>
											<?php
											$variation_name = wc_get_product($variation_radio_val)->get_name();
											$variation_name = str_replace($name . ' - ', '', $variation_name);
											?>
											<input type="radio" id="variation-<?= $variation_radio_val ?>" product-name="<?= $variation_name ?>"
												value="<?= $variation_radio_val ?>" name="variation-radio">
											<label for="variation-<?= $variation_radio_val ?>"
												class="d-flex align-items-center text-center justify-content-center"> <?= $variation_name ?> </label>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php }
						else { ?>
							<?php if (is_product()) { ?>
								<div class="price-box mb-0">
									<?= $price ?>
								</div>
							<?php } ?>
						<?php } ?>
						<div class="<?= $variation_radio ? $class2 : 'col' ?> col-add-to-cart">
							<?php if (!is_product()) { ?>
								<div class="column-holder d-flex  <?= $class1 ?> ">
									<div class="price-box">
										<?= $price ?>
									</div>
								<?php } ?>
								<div class="add-to-cart-box">
									<?php
									echo do_shortcode('[add_to_cart_form id="' . $product_id . '"]');
									?>
								</div>
							</div>
						</div>
					</div>
				<?php }
				else { ?>
					<?php if (!is_product()) { ?>
						<?php $Theme_Options = new Theme_Options; ?>
						<div class="button-group-box">
							<?php
							$DisplayData = new DisplayData;
							if (get__theme_option('product_enquire_button_button_type')) {
								$DisplayData->button(
									get__theme_option('product_enquire_button_button_text'),
									get__theme_option('product_enquire_button_' . get__theme_option('product_enquire_button_button_type')),
									get__theme_option('product_enquire_button_button_action'),
									get__theme_option('product_enquire_button_button_icon'),
									'button-bordered ',
									false,
									get__theme_option('product_enquire_button_button_attribute'),
								);
							}
							?>
							<div class="button-box button-accent">
								<a href="<?= get_permalink($product_id) ?>">VIEW PRODUCT</a>
							</div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php }
		else { ?>
			<?php if (!is_product()) { ?>
				<div class="inner">
					<?php $Theme_Options = new Theme_Options; ?>
					<div class="button-group-box">
						<?php
						$DisplayData = new DisplayData;
						if (get__theme_option('product_enquire_button_button_type')) {
							$DisplayData->button(
								get__theme_option('product_enquire_button_button_text'),
								get__theme_option('product_enquire_button_' . get__theme_option('product_enquire_button_button_type')),
								get__theme_option('product_enquire_button_button_action'),
								get__theme_option('product_enquire_button_button_icon'),
								'button-bordered',
								false,
								get__theme_option('product_enquire_button_button_attribute'),
							);
						}
						?>
						<div class="button-box button-accent">
							<a href="<?= get_permalink($product_id) ?>">VIEW PRODUCT</a>
						</div>
					</div>
				</div>
			<?php }
			else if ($stock_status == 'outofstock') { ?>
					<div class="out-of-stock">
						<p>
							OUT OF STOCK
						</p>
					</div>
			<?php }
			else { ?>
					<div class="on-backorder">
						<p>
							ON BACKORDER
						</p>
					</div>
			<?php } ?>

		<?php } ?>
		<?php
		return ob_get_clean();
	}

	function need_help($product_id)
	{
		$DisplayData = new DisplayData;
		$Theme_Options = new Theme_Options;
		$SVG = new SVG;
		$button_type = get__post_meta_by_id($product_id, 'button_type');
		$cst_btn_link = get__post_meta_by_id($product_id, 'cst_btn_text');
		$cst_btn_text = get__post_meta_by_id($product_id, 'cst_btn_link');
		$finance_available = get__post_meta_by_id($product_id, 'finance_available');
		$business_invoicing = get__post_meta_by_id($product_id, 'business_invoicing');
		$product = wc_get_product($product_id);
		?>
		<div class="need-help text-center content-margin">
			<div class="heading-box">
				<h4>
					NEED HELP BUYING?
				</h4>
			</div>

			<div class="button-group-box justify-content-center">
				<div class="button-box  button-bordered button-small">
					<?= $Theme_Options->contact_number ?>
				</div>
				<?php
				if (!$product->get_price()) {
					if ($button_type) {
						if ($button_type == 'replace_enquire_button') {
							$button_link = $cst_btn_link;
							$button_text = $cst_btn_text;
						}
						else {
							$button_link = '#product-tabs';
							$button_text = 'REQUEST INFO';
						}
						?>
						<div class="button-box  button-secondary button-small">
							<a href="<?= $button_link ?>" class="<?= $button_type == 'link_to_form' ? 'open-enquire-tab' : '' ?>">
								<span class="text"><?= $button_text ?></span>
							</a>
						</div>
						<?php
					}
					else {
						if (get__theme_option('product_enquire_button_button_type')) {
							$DisplayData->button(
								get__theme_option('product_enquire_button_button_text'),
								get__theme_option('product_enquire_button_' . get__theme_option('product_enquire_button_button_type')),
								get__theme_option('product_enquire_button_button_action'),
								get__theme_option('product_enquire_button_button_icon'),
								'button-secondary button-small',
								false,
								get__theme_option('product_enquire_button_button_attribute'),
							);
						}
					}
				}
				?>
			</div>

			<div class="list-icon-box">
				<ul class="list-icon d-flex justify-content-center flex-wrap">
					<?php if ($finance_available) { ?>
						<li>
							<span class="icon"><?= $SVG->check ?></span>
							<span class="text">0% financing available</span>
						</li>
					<?php } ?>
					<?php if ($business_invoicing) { ?>
						<li>
							<span class="icon"><?= $SVG->check ?></span>
							<span class="text">Business invoicing</span>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php
	}

}