<div class="news-box style-2">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">				
				<?php $x=1; while( have_posts() ): the_post(); ?>
				<?php get_template_part("includes/components/blog","6"); /* include(get_template_directory().'/includes/components/blog-6.php'); */ ?>		
				<?php $x++; endwhile; ?>									
			</div>
		</div>
	</div>
</div>