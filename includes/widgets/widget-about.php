<?php
/*===================================================================
WIDGET ABOUT
Displays Mini About us.
=================================================================== */
class Arsene_Widget_About_Us extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'about_us', 'description' => __('Mini about us',"arsene"));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('about_us', __('Arsene About Us',"arsene"), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$logo_url = $instance['logo_url'];
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		echo $before_widget;

		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
			<div class="widget-about">
				<?php if(!empty($logo_url)): ?> <div class="about-logo"><img src="<?php echo $logo_url; ?>" alt="" /></div><?php endif; ?>
				<?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?>
			</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['logo_url'] = strip_tags($new_instance['logo_url']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '','logo_url'=>get_template_directory_uri().'/assets/images/logo.png' ) );
		$title = strip_tags($instance['title']);
		$logo_url = strip_tags($instance['logo_url']);
		$text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('logo_url'); ?>"><?php _e('Logo Image URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('logo_url'); ?>" name="<?php echo $this->get_field_name('logo_url'); ?>" type="text" value="<?php echo esc_attr($logo_url); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Introduction Text:',"arsene"); ?></label><textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></p>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs','arsene'); ?></label></p>
<?php
	}
}