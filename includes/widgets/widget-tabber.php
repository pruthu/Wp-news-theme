<?php
/*===================================================================
WIDGET TABBER
Displays Popular posts, recent posts, recent comments, and tags.
=================================================================== */

class Arsene_Widget_Tabber extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays tabber: Popular posts, recent posts, recent comments and tags.","arsene") );
		parent::__construct('tabber', __('Arsene Tabber',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$show_popular_posts = (bool) $instance['show_popular_posts'];
		$show_recent_posts = (bool) $instance['show_recent_posts'];
		$show_recent_comments = (bool) $instance['show_recent_comments'];
		$show_tags = (bool) $instance['show_tags'];
		$number_popular_posts = $instance['number_popular_posts'];
		$number_recent_posts = $instance['number_recent_posts'];
		$number_recent_comments = $instance['number_recent_comments'];
		$number_tags = $instance['number_tags'];

        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
		
		<div class="bt-tab style-1">								
			<ul class="nav nav-tabs">
				<?php if($show_recent_posts): ?><li><a href="#recent-posts" class="tip" title="<?php _e('Recent Posts','arsene'); ?>"><i class="icon-calendar"></i></a></li><?php endif; ?>
				<?php if($show_popular_posts): ?><li><a href="#popular-posts" class="tip" title="<?php _e('Popular Posts','arsene'); ?>"><i class="icon-thumbs-up"></i></a></li><?php endif; ?>
				<?php if($show_recent_comments): ?><li><a href="#recent-comments" class="tip" title="<?php _e('Recent Comments','arsene'); ?>"><i class="icon-comments"></i></a></li><?php endif; ?>
				<?php if($show_tags): ?><li><a href="#tags" class="tip" title="<?php _e('Tags','arsene'); ?>"><i class="icon-tags"></i></a></li><?php endif; ?>
			</ul><!-- /nav-tabs -->

			<div class="tab-content">

				<?php if($show_recent_posts): ?>
				<div class="tab-pane" id="recent-posts">
					<?php arsene_recent_posts($number_recent_posts); ?>
				</div>
				<?php endif; ?>

				<?php if($show_popular_posts): ?>
				<div class="tab-pane" id="popular-posts">
					<?php arsene_popular_posts($number_popular_posts); ?>
				</div>
				<?php endif; ?>

				<?php if($show_recent_comments): ?>
				<div class="tab-pane" id="recent-comments">
					<?php arsene_recent_comments($number_recent_comments); ?>
				</div>
				<?php endif; ?>

				<?php if($show_tags): ?>
				<div class="tab-pane" id="tags">
					<?php arsene_tag_cloud($number_tags); ?>
				</div>
				<?php endif; ?>

			</div>
		</div>

<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['show_popular_posts'] = (bool) $new_instance['show_popular_posts'];
		$instance['show_recent_posts'] = (bool) $new_instance['show_recent_posts'];
		$instance['show_recent_comments'] = (bool) $new_instance['show_recent_comments'];
		$instance['show_tags'] = (bool) $new_instance['show_tags'];

		$instance['number_popular_posts'] = strip_tags($new_instance['number_popular_posts']);
		$instance['number_recent_posts'] = strip_tags($new_instance['number_recent_posts']);
		$instance['number_recent_comments'] = strip_tags($new_instance['number_recent_comments']);
		$instance['number_tags'] = strip_tags($new_instance['number_tags']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'show_popular_posts' => true, 'show_recent_posts' => true, 'show_recent_comments' => true, 'show_tags' => true, 'number_popular_posts' => 4, 'number_recent_posts' => 4, 'number_recent_comments' => 4, 'number_tags' => 15 ) );

		$title = strip_tags($instance['title']);
		$show_popular_posts = (int) $instance['show_popular_posts'];
		$show_recent_posts = (int) $instance['show_recent_posts'];
		$show_recent_comments = (int) $instance['show_recent_comments'];
		$show_tags = (int) $instance['show_tags'];

		$number_popular_posts = strip_tags($instance['number_popular_posts']);
		$number_recent_posts = strip_tags($instance['number_recent_posts']);
		$number_recent_comments = strip_tags($instance['number_recent_comments']);
		$number_tags = strip_tags($instance['number_tags']);
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number_popular_posts'); ?>"><?php _e('Number posts display in Popular Posts tab:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number_popular_posts'); ?>" name="<?php echo $this->get_field_name('number_popular_posts'); ?>" type="text" value="<?php echo esc_attr($number_popular_posts); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number_recent_posts'); ?>"><?php _e('Number posts display in Recent Posts tab:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number_recent_posts'); ?>" name="<?php echo $this->get_field_name('number_recent_posts'); ?>" type="text" value="<?php echo esc_attr($number_recent_posts); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number_recent_comments'); ?>"><?php _e('Number comments display in Recent Comments tab:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number_recent_comments'); ?>" name="<?php echo $this->get_field_name('number_recent_comments'); ?>" type="text" value="<?php echo esc_attr($number_recent_comments); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number_tags'); ?>"><?php _e('Number tags item display in Tags tab:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number_tags'); ?>" name="<?php echo $this->get_field_name('number_tags'); ?>" type="text" value="<?php echo esc_attr($number_tags); ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" type="checkbox" value="1" <?php if ( $show_popular_posts ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_popular_posts'); ?>"><?php _e('Display popular posts?',"arsene"); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_recent_posts'); ?>" name="<?php echo $this->get_field_name('show_recent_posts'); ?>" type="checkbox" value="1" <?php if ( $show_recent_posts ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_recent_posts'); ?>"><?php _e('Display recent posts?',"arsene"); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_recent_comments'); ?>" name="<?php echo $this->get_field_name('show_recent_comments'); ?>" type="checkbox" value="1" <?php if ( $show_recent_comments ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_recent_comments'); ?>"><?php _e('Display recent comments?',"arsene"); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_tags'); ?>" name="<?php echo $this->get_field_name('show_tags'); ?>" type="checkbox" value="1" <?php if ( $show_tags ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_tags'); ?>"><?php _e('Display tags?',"arsene"); ?></label></p>

		
<?php
	}

}

