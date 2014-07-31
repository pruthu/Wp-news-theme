<?php
/*
Template Name: Sitemap
*/
?>
<?php get_header(); ?>
<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar('page');
?>

<!-- BEGIN SINGLE POST -->
<div class="span8">

<?php if(have_posts()): the_post(); ?>
	

	<!-- BREADCRUMB -->
	<?php if(function_exists("dimox_breadcrumbs") && get_arsene_option('arsene_enable_breadcrumbs')) dimox_breadcrumbs(); ?>
	<!-- END BREADCRUMB -->
	<div class="widget single-post-container">
		<span class="paper-tape"></span>

		<!-- BEGIN ARTICLE -->
		<article class="page post post-single sitemap">

			<header class="post-header">				
				<h1 class="post-title"><?php the_title(); ?></h1>	
			</header>

			<div class="post-single-body clearfix margin-t20">				

				<?php 
				/* Post */
				the_content(); 
				?>

				<div class="sitemap-block author-sitemap margin-t40">
					<h2><i class="icon-user"></i>&nbsp; <?php _e('Authors','arsene'); ?></h2>
					<ul>
						<?php wp_list_authors('exclude_admin=false'); ?>
					</ul>
				</div>

				<div class="sitemap-block pages-sitemap">
					<h2><i class="icon-file-alt"></i>&nbsp; <?php _e('Pages','arsene'); ?></h2>
					<ul>
						<?php wp_list_pages( array( 'exclude' => '', 'title_li' => '', ) ); ?>
					</ul>
				</div>

				<div class="sitemap-block posts-sitemap">
					<h2><i class="icon-list-ul"></i>&nbsp; <?php _e('Posts','arsene'); ?></h2>
					<ul>
					<?php
						// Add categories you'd like to exclude in the exclude here
						$cats = get_categories('exclude=');
						foreach ($cats as $cat) {
						  echo "<li><h3>".$cat->cat_name."</h3>";
						  echo "<ul>";
						  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
						  while(have_posts()) {
						    the_post();
						    $category = get_the_category();
						    // Only display a post link once, even if it's in multiple categories
						    if ($category[0]->cat_ID == $cat->cat_ID) {
						      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
						    }
						  }
						  echo "</ul>";
						  echo "</li>";
						}
					?>
					</ul>
				</div>

			</div>

			<footer class="post-single-footer clearfix">				
				<div class="pull-right">
					<?php edit_post_link(__('<i class="icon-edit"></i>&nbsp; Edit this')); ?>
				</div>				
			</footer>
		</article>
		<!-- END ARTICLE -->		
		
	</div>	

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