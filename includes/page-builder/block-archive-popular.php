<?php
/*===================================================================
PAGE BUILDER : NEWS BOX
=================================================================== */
class Arsene_Block_Archive_Popular extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Archive Popular',
			'size' => 'span6',
			'class_name' => 'widget-news-box',
		);
		
		//create the block
		parent::__construct('arsene_block_archive_popular', $block_options);
	}
	
	function form($instance) {
		$defaults = array(
			'number_post' => 5,
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);				
		?>
		<div class="widget-content">
			
			<p>
				<label for="<?php echo $this->get_field_id('number_post') ?>">
					<?php _e('Number Posts','arsene'); ?>:
					<?php echo aq_field_input('number_post', $block_id, $number_post, $size = 'full') ?>
				</label>
			</p>

		</div>
		<?php
	}

	/* block header */
	function before_block($instance) {
		extract($instance);
		$column_class = $first ? 'aq-first' : '';
	 		
		echo '<div id="arsene-block-'.$number.'" class="widget '.$class_name.' '. $size .'"><span class="paper-tape"></span>';		
	}
	
	function block($instance) {
		extract($instance);

		global $query_string;
		
		/* Query */
		query_posts($query_string.'&ignore_sticky_posts=1&orderby=comment_count&posts_per_page='.$number_post);

		/* Loop */
		if( have_posts() ):
			echo '<h3 class="widget-title"><span>';
			if(is_category()){
				printf( __( 'Popular: %s', 'arsene' ), '<span class="second-word">' . single_cat_title( '', false ) . '</span>' );
			}elseif(is_tag()){
				printf( __( 'Popular: %s', 'arsene' ), '<span class="second-word">' . single_tag_title( '', false ) . '</span>' );
			}elseif(is_author()){
				the_post();
				printf( __( 'Popular by %s', 'arsene' ), '<span class="second-word">' . get_the_author() . '</span>' );
				rewind_posts();
			}elseif(is_day()){
				printf( __( 'Popular: %s', 'arsene' ), '<span class="second-word">' . get_the_date() . '</span>' );
			} elseif ( is_month() ) {
				printf( __( 'Popular: %s', 'arsene' ), '<span class="second-word">' . get_the_date( 'F Y' ) . '</span>' );
			} elseif ( is_year() ) {
				printf( __( 'Popular: %s', 'arsene' ), '<span class="second-word">' . get_the_date( 'Y' ) . '</span>' );
			} else {
				_e( 'Popular', 'arsene' );
			}
			echo '</span></h3>';


			echo '<ul class="post-list">';
			while(have_posts()): the_post();
				get_template_part("includes/components/blog","5");
				//include(get_template_directory().'/includes/components/blog-5.php'); 
			endwhile;
		endif;

		/* Reset Query */
		wp_reset_query();

	}
	
}