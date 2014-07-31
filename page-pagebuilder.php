<?php
/*
Template Name: Page Builder
*/
?>
<?php get_header(); ?>

<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar('frontpage');
?>

<div class="span8">
	<div class="boxed-container">
	<?php if( have_posts() ): ?>
	<?php while( have_posts() ): the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>	
	<?php endif; ?>
	</div>
</div>

<?php 
/* RIGHT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar('frontpage');
?>
<?php get_footer(); ?>