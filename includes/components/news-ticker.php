<?php
if(!function_exists("bt_newsticker")){
	function bt_newsticker(){
?>
	<div class="headline span12">
		<div class="row-fluid">
			<div class="span2">                                     
				<h3><?php _e('Breaking News','arsene'); ?></h3>
			</div>
			<div class="span10">

				<?php query_posts('posts_per_page=5&ignore_sticky_posts=1'); ?>
				<?php if(have_posts()): ?>

				<ul id="js-news" class="js-hidden headline-content">
					<?php while(have_posts()): the_post(); ?>
					<li class="news-item">
						<div class="headline-data">
							<div class="headline-date">
								<span class="date"><?php echo get_the_date('d'); ?></span>
								<span class="month"><?php echo get_the_date('M'); ?></span>
							</div>
							<a class="headline-url" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>														
							<?php arsene_get_review_star_rating('headline-rating', false); ?>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				<?php wp_reset_query(); ?>

			</div>
		</div>
	</div>
<?php		
	}
}
?>