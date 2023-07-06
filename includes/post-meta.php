<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;

class PostMeta extends GetData
{
	function _button($id, $separator = '')
	{
		$link_type = array(
			''                => 'None',
			'page_button'     => 'Page',
			'post_button'     => 'Post',
			'services_button' => 'Service',
			'custom_button'   => 'Custom',
		);

		$buttons = array(
			Field::make('select', $id . '_button_type', __('Button Type'))
				->set_width(10)
				->set_options($link_type),
			Field::make('text', $id . '_button_text', 'Button Text')
				->set_help_text('Leave blank to use post title. Does not work with custom button')
				->set_width(20)
				->set_conditional_logic(
					array(
						array(
							'field'   => $id . '_button_type',
							'value'   => array('page_button', 'post_button', 'services_button', 'custom_button'),
							'compare' => 'IN'
						)
					)
				),
			Field::make('select', $id . '_page_button', 'Page Link')
				->set_width(20)
				->set_options($this->get_posts('page'))
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'page_button',
						)
					)
				),
			Field::make('select', $id . '_post_button', 'Post Link')
				->set_options($this->get_posts('post'))
				->set_width(20)
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'post_button',
						)
					)
				),
			Field::make('select', $id . '_services_button', 'Service Link')
				->set_width(20)
				->set_options($this->get_posts('services'))
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'services_button',
						)
					)
				),
			Field::make('text', $id . '_custom_button', 'Custom Link')
				->set_width(20)
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'custom_button',
						)
					)
				),
			Field::make('select', $id . '_button_action', 'Button Action')
				->set_options(
					array(
						''                => 'Same Window',
						'target="_blank"' => 'New Tab',
					)
				)
				->set_width(20)
				->set_conditional_logic(
					array(
						array(
							'field'   => $id . '_button_type',
							'value'   => array('page_button', 'post_button', 'services_button', 'custom_button'),
							'compare' => 'IN'
						)
					)
				),
			Field::make('text', $id . '_button_attribute', 'Button Attribute')
				->set_width(15),
			Field::make('select', $id . '_button_icon', 'Button Icon')
				->set_conditional_logic(
					array(
						array(
							'field'   => $id . '_button_type',
							'value'   => array('page_button', 'post_button', 'services_button', 'custom_button'),
							'compare' => 'IN'
						)
					)
				)
				->set_options(svg_list())
				->set_classes('select-button-icon ')
				->set_width(10),
			/*Field::make('html',  $id . '_button_select_icon', 'Select Icon')
																																																																			 ->set_html('<a class="button button-primary button-large thickbox select-icon" href="#TB_inline?width=600&height=550&inlineId=modal-svg-" >SELECT ICON</a>')
																																																																			 ->set_conditional_logic(array(
																																																																			 array(
																																																																			 'field' => $id . '_button_type',
																																																																			 'value' => array('page_button', 'post_button', 'services_button', 'custom_button'),
																																																																			 'compare' => 'IN'
																																																																			 )
																																																																			 ))
																																																																			 ->set_width(20)*/

		);

		if ($separator) {
			return array_merge(
				array(
					Field::make('html', $id . '_sep')
						->set_html('<label>' . $separator . '</label>')
						->set_classes('seperator ')
				),
				$buttons
			);
		}
		else {
			return $buttons;
		}
	}

	function _button_full_width($id, $separator = '')
	{
		$link_type = array(
			''                => 'None',
			'page_button'     => 'Page',
			'post_button'     => 'Post',
			'services_button' => 'Service',
			'custom_button'   => 'Custom',
		);

		$buttons = array(
			Field::make('select', $id . '_button_type', __('Button Type'))
				->set_options($link_type),
			Field::make('text', $id . '_button_text', 'Button Text')
				->set_help_text('Leave blank to use post title. Does not work with custom button')
				->set_conditional_logic(
					array(
						array(
							'field'   => $id . '_button_type',
							'value'   => array('page_button', 'post_button', 'services_button', 'custom_button'),
							'compare' => 'IN'
						)
					)
				),
			Field::make('select', $id . '_page_button', 'Page Link')
				->set_options($this->get_posts('page'))
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'page_button',
						)
					)
				),
			Field::make('select', $id . '_post_button', 'Post Link')
				->set_options($this->get_posts('post'))
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'post_button',
						)
					)
				),
			Field::make('select', $id . '_services_button', 'Service Link')
				->set_options($this->get_posts('Service_button'))
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'services_button',
						)
					)
				),
			Field::make('text', $id . '_custom_button', 'Custom Link')
				->set_conditional_logic(
					array(
						array(
							'field' => $id . '_button_type',
							'value' => 'custom_button',
						)
					)
				),
			Field::make('select', $id . '_button_action', 'Button Action')
				->set_options(
					array(
						''                => 'Same Window',
						'target="_blank"' => 'New Tab',
					)
				)
				->set_conditional_logic(
					array(
						array(
							'field'   => $id . '_button_type',
							'value'   => array('page_button', 'post_button', 'services_button', 'custom_button'),
							'compare' => 'IN'
						)
					)
				),
			Field::make('select', $id . '_button_icon', 'Button Icon')
				->set_conditional_logic(
					array(
						array(
							'field'   => $id . '_button_type',
							'value'   => array('page_button', 'post_button', 'services_button', 'custom_button'),
							'compare' => 'IN'
						)
					)
				)
				->set_options(svg_list())

		);

		if ($separator) {
			return array_merge(
				array(
					Field::make('html', $id . '_sep')
						->set_html('<label>' . $separator . '</label>')
						->set_classes('seperator ')
				),
				$buttons
			);
		}
		else {
			return $buttons;
		}
	}

	function after_banner_fields($id = '')
	{
		$after_banner = carbon_get_theme_option('after_banner');
		$after_banner_container_fields = array();
		foreach ($after_banner as $after_banner_template) {
			$after_banner_container_fields[] = Field::make('checkbox', $id . 'hide_after_header_' . $after_banner_template['template'], 'HIDE ' . strtoupper(get_the_title($after_banner_template['template'])));
		}
		return $after_banner_container_fields;
	}

	function before_footer_fields($id = '')
	{
		$after_banner = carbon_get_theme_option('before_footer');
		$after_banner_container_fields = array();
		foreach ($after_banner as $after_banner_template) {
			$after_banner_container_fields[] = Field::make('checkbox', $id . 'hide_before_footer_' . $after_banner_template['template'], 'HIDE ' . strtoupper(get_the_title($after_banner_template['template'])));
		}
		return $after_banner_container_fields;
	}
}
class ModulesFields extends GetData
{
	function before_module_fields()
	{
		return array(
			Field::make('html', 'before_module_sep')->set_html('<label>TITLE AND SECTION ID</label>')->set_classes('seperator '),
			Field::make('text', 'title', 'Title')->set_width(33),
			Field::make('text', 'id', 'Section ID')->set_width(33),
			Field::make('checkbox', 'disable_module', 'Disable Module')->set_width(33),
			Field::make('html', 'before_module_sep_2')->set_html('<label>SECTION OPTIONS</label>')->set_classes('seperator '),
			Field::make('select', 'padding_top', 'Padding Top')->set_width(20)
				->set_options(
					array(
						''                => 'None',
						'xxs-padding-top' => 'Extra Small',
						'sm-padding-top'  => 'Small',
						'md-padding-top'  => 'Medium',
						'lg-padding-top'  => 'Large',
						'xl-padding-top'  => 'Extra Large',
					)
				),
			Field::make('select', 'padding_bottom', 'Padding Bottom')->set_width(20)
				->set_options(
					array(
						''                   => 'None',
						'xxs-padding-bottom' => 'Extra Small',
						'sm-padding-bottom'  => 'Small',
						'md-padding-bottom'  => 'Medium',
						'lg-padding-bottom'  => 'Large',
						'xl-padding-bottom'  => 'Extra Large',
					)
				),
			Field::make('select', 'margin_top', 'Margin Top')->set_width(20)
				->set_options(
					array(
						''               => 'None',
						'xxs-margin-top' => 'Extra Small',
						'sm-margin-top'  => 'Small',
						'md-margin-top'  => 'Medium',
						'lg-margin-top'  => 'Large',
						'xl-margin-top'  => 'Extra Large',
					)
				),
			Field::make('select', 'margin_bottom', 'Margin Bottom')->set_width(20)
				->set_options(
					array(
						''                  => 'None',
						'xxs-margin-bottom' => 'Extra Small',
						'sm-margin-bottom'  => 'Small',
						'md-margin-bottom'  => 'Medium',
						'lg-margin-bottom'  => 'Large',
						'xl-margin-bottom'  => 'Extra Large',
					)
				),
			Field::make('select', 'background_color', 'Background Color')
				->set_options(
					array(
						''                     => 'None',
						'background-black'     => 'Black/Primary',
						'background-secondary' => 'Gray/Secondary',
						'background-accent'    => 'Accent',
						'background-body'      => 'Light',
						'background-white'     => 'White',
					)
				)->set_width(20)
		);
	}

