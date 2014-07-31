<?php
/*===================================================================
PAGE BUILDER : BLOG POSTS
=================================================================== */
class Arsene_Block_Blog_Post extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Blog Posts',
			'size' => 'span12',
			'class_name' => 'widget-blog-post widget-archive',
			'resizable' => 0
		);
		
		//create the block
		parent::__construct('arsene_block_blog_post', $block_options);
	}

	/* block header */
	function before_block($instance) {
		extract($instance);
		$column_class = $first ? 'aq-first' : '';
	 		
		echo '<div id="arsene-block-'.$number.'" class="widget '.$class_name.''. $size .' archive-'. $blog_style .' "><span class="paper-tape"></span>';
		if(!empty($title)){
		?> <h3 class="widget-title"><span> <?php echo $title; ?></span></h3><?php
		}
	}
	
	function form($instance) {
		$defaults = array(
			'title' => '',
			'posts_per_page' => 6,
			'blog_style' => 2,
			//'show_excerpt' => 0,	
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
				<label for="<?php echo $this->get_field_id('posts_per_page') ?>">
					<?php _e('Posts per page','arsene'); ?>:
					<input id="<?php echo $this->get_field_id('posts_per_page') ?>" type="text" value="<?php echo $posts_per_page ?>" name="<?php echo $this->get_field_name('posts_per_page') ?>" class="widefat">
				</label>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('blog_style') ?>">
					<?php _e('Select blog style','arsene'); ?>:
					<select id="<?php echo $this->get_field_id('blog_style') ?>" name="<?php echo $this->get_field_name('blog_style') ?>" class="widefat">
						<option <?php echo $blog_style == 1 ? "selected": ""; ?> value="1"><?php _e('Style 1','arsene'); ?></option>
						<option <?php echo $blog_style == 2 ? "selected": ""; ?> value="2"><?php _e('Style 2','arsene'); ?></option>
						<option <?php echo $blog_style == 3 ? "selected": ""; ?> value="3"><?php _e('Style 3','arsene'); ?></option>
						<option <?php echo $blog_style == 4 ? "selected": ""; ?> value="4"><?php _e('Style 4','arsene'); ?></option>
					</select>
				</label>
			</p>

			<!--<p>
				<input id="<?php echo $this->get_field_id('show_excerpt') ?>" name="<?php echo $this->get_field_name('show_excerpt') ?>" type="checkbox" value="1" <?php if ( $show_excerpt ) echo 'checked="checked"'; ?>/>
				<label for="<?php echo $this->get_field_id('show_excerpt') ?>" ><?php _e('Display Post Excerpt?',"arsene"); ?></label>
			</p>-->

		</div>
		<?php
	}
	
	function block($instance) {
		extract($instance);		

		/* Query */	

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
		  'posts_per_page' => $posts_per_page,
		  'paged' => $paged,
		  'ignore_sticky_posts'=>1,
		);

		$blog_posts = new WP_Query($args);	

		/* Loop */

		if( $blog_posts->have_posts() ):			
		?>
		<div class="blog-container blog-<?php echo $blog_style; ?>">
		<?php
			switch($blog_style):
				case 1:
					while( $blog_posts->have_posts() ): $blog_posts->the_post();
						get_template_part("includes/components/blog","1");
						//include(get_template_directory().'/includes/components/blog-1.php'); 
					endwhile;
				break;
				case 2:
					?>
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid">
					<?php
					$x = 1;
					while( $blog_posts->have_posts() ): $blog_posts->the_post();

						get_template_part("includes/components/blog","2");
						//include(get_template_directory().'/includes/components/blog-2.php'); 

						if($x % 3 == 0){
							echo '</div><div class="row-fluid">';
						}
						$x++;
					endwhile;
					?>
							</div>
						</div>
					</div>
					<?php
				break;
				case 3:
					?>
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid">
					<?php
					$x = 1;
					while( $blog_posts->have_posts() ): $blog_posts->the_post();
						get_template_part("includes/components/blog","3");
						//include(get_template_directory().'/includes/components/blog-3.php'); 

						if($x % 2 == 0){
							echo '</div><div class="row-fluid">';
						}
						$x++;
					endwhile;
					?>
							</div>
						</div>
					</div>
					<?php
				break;
				case 4:
					while( $blog_posts->have_posts() ): $blog_posts->the_post();
						get_template_part("includes/components/blog","4");
						//include(get_template_directory().'/includes/components/blog-4.php'); 
					endwhile;
				break;
			endswitch;
		?>
		</div>

		<?php if($blog_posts->max_num_pages > 1): ?>
        <div class="row-fluid">
            <div class="span12">
                <div class="pagination-container">                                              
                    <div class="pagination">
                        <?php
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $blog_posts->max_num_pages,
                            'prev_next' => false,
                            'type' => 'list'
                        ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
		<?php
		endif;

		/* Reset Query */
		wp_reset_query();

	}
	
}