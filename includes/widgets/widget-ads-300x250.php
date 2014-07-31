<?php
/*===================================================================
WIDGET ADS 300x250
Displays 300x250 Ads
=================================================================== */

class Arsene_Widget_Ads_300x250 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays 300x250 Advertisement.","arsene") );
		parent::__construct('ads_300x250', __('Arsene 300x250 Ads',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$ads_link = $instance['ads_link'];
        $ads_banner = $instance['ads_banner'];
        
        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>		

		<?php if(!empty($ads_link) && !empty($ads_banner)): ?>
		<div class="ads-container">
			<div class="ads-block">
				<a href="<?php echo $ads_link; ?>" target="_blank">
					<img src="<?php echo $ads_banner; ?>" alt="">
				</a>
			</div>
		</div>
		<?php endif; ?>
			
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['ads_link'] = strip_tags($new_instance['ads_link']);
        $instance['ads_banner'] = strip_tags($new_instance['ads_banner']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ads_link' => '', 'ads_banner' => '') );
		$title = strip_tags($instance['title']);
		$ads_link = strip_tags($instance['ads_link']);
		$ads_banner = strip_tags($instance['ads_banner']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('ads_link'); ?>"><?php _e('Advertisement Link URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_link'); ?>" name="<?php echo $this->get_field_name('ads_link'); ?>" type="text" value="<?php echo esc_attr($ads_link); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('ads_banner'); ?>"><?php _e('Advertisement banner Image URL :',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_banner'); ?>" name="<?php echo $this->get_field_name('ads_banner'); ?>" type="text" value="<?php echo esc_attr($ads_banner); ?>" /></p>

		
<?php
	}

}
?>