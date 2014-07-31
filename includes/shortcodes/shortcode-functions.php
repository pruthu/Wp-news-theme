<?php
/*=====================================================
  SHORTCODE FUNCTIONS
  =====================================================*/

/*=====================================================
  TINY MCE
  =====================================================*/
add_action('init', 'mce_add_button'); 
function mce_add_button(){
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   	{  
    	add_filter('mce_external_plugins', 'mce_add_plugin');  
     	add_filter('mce_buttons_3', 'mce_register_button');  
   	}  
}

function mce_add_plugin(){
	$plugin_array['quote'] = get_template_directory_uri().'/includes/shortcodes/quote/mce-plugin.js';
	$plugin_array['tabs'] = get_template_directory_uri().'/includes/shortcodes/tabs/mce-plugin.js';
	$plugin_array['accordion'] = get_template_directory_uri().'/includes/shortcodes/accordion/mce-plugin.js';
	$plugin_array['button'] = get_template_directory_uri().'/includes/shortcodes/button/mce-plugin.js';
	$plugin_array['dropcap'] = get_template_directory_uri().'/includes/shortcodes/dropcap/mce-plugin.js';
	$plugin_array['alert'] = get_template_directory_uri().'/includes/shortcodes/alert/mce-plugin.js';
	$plugin_array['column'] = get_template_directory_uri().'/includes/shortcodes/column/mce-plugin.js';
	$plugin_array['googlemap'] = get_template_directory_uri().'/includes/shortcodes/googlemap/mce-plugin.js';
	$plugin_array['qa'] = get_template_directory_uri().'/includes/shortcodes/qa/mce-plugin.js';
	$plugin_array['slider'] = get_template_directory_uri().'/includes/shortcodes/slider/mce-plugin.js';
   	return $plugin_array;  
}

function mce_register_button($buttons){
	array_push($buttons, "quote","tabs","accordion","button","dropcap","alert","column","googlemap","qa","slider");
   	return $buttons;  
}
/*=====================================================
  END TINY MCE
  =====================================================*/


/*=====================================================
  SHORTCODE QUOTE
  =====================================================*/
function bright_quote($atts, $content = null){
	extract( shortcode_atts( array(
		'cite'		=> '',
		'citeurl' 	=> '',
		'align'		=> '',
		), $atts ) );

	$data = '<blockquote class="' . $align . '">' . do_shortcode($content);

	if(!empty($cite)){
		$data .= '<footer>- ';
		if(!empty($citeurl)){
			$data .= '<a href="' . $citeurl . '" target="_blank" rel="nofollow external">' . $cite .'</a>';
		}else{
			$data .= $cite;
		}
		$data .= '</footer>';
	}		

	$data .= '</blockquote>';

	return $data;
}

add_shortcode("quote", "bright_quote");



/*=====================================================
  SHORTCODE DROPCAP
  =====================================================*/
function bright_dropcap($atts, $content = null){
	return '<span class="dropcap">' . $content . '</span>';
}

add_shortcode("dropcap", "bright_dropcap");


/*=====================================================
  SHORTCODE ALERT
  =====================================================*/
function bright_alert($atts, $content = null){
	extract( shortcode_atts( array(
		'style'		=> '',
		'title' 	=> '',
		), $atts ) );

	$data = '<div class="alert alert-block ' . $style . '"><button type="button" class="close" data-dismiss="alert">&times;</button>';

	if(!empty($title))
		$data .= '<h4>' . $title . '</h4>';

	$data .= do_shortcode($content) . '</div>';

	return $data;
}

add_shortcode("alert", "bright_alert");


/*=====================================================
  SHORTCODE BUTTON
  =====================================================*/
