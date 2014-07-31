<?php
/*===================================================================
WIDGET ADS 125x125
Displays four 125x125 Ads
=================================================================== */

class Arsene_Widget_Ads_125x125 extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays 125x125 Advertisements.","arsene") );
		parent::__construct('ads_125x125', __('Arsene 125x125 Ads',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
        
        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>		

		<div class="ads-container">
		<?php for($i=1; $i<5; $i++): ?>
		<?php if(!empty($instance['ads_link_'.$i]) && !empty($instance['ads_banner_'.$i])): ?>
			<div class="ads-block">
				<a href="<?php echo $instance['ads_link_'.$i]; ?>" target="_blank"><img src="<?php echo $instance['ads_banner_'.$i]; ?>" alt=""></a>
			</div>
		<?php endif; ?>
		<?php endfor; ?>
		</div>
			
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);


		for($i=1; $i<5; $i++){
			$instance['ads_link_'.$i] = strip_tags($new_instance['ads_link_'.$i]);
        	$instance['ads_banner_'.$i] = strip_tags($new_instance['ads_banner_'.$i]);
		}

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ads_link_1' => '', 'ads_banner_1' => '', 'ads_link_2' => '', 'ads_banner_2' => '', 'ads_link_3' => '', 'ads_banner_3' => '', 'ads_link_4' => '', 'ads_banner_4' => '') );
		$title = strip_tags($instance['title']);

		$ads_link_1 = strip_tags($instance['ads_link_1']);
		$ads_banner_1 = strip_tags($instance['ads_banner_1']);
		$ads_link_2 = strip_tags($instance['ads_link_2']);
		$ads_banner_2 = strip_tags($instance['ads_banner_2']);
		$ads_link_3 = strip_tags($instance['ads_link_3']);
		$ads_banner_3 = strip_tags($instance['ads_banner_3']);
		$ads_link_4 = strip_tags($instance['ads_link_4']);
		$ads_banner_4 = strip_tags($instance['ads_banner_4']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<!-- Ads 1 -->
		<p><label for="<?php echo $this->get_field_id('ads_link_1'); ?>"><?php _e('Ads 1 Link URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_link_1'); ?>" name="<?php echo $this->get_field_name('ads_link_1'); ?>" type="text" value="<?php echo esc_attr($ads_link_1); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('ads_banner_1'); ?>"><?php _e('Ads 1 Banner Image URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_banner_1'); ?>" name="<?php echo $this->get_field_name('ads_banner_1'); ?>" type="text" value="<?php echo esc_attr($ads_banner_1); ?>" /></p>

		<!-- Ads 2 -->
		<p><label for="<?php echo $this->get_field_id('ads_link_2'); ?>"><?php _e('Ads 2 Link URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_link_2'); ?>" name="<?php echo $this->get_field_name('ads_link_2'); ?>" type="text" value="<?php echo esc_attr($ads_link_2); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('ads_banner_2'); ?>"><?php _e('Ads 2 Banner Image URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_banner_2'); ?>" name="<?php echo $this->get_field_name('ads_banner_2'); ?>" type="text" value="<?php echo esc_attr($ads_banner_2); ?>" /></p>

		<!-- Ads 3 -->
		<p><label for="<?php echo $this->get_field_id('ads_link_3'); ?>"><?php _e('Ads 3 Link URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_link_3'); ?>" name="<?php echo $this->get_field_name('ads_link_3'); ?>" type="text" value="<?php echo esc_attr($ads_link_3); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('ads_banner_3'); ?>"><?php _e('Ads 3 Banner Image URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_banner_3'); ?>" name="<?php echo $this->get_field_name('ads_banner_3'); ?>" type="text" value="<?php echo esc_attr($ads_banner_3); ?>" /></p>

		<!-- Ads 4 -->
		<p><label for="<?php echo $this->get_field_id('ads_link_4'); ?>"><?php _e('Ads 4 Link URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_link_4'); ?>" name="<?php echo $this->get_field_name('ads_link_4'); ?>" type="text" value="<?php echo esc_attr($ads_link_4); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('ads_banner_4'); ?>"><?php _e('Ads 4 Banner Image URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('ads_banner_4'); ?>" name="<?php echo $this->get_field_name('ads_banner_4'); ?>" type="text" value="<?php echo esc_attr($ads_banner_4); ?>" /></p>

		

		
<?php
	}

}
?>