<?php
$DisplayData = new DisplayData();
$Theme_Options = new Theme_Options();
$hero_banner_type = get__post_meta('hero_banner_type');

?>

<?php
if ($hero_banner_type == 'animated') {
	get_template_part('template-parts/section/content-banner', 'animated');
}
else if ($hero_banner_type == 'revealing_heading') {
	get_template_part('template-parts/section/content-banner', 'revealing');
}
else {
	get_template_part('template-parts/section/content', 'breadcrumbs');
}
?>