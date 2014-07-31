<?php
/*===================================================================
PAGE BUILDER : NEWS BOX
=================================================================== */
class Arsene_Block_News_Box extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'News Box',
			'size' => 'span12',
			'class_name' => 'widget-news-box',
		);
		
		//create the block
		parent::__construct('arsene_block_news_box', $block_options);
	}
	
	function form($instance) {
		$defaults = array(
			'title' => '',
			'number_post' => 5,
			'category' => '',			
			'news_box_style' => 1,
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
				<label for="<?php echo $this->get_field_id('news_box_style') ?>">
					<?php _e('Select News Box Style','arsene'); ?>:
					<select id="<?php echo $this->get_field_id('news_box_style') ?>" name="<?php echo $this->get_field_name('news_box_style') ?>" class="widefat">
						<option <?php echo $news_box_style == 1 ? "selected": ""; ?> value="1"><?php _e('Style 1','arsene'); ?></option>
						<option <?php echo $news_box_style == 2 ? "selected": ""; ?> value="2"><?php _e('Style 2','arsene'); ?></option>
						<option <?php echo $news_box_style == 3 ? "selected": ""; ?> value="3"><?php _e('Style 3','arsene'); ?></option>
						<option <?php echo $news_box_style == 4 ? "selected": ""; ?> value="4"><?php _e('Style 4','arsene'); ?></option>
					</select>
				</label>
			</p>
		</div>
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		/* Query */
		$args = array('posts_per_page' => $number_post, 'cat' => $category, 'ignore_sticky_posts' => 1);
		query_posts($args);

		/* Loop */
		if( have_posts() ):
			switch($news_box_style):
				case 1:
					get_template_part("includes/components/news-box","1");
					//include(get_template_directory().'/includes/components/news-box-1.php'); 
				break;
				case 2:
					get_template_part("includes/components/news-box","2");
					//include(get_template_directory().'/includes/components/news-box-2.php'); 
				break;
				case 3:
					get_template_part("includes/components/news-box","3");
					//include(get_template_directory().'/includes/components/news-box-3.php'); 
				break;
				case 4:
					get_template_part("includes/components/news-box","4");
					//include(get_template_directory().'/includes/components/news-box-4.php'); 
				break;
			endswitch;
		endif;

		/* Reset Query */
		wp_reset_query();

	}
	
}