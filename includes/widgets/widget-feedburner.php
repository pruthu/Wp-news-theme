<?php
/*===================================================================
WIDGET FEEDBURNER SUBSCRIPTION
Displays Feedburner Email Subscription
=================================================================== */

class Arsene_Widget_Feedburner extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays Feedburner email subscription.","arsene") );
		parent::__construct('feedburner', __('Arsene Feedburner',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$intro_text = $instance['intro_text'];
		$feedburner_id = $instance['feedburner_id'];
        
        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>		
			<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner_id; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
				<!--<input type="text" name="email"/>-->
				<p class="intro-text"><?php echo $intro_text; ?></p>
				<div class="input-prepend input-area">
				  	<span class="add-on"><i class="icon-envelope"></i></span>
				  	<input type="text" name="email" placeholder="Email" class="txt-email">				  	
				</div>				
				<input type="hidden" value="<?php echo $feedburner_id; ?>" name="uri"/>
				<input type="hidden" name="loc" value="en_US"/>				
				<button type="submit" class="btn brn-large btn-inverse"><i class="icon-circle-arrow-right"></i> Subscribe</button>
			</form>	
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['intro_text'] = strip_tags($new_instance['intro_text']);
		$instance['feedburner_id'] = strip_tags($new_instance['feedburner_id']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'feedburner_id' => '', 'intro_text'=>'New releases, updates, sneak peeks & exclusive deals right in your inbox.') );
		$title = strip_tags($instance['title']);
		$intro_text = strip_tags($instance['intro_text']);
		$feedburner_id = strip_tags($instance['feedburner_id']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('intro_text'); ?>"><?php _e('Introduction text:',"arsene"); ?></label>
		<textarea rows="5" cols="20" class="widefat" id="<?php echo $this->get_field_id('intro_text'); ?>" name="<?php echo $this->get_field_name('intro_text'); ?>"><?php echo esc_attr($intro_text); ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Feedburner ID:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo esc_attr($feedburner_id); ?>" /></p>
		
<?php
	}

}
?>