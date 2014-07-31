<div class="span3">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ): ?>	
			<?php the_post_thumbnail('big-thumbnail'); ?>						
		<?php endif; ?>								
	</a>
	<?php
	if(arsene_get_review_star_rating('',false,false) != ""){
		arsene_get_review_star_rating('', true);
	}else{
		arsene_post_category();
	}
	?>	
	<a class="post-title" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'arsene' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
	<?php arsene_post_meta(); ?>
</div>