<?php
/*===================================================================
PAGE BUILDER : 728x90 ADS BLOCK
=================================================================== */
class Arsene_Block_300_Ads extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Ads 300x250',
			'size' => 'span6',
			'class_name' => 'widget-ads-300x250',
			'resizable' => 0
		);
		
		//create the block
		parent::__construct('arsene_block_300_ads', $block_options);
	}
	
	function form($instance) {
		$defaults = array(
			'title' => '',
			'ads_link' => '',
			'ads_banner' => '',
			'ads_code' => '',
			'target_link' => '_blank',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);		

		?>
		<div class="widget-content">
			<p>
				<label for="<?php echo $this->get_field_id('title') ?>">
					<?php _e('Title (optional)','arsene'); ?>:
					<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
				</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('ads_link') ?>">
					<?php _e('Advertisement Link (use http://)','arsene');?>:
					<?php echo aq_field_input('ads_link', $block_id, $ads_link, $size = 'full') ?>					
				</label>
				<small>Enter the advertisement link.</small>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('target_link') ?>">
					<?php _e('Target Link','arsene');?>:
					<select id="<?php echo $this->get_field_id('target_link') ?>" name="<?php echo $this->get_field_name('target_link') ?>">
						<option value="_blank" <?php echo $target_link == "_blank" ? "selected": ""; ?>>_blank</option>
						<option value="_self" <?php echo $target_link == "_self" ? "selected": ""; ?>>_self</option>
						<option value="_parent" <?php echo $target_link == "_parent" ? "selected": ""; ?>>_parent</option>
						<option value="_top" <?php echo $target_link == "_top" ? "selected": ""; ?>>_top</option>
					</select>				
				</label>
				<small>Select the target link.</small>
			</p>


			<p>
				<label for="<?php echo $this->get_field_id('ads_banner') ?>">
					<?php _e('Advertisement Banner Image URL (use http://)','arsene');?>:
					<?php echo aq_field_input('ads_banner', $block_id, $ads_banner, $size = 'full') ?>					
				</label>
				<small>Enter the advertisement banner image url.</small>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('ads_code') ?>">
					<?php _e('Advertisement custom code','arsene');?>:
					<textarea class="widefat" rows="5" id="<?php echo $this->get_field_id('ads_code') ?>" name="<?php echo $this->get_field_name('ads_code') ?>"><?php echo $ads_code; ?></textarea>				
				</label>
				<small>Custom advertisement code like Google Adsense.</small>
			</p>

		</div>
		<?php
	}
	
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function block($instance) {
		extract($instance);
		
		?>
		<div class="ads-container">
			<div class="ads-block">
				<?php if(!empty($ads_link) && !empty($ads_banner)): ?>
				<a href="<?php echo $ads_link; ?>" target="<?php echo $target_link; ?>">
					<img src="<?php echo $ads_banner; ?>" alt="">
				</a>
				<?php elseif(!empty($ads_code)): ?>
				<?php echo ($ads_code); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php

	}
	
}