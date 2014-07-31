<?php
if(!function_exists("arsene_related_posts")){
	function arsene_related_posts($number_posts= 4){
		global $post;

		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
			
			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts'=>$number_posts, // Number of related posts that will be shown.
				'ignore_sticky_posts'=>1
			);
			query_posts($args);

			if(have_posts()): ?>
				<div class="related-post"><div class="span12"><div class="row-fluid">
				<?php while(have_posts()): the_post(); ?>
					<?php get_template_part("includes/components/blog","6"); /* include(get_template_directory().'/includes/components/blog-6.php'); */ ?>
				<?php endwhile; ?>
				</div></div></div>
			<?php				
			endif;

			wp_reset_query();		
		}
	}
}