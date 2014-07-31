<?php
/*===================================================================
WIDGET RECENT POSTS
Displays Editor Picks posts.
=================================================================== */

class Arsene_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays most recent posts.","arsene") );
		parent::__construct('recent_posts', __('Arsene Recent Posts',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$number = $instance['number'];
        
        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 

		arsene_recent_posts($number);

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number' => '4') );
		$title = strip_tags($instance['title']);
		$number = strip_tags($instance['number']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to display:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></p>

		
<?php
	}

}
?>