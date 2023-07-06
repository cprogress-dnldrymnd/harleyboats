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


	<header class="py-2">
		<div class="header-inner">
			<div class="header-main ">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-6">
							<div class="column-holder">
								<div class="site-logo-holder position-relative">
									<a href="<?= get_site_url() ?>" class="site-logo">
										<img src="https://used.hartleyboats.com/wp-content/uploads/2023/07/hbc_logo_wht.png" alt="">
									</a>
								</div>
							</div>
						</div>
						<div class="col-md-9 col-6">
							<div class="column-holder">

								<button class="btn btn-primary d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasMenu"
									aria-controls="offCanvasMenu">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list"
										viewBox="0 0 16 16">
										<path fill-rule="evenodd"
											d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
									</svg>
								</button>
								<div class="offcanvas offcanvas-start" tabindex="-1" id="offCanvasMenu"
									aria-labelledby="offCanvasMenuLabel">
									<div class="offcanvas-header d-block d-lg-none">
										<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
											aria-label="Close"></button>
									</div>
									<div class="offcanvas-body">
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
		</div>
	</header>


	<main id="main">

		<?php do_action('after_open_main') ?>