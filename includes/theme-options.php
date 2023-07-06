<?php
class Theme_Options extends Helpers
{
	function __construct()
	{
		$SVG = new SVG;
		$this->site_logo = wp_get_attachment_image_url(get__theme_option('logo'), 'large');
		$this->alt_logo_url = wp_get_attachment_image_url(get__theme_option('alt_logo'), 'large');
		$this->disable_gutenberg = get__theme_option('disable_gutenberg');
		$this->default_page_banner = wp_get_attachment_image_url(get__theme_option('default_page_banner'), 'full');

		$this->placeholder_image = wp_get_attachment_image_url(get__theme_option('placeholder_image'), 'large');



		$this->logo = '<a class="site-logo full-logo" href="' . get_site_url() . '"> <img src="' . wp_get_attachment_image_url(get__theme_option('logo'), 'medium') . '" alt="' . get_bloginfo('name') . '"> </a>';
		$this->alt_logo = '<a class="site-logo alt-logo" href="' . get_site_url() . '"> <img src="' . wp_get_attachment_image_url(get__theme_option('alt_logo'), 'large') . '" alt="' . get_bloginfo('name') . '"></a>';
		$this->contact_number_text  = get__theme_option('contact_number');
		$this->contact_number_url = 'tel:' . $this->clean_string($this->contact_number_text, '');
		$this->contact_number  = '<a href="' . $this->contact_number_url . '">' . $this->contact_number_text . '</a>';

		$this->email_address_text  = get__theme_option('email_address');
		$this->email_address_url = 'mailto:' . $this->email_address_text;
		$this->email_address  = '<a href="' . $this->email_address_url . '">' . $this->email_address_text . '</a>';

		$this->facebook = get__theme_option('facebook_url');
		$this->twitter = get__theme_option('twitter_url');
		$this->linkedin = get__theme_option('linkedin_url');
		$this->youtube = get__theme_option('youtube_url');

		$this->shop_mega_menu = get__theme_option('shop_mega_menu');

		$this->address = get__theme_option('address');
		$this->opening_times = get__theme_option('opening_times');

	}
}
