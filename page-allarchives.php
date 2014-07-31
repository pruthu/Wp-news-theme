<?php
/*
Template Name: Archives
*/
?>
<?php get_header(); ?>
<div class="row-fluid">
<!-- BEGIN SINGLE POST -->
<div class="span12">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); ?>
	
	<?php

	/* Begin Query for All Articles */
	query_posts('posts_per_page=-1&ignore_sticky_posts=1');

	/* Loop */
	if(have_posts()):
		echo '<ul class="page-archives">';
		$x = 1;
		while(have_posts()): the_post(); ?>

			<li>
				<div class="widget widget-all-archives">
					<article class="archive-post">
						<a href="<?php the_permalink(); ?>">
							<?php if ( has_post_thumbnail() ): ?>	
								<?php the_post_thumbnail('mediumsmall-image'); ?>						
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
						<?php //arsene_post_meta(); ?>
					</article>
				</div>
			</li>

<?php			
			$x++;
		endwhile;
		echo '</ul>';
	endif;

	/* Reset Query */
	wp_reset_query();

	?>
	

<?php endwhile; ?>

<?php else: ?>
	<?php get_template_part("no-results"); ?>
<?php endif; ?>

</div>

<?php get_footer(); ?>