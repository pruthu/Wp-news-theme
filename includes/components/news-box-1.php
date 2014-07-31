<div class="news-box style-1">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">				
				<?php $x=1; while( have_posts() ): the_post(); ?>

				<?php if($x == 1): ?>
				<?php get_template_part("includes/components/blog","3"); /*include(get_template_directory().'/includes/components/blog-3.php'); */ ?>	
				<div class="span6">
					<ul class="post-list">
				<?php else: ?>
				<?php get_template_part("includes/components/blog","5"); /*include(get_template_directory().'/includes/components/blog-5.php'); */ ?>	
				<?php endif; ?>				
				<?php $x++; endwhile; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>