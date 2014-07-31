<?php
/*===================================================================
PAGE BUILDER : POST SLIDER
=================================================================== */
class Arsene_Block_Post_Carousel extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Post Carousel',
			'size' => 'span12',
			'class_name' => 'widget-post-carousel',
		);
		
		//create the block
		parent::__construct('arsene_block_post_carousel', $block_options);
	}
	
	function form($instance) {
		$defaults = array(
			'title' => '',
			'number_post' => 5,
			'category' => '',
			'post_ids' => ''
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);		

		?>
		<div class="widget-content">
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)','arsene'); ?>:
					<input id="<?php echo $this->get_field_id('title') ?>" type="text" value="<?php echo $title ?>" name="<?php echo $this->get_field_name('title') ?>" class="widefat">
				</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('number_post') ?>">
					<?php _e('Number of posts','arsene');?>:
					<input id="<?php echo $this->get_field_id('number_post') ?>" type="text" value="<?php echo $number_post ?>" name="<?php echo $this->get_field_name('number_post') ?>" class="widefat">
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('category') ?>">
					<?php _e('Select category','arsene'); ?>:
					<?php
					$categories = get_categories('hierarchical=0'); 
					if(!empty($categories)): ?>					
					<select id="<?php echo $this->get_field_id('category') ?>" name="<?php echo $this->get_field_name('category') ?>" class="widefat">
						<option value=""><?php _e('Select Category','arsene'); ?></option>
						<?php foreach($categories as $cat): ?>
						<option value="<?php echo $cat->term_id; ?>" <?php echo $category == $cat->term_id ? "selected":"" ?>><?php echo $cat->name; ?></option>
						<?php endforeach; ?>
					</select>
					<?php endif; ?>
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('post_ids') ?>">
					<?php _e('Post IDs, separate by commas.','arsene'); ?>:
					<input id="<?php echo $this->get_field_id('post_ids') ?>" type="text" value="<?php echo $post_ids ?>" name="<?php echo $this->get_field_name('post_ids') ?>" class="widefat">
					<small><?php _e('Enter the post id or leave blank if you select the category field above.','arsene'); ?></small>
				</label>
			</p>
			
		</div>
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		$arr_post_ids = array();
		$args = array();

		if(!empty($post_ids)){
			$arr_post_ids = explode(",",$post_ids);
			$args = array('post__in' => $arr_post_ids, 'ignore_sticky_posts' => 1);
		}elseif(!empty($category)){
			$args = array('cat' => $category, 'posts_per_page'=> $number_post, 'ignore_sticky_posts' => 1, 'meta_key'=>'_thumbnail_id');
		}

		/* Query */
		query_posts($args);

		/* Loop */
		if(have_posts()):
	?>
		<?php $uniqid = uniqid(); ?>
		<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function($){
			$("#post-carousel-<?php echo $uniqid; ?>").flexslider({
				animation: "slide",
				itemWidth: 160,
				itemMargin: 20,
				controlNav: false,
				slideshow: false,
				minItems: 1,
				maxItems: 4,
				move: 1
			})
		});
		//]]>
		</script>

		<div id="post-carousel-<?php echo $uniqid; ?>" class="flexslider carousel post-carousel">
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

	<?php
		endif;

		/* Reset Query */
		wp_reset_query();

	}
	
}