	function module_fields($module_fields)
	{
		return $module_fields;
	}

	function templates_fields()
	{
		return array(
			Field::make('text', 'title', 'Title'),
			Field::make('select', 'template', 'Template')
				->set_options($this->get_posts('templates', 'Select Template')),
		);
	}
	function tabs_center_content_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('text', 'heading_prefix', 'Heading Prefix'),
					Field::make('text', 'heading', 'Heading'),
					Field::make('complex', 'items', 'Items')
						->add_fields(
							array(
								Field::make('image', 'icon', 'Icon'),
								Field::make('text', 'heading', 'Heading'),
								Field::make('textarea', 'description', 'Description'),
								Field::make('image', 'image', 'Image'),
								Field::make('image', 'image_top_right', 'Top right image'),
							)
						)
						->set_layout('tabbed-vertical')
						->set_header_template('<%- heading  %>')
						->set_max(4)
				),
			)
		);
	}

	function logo_slider_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('select', 'image_source', 'Image Source')
						->set_options(
							array(
								'select-from-gallery' => 'Select from Gallery',
								'custom-gallery'      => 'Custom Images',
							)
						),
					Field::make('text', 'custom_heading', 'Custom Heading')
						->set_conditional_logic(
							array(
								array(
									'field' => 'image_source',
									'value' => 'select-from-gallery',
								)
							)
						),
					Field::make('select', 'gallery', 'Gallery')
						->set_options($this->get_posts('galleries', 'Select Gallery'))
						->set_conditional_logic(
							array(
								array(
									'field' => 'image_source',
									'value' => 'select-from-gallery',
								)
							)
						),
					Field::make('media_gallery', 'custom_gallery', 'Images')
						->set_conditional_logic(
							array(
								array(
									'field' => 'image_source',
									'value' => 'custom-gallery'
								)
							)
						),

				),
			)
		);
	}
	function featured_product_slider_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('html', 'seperator_2')->set_html('<h2> This section will display featured products </h2>'),
				),
			)
		);
	}

	function parallax_image_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('image', 'image', 'Image'),
				),
			)
		);
	}

	function scrolling_section_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),

					Field::make('multiselect', 'featured_posts', 'Featured Posts')
						->set_options($PostMeta->get_posts('post', 'Select Posts')),

				)
			)
		);
	}
	function cta_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array_merge(
					array(
						Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
						Field::make('text', 'heading', 'Heading'),
						Field::make('textarea', 'description', 'Description'),
						Field::make('file', 'background', 'Background')->set_width(20)
							->set_help_text('Select Image/Video Background'),
						Field::make('select', 'style', 'Style')
							->set_options(
								array(
									'style-1' => 'Style 1',
									'style-2' => 'Style 2',
								)
							)
					),
					$PostMeta->_button('cta', 'Button')
				)
			)
		);
	}




	function customer_reviews_fields()
	{
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('html', 'testimonial')
						->set_html('This module will display testimonial. Manage testitimonial <a target="_blank" href="/wp-admin/edit.php?post_type=testimonials"> here </a>.'),
				)
			)
		);
	}

	function accordion_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('complex', 'accordion_items', 'Accordion Items')
						->add_fields(
							array(
								Field::make('text', 'heading', 'Heading'),
								Field::make('textarea', 'description', 'Description'),

							)
						)
						->set_layout('tabbed-vertical')
						->set_header_template('<%- heading  %>')

				)
			)
		);
	}

	function slider_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('text', 'left_title', 'Left Title'),
					Field::make('text', 'heading', 'Heading'),
					Field::make('complex', 'slider_items', 'Slider Items')
						->add_fields(
							array_merge(
								array(
									Field::make('image', 'image', 'image'),
									Field::make('text', 'heading', 'Heading'),
									Field::make('rich_text', 'description', 'Description'),

								),
								$PostMeta->_button('slider', 'BUTTON'),
							)
						)
						->set_layout('tabbed-vertical')
						->set_header_template('<%- heading  %>')

				)
			)
		);
	}
	function two_columns_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array_merge(
					array(
						Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
						Field::make('image', 'image', 'Image'),
						Field::make('text', 'heading_small', 'Heading Small'),
						Field::make('text', 'heading', 'Heading'),
						Field::make('rich_text', 'description', 'Description'),
						Field::make('select', 'columns_width', 'Columns Width')
							->set_options(
								array(
									'3' => '3-9',
									'4' => '4-8',
									'5' => '5-7',
									'6' => '6-6',
									'7' => '7-5',
									'8' => '8-4',
									'9' => '9-3',
								)
							)
					),
					$PostMeta->_button('two_col_1', 'BUTTON'),
				)
			)
		);
	}


	function two_columns_v2_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array_merge(
					array(
						Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
						Field::make('text', 'left_title', 'Left Title'),
						Field::make('text', 'heading', 'Heading'),
						Field::make('select', 'columns_width', 'Columns Width')
							->set_options(
								array(
									'3' => '3-9',
									'4' => '4-8',
									'5' => '5-7',
									'6' => '6-6',
									'7' => '7-5',
									'8' => '8-4',
									'9' => '9-3',
								)
							),
						Field::make('rich_text', 'column_1', 'Column 1')->set_width(50),
						Field::make('rich_text', 'column_2', 'Column 2')->set_width(50),

					),
					$PostMeta->_button('two_col_1', 'BUTTON'),
				)
			)
		);
	}

	function two_columns_v3_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array_merge(
					array(
						Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
						Field::make('select', 'box_background_color', 'Box Background Color')
							->set_options(
								array(
									''                     => 'None',
									'background-black'     => 'Black/Primary',
									'background-secondary' => 'Gray/Secondary',
									'background-accent'    => 'Accent',
									'background-body'      => 'Light',
									'background-white'     => 'White',
								)
							),
						Field::make('image', 'image', 'Image'),
						Field::make('text', 'heading', 'Heading'),
						Field::make('rich_text', 'description', 'Description'),
						Field::make('select', 'columns_width', 'Columns Width')
							->set_options(
								array(
									'3' => '3-9',
									'4' => '4-8',
									'5' => '5-7',
									'6' => '6-6',
									'7' => '7-5',
									'8' => '8-4',
									'9' => '9-3',
								)
							)
					),
					$PostMeta->_button('two_col_1', 'BUTTON'),
				)
			)
		);
	}


	function contact_form_fields()
	{

		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<label>CONTENTS</label>')->set_classes('seperator '),
					Field::make('text', 'heading', 'Heading'),
					Field::make('select', 'contact_form', 'Contact Form')
						->set_options($this->get_contact_forms())
				)
			)
		);
	}

	function vendor_fields()
	{

		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(
				array(
					Field::make('html', 'seperator_1')->set_html('<h3>THIS WILL DISPLAY THE VENDOR SLIDER</h3>'),
				)
			)
		);
	}
}


