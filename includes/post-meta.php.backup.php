<?php
use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;

class PostMeta extends GetData {
	function _field($type, $id, $label) {
		return Field::make( $type, $id, __( $label ) );
	}
	function _text($id, $label) {
		return Field::make( 'text', $id, __( $label ) );
	}
	function _number($id, $label) { 
		return Field::make( 'text', $id, __( $label ) )->set_attribute('type', 'number');
	}
	function _textarea($id, $label) {
		return Field::make( 'textarea', $id, __( $label ) );
	}
	function _rich_text($id, $label) {
		return Field::make( 'rich_text', $id, __( $label ) );
	}
	function _file($id, $label) {
		return Field::make( 'file', $id, __( $label ) );
	}
	function _image($id = 'image', $label = 'Image') {
		return Field::make( 'image', $id, __( $label ) );
	}
	function _media_gallery($id='image_gallery', $label = 'Images') {
		return Field::make( 'media_gallery', $id, __( $label ) )
		->set_duplicates_allowed( true )
		->set_type( array( 'image') );
	}
	function _complex($id, $label, $layout='tabbed-vertical') {
		return Field::make( 'complex', $id, __( $label ) )
		->set_layout( $layout );
	}
	function _checkbox($id, $label) {
		return Field::make( 'checkbox', $id, __( $label ) );
	}
	function _documentation() {
		ob_start();
		get_template_part( 'admin/documentation' );
		return ob_get_clean();
	}
	function _button($id, $separator = '') {
		$link_type = array(
			'' => 'None',
			'page_button' => 'Page',
			'post_button' => 'Post',
			'product_button' => 'Product',
			'custom_button' => 'Custom',
		);

		$buttons = array(
			$this->_select( $id.'_button_type', 'Button Type', $link_type)
			->set_width(25),
			$this->_text($id.'_button_text', 'Button Text')
			->set_help_text('Leave blank to use post title. Does not work with custom button')
			->set_width(25)
			->set_conditional_logic( array(
				array(
					'field' => $id.'_button_type',
					'value' => array('page_button', 'post_button', 'product_button', 'custom_button'), 
					'compare' => 'IN'
				)
			)),
			$this->_select( $id.'_page_button', 'Page Link', $this->get_posts('page'))
			->set_width(25)
			->set_conditional_logic( array(
				array(
					'field' => $id.'_button_type',
					'value' => 'page_button', 
				)
			)),
			$this->_select( $id.'_post_button', 'Post Link', $this->get_posts('post'))
			->set_width(25)
			->set_conditional_logic( array(
				array(
					'field' => $id.'_button_type',
					'value' => 'post_button', 
				)
			)),
			$this->_select( $id.'_product_button', 'Service Link', $this->get_posts('product'))
			->set_width(25)
			->set_conditional_logic( array(
				array(
					'field' => $id.'_button_type',
					'value' => 'product_button', 
				)
			)),
			$this->_text($id.'_custom_button', 'Custom Link')
			->set_width(25)
			->set_conditional_logic( array(
				array(
					'field' => $id.'_button_type',
					'value' => 'custom_button', 
				)
			)),
			$this->_select( $id.'_button_action', 'Button Action', array(
				'' => 'Same Window',
				'target="_blank"' => 'New Tab',
			))
			->set_width(25)
			->set_conditional_logic( array(
				array(
					'field' => $id.'_button_type',
					'value' => array('page_button', 'post_button', 'product_button', 'custom_button'), 
					'compare' => 'IN'
				)
			)),
		);

		if($separator) {
			return array_merge(array($this->_seperator($id.'_sep', $separator)), $buttons);
		} else {
			return $buttons;
		}
	}
	function _select($id, $label, $options) {
		return Field::make( 'select', $id, __( $label ) )
		->set_options($options);
	}
	function _radio($id, $label, $options) {
		return Field::make( 'radio', $id, __( $label ) )
		->set_options($options);
	}
	function _color($id, $label) {
		return Field::make( 'color', $id, __( $label ) );
	}
	function _html($id='html', $html = 'Please put htlm content') {
		return Field::make( 'html', $id )
		->set_html($html);
	}

	function _seperator($id='html', $html = 'Please put htlm content') {
		return Field::make( 'html', $id )
		->set_html('<label>'.$html.'</label>')
		->set_classes('seperator ');
	} 
	
	function _contact_form($id = 'contact_form', $label = 'Contact Form') {
		return Field::make( 'select', $id, __( $label ) )
		->set_options($this->get_contact_forms());
	}
	
