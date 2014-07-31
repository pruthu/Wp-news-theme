<?php
/** A simple text block **/
class Arsene_Block_Text extends Arsene_Block_Parent {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Text',
			'size' => 'span12',
			'class_name' => 'widget-custom-text',
		);
		
		//create the block
		parent::__construct('arsene_block_text', $block_options);
	}
	
	function form($instance) {
		
		$defaults = array(
			'text' => '',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<p class="description">
			<label for="<?php echo $this->get_field_id('title') ?>">
				Title (optional)
				<?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('text') ?>">
				Content
				<?php echo aq_field_textarea('text', $block_id, $text, $size = 'full') ?>
			</label>
		</p>
		
		<?php
	}
	
	function block($instance) {
		extract($instance);
		echo wpautop(do_shortcode(htmlspecialchars_decode($text)));
	}
	
}