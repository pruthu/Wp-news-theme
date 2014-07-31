<?php
/*===================================================================
PAGE BUILDER : 728x90 ADS BLOCK
=================================================================== */
class Arsene_Block_Archive_Posts extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Archive Posts',
			'size' => 'span12',
			'class_name' => 'widget-archive',
			'resizable' => 0
		);
		
		//create the block
		parent::__construct('arsene_block_archive_posts', $block_options);
	}
	
	function form($instance) {
		$defaults = array(
			'style' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);		

		?>
		<div class="widget-content">
			<p>
				<label for="<?php echo $this->get_field_id('style') ?>">
					<?php _e('Archive Posts Style','arsene');?>:
					<select id="<?php echo $this->get_field_id('style') ?>" name="<?php echo $this->get_field_name('style') ?>">
						<?php for($i=1; $i<8; $i++): ?>
						<option <?php echo $style==$i?"selected":"" ?> value="<?php echo $i; ?>">Style <?php echo $i; ?></option>
						<?php endfor; ?>
					</select>				
				</label>
			</p>

		</div>
		<?php
	}
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/* block header */
	function before_block($instance) {
		extract($instance);
		$column_class = $first ? 'aq-first' : '';
	 	echo '<div class="'.$size.'">';
		if(function_exists("dimox_breadcrumbs") && get_arsene_option('arsene_enable_breadcrumbs')) dimox_breadcrumbs(); 		
		echo '<div id="arsene-block-'.$number.'" class="widget '.$class_name.' archive-'. $style .'"><span class="paper-tape"></span>';		
	}

	/* block footer */
	function after_block($instance) {
		extract($instance);
		echo '</div></div>';	
	}

	function block($instance) {
		extract($instance);		
		?>
			<?php if ( have_posts() ) : ?>
				<h3 class="widget-title"><span>
						<?php
						if ( is_category() ) {
							printf( __( 'Category Archives: %s', 'arsene' ), '<span class="second-word">' . single_cat_title( '', false ) . '</span>' );
						} elseif ( is_tag() ) {
							printf( __( 'Tag Archives: %s', 'arsene' ), '<span class="second-word">' . single_tag_title( '', false ) . '</span>' );
						} elseif ( is_author() ) {
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author Archives: %s', 'arsene' ), '<span class="second-word">' . get_the_author() . '</span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();
						} elseif ( is_day() ) {
							printf( __( 'Daily Archives: %s', 'arsene' ), '<span class="second-word">' . get_the_date() . '</span>' );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives: %s', 'arsene' ), '<span class="second-word">' . get_the_date( 'F Y' ) . '</span>' );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives: %s', 'arsene' ), '<span class="second-word">' . get_the_date( 'Y' ) . '</span>' );
						} else {
							_e( 'Archives', 'arsene' );
						}
						?>
					</span></h3>
					
					<?php if(is_tag()): ?>
						<?php if ( tag_description() != ""): ?><div class="archive-description"><?php echo tag_description(); ?></div><?php endif; ?>
					<?php elseif(is_category()): ?>
						<?php if ( category_description() != ""): ?><div class="archive-description"><?php echo category_description(); ?></div><?php endif; ?>
					<?php endif; ?>

					<?php /* Loop */ ?>
					<?php
					switch($style){
						case 1:
							while(have_posts()): the_post();
								get_template_part("includes/components/blog","1");
								//include(get_template_directory().'/includes/components/blog-1.php');
							endwhile;
						break;
						case 2:
							echo '<div class="row-fluid">';
							$x = 1;
							while(have_posts()): the_post();
								get_template_part("includes/components/blog","2");
								//include(get_template_directory().'/includes/components/blog-2.php');
								if($x % 3 == 0)
									echo '</div><div class="row-fluid">';
								$x++;
							endwhile;
							echo '</div>';
						break;
						case 3:
							echo '<div class="row-fluid">';
							$x = 1;
							while(have_posts()): the_post();
								get_template_part("includes/components/blog","3");
								//include(get_template_directory().'/includes/components/blog-3.php');
								if($x % 2 == 0)
									echo '</div><div class="row-fluid">';
								$x++;
							endwhile;
							echo '</div>';
						break;
						case 4:										
							while(have_posts()): the_post();
								echo '<div class="row-fluid"><div class="span12">';
								get_template_part("includes/components/blog","4");
								//include(get_template_directory().'/includes/components/blog-4.php');						
								echo '</div></div>';
							endwhile;					
						break;
						case 5:
							echo '<div class="row-fluid margin-b30">';
							$x = 1;
							while(have_posts()): the_post();
								get_template_part("includes/components/blog","6");
								//include(get_template_directory().'/includes/components/blog-6.php');
								if($x % 4 == 0)
									echo '</div><div class="row-fluid margin-b30">';
								$x++;
							endwhile;
							echo '</div>';
						break;
						case 6:										
							while(have_posts()): the_post();
								echo '<div class="row-fluid">';
								get_template_part("includes/components/blog","7");
								//include(get_template_directory().'/includes/components/blog-7.php');
								echo '</div>';
							endwhile;
						break;
						case 7:
							echo '<div class="row-fluid">';
							$x = 1;
							while(have_posts()): the_post();
								echo '<div class="span6">';
								get_template_part("includes/components/blog","8");
								//include(get_template_directory().'/includes/components/blog-8.php');
								echo '</div>';
								if($x % 2 == 0)
									echo '</div><div class="row-fluid">';
								$x++;
							endwhile;
							echo '</div>';
						break;
					}
					?>

					<?php arsene_post_pagination(); ?>
					</div>
			<?php else : ?>
					<?php get_template_part( 'no-results' ); ?>
				</div>
			<?php endif; ?>
		<?php
	}
	
}