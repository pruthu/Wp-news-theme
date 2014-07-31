<?php
/*===================================================================
Archive Template
=================================================================== */
$arsene_archive_style = 7;
get_header(); ?>

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar();
?>

<div class="row-fluid">
	<div class="span8">
		<?php 
		if(get_arsene_option("arsene_archive_template") != "0"){
			echo do_shortcode('[template id="'.get_arsene_option("arsene_archive_template").'"]');
		}
		?>

<?php 
/* RIGHT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar();
?>

<?php get_footer(); ?>