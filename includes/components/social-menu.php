<?php

/*===================================================================
Social Menu :: Display social menu icons in top bar.
=================================================================== */

if(!function_exists("bt_social_menu")){
	function bt_social_menu(){
?>
	<ul class="social-menu">
		<?php
			$available_social = array("Twitter","Facebook","Google+","Pinterest","Youtube","Vimeo","Flickr","Dribbble","DeviantArt","LinkedIn","RSS","Email");

			for($i=0; $i<count($available_social); $i++){
				$class = str_replace("+","plus",strtolower($available_social[$i]));
				if(get_arsene_option("arsene_".$class."_profile") != ""){					
					$url = "";
					if($class=="email")
						$url .= "mailto:". get_arsene_option("arsene_".$class."_profile");
					else
						$url .= get_arsene_option("arsene_".$class."_profile");
					echo '<li class="'.$class.'"><a href="'.$url.'" title="'.$available_social[$i].'" target="_blank"></a></li>';
				}

			}
		?>        
	</ul>
<?php
	}
}
?>