	function after_banner_fields() {
		$after_banner = carbon_get_theme_option('after_banner');
		$after_banner_container_fields = array();
		foreach($after_banner as $after_banner_template) {
			$after_banner_container_fields[] = $this->_checkbox('hide_after_header_'.$after_banner_template['template'], 'Hide '.get_the_title($after_banner_template['template']));
		}
		return $after_banner_container_fields;
	}

	function before_footer_fields() {
		$after_banner = carbon_get_theme_option('before_footer');
		$after_banner_container_fields = array();
		foreach($after_banner as $after_banner_template) {
			$after_banner_container_fields[] = $this->_checkbox('hide_before_footer_'.$after_banner_template['template'], 'Hide '.get_the_title($after_banner_template['template']));
		}
		return $after_banner_container_fields;
	}
	
	function documentation() {
		ob_start();
		get_template_part( 'admin/documentation' );
		return ob_get_clean();
	}
}
class ModulesFields extends PostMeta {
	function __construct() {
		$this->overlay_options = array(
			'' => 'None',
			'overlay overlay-primary' => 'Overlay Primary',
			'overlay overlay-secondary' => 'Overlay Secondary',
			'overlay overlay-tertiary' => 'Overlay Tertiary',
			'overlay overlay-accent' => 'Overlay Accent',
		);
		$this->background_options = array(
			'' => 'None',
			'custom' => 'Custom Color',
			'image' => 'Image',
			'background-primary' => 'Background Primary',
			'background-secondary' => 'Background Secondary',
			'background-accent' => 'Background Accent',
		);
		$this->container_options = array(
			'container' => 'Default',
			'container-fluid g-0' => 'Full Width',
			'container small-container' => 'Small Container',
			'container extra-small-container' => 'Extra Small Container',
		);
		$this->text_align_options = array(
			'text-left' => 'Text Left',
			'text-center' => 'Text Center',
			'text-right' => 'Text Right',
			'text-justify' => 'Text Justify',
		);
		$this->padding_top_options = array(
			'' => 'None',
			'pt-extra-small' => 'Extra Small',
			'pt-small' => 'Small',
			'pt-medium' => 'Medium',
			'pt-large' => 'Large',
			'pt-extra-large' => 'Extra Large',
		);
		$this->padding_bottom_options = array(
			'' => 'None',
			'pb-extra-small' => 'Extra Small',
			'pb-small' => 'Small',
			'pb-medium' => 'Medium',
			'pb-large' => 'Large',
			'pb-extra-large' => 'Extra Large',
		);
		$this->background_attachment_options = array(
			'' => 'Scroll',
			'background-fixed' => 'Fixed',
		);
		$this->column_layout = array(
			4 => '4-8',
			5 => '5-7',
			6 => '6-6',
			7 => '7-5',
			8 => '8-4',
		);
		$this->number_of_columns = array(
			4 => '4',
			3 => '3',
			2 => '2',
			1 => '1',
		);
		$this->column_content_width = array(
			'large-width' => 'Large',
			'small-width' => 'Small',
			'medium-width' => 'Medium',
		);
		$this->column_padding_option = array(
			'p-0' => 'None',
			'extra-padding' => 'Extra Small',
			'small-padding' => 'Small',
			'medium-padding' => 'Medium',
			'large-padding' => 'Large',
			'extra-large-padding' => 'Extra Large',
		);
		$this->circle_options = array(
			'' => 'None',
			'circle top-left' => 'Top Left',
			'circle bottom-right' => 'Bottom Right'
		);
		$this->style_options = array(
			'style-1' => 'Style 1',
			'style-2' => 'Style 2',
			'style-1 style-3' => 'Style 3',
		);
	}  

	
	function before_module_fields() { 
		return  array(
			$this->_seperator('html_styles', 'TITLE AND SECTION ID'),
			$this->_text('title', 'Title')->set_width(33),
			$this->_text('id', 'Section ID')->set_width(33),
			$this->_checkbox('disable_module', 'Disable Module')->set_width(33),
		);
	}

	function module_fields($module_fields) {
		return $module_fields;
	}

	function templates_fields() {
		return array(
			$this->_text('title', 'Title'),
			$this->_select('template', 'Template', $this->get_posts('templates', 'Select Template')), 
		);
	}