/*-----------------------------------------------------------------------------------*/
/* Theme Settings
/*-----------------------------------------------------------------------------------*/
class ThemeOptionsMeta extends PostMeta
{
	function theme_options()
	{
		global $theme_settings;
		$theme_settings_container = Container::make('theme_options', __('Theme Settings'))->set_page_parent('themes.php');
		foreach ($theme_settings as $theme_setting) {
			$theme_settings_container->add_tab($theme_setting['label'], $this->{$theme_setting['id'] . '_fields'}());
		}
		return $theme_settings_container;
	}

	function theme_options_single()
	{
		global $theme_settings;

		foreach ($theme_settings as $theme_setting) {
			$theme_settings_container = Container::make('theme_options', __('→' . $theme_setting['label']))->set_page_parent('themes.php');
			$theme_settings_container->add_fields($this->{$theme_setting['id'] . '_fields'}());
		}
		return $theme_settings_container;
	}

	function general_settings_fields()
	{
		return array(
			Field::make('checkbox', 'disable_gutenberg', 'Disable Gutenberg'),
			Field::make('image', 'placeholder_image', 'Placeholder Image'),
		);
	}
	function brand_details_fields()
	{
		return array(
			Field::make('html', 'site_logo_html')->set_html('<label> SITE LOGO </label>')->set_classes('seperator '),
			Field::make('image', 'logo', 'Logo')->set_width(33),
			Field::make('image', 'alt_logo', 'Alt Logo')->set_width(33),
			Field::make('html', 'contact_details_html')->set_html('<label> CONTACT DETAILS </label>')->set_classes('seperator '),
			Field::make('text', 'contact_number', 'Contact Number'),
			Field::make('text', 'email_address', 'Email Address'),
			Field::make('html', 'social_html')->set_html('<label> SOCIALS </label>')->set_classes('seperator '),
			Field::make('text', 'facebook_url', 'Facebook URL'),
			Field::make('text', 'twitter_url', 'Twitter URL'),
			Field::make('text', 'linkedin_url', __('Linkedin URL')),
			Field::make('text', 'youtube_url', __('Youtube URL')),
			Field::make('html', 'where_html')->set_html('<label> WHERE TO FIND US </label>')->set_classes('seperator '),
			Field::make('rich_text', 'address', ''),
			Field::make('html', 'opening_times_html')->set_html('<label> OPENING TIMES </label>')->set_classes('seperator '),
			Field::make('rich_text', 'opening_times', ''),


		);
	}