function bright_button($atts, $content = null){
	extract( shortcode_atts( array(
		'style'	=> '',
		'text' 	=> '',
		'link' 	=> '',
		'icon' 	=> '',
		'target' 	=> '',
		'nofollow' 	=> '',
		'size'	=> '',
		'icon_position' => ''
		), $atts ) );

	$data = '<a href="'.$link.'" rel="'.$nofollow.'" target="'.$target.'" class="btn '.$style.' '.$size.'">';
	if($icon !== ""){
		if($icon_position === "")
			$data .= '<i class="'.$icon.'"></i> '.$text.'</a>';
		else
			$data .= $text.' <i class="'.$icon.'"></i></a>';
	}else{
		$data .= $text.'</a>';
	}
	

	return $data;
}

add_shortcode("button", "bright_button");


/*=====================================================
  SHORTCODE QA
  =====================================================*/
function bright_question_answer($atts, $content = null){
	extract( shortcode_atts( array(
		'question'	=> '',
		), $atts ) );

	$data = '<div class="qa"><p class="question">'.$question.'</p><p class="answer">'.do_shortcode($content).'</p></div>';
	return $data;
}
add_shortcode("qa", "bright_question_answer");


/*=====================================================
  SHORTCODE TAB
  =====================================================*/
global $tab_n;
function bright_tabs($atts, $content = null){
	extract( shortcode_atts( array(
		'style'	=> '',
		), $atts ) );	

	$tabstyle = "style-2";
	if($style == 2)
		$tabstyle = "style-3";

	$tab_id = 'brightTab-'.rand(1,100);	
	$data = '<div id="'.$tab_id.'" class="bt-tab '.$tabstyle.'"><ul class="nav nav-tabs">';

	global $tab_n;
	$tab_data = explode('<!-- tab-cut -->', do_shortcode($content));
	$i = 0; $tab_titles = ''; $tab_contents = '';

	foreach($tab_data as $item){
		if($i++%2==0)
			$tab_titles .= $item;
		else 
			$tab_contents .= $item;
	}
	
	$data .= $tab_titles . '</ul><div class="tab-content">' . $tab_contents . '</div></div>';
	return $data;
}
/*=====================================================
  SHORTCODE QA
  =====================================================*/
function bright_tab($atts, $content = null){
	global $tab_n; $tab_n++;
	extract( shortcode_atts( array(
		'title'	=> '',
		), $atts ) );	
	
	if($tab_n == 1)
		$active = "active";
	else
		$active = "";

	
	$data = '<li class="'.$active.'"><a href="#tab-'.$tab_n.'">'.$title.'</a></li>';
	$data .= '<!-- tab-cut --><div class="tab-pane '.$active.'" id="tab-'.$tab_n.'">'.do_shortcode($content).'</div><!-- tab-cut -->';

	return $data;
}
add_shortcode("tabs", "bright_tabs");
add_shortcode("tab", "bright_tab");


/*=====================================================
  SHORTCODE GOOGLEMAP
  =====================================================*/
function bright_googlemap($atts, $content = null){
	extract( shortcode_atts( array(
		'latitude'		=> '',
		'longitude' 	=> '',
		), $atts ) );

	$data = ' <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
      var map;
	  function initialize() {
        var mapOptions = {
          zoom: 15,
          center: new google.maps.LatLng('.$latitude.','.$longitude.'),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("bright-map"),
            mapOptions);

        var marker = new google.maps.Marker({
          position: map.getCenter(),
          map: map,
          title: "Click to zoom"
        });

        google.maps.event.addListener(map, "center_changed", function() {
          // 3 seconds after the center of the map has changed, pan back to the
          // marker.
          window.setTimeout(function() {
            map.panTo(marker.getPosition());
          }, 3000);
        });
      }

      google.maps.event.addDomListener(window, "load", initialize);
    </script>
    <div id="map-container"><div id="bright-map"></div></div>';

	return $data;
}

add_shortcode("googlemap", "bright_googlemap");

/*=====================================================
  SHORTCODE TAB
  =====================================================*/