	function hero_banner_slider_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array_merge(
				array(
					$this->_seperator('seperator_1', 'CONTENTS'),
					$this->_image('icon', 'Icon'),
					$this->_text('heading', 'Heading'),
					$this->_rich_text('description', 'Description'),
					$this->_select('gallery', 'Gallery', $this->get_posts('galleries', 'Select Background Gallery')),
				),
				$this->_button('hero_banner', 'Button'),
			))
		);
	}

	function logo_slider_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array(
				$this->_seperator('seperator_1', 'CONTENTS'),
				$this->_text('heading', 'Heading'),
				$this->_rich_text('description', 'Description'),
				$this->_select('gallery', 'Gallery', $this->get_posts('galleries', 'Select Logo Slider Gallery')),
			))
		);
	}

	function two_columns_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array_merge(
				array(
					$this->_seperator('seperator_1', 'CONTENTS'),
					$this->_image('icon', 'Icon')->set_width(50),
					$this->_image('image', 'Image')->set_width(50),
					$this->_text('heading', 'Heading'),
					$this->_rich_text('description', 'Description'),
				),
				$this->_button('two_column', 'Button'),
			))
		);
	}

	function image_and_logo_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array(
				$this->_seperator('seperator_1', 'CONTENTS'),
				$this->_image('image', 'Image'),
			))
		);
	}

	function text_section_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array(
				$this->_seperator('seperator_1', 'CONTENTS'),
				$this->_image('icon', 'Icon'),
				$this->_text('heading', 'Heading'),
				$this->_rich_text('description', 'Description'),
			))
		);
	}
	function featured_text_section_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array_merge(
				array(
					$this->_seperator('seperator_1', 'CONTENTS'),
					$this->_image('bg_image', 'Background Image'),
					$this->_text('heading', 'Heading'),
					$this->_rich_text('description', 'Description'),
				),
				$this->_button('featured', 'Button'),
			))
		);
	}
	function text_with_images_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array_merge(
				array(
					$this->_seperator('seperator_1', 'CONTENTS'),
					$this->_text('heading', 'Heading'),
					$this->_rich_text('description', 'Description'),
					$this->_select('gallery', 'Gallery', $this->get_posts('galleries', 'Select Images Gallery'))
					->set_help_text('Please select exactly 3 images on the gallery')

				),
				$this->_button('text_images', 'Button'),
			))
		);
	}
	function wysiwyg_fields() {
		return array_merge(
			$this->before_module_fields(),
			$this->module_fields(array(
				$this->_seperator('seperator_1', 'CONTENTS'),
				$this->_rich_text('description', 'Description'),
			))
		);
	}
}



/*$PostMeta = new PostMeta();

$documentation_fields = array(
	$PostMeta->_html('documentation', $PostMeta->documentation()),
);
*/

/*-----------------------------------------------------------------------------------*/
/* Theme Settings
/*-----------------------------------------------------------------------------------*/
class ThemeOptionsMeta extends PostMeta {
	function theme_options() {
		global $theme_settings;
		$theme_settings_container = Container::make( 'theme_options', __( 'Theme Settings' ) )->set_page_parent('themes.php');
		foreach($theme_settings as $theme_setting) {
			$theme_settings_container->add_tab($theme_setting['label'], $this->{$theme_setting['id'].'_fields'}());
		}
		return $theme_settings_container;
	}

	function theme_options_single() {
		global $theme_settings;

		foreach($theme_settings as $theme_setting) {
			$theme_settings_container = Container::make( 'theme_options', __( '→'.$theme_setting['label'] ) )->set_page_parent('themes.php');
			$theme_settings_container->add_fields($this->{$theme_setting['id'].'_fields'}());
		}
		return $theme_settings_container;
	}

	function general_settings_fields() {
		return array(
			$this->_checkbox('disable_gutenberg', 'Disable Gutenberg'),
			$this->_image('default_page_banner', 'Default Page Banner'),
		);
	}
	function company_details_fields() {
		return array(
			$this->_image('logo', 'Logo'),
			$this->_image('alt_logo', 'Alt Logo'),
			$this->_image('footer_logo', 'Footer Logo'),
			$this->_text('phone_number', 'Phone Number'),
			$this->_text('email_address', 'Email Address'),
			$this->_text('location_1', 'Location 1'),
			$this->_text('location_2', 'Location 2'),
		);
	}

	function after_banner_fields() {
		return array(
			$this->_complex('after_banner', 'Template')
			->add_fields(array(
				$this->_text('title', 'Title'),
				$this->_select('template', 'Template', $this->get_posts('templates', 'Select Template')), 
			))
			->set_header_template('<%- title  %>')
		);
	}

