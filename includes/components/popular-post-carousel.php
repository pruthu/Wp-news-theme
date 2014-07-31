<?php
if(!function_exists("bt_popular_post_carousel")){
	function bt_popular_post_carousel($number_posts = 10){

		/* QUERY */
		query_posts(array('posts_per_page' => $number_posts, 'orderby' => 'comment_count', 'ignore_sticky_posts'=>1, 'meta_key'=>'_thumbnail_id'));
		/* LOOP */
		if(have_posts()): ?>
		<div class="row-fluid popular-carousel">
			<div class="span12">
				<div class="widget-container">
					<div class="widget widget-popular-carousel">
						<span class="paper-tape"></span>	
						<div class="flexslider carousel">
							<ul class="slides">
								<?php while(have_posts()): the_post(); ?>
								<li>
									<a href="<?php the_permalink(); ?>">
										<?php if ( has_post_thumbnail() ): ?>	
										<div class="post-thumbnail">
											<?php the_post_thumbnail('mediumbig-image'); ?>									
											<div class="image-overlay"><span></span></div>
										</div>
										<?php endif; ?>								
									</a>
									<div class="post-detail margin-t20">	
										<?php
											if(arsene_get_review_star_rating('',false,false) != ""){
												arsene_get_review_star_rating('', true);
											}else{
												arsene_post_category();
											}
										?>
										<?php arsene_comment_meta(); ?>
										<h2 class="post-title post-title-medium clearfix"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arsene' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
										<?php arsene_post_meta(); ?>
										<!--<div class="post-excerpt">
											<?php echo wp_trim_words(get_the_excerpt(), 25); ?>
										</div>-->
									</div>
								</li>	
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php			
		endif;
		/* RESET QUERY */
		wp_reset_query();
	}
}
?>