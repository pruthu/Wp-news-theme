<article class="post post-archive">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ): ?>	
		<div class="post-thumbnail">
			<?php the_post_thumbnail('big-image'); ?>									
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
		<h2 class="post-title post-title-big clearfix"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arsene' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php arsene_post_meta(); ?>
		<?php //if((isset($show_excerpt) && $show_excerpt) || is_archive()): ?>
			<div class="post-excerpt">
				<?php echo wp_trim_words(get_the_excerpt(), 50); ?>
			</div>
		<?php //endif; ?>
	</div>
</article>