	function before_footer_fields() {
		return array(
			$this->_complex('before_footer', 'Template')
			->add_fields(array(
				$this->_text('title', 'Title'),
				$this->_select('template', 'Template', $this->get_posts('templates', 'Select Template')), 
			))
			->set_header_template('<%- title  %>')
		);
	}

	function header_settings_fields() {
		return $this->_button('header_right', 'Header Right Button');

	}
	
	function footer_settings_fields() {
		return array_merge(
			array(
				$this->_seperator('footer_text_html', 'FOOTER TEXT'),
				$this->_rich_text('footer_text', ''),
			),
		);
	}


}

$ThemeOptionsMeta = new ThemeOptionsMeta();

$ThemeOptionsMeta->theme_options();

$ThemeOptionsMeta->theme_options_single();

$PostMeta = new PostMeta();
/*
->set_page_parent('themes.php')
->add_tab('General Settings',  array())

->add_tab('Footer CTA', array())

->add_tab('Social Links', array());
*/


/*Container::make( 'theme_options', __( 'Documentation' ) )
->set_page_parent('themes.php')
->add_fields($documentation_fields);*/

/*Container::make( 'theme_options', __( 'Services Settings' ) )
->set_page_parent('edit.php?post_type=medicalconditions')
->add_tab('Button', $Modules->custom_button('services'));*/

/*-----------------------------------------------------------------------------------*/
/* Page Options

Container::make( 'post_meta', 'Page Options' )
->where( 'post_type', '=', 'page' )
->or_where( 'post_type', '=', 'medicalconditions' )
->set_context('side')
->add_fields( array(
	$PostMeta->_text('alt_title', 'Alt Title'),
));
/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
/* Page Banner
/*-----------------------------------------------------------------------------------*/
Container::make( 'post_meta', 'Page Banner' )
->where( 'post_type', '=', 'page' )
->or_where( 'post_type', '=', 'medicalconditions' )
->set_context('side')
->add_fields( array(
	$PostMeta->_checkbox('hide_page_banner', 'Hide Page Banner'),
	$PostMeta->_textarea('page_banner_description', 'Page Banner Description'),
	$PostMeta->_select('page_banner_style', 'Page Panner Style', array(
		'style-1' => 'Style 1',
		'style-2' => 'Style 2',
	)),
));

/*-----------------------------------------------------------------------------------*/
/* Page Banner
/*-----------------------------------------------------------------------------------*/

Container::make( 'post_meta', 'After Banner' )
->where( 'post_type', '=', 'page' )
->or_where( 'post_type', '=', 'medicalconditions' )
->set_context('side')
->add_fields($PostMeta->after_banner_fields());

Container::make( 'post_meta', 'Before Footer' )
->where( 'post_type', '=', 'page' )
->or_where( 'post_type', '=', 'medicalconditions' )
->set_context('side')
->add_fields($PostMeta->before_footer_fields());





/*Container::make( 'post_meta', 'Default Template Page Options' )
->where( 'post_template', '=', 'default' )
->where( 'post_type', '!=', 'accordions' )
->set_context('side')
->add_fields( array(
	Field::make( 'checkbox', 'fullwidth', __( 'Page Full Width' ) ),
));*/
/*-----------------------------------------------------------------------------------*/
/* Modules
/*-----------------------------------------------------------------------------------*/
$Modules = new Modules();
Container::make( 'post_meta', 'Modules' )
->where( 'post_template', '=', 'templates/modules.php' )
->where( 'post_type', '!=', 'accordions' )
->where( 'post_type', '!=', 'galleries' )
->or_where( 'post_type', '=', 'templates' )
->add_fields( array($Modules->modules_post_meta()));


/*-----------------------------------------------------------------------------------*/
/* Accordion
/*-----------------------------------------------------------------------------------*/
Container::make( 'post_meta', 'Accordion Items' )
->where( 'post_type', '=', 'accordions' )
->add_fields( array(
	$PostMeta->_complex('accordion','')
	->add_fields(array(
		$PostMeta->_text('accordion_title','Accordion Title'),
		$PostMeta->_rich_text('accordion_content','Accordion Content'),
	))
	->set_header_template('<%- accordion_title %>')
));

