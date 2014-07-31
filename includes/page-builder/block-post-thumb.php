<?php
/*===================================================================
PAGE BUILDER : NEWS BOX
=================================================================== */
class Arsene_Block_Post_Thumb extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Post Thumb',
			'size' => 'span12',
			'class_name' => 'widget-post-thumb',
		);
		
		//create the block
		parent::__construct('arsene_block_post_thumb', $block_options);
	}
	
	function form($instance) {
		$defaults = array(
			'title' => '',
			'number_post' => 12
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);				
		?>
		<div class="widget-content">
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)','arsene'); ?>:
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('number_post') ?>">
					<?php _e('Number Posts','arsene'); ?>:
					<?php echo aq_field_input('number_post', $block_id, $number_post, $size = 'full') ?>
				</label>
			</p>
		</div>
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		/* Query */
		$args = array('posts_per_page' => $number_post, 'ignore_sticky_posts' => 1, 'meta_key'=>'_thumbnail_id');
		query_posts($args);

		/* Loop */
		if( have_posts() ): ?>
		<ul class="post-thumb">
		<?php while(have_posts()): the_post(); ?>
			<?php if ( has_post_thumbnail() ): ?>	
			<li><a href="<?php the_permalink(); ?>" class="tip" title="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail(); ?></a></li>
			<?php endif; ?>
		<?php endwhile; ?>
		</ul>
		<?php endif;

		/* Reset Query */
		wp_reset_query();

	}
	
}