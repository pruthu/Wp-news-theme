<div class="span4">
	<div class="boxed-container">
		<?php
		if(is_active_sidebar("sidebar-single")){
			dynamic_sidebar( 'sidebar-single' );
		}else{
			dynamic_sidebar( 'sidebar-default' );
		}
		?>
	</div>
</div>