/*===================================================================
RECENT POSTS
=================================================================== */

function arsene_recent_posts($number_posts){

	query_posts(array('posts_per_page' => $number_posts, 'ignore_sticky_posts' => 1));

	if( have_posts() ):?>
	<ul class="post-list">
<?php
		while( have_posts() ): the_post();
			get_template_part("includes/components/blog","5");
			// include(get_template_directory().'/includes/components/blog-5.php');
		endwhile; ?>
	</ul>
<?php		
	endif;

	wp_reset_query();
}

/*===================================================================
RECENT COMMENTS
=================================================================== */
function arsene_recent_comments($number_comments){
	$args = array(
		'status' => 'approve',
		'number' => $number_comments
	);

	$comments = get_comments($args);	
	if(!empty($comments)): ?>
	<ul class="recent-comments-list">
<?php
	foreach($comments as $comment) : ?>
	<li>
		<?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
		<div class="comment">
			<?php echo $comment->comment_author_url != "" ? '<a class="comment-author" href="'. $comment->comment_author_url.'" rel="nofollow external" target="_blank">'.$comment->comment_author .'</a>' : '<span class="comment-author">'.$comment->comment_author.'</span>'; ?>
			<time class="comment-date" datetime="<?php echo $comment->comment_date; ?>"><?php comment_date('F j, Y', $comment->comment_ID) ?></time>
			<div class="comment-message">
				<a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID; ?>"><?php echo wp_trim_words($comment->comment_content, 10); ?></a>
			</div>
		</div>
	</li>
<?php
	endforeach; ?>
	</ul>
<?php
	endif; 
}

/*===================================================================
TAGS
=================================================================== */

function arsene_tag_cloud($number_tags){
	echo '<div class="tagcloud">';
	wp_tag_cloud('smallest=11&largest=11&unit=px&number='.$number_tags);
	echo '</div>';
}

/*===================================================================
POPULAR POSTS
=================================================================== */

function arsene_popular_posts($number_posts){

	query_posts(array('posts_per_page' => $number_posts, 'orderby' => 'comment_count', 'ignore_sticky_posts' => 1));

	if( have_posts() ):?>
	<ul class="post-list">
<?php
		while( have_posts() ): the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ): ?>	
					<?php the_post_thumbnail(); ?>						
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
			<div class="post-meta"><span class="comment-meta"><?php comments_number( 'No comment', '1 comment', '% comments' ); ?></span></div>
		</li>		
<?php			
		endwhile; ?>
	</ul>
<?php		
	endif;

	wp_reset_query();
}


?>