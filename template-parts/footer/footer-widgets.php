<?php
$Theme_Options = new Theme_Options();
$footer_logo = get__theme_option('footer_logo') ? get__theme_option('footer_logo') : get__theme_option('alt_logo');
$footer_logo = $footer_logo ? $footer_logo : get__theme_option('logo');
$SVG = new SVG();
?>
<div class="footer-main background-primary sm-padding">
	<div class="container">
		<div class="row g-5">
			<div class="col footer-column-1">
				<?php if (is_active_sidebar('footer_column_1')) { ?>

					<div class="column-holder  ">
						<?php dynamic_sidebar('footer_column_1') ?>
					</div>
				</div>
			<?php } ?>
			<?php if (is_active_sidebar('footer_column_2')) { ?>

				<div class="col footer-column-2">
					<div class="column-holder">
						<?php dynamic_sidebar('footer_column_2') ?>
					</div>
				</div>
			<?php } ?>

			<?php if (is_active_sidebar('footer_column_3')) { ?>
				<div class="col footer-column-3">
					<div class="column-holder">
						<?php dynamic_sidebar('footer_column_3') ?>
					</div>
				</div>
			<?php } ?>
			<?php if (is_active_sidebar('footer_column_4')) { ?>
				<div class="col footer-column-4">
					<div class="column-holder">
						<?php dynamic_sidebar('footer_column_4') ?>
					</div>
				</div>
			<?php } ?>
			<?php if (is_active_sidebar('footer_column_5')) { ?>
				<div class="col footer-column-5">
					<div class="column-holder ">
						<?php dynamic_sidebar('footer_column_5') ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>