Container::make( 'post_meta', 'Shortcode' )
->where( 'post_type', '=', 'accordions' )
->set_context('side')
->add_fields( array(
	$PostMeta->_html('ac_html', isset($_GET['post']) ? "<code>[accordion id='".$_GET['post']."' title='".get_the_title($_GET['post'])."]</code>" : '')
));


/*-----------------------------------------------------------------------------------*/
/* Testimonial
/*-----------------------------------------------------------------------------------*/
Container::make( 'post_meta', 'Testimonial Content' )
->where( 'post_type', '=', 'testimonials' )
->add_fields( array(
	$PostMeta->_text('testimonial_title','Testimonial Title'),
	$PostMeta->_textarea('testimonial_content','Testimonial Content'),
	$PostMeta->_radio('stars','Testimonial Stars', array(
		5 => 5,
		4 => 4,
		3 => 3,
		2 => 2,
		1 => 1,
	)),
));

Container::make( 'theme_options', __( 'Settings' ) )
->set_page_parent('edit.php?post_type=testimonials')
->add_fields(array(
	$PostMeta->_text('testimonial_heading', 'Heading'),
	$PostMeta->_text('testimonial_heading_left', 'Left Heading'),
	$PostMeta->_text('testimonial_description', 'Description'),
));

/*-----------------------------------------------------------------------------------*/
/* Services
/*-----------------------------------------------------------------------------------*/
Container::make( 'theme_options', __( 'Settings' ) )
->set_page_parent('edit.php?post_type=medicalconditions')
->add_fields(array(
	$PostMeta->_seperator('sticky_cta', 'STICKY CTA'),
	$PostMeta->_text('sticky_cta_heading', 'Heading'),
	$PostMeta->_rich_text('sticky_cta_description', 'Description'),
));

/*-----------------------------------------------------------------------------------*/
/* Gallery
/*-----------------------------------------------------------------------------------*/
Container::make( 'post_meta', 'Gallery' )
->where( 'post_type', '=', 'galleries' )
->add_fields( array(
	$PostMeta->_media_gallery('gallery', '')
));

/*-----------------------------------------------------------------------------------*/
/* CSS, Header and Footer Scripts
/*-----------------------------------------------------------------------------------*/
Container::make( 'post_meta', 'Custom CSS / Header Scripts / Footer Scripts' )
->set_priority('default')
->where( 'post_type', '=', 'post' )
->or_where( 'post_type', '=', 'page' )
->or_where( 'post_type', '=', 'medicalconditions' )
->add_fields( array(
	$PostMeta->_textarea('page_custom_css', 'Custom CSS'),
	Field::make( 'header_scripts', 'page_header_scripts', __( 'Header Scripts' ) ),
	Field::make( 'footer_scripts', 'page_footer_scripts', __( 'Footer Scripts' ) ),
));


/*-----------------------------------------------------------------------------------*/
/* Documentaton
/*-----------------------------------------------------------------------------------*/
/*Container::make( 'theme_options', __( 'Documentation' ) )
->add_fields(array(
	$PostMeta->_html('docx', $PostMeta->_documentation()),
));*/

/*-----------------------------------------------------------------------------------*/
/* Header and Footer Scripts
/*-----------------------------------------------------------------------------------*/
Container::make( 'theme_options', __( '→Header and Footer Scripts' ) )
->set_page_parent('themes.php')
->add_fields(array(
	Field::make( 'header_scripts', 'header_scripts', __( 'Header Scripts' ) ),
	Field::make( 'footer_scripts', 'footer_scripts', __( 'Footer Scripts' ) )
));


/*-----------------------------------------------------------------------------------*/
/* User Custom Field
/*-----------------------------------------------------------------------------------*/
/*Container::make( 'user_meta', 'Custom Field' )
->add_fields( array(
	$PostMeta->_checkbox('newsletter', "I would like to receive email communications about  product updates, news and offers."),
) );*/

/*-----------------------------------------------------------------------------------*/
/* Products
/*-----------------------------------------------------------------------------------*/
Container::make( 'post_meta', 'Product Data' )
->where( 'post_type', '=', 'product' )
->add_tab('PRODUCT INFO',  array(
	$PostMeta->_text('product_size', 'Product Size')
))
->add_tab('IN THIS BOX',  array(
	$PostMeta->_complex('in_this_box', '')
	->add_fields(array(
		$PostMeta->_text('product_name', 'Product Name'),
		$PostMeta->_textarea('product_description', 'Product Description'),
		$PostMeta->_image('product_image', 'Product Image'),
	))
	->set_header_template('<%- product_name  %>')
));