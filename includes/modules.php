<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;

class Modules
{
	function modules_post_meta()
	{
		global $modules_section;
		$modules = Field::make('complex', 'modules', __(''));
		$ModulesFields = new ModulesFields();

		foreach ($modules_section as $section) {
			$modules->add_fields($section['id'], $ModulesFields->{$section['id'] . '_fields'}());
			$modules->set_header_template($section['label'] . '<% if (title) { %>[<%- title %>] <% } %>');
		}
		$modules->set_collapsed(true);
		return $modules;
	}
	function module_template($section_type)
	{
		return locate_template('/template-parts/modules/_' . $section_type . '.php');
	}
	function modules_section_field($id = '')
	{
		return carbon_get_post_meta($id, 'modules');
	}
	function modules_section($id, $templates = false, $position = '', $class = '')
	{
		$Helpers = new Helpers;
		$GetData = new GetData;
		$modules = $this->modules_section_field($id);
		foreach ($modules as $key => $module) {
			$section_type = $module['_type'];
			$disable_module = $module['disable_module'];
			$background_color = $module['background_color'];
			$padding_top = $module['padding_top'];
			$padding_bottom = $module['padding_bottom'];
			$margin_top = $module['margin_top'];
			$margin_bottom = $module['margin_bottom'];
			$spacings = $padding_top . ' ' . $padding_bottom . ' ' . $margin_top . ' ' . $margin_bottom;
			$pos = $position ? '-' . $position : '';
			global $section_id, $template_class;

			if ($section_type == 'two_columns_v3') {
				$class .= ' two-columns-v2';
			}
			if ($templates) {
				$template_class = $class . ' template-' . $id . ($pos);
				$postid = $id;
			}
			else {
				$template_class = '';
				$postid = '';
			}
			$section_id = $module['_type'] . '-' . get_the_ID() . '-' . $key . $pos;
			$id = isset($module['id']) ? $module['id'] : '';
			$module_id = $id != '' ? $id : $section_id;

			switch ($section_type) {
				case $section_type:
					if (!$disable_module) {
						echo '<section ' . $GetData->get_attributes(str_replace('_', '-', $section_type) . $class . ' ' . $background_color . ' ' . $spacings, str_replace('_', '-', $module_id), str_replace('_', '-', $template_class)) . '>';
						if ($template_class) {
							echo $Helpers->get_edit_url('post.php?post=' . $postid . '&action=edit', 'Edit Template');
						}
						include($this->module_template($section_type));
						echo '</section>';
					}
					break;
			}
		}
	}
}