<?php
if(!function_exists("arsene_editor_picks")){
	function arsene_editor_picks($number_posts = 5){
		global $post;
		/* QUERY */
		query_posts('meta_key=arsene_editor_picks&meta_value=on&posts_per_page='.$number_posts.'&ignore_sticky_posts=1');
		/* LOOP */

		if(have_posts()): ?>

		<ul class="post-list">
			<?php while(have_posts()): the_post(); ?>
			<?php get_template_part("includes/components/blog","5"); /* include(get_template_directory().'/includes/components/blog-5.php'); */ ?>	
			<?php endwhile; ?>
		</ul>
		<?php
		endif;

		/* RESET QUERY */
		wp_reset_query();
	}
}