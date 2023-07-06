<?php
$DisplayData = new DisplayData;
$Helpers = new Helpers;
$GetData = new GetData;
$custom_heading = $module['custom_heading'];
$image_source = $module['image_source'];
$background_color = $module['background_color'];

if ($image_source == 'select-from-gallery') {
	$logo_slider = get__post_meta_by_id($module['gallery'], 'media_gallery');
} else {
	$logo_slider = $module['custom_gallery'];
}
?>
<div class="container ">
	<div class="slider-title white-color line-title d-flex align-items-center fw-medium">
		<span class="text">
			<?= $custom_heading ? $custom_heading : get_the_title($module['gallery']) ?>
		</span>
		<span class="line"></span>
	</div>
</div>
<div class="logo-slider-box md-padding">
	<div class="swiper mySwiper-logoSwiper">
		<div class="swiper-wrapper text-center align-items-center">
			<?php foreach ($logo_slider as $logo) { ?>
			<div class="swiper-slide">
				<?php
	                $DisplayData->image(
	                	array(
	                		'image_id' => $logo,
	                		'size' => 'medium'
	                	)
	                );
                    ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>