	function header_settings_fields()
	{
		$PostMeta = new PostMeta;
		return array_merge(
			array(
				Field::make('html', 'shop_mega_menu_html')->set_html('<label>SHOP MEGA MENU</label>')->set_classes('seperator '),
				Field::make('association', 'shop_mega_menu', __(''))
					->set_types(
						array(
							array(
								'type'      => 'post',
								'post_type' => 'page',
							),
							array(
								'type'      => 'post',
								'post_type' => 'post',
							),
							array(
								'type'     => 'term',
								'taxonomy' => 'category',
							),
							array(
								'type'     => 'term',
								'taxonomy' => 'product_cat',
							),
							array(
								'type'     => 'term',
								'taxonomy' => 'product_cat',
							),
							array(
								'type'     => 'term',
								'taxonomy' => 'post_tag',
							),
						)
					)
					->set_max(6)
			)
		);
	}

	function footer_settings_fields()
	{
		$PostMeta = new PostMeta;
		return array(
			Field::make('rich_text', 'copyright_text', 'Copyright Text'),
		);
	}


	function after_banner_fields($id = '')
	{
		return array(
			Field::make('complex', 'after_banner', 'Template')
				->add_fields(
					array(
						Field::make('text', 'title', 'Title'),
						Field::make('text', 'class', 'Template Class'),
						Field::make('select', 'template', 'Template')
							->set_options($this->get_posts('templates', 'Select Template')),
					)
				)
				->set_header_template('<%- title  %>')
		);
	}

