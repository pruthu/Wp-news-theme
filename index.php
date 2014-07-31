<?php get_header(); ?>

<?php if(get_arsene_option("arsene_show_popular_carousel")) bt_popular_post_carousel(); ?>
<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar('frontpage');
?>

<div class="span8">
	<?php 
	if(get_arsene_option("arsene_homepage_template") != "0"){
		echo do_shortcode('[template id="'.get_arsene_option("arsene_homepage_template").'"]');
	}
	?>
</div>

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar('frontpage');
?>

<?php get_footer(); ?>