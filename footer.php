<?php
/*-----------------------------------------------------------------------------------*/
/* This template will be called by all other template files to finish 
/* rendering the page and display the footer area/content
/*-----------------------------------------------------------------------------------*/
$Helpers = new Helpers();
$hero_banner_type = get__post_meta('hero_banner_type');
$form = get__post_meta('form');
$form_title = get__post_meta('form_title');
?>


<?php if ($form && is_single()) { ?>
	<section class="lg-padding webinar-form" id="form">
		<div class="container">
			<div class="heading-box heading-elementor text-center mb-5">
				<h2><?= $form_title ? $form_title : 'SAVE YOUR SEAT' ?></h2>
			</div>
			<div class="form-box">
				<?= $form ?>
			</div>
		</div>
	</section>
<?php } ?>


<?= single_product_components() ?>

<?php
get_template_part('template-parts/footer/content', 'before-footer');

if ($hero_banner_type == 'revealing_heading') {
	echo '</div>';
}

?>
</main>
<?php if ($Helpers->is_not_quote_page()) { ?>
	<?php
	do_action('open_footer');
	get_template_part('template-parts/footer/footer', 'widgets');
	//get_template_part('template-parts/footer/footer', 'bottom');
	do_action('close_footer');
?>
<?php } ?>

<?php
if (is_archive()) {
	get_template_part('template-parts/woocommerce/product', 'modal');
}

get_template_part('template-parts/global/customer-type', 'modal');
get_template_part('template-parts/global/search', 'modal');

if (isset($_GET['customer_type']) && is_user_logged_in()) {
	carbon_set_user_meta(get_current_user_id(), 'customer_type', $_GET['customer_type']);
}

get_template_part('template-parts/woocommerce/sidecart');

?>
<?php wp_footer(); ?>
</body>
</html>

<?php do_action('wp_footer_scripts') ?>