	function before_footer_fields($id = '')
	{
		return array(
			Field::make('complex', 'before_footer', 'Template')
				->add_fields(
					array(
						Field::make('text', 'title', 'Title'),
						Field::make('text', 'class', 'Template Class'),
						Field::make('select', 'template', 'Template')
							->set_options($this->get_posts('templates', 'Select Template')),
					)
				)
				->set_header_template('<%- title  %>')
		);
	}
}

$ThemeOptionsMeta = new ThemeOptionsMeta();

$ThemeOptionsMeta->theme_options();

$ThemeOptionsMeta->theme_options_single();

$PostMeta = new PostMeta();

/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
/* Page Options
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Page Options')
	->where('post_type', '=', 'page')
	->set_context('side')
	->add_fields(
		array(
			Field::make('select', 'page_theme', 'Page Theme')
				->set_options(
					array(
						'background-body'  => 'Light',
						'background-black' => 'Dark',
					)
				),
			Field::make('select', 'header_type', 'Header Type')
				->set_options(
					array(
						'background-white'       => 'Light',
						'background-black'       => 'Dark',
						'background-transparent' => 'Transparent',
					)
				),




			//Field::make('checkbox', 'hide_page_banner', 'Hide Page Banner'),
		)
	);


Container::make('post_meta', 'Tag Options')
	->where('post_type', '=', 'page')
	->or_where('post_type', '=', 'product')
	->or_where('post_type', '=', 'solutions')
	->set_context('side')
	->add_fields(
		array(
			Field::make('checkbox', 'use_microsoft_ads_uet_tag', 'Use Microsoft Ads UET Tag'),
			Field::make('checkbox', 'use_linkedin_insight_tag', 'Use LinkedIn Insight Tag'),
		)
	);




/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
/* Page Banner
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', 'Page Banner')
	->where('post_type', '=', 'page')
	->where('post_template', '!=', 'elementor_header_footer')
	->set_priority('high')
	->add_fields(
		array_merge(
			array_merge(
				array(
					Field::make('select', 'hero_banner_type', 'Hero Type')
						->set_options(
							array(
								'default'           => 'Default',
								'animated'          => 'Video with animated images',
								'revealing_heading' => 'Revealing Heading',
								'none'              => 'None',
							)
						),
					Field::make('text', 'heading', 'Heading'),
					Field::make('textarea', 'description', 'Description')->set_conditional_logic(
						array(
							array(
								'field'   => 'hero_banner_type',
								'value'   => array('animated'),
								'compare' => 'IN'
							)
						)
					),
					Field::make('file', 'vide_background', 'Video Background')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('animated'),
									'compare' => 'IN'
								)
							)
						),
					Field::make('image', 'floating_image_1', 'Floating Image[1]')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('animated'),
									'compare' => 'IN'
								)
							)
						),
					Field::make('image', 'floating_image_2', 'Floating Image[2]')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('animated'),
									'compare' => 'IN'
								)
							)
						),
					Field::make('image', 'logo_image_1', 'Logo Image[1]')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('animated'),
									'compare' => 'IN'
								)
							)
						),
					Field::make('image', 'logo_image_2', 'Logo Image[2]')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('animated'),
									'compare' => 'IN'
								)
							)
						),
					Field::make('image', 'logo_image_3', 'Logo Image[3]')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('animated'),
									'compare' => 'IN'
								)
							)
						),

					Field::make('image', 'revealing_bg_1', 'Background Image 1')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('revealing_heading'),
									'compare' => 'IN'
								)
							)
						),
					Field::make('image', 'revealing_bg_2', 'Background Image 2')->set_width(20)
						->set_conditional_logic(
							array(
								array(
									'field'   => 'hero_banner_type',
									'value'   => array('revealing_heading'),
									'compare' => 'IN'
								)
							)
						),

				),
				$PostMeta->_button('cta', 'BUTTON[1]')
			), $PostMeta->_button('cta_2', 'BUTTON[2]')
		)
	);




/*-----------------------------------------------------------------------------------*/
/* Service Contents
/*-----------------------------------------------------------------------------------*/

