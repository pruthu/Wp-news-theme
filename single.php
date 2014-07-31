<?php get_header(); ?>
<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar('single');
?>	

<!-- BEGIN SINGLE POST -->
<div class="span8">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); ?>
	

	<!-- BREADCRUMB -->
	<?php if(function_exists("dimox_breadcrumbs") && get_arsene_option('arsene_enable_breadcrumbs')) dimox_breadcrumbs(); ?>
	<!-- END BREADCRUMB -->
	<?php if(get_arsene_option("arsene_show_social_share")): ?>
	<!-- SHARE AREA -->
	<?php arsene_social_share(); ?>
	<!-- END SHARE AREA -->
	<?php endif; ?>
	<div class="widget single-post-container">
		<span class="paper-tape"></span>

		<!-- BEGIN ARTICLE -->
		<article <?php post_class('post post-single'); ?>>

			<header class="post-header">

				<?php if ( has_post_thumbnail() && get_arsene_option("arsene_show_featured_image")): ?>					
				<div class="single-post-image clearfix margin-b20">
					<?php //the_post_thumbnail('big-image'); ?>		
					<?php arsene_featured_image_slider(); ?>
				</div>
				<?php endif; ?>	

				<div class="top-meta">						
					<div class="post-category-container pull-left"><?php the_category(' '); ?></div>																			
					
					<div class="pull-right">
						<?php arsene_get_review_star_rating(); ?>
						<?php arsene_comment_meta(); ?>
					</div>
					<div class="clearfix"></div>
				</div>
				
				<h1 class="post-title"><?php the_title(); ?></h1>	
				<?php arsene_post_meta(); ?>	

			</header>

			<div class="post-single-body clearfix margin-t20">
				<?php arsene_review_post(); ?>
				<?php the_content(); ?>				
			</div>

			<footer class="post-single-footer clearfix">
				<div class="pull-left"><?php the_tags('<div class="post-tags">', ' ', '</div>'); ?></div>
				<div class="pull-right">
					<?php edit_post_link(__('<i class="icon-edit"></i>&nbsp; Edit this')); ?>
				</div>				
			</footer>
		</article>
		<!-- END ARTICLE -->

		<?php if(get_arsene_option("arsene_show_author_info")): ?>
		<!-- BEGIN AUTHOR INFO -->
		<div class="post-author-info margin-t30">
			<h3 class="margin-b20"><i class="icon-pencil"></i> <?php _e('About the author','arsene'); ?></h3>
			<div class="post-author-content">
				<?php echo get_avatar( get_the_author_meta('ID'), 80 ); ?>
				<div class="author-detail">
					<h3 class="author-name"><a title="<?php _e('Browse all posts by ','arsene'); ?> <?php the_author(); ?>" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a></h3>
					<div class="author-description">
						<?php the_author_meta('description'); ?>
					</div>					
				</div>
			</div>
		</div>
		<!-- END AUTHOR INFO -->
		<?php endif; ?>

		<!-- BEGIN COMMENT AREA -->
		<?php 
		if ( comments_open() || '0' != get_comments_number() ) 
			comments_template( '', true ); 
		?>
		<!-- END COMMENT AREA -->	
		
	</div>

	<?php if(get_arsene_option("arsene_show_related_posts")): ?>
	<!-- BEGIN RELATED POSTS -->
	<div class="widget widget-related-post">
		<span class="paper-tape"></span>
		<h3 class="widget-title"><span><?php _e('Related Posts','arsene'); ?></span></h3>
		<?php arsene_related_posts(4); ?>
	</div>
	<!-- END RELATED POSTS -->
	<?php endif; ?>

	<!-- SINGLE BOTTOM SIDEBAR -->
	<?php get_sidebar('singlebottom'); ?>
	<!-- END SINGLE BOTTOM SIDEBAR -->

<?php endwhile; ?>

<?php else: ?>
	<?php get_template_part("no-results"); ?>
<?php endif; ?>

</div>

<?php 
/* RIGHT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar('single');
?>
<?php get_footer(); ?>