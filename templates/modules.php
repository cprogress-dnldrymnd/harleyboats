<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Modules
/*-----------------------------------------------------------------------------------*/
?>

<?php get_header(); ?>
<?php
$Modules = new Modules();
?>
<?php while (have_posts()) {
	the_post(); ?>

	<?php
	if (!get__post_meta('hide_page_banner')) {
		get_template_part('template-parts/section/content', 'banner');
	}
	get_template_part('template-parts/section/content', 'after-banner');
	$Modules->modules_section(get_the_ID());
	?>
<?php } ?>
<?php get_footer(); ?>