$Modules = new Modules();

Container::make('post_meta', 'Service Contents')
	->where('post_type', '=', 'services')
	->add_tab(
		'General Settings',
		array(
			Field::make('select', 'icon_svg', 'Service Icon')
				->set_options(svg_list()),
			Field::make('rich_text', 'short_description', 'Short Description')
		)
	)
	->add_tab('Modules', array($Modules->modules_post_meta()));



/*-----------------------------------------------------------------------------------*/
/* Testimonial
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Testimonial Content')
	->where('post_type', '=', 'testimonials')
	->add_fields(
		array(
			Field::make('text', 'testimonial_title', 'Testimonial Title'),
			Field::make('textarea', 'testimonial_content', 'Testimonial Content'),
		)
	);

/*-----------------------------------------------------------------------------------*/
/* CSS, Header, Body and Footer Scripts
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Custom CSS / Header Scripts / Body Scripts / Footer Scripts')
	->set_priority('high')
	->where('post_type', '=', 'post')
	->or_where('post_type', '=', 'page')
	->or_where('post_type', '=', 'services')
	->add_fields(
		array(
			Field::make('textarea', 'page_custom_css', 'Custom CSS'),
			Field::make('header_scripts', 'page_header_scripts', __('Header Scripts')),
			Field::make('textarea', 'page_body_scripts', __('Body Scripts')),
			Field::make('footer_scripts', 'page_footer_scripts', __('Footer Scripts')),
		)
	);


/*-----------------------------------------------------------------------------------*/
/* Modules
/*-----------------------------------------------------------------------------------*/
$Modules = new Modules();
Container::make('post_meta', 'Modules')
	->set_priority('high')
	->where('post_template', '=', 'templates/modules.php')
	->or_where('post_type', '=', 'templates')
	->add_fields(array($Modules->modules_post_meta()));



/*-----------------------------------------------------------------------------------*/
/* Documentaton
/*-----------------------------------------------------------------------------------*/
/*Container::make( 'theme_options', __( 'Documentation' ) )
->add_fields(array(
$PostMeta->_html( 'docx', $PostMeta->_documentation()),
));*/

/*-----------------------------------------------------------------------------------*/
/* Header, Body and Footer Scripts
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', __('→Header, Body and Footer Scripts'))
	->set_page_parent('themes.php')
	->add_fields(
		array(
			Field::make('header_scripts', 'header_scripts', __('Header Scripts')),
			Field::make('textarea', 'body_scripts', __('Body Scripts')),
			Field::make('footer_scripts', 'footer_scripts', __('Footer Scripts'))
		)
	);




/*-----------------------------------------------------------------------------------*/
/* Testimonials
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', __('Settings'))
	->set_page_parent('edit.php?post_type=testimonials')
	->add_fields(
		array(
			Field::make('text', 'testimonial_heading', 'Heading'),
			Field::make('rich_text', 'testimonial_description', 'Description'),
		)
	);

/*-----------------------------------------------------------------------------------*/
/* After Banner
/*-----------------------------------------------------------------------------------*/
if ($PostMeta->after_banner_fields()) {
	Container::make('post_meta', 'After Banner')
		->where('post_type', '=', 'page')
		->or_where('post_type', '=', 'services')
		->set_context('side')
		->add_fields($PostMeta->after_banner_fields());
}

/*-----------------------------------------------------------------------------------*/
/* Before Footer
/*-----------------------------------------------------------------------------------*/
if ($PostMeta->before_footer_fields()) {
	Container::make('post_meta', 'Before Footer')
		->where('post_type', '=', 'page')
		->or_where('post_type', '=', 'services')
		->set_context('side')
		->add_fields($PostMeta->before_footer_fields());
}



