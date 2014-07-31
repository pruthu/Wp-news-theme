<div class="span4">
	<div class="boxed-container">
		<?php
		if(is_active_sidebar("sidebar-front-page")){
			dynamic_sidebar( 'sidebar-front-page' );
		}else{
			dynamic_sidebar( 'sidebar-default' );
		}
		?>
	</div>
</div>