$accordion_id = rand(1,10000);
function bright_accordions($atts, $content = null){
	extract( shortcode_atts( array(
		'align'	=> '',
		), $atts ) );	
	global $accordion_id;

	$data = '<div class="accordion bt-accordion '.$align.'" id="accordion-'.$accordion_id.'">'.do_shortcode($content).'</div>';
	$accordion_id = rand(1,10000);
	return $data;
}
/*=====================================================
  SHORTCODE ACCORDION
  =====================================================*/
function bright_accordion($atts, $content = null){
	global $accordion_id; 
	extract( shortcode_atts( array(
		'title'	=> '',
		'state'	=> '',
		), $atts ) );	
	

	if($state == "open"){
		$active = "in";
		$active_heading = "active-accordion";
	}else{
		$active = "";
		$active_heading = "";
	}

	$accordion_groupid = rand(1,1000);

	$data 	= '<div class="accordion-group">';
	$data 	.= '<div class="accordion-heading">';
	$data 	.= '<a class="accordion-toggle '.$active_heading.'" data-toggle="collapse" data-parent="#accordion-'.$accordion_id.'" href="#collapse-'.$accordion_groupid.'">'.$title.'</a>';
	$data 	.= '</div>';
	$data 	.= '<div id="collapse-'.$accordion_groupid.'" class="accordion-body collapse '.$active.'">';
	$data 	.= '<div class="accordion-inner">'.do_shortcode($content).'</div>';
	$data 	.= '</div></div>';

	$accordion_groupid = rand(1,1000);

	return $data;
}
add_shortcode("accordions", "bright_accordions");
add_shortcode("accordion", "bright_accordion");


/*=====================================================
  SHORTCODE COLUMN
  =====================================================*/
/* COL */
function bright_column($atts, $content = null){
	extract( shortcode_atts( array(
		'span'	=> '',
		), $atts ) );

	$newspan = intval($span)*2;
	return '<div class="span'.$newspan.'">'.do_shortcode($content).'</div>';	
}
/* ROW */
function bright_row($atts, $content = null){
	return '<div class="row-fluid margin-b30">'.do_shortcode($content).'</div>';
}
/* GRID */
function bright_grid($atts, $content = null){
	return '<div class="bt-grid">'.do_shortcode($content).'</div>';
}

add_shortcode("col", "bright_column");
add_shortcode("row", "bright_row");
add_shortcode("grid", "bright_grid");


/*===================================================
  SHORTCODE AUDIO
  ===================================================*/
function bright_audio($atts, $content = null){
	$audio_file = "";
	if(!empty($atts)){
		$audio_file = $atts[0];
	}

	$data = "";

	if(!empty($audio_file)){
		$data  = '<audio controls>';
		$data .= '<source src="'.$audio_file.'">';
		$data .= '</audio>';
	}

	return $data;

}
add_shortcode("audio","bright_audio");


/*===================================================
  SHORTCODE SLIDESHOW
  ===================================================*/
function bright_slideshow($atts, $content = null){
	extract( shortcode_atts( array(
		'align'	=> '',
		), $atts ) );

	$id=  rand(1,1000);

	return '<script type="text/javascript">jQuery(document).ready(function($){ $("#bt_slider_'.$id.'").flexslider({ animation :"slide",controlNav:false, smoothHeight: true, }); });</script><div id="bt_slider_'.$id.'" class="bt_slider flexslider '.$align.'"><ul class="slides">'.do_shortcode($content).'</ul></div>';	
}
/* ROW */
function bright_slideitem($atts, $content = null){
	extract( shortcode_atts( array(
		'image'	=> '',
		'title' => ''
		), $atts ) );
	return '<li><div class="slideshow-content"><div class="slideshow-image"><img src="'.$image.'" alt=""><div class="slideshow-title"><span>'.$title.'</span></div></div><div class="slideshow-description">'.do_shortcode($content).'</div></div></li>';
}
add_shortcode("slideitem", "bright_slideitem");
add_shortcode("slideshow", "bright_slideshow");