/*-----------------------------------------------------------------------------------*/
/* Product Attributes
/*-----------------------------------------------------------------------------------*/
Container::make('term_meta', __('Category Properties'))
	->where('term_taxonomy', '=', 'pa_vendors')
	->add_fields(
		array(
			Field::make('image', 'image', __('Logo')),
			Field::make('image', 'featured_product_image', 'Featured Product Logo'),

			Field::make('complex', 'featured_boxes', 'Featured Boxes')
				->add_fields(
					array(
						Field::make('text', 'prefix', 'Prefix'),
						Field::make('text', 'heading', 'Heading'),
						Field::make('textarea', 'description', 'Description'),
						Field::make('text', 'link', 'Link'),
						Field::make('image', 'image', 'Image'),

					)
				)
				->set_layout('grid')
				->set_header_template('<%- heading  %>'),
			Field::make('checkbox', 'hide_vendor', 'Hide Vendor On Slider'),

		)
	);


/*-----------------------------------------------------------------------------------*/
/* Product Category
/*-----------------------------------------------------------------------------------*/
Container::make('term_meta', __('Category Properties'))
	->where('term_taxonomy', '=', 'product_cat')
	->add_fields(
		array(
			Field::make('checkbox', 'display_in_shop', __('Display in Shop Page')),
			Field::make('text', 'menu_order', __('Menu Order'))->set_default_value(0),
			Field::make('select', 'display_type', 'Display Type')
				->set_options(
					array(
						'slider' => 'Slider',
						'grid'   => 'Grid',
					)
				),
			Field::make('select', 'product_slider_items_width', 'Product Slider Items Width')
				->set_options(
					array(
						''       => 'Large',
						'medium' => 'Medium',
						'small'  => 'Small',
					)
				)->set_conditional_logic(
					array(
						array(
							'field'   => 'display_type',
							'value'   => 'grid',
							'compare' => '!='
						)
					)
				),

		)
	);


/*-----------------------------------------------------------------------------------*/
/* Product
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Product Components')
	->set_priority('high')
	->or_where('post_type', '=', 'product')
	->add_tab(
		'Product Options',
		array(
			Field::make('html', 'sep_1')->set_html('<label>ENQUIRE NOW BUTTON SETTINGS</label>')->set_classes('seperator '),
			Field::make('select', 'button_type', 'Button Type')
				->set_options(
					array(
						''                       => 'Default',
						'replace_enquire_button' => 'Replace enquire button text and link',
						'link_to_form'           => 'Link to a form within the page',
					)
				),

			Field::make('text', 'cst_btn_link', 'Button Text')->set_width(50)
				->set_conditional_logic(
					array(
						array(
							'field' => 'button_type',
							'value' => 'replace_enquire_button',
						)
					)
				),
			Field::make('text', 'cst_btn_text', 'Button Link')->set_width(50)
				->set_conditional_logic(
					array(
						array(
							'field' => 'button_type',
							'value' => 'replace_enquire_button',
						)
					)
				),
			Field::make('textarea', 'enquire_now_form', 'Enquire Now Form')
				->set_conditional_logic(
					array(
						array(
							'field' => 'button_type',
							'value' => 'link_to_form',
						)
					)
				),
			Field::make('html', 'sep_2')->set_html('<label>OTHER OPTIONS</label>')->set_classes('seperator '),
			Field::make('checkbox', 'finance_available', 'Finance Available?'),
			Field::make('checkbox', 'business_invoicing', 'Business Invoicing?'),
			Field::make('checkbox', 'hide_product_summary', 'Hide Product Summary'),

		)
	)
	->add_tab(
		'Featured Video',
		array(
			Field::make('text', 'featured_video_text', __('Featured Video Heading')),
			Field::make('textarea', 'featured_video_description', __('Featured Video Description')),
			Field::make('file', 'featured_video_file', __('Featured Video File')),
		)
	)
	->add_tab(
		'Specifications',
		array(
			Field::make('complex', 'specifications', '')
				->add_fields(
					array(
						Field::make('text', 'heading', 'Heading'),
						Field::make('textarea', 'description', 'Description'),
						Field::make('image', 'icon', 'Icon')
					)
				)
				->set_layout('tabbed-vertical')
				->set_header_template('<%- heading  %>')
		)
	)
	->add_tab(
		'Modules',
		array($Modules->modules_post_meta())
	);



/*-----------------------------------------------------------------------------------*/
/* Gallery
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Gallery')
	->set_priority('high')
	->or_where('post_type', '=', 'galleries')
	->add_fields(
		array(
			Field::make('media_gallery', 'media_gallery', ''),
		)
	);


/*-----------------------------------------------------------------------------------*/
/* Blogs
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', __('Settings'))
	->set_page_parent('edit.php')
	->add_fields(
		array(
			Field::make('multiselect', 'suggested_articles', 'Suggested Articles')
				->set_options($PostMeta->get_posts('post', 'Select Posts')),
			Field::make('multiselect', 'featured_posts', 'Featured Posts')
				->set_options($PostMeta->get_posts('post', 'Select Posts')),
		)
	);


/*-----------------------------------------------------------------------------------*/
/* Events
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Event Details')
	->set_priority('high')
	->or_where('post_type', '=', 'events')
	->add_fields(
		array(
			Field::make('date', 'crb_event_start_date', __('Event Start Date'))
				->set_storage_format('d/m/Y'),
			Field::make('time', 'crb_event_start_time', 'Event Start Time')
				->set_storage_format('g:i a'),

		)
	);


/*-----------------------------------------------------------------------------------*/
/* Events Category
/*-----------------------------------------------------------------------------------*/
Container::make('term_meta', __('Category Properties'))
	->where('term_taxonomy', '=', 'events_category')
	->add_fields(
		array(
			Field::make('text', 'menu_order', __('Menu Order')),
			Field::make('html', 'html_1')
				->set_html('<label>CTA</label>')
				->set_classes('seperator '),
			Field::make('text', 'heading', __('Heading')),
			Field::make('text', 'link_text', __('Link Text')),
			Field::make('text', 'link_url', __('Link URL')),

		)
	);


Container::make('user_meta', 'User Fields')
	->add_fields(
		array(
			Field::make('select', 'customer_type', 'Customer Type')
				->set_options(
					array(
						''         => 'Select',
						'business' => 'Business',
						'consumer' => 'Consumer',
					)
				),
		)
	);


/*-----------------------------------------------------------------------------------*/
/* Events
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Product Modal Description')
	->set_priority('high')
	->or_where('post_type', '=', 'product')
	->add_fields(
		array(
			Field::make('rich_text', 'product_modal_description', __(''))
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Webinar
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Webinar Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'webinars')
	->add_fields(
		array(
			Field::make('text', 'alt_title', __('Alt Title')),
			Field::make('textarea', 'description', __('Description')),
			Field::make('oembed', 'video', __('Video')),
			Field::make('text', 'minutes', __('Minutes')),
			Field::make('date', 'date', __('Date')),
			Field::make('time', 'time', __('Time')),
			Field::make('text', 'form_title', __('Form Title'))->set_help_text('Default is SAVE YOUR SEAT'),
			Field::make('textarea', 'form', __('Form')),
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Nira 3D
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Nira 3D Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'nira3d')
	->add_fields(
		array(
			Field::make('text', '3d_url', __('URL')),
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Partners
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Partner Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'partners')
	->add_fields(
		array(
			Field::make('text', 'tagline', __('Tagline')),
			Field::make('text', 'website', __('Website')),
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Team
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Team Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'team')
	->add_fields(
		array(
			Field::make('text', 'position', __('Position')),
			Field::make('text', 'linkedin', __('Linkedin')),
			Field::make('text', 'calendly', __('Calendly')),
		)
	);

/*-----------------------------------------------------------------------------------*/
/* Careers
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', 'Career Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'careers')
	->add_fields(
		array(
			Field::make('text', 'salary_and_location', __('Salary and Location')),
			Field::make('text', 'duration', __('Full Time')),
		)
	);


/*-----------------------------------------------------------------------------------*/
/* Vendor Settings
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', __('Vendor Settings'))
	->set_page_parent('edit.php?post_type=product')
	->add_fields(
		array(
			Field::make('rich_text', 'vendor_description', 'Vendor Description'),

		)
	);



/*-----------------------------------------------------------------------------------*/
/* Product Settings
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', __('Settings'))
	->set_page_parent('edit.php?post_type=product')
	->add_fields(
		array_merge(
			array_merge(
				array(
					Field::make('html', 'html_1')->set_html('<label>PRODUCT ARCHIVE PAGE CTA</label>')->set_classes('seperator '),
					Field::make('text', 'product_archive_cta_heading', 'Heading'),
					Field::make('textarea', 'product_archive_cta_description', 'Description'),
					Field::make('file', 'product_archive_cta_background', 'Background')->set_width(20)
						->set_help_text('Select Image/Video Background'),
					Field::make('select', 'product_archive_cta_style', 'Style')
						->set_options(
							array(
								'style-1' => 'Style 1',
								'style-2' => 'Style 2',
							)
						),
					Field::make('select', 'product_enquire_link', 'Enquire Now link')
						->set_options($PostMeta->get_posts('page')),
				),

				$PostMeta->_button('product_archive_cta', 'PRODUCT ARCHIVE PAGE CTA BUTTON')
			),

			$PostMeta->_button('product_enquire_button', 'PRODUCT ENQUIRE  BUTTON')

		)

	);