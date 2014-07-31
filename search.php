<?php get_header(); ?>

<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar();
?>


	<div class="span8">
	<?php
	/* Query */
	//query_posts('posts_per_page=10&s='.get_search_query().'&ignore_sticky_posts=1');

	/* Loop */
	if(have_posts()): ?>
		<!-- BREADCRUMB -->
		<?php if(function_exists("dimox_breadcrumbs") && get_arsene_option('arsene_enable_breadcrumbs')) dimox_breadcrumbs(); ?>
		<!-- END BREADCRUMB -->
		<div class="widget widget-search archive-1">
			<span class="paper-tape"></span>
			<h3 class="widget-title"><span><?php _e('Search Results: ','arsene'); ?></span> <span class="search-query"><?php the_search_query(); ?></span></h3>

			<?php
			while(have_posts()): the_post(); 
				get_template_part("includes/components/blog","1");
				//include(get_template_directory().'/includes/components/blog-1.php');
			endwhile; ?>
			<?php arsene_post_pagination(); ?>
		</div>

	<?php else: 
		get_template_part('no-results');
	endif;
	/* Reset Query */
	wp_reset_query();
	?>
	</div>

<?php 
/* RIGHT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar();
?>

<?php get_footer(); ?>