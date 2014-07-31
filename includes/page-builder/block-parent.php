<?php
class Arsene_Block_Parent extends AQ_Block {
	
	/* PHP4 constructor */
	function Arsene_Block_Parent($id_base = false, $block_options = array()) {
		Arsene_Block_Parent::__construct($id_base, $block_options);
	}
	 	
	/* PHP5 constructor */
	function __construct($id_base = false, $block_options = array()) {
		$this->id_base = isset($id_base) ? strtolower($id_base) : strtolower(get_class($this));
		$this->name = isset($block_options['name']) ? $block_options['name'] : ucwords(preg_replace("/[^A-Za-z0-9 ]/", '', $this->id_base));
		$this->block_options = $this->parse_block($block_options);
	}

	/* block header */
	function before_block($instance) {
		extract($instance);
		$column_class = $first ? 'aq-first' : '';
	 		
		echo '<div id="arsene-block-'.$number.'" class="widget '.$class_name.' '. $size .'"><span class="paper-tape"></span>';
		if(!empty($title)){
		?> <h3 class="widget-title"><span> <?php echo $title; ?></span></h3> <?php
		}
	}
	 	
	/* block footer */
	function after_block($instance) {
		extract($instance);
		echo '</div>';	
	}

}