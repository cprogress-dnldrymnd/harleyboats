<!DOCTYPE html>
<html <?php language_attributes(); ?> class="coptrz-html">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="author" content="">
	<meta name="format-detection" content="telephone=no">
	<title>
		<?php bloginfo('name'); // show the blog name, from settings 
		?> |
		<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page 
		?>
	</title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

	<!--[if lte IE 9]>
		<link href="stylesheets/non-responsive.css" rel="stylesheet" />
	<![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body <?php body_class(); ?>>

	<!--[if lt IE 9]>
		<div id="browser-notification" class="alert alert-danger">
			<div class="container">
				We are sorry but it looks like your <a href="http://www.whatbrowser.org/intl/en_us/" target=_blank>browser</a> doesn't support our website features. In order to get the full experience please download a new version of <a title="Download Chrome" href="http://www.google.com/chrome/" target=_blank>Chrome</a>, <a title="Download Safari" href="http://www.apple.com/safari/download/" target=_blank>Safari</a>, <a title="Download Firefox" href="http://www.mozilla.com/firefox/" target=_blank>Firefox</a>, or <a title="Download Internet Explorer" href="http://www.microsoft.com/windows/internet-explorer/default.aspx" target=_blank>Internet Explorer</a>.
			</div>
		</div>
	<![endif]-->
	<?php do_action('body_scripts') ?>


	<header>
		<div class="header-inner">
			<div class="header-main ">
				<div class="container">
					<div class="row align-items-center justify-content-between align-items-center gy-3 row-holder">
						<div class="col col-lg-auto col-logo">
							<div class="column-holder">
								<div class="site-logo-holder position-relative">
									<a href="<?= get_site_url() ?>" class="site-logo">

									</a>
								</div>
							</div>
						</div>
						<div class="col-auto col-menu d-flex align-self-stretch align-items-center justify-content-end">
							<div class="column-holder h-lg-100">
								<div class="h-lg-100">
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'header-menu',
											'container'      => false,
											'menu_class'     => '',
											'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
											'items_wrap'     => '<ul id="%1$s" class="navbar-nav align-items-center h-100 %2$s">%3$s</ul>',
											'depth'          => 3,
											'walker'         => new bootstrap_5_wp_nav_menu_walker()
										)
									);
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>


	<main id="main">

		<?= single_product_summary(get_the_ID()) ?>

		<?php do_action('after_open_main') ?>