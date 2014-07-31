<div class="news-box style-4">
	<ul class="post-list">
		<?php while( have_posts() ): the_post(); ?>
			<?php get_template_part("includes/components/blog","5"); /* include(get_template_directory().'/includes/components/blog-5.php'); */ ?>		
		<?php endwhile; ?>
	</ul>
</div>