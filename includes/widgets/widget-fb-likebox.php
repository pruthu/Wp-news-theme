<?php
/*===================================================================
WIDGET FB LIKEBOX
Displays Facebook Like Box
=================================================================== */

class Arsene_Widget_FB_Likebox extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays FB Likebox.","arsene") );
		parent::__construct('fb-likebox', __('Arsene FB Likebox',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$likebox_url = $instance['likebox_url'];
		$show_faces = (bool) $instance['show_faces'];
		$show_stream = (bool) $instance['show_stream'];
		$show_header = (bool) $instance['show_header'];
		$color_scheme = $instance['color_scheme'];
        
        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>				
		<div class="fb-like-box" data-href="<?php echo $likebox_url; ?>" data-width="300" data-show-faces="<?php echo  ($show_faces) ? 'true' : 'false'; ?>" data-stream="<?php echo  ($show_stream) ? 'true' : 'false'; ?>" data-border-color="#dddddd" data-header="<?php echo  ($show_header) ? 'true' : 'false'; ?>" data-colorscheme="<?php echo $color_scheme; ?>"></div>
			
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['likebox_url'] = strip_tags($new_instance['likebox_url']);
		$instance['show_faces'] = (bool) $new_instance['show_faces'];
		$instance['show_stream'] = (bool) $new_instance['show_stream'];
		$instance['show_header'] = (bool) $new_instance['show_header'];
		$instance['color_scheme'] = strip_tags($new_instance['color_scheme']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'likebox_url' => 'http://facebook.com/envato','show_faces' => true, 'show_stream'=>false, 'show_header'=>true,'color_scheme' => 'light') );
		$title = strip_tags($instance['title']);
		$likebox_url = strip_tags($instance['likebox_url']);
		$show_faces = (int) $instance['show_faces'];
		$show_stream = (int) $instance['show_stream'];
		$show_header = (int) $instance['show_header'];
		$color_scheme = strip_tags($instance['color_scheme']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('likebox_url'); ?>"><?php _e('Facebook Page URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('likebox_url'); ?>" name="<?php echo $this->get_field_name('likebox_url'); ?>" type="text" value="<?php echo esc_attr($likebox_url); ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" type="checkbox" value="1" <?php if ( $show_faces ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_faces'); ?>"><?php _e('Show Faces',"arsene"); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" type="checkbox" value="1" <?php if ( $show_stream ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_stream'); ?>"><?php _e('Show Stream',"arsene"); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>" type="checkbox" value="1" <?php if ( $show_header ) echo 'checked="checked"'; ?>/> <label for="<?php echo $this->get_field_id('show_header'); ?>"><?php _e('Show Header',"arsene"); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color Scheme:',"arsene"); ?></label>
		<select id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>">
		<option value="light" <?php echo $color_scheme == "light"?"selected":""; ?>>Light</option>
		<option value="dark" <?php echo $color_scheme == "dark"?"selected":""; ?>>Dark</option>
		</select></p>

		
<?php
	}

}
?>