<div class="span4">
	<div class="boxed-container">
		<?php
		if(is_active_sidebar("sidebar-page")){
			dynamic_sidebar( 'sidebar-page' );
		}else{
			dynamic_sidebar( 'sidebar-default' );
		}
		?>
	</div>
</div>