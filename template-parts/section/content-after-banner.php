<?php
if (!is_404()) {
	$after_banner = get__theme_option('after_banner');
	$Modules = new Modules();
	foreach ($after_banner as $position => $after_header_template) {

		if (is_post_type_archive('equipments')) {
			$equpment = get__theme_option('equipment_hide_after_header_' . $after_header_template['template']);
			if (!$equpment) {
				$Modules->modules_section($after_header_template['template'], true, $position, $after_header_template['class']);
			}
		} else {
			$post_meta = get__post_meta('hide_after_header_' . $after_header_template['template']);
			if (!$post_meta) {
				$Modules->modules_section($after_header_template['template'], true, $position, $after_header_template['class']);
			}
		}
	}
}
