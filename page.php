<?php get_header(); ?>
<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar('page');
?>

<!-- BEGIN SINGLE POST -->
<div class="span8">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); ?>
	

	<!-- BREADCRUMB -->
	<?php if(function_exists("dimox_breadcrumbs") && get_arsene_option('arsene_enable_breadcrumbs')) dimox_breadcrumbs(); ?>
	<!-- END BREADCRUMB -->
	<div class="widget single-post-container">
		<span class="paper-tape"></span>

		<!-- BEGIN ARTICLE -->
		<article class="page post post-single">

			<header class="post-header">				
				<h1 class="post-title"><?php the_title(); ?></h1>	
			</header>

			<div class="post-single-body clearfix margin-t20">				
				<?php the_content(); ?>				
			</div>

			<footer class="post-single-footer clearfix">				
				<div class="pull-right">
					<?php edit_post_link(__('<i class="icon-edit"></i>&nbsp; Edit this')); ?>
				</div>				
			</footer>
		</article>
		<!-- END ARTICLE -->		

		<!-- BEGIN COMMENT AREA -->
		<?php 
		if ( comments_open() || '0' != get_comments_number() ) 
			comments_template( '', true ); 
		?>
		<!-- END COMMENT AREA -->	
		
	</div>	

<?php endwhile; ?>

<?php else: ?>
	<?php get_template_part("no-results"); ?>
<?php endif; ?>

</div>

<?php 
/* RIGHT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar('page');
?>

<?php get_footer(); ?>