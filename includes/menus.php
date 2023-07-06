<?php 
/*-----------------------------------------------------------------------------------*/
/* Register main menu for Wordpress use
/*-----------------------------------------------------------------------------------*/
function menu_locations() {

	register_nav_menus(
		array(

			'header-menu'	=>	__( 'Header Menu'), 
			'mobile-menu'	=>	__( 'Mobile Menu'), 
			'footer-links'	=>	__( 'Footer Links'), 
		)

	);

}

add_action( 'init', 'menu_locations' );
/*-----------------------------------------------------------------------------------*/
/* Admim Bar
/*-----------------------------------------------------------------------------------*/
add_action('admin_bar_menu', 'add_toolbar_items', 100);

function add_toolbar_items($admin_bar) {
	global $theme_settings;

	$admin_bar->add_menu(array(
		'id'    => 'theme-settings',
		'title' => '<i style="width: 14px" class="fas fa-cog"></i> Theme Settings',
		'href'  => '/wp-admin/themes.php?page=crb_carbon_fields_container_theme_settings.php',
		'meta'  => array(
			'title' => __('Theme Settings'),
		)
	));
	foreach($theme_settings as $theme_setting) {
	

		$admin_bar->add_menu(array(
			'id'    => 'theme-settings-'.$theme_setting['id'],
			'parent' => 'theme-settings',
			'title' => '→'.$theme_setting['label'],
			'href'  => '/wp-admin/themes.php?page=crb_carbon_fields_container_'.$theme_setting['id'].'.php',
			'meta'  => array(
				'title' => __($theme_setting['label']),
			),
		));
	}
}