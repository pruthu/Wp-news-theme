<?php
/*===================================================================
WIDGET TAGCLOUD
Display Tag Cloud
=================================================================== */

class Arsene_Widget_Tagcloud extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays tagcloud.","arsene") );
		parent::__construct('tagcloud', __('Arsene Tagcloud',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$number = $instance['number'];
        $orderby = $instance['orderby'];
        
        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>		
		<div class="tagcloud">
			<?php wp_tag_cloud('smallest=11&largest=11&unit=px&number='.$number.'&orderby='.$orderby); ?>
		</div>			
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = strip_tags($new_instance['number']);
        $instance['orderby'] = strip_tags($new_instance['orderby']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number' => '15', 'orderby' => 'name') );
		$title = strip_tags($instance['title']);
		$number = strip_tags($instance['number']);
		$orderby = strip_tags($instance['orderby']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tags to display:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order by:',"arsene"); ?></label>
		<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
		<option value="name" <?php echo $orderby == "name"?"selected":""; ?>>Name</option>
		<option value="count" <?php echo $orderby == "count"?"selected":""; ?>>Count</option>
		</select></p>

		
<?php
	}

}
?>