<div class="news-box style-3">
	<div class="row-fluid">
		<div class="span12">
										
			<?php $x = 1; $a = 1; while( have_posts() ): the_post(); ?>
				<?php if($x == 1): ?>
					<div class="row-fluid">
						<?php get_template_part("includes/components/blog","7"); /* include(get_template_directory().'/includes/components/blog-7.php'); */ ?>
					</div>
					<div class="row-fluid">					
				<?php else: ?>					
					<div class="span6">
						<?php get_template_part("includes/components/blog","8"); /* include(get_template_directory().'/includes/components/blog-8.php'); */ ?>
					</div>
					<?php if($a % 2 == 0): ?>
					</div><div class="row-fluid">
					<?php endif; ?>

				<?php $a++; endif; ?>
			<?php $x++; endwhile; ?>
			</div>
		</div>
	</div>
</div>