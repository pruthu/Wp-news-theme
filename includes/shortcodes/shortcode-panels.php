<?php

/*======================================================
  CREATE AJAX
======================================================*/
add_action('wp_ajax_bright-quote-shortcode-panel', 'bright_quote_shortcode_panel');
add_action('wp_ajax_bright-alert-shortcode-panel', 'bright_alert_shortcode_panel');
add_action('wp_ajax_bright-button-shortcode-panel', 'bright_button_shortcode_panel');
add_action('wp_ajax_bright-tabs-shortcode-panel', 'bright_tabs_shortcode_panel');
add_action('wp_ajax_bright-googlemap-shortcode-panel', 'bright_googlemap_shortcode_panel');
add_action('wp_ajax_bright-accordion-shortcode-panel', 'bright_accordion_shortcode_panel');
add_action('wp_ajax_bright-column-shortcode-panel', 'bright_column_shortcode_panel');
add_action('wp_ajax_bright-slider-shortcode-panel', 'bright_slider_shortcode_panel');


function bright_init_html($title = "Insert Shortcode"){
?>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<title><?php echo $title; ?></title>
			<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/shortcodes/shortcode-style.css">
			<script type="text/javascript" src="<?php echo includes_url('js/jquery/jquery.js'); ?>"></script>
			<script type="text/javascript" src="<?php echo includes_url('js/tinymce/tiny_mce_popup.js'); ?>"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/shortcodes/shortcode-actions.js"></script>
		</head>
		<body>
<?php
}
function bright_end_html(){
?>
		</body>
	</htmL>
<?php
}


/*======================================================
  QUOTE SHORTCODE PANEL
======================================================*/
function bright_quote_shortcode_panel(){
	bright_init_html("Insert Quote");
?>
	<!-- BEGIN SHORTCODE PANEL -->
	<script type="text/javascript">
	jQuery(document).ready(function($){		
		$("#quote_content").val(tinyMCE.activeEditor.selection.getContent({format : 'text'}));
	})
	</script>
	<input id="shortcode_type" type="hidden" value="quote">
	<div class="block">
		<p>
			<label for="content">Quote Content</label>			
			<textarea id="content" rows="5" cols="20"></textarea>
		</p>
		<p>
			<label for="cite">Citation</label>
			<input type="text" id="cite" name="cite" value="">
		</p>
		<p>
			<label for="citeurl">Citation URL</label>
			<input type="text" id="citeurl" name="citeurl" value="">
		</p>
		<p>
			<label for="align">Pull</label>
			<select id="align">
				<option value="">None</option>
				<option value="pull-left">Left</option>
				<option value="pull-right">Right</option>
			</select>
		</p>
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}


/*======================================================
  ALERT SHORTCODE PANEL
======================================================*/
function bright_alert_shortcode_panel(){
	bright_init_html("Insert Alert");
?>
	<!-- BEGIN SHORTCODE PANEL -->
	<script type="text/javascript">
	jQuery(document).ready(function($){		
		$("#alert_content").val(tinyMCE.activeEditor.selection.getContent({format : 'text'}));
	})
	</script>
	<input id="shortcode_type" type="hidden" value="alert">
	<div class="block">
		<p>
			<label for="style">Alert Style</label>
			<select id="style">
				<option value="">Warning</option>
				<option value="alert-error">Error</option>
				<option value="alert-success">Success</option>
				<option value="alert-info">Info</option>
			</select>
		</p>
		<p>
			<label for="title">Alert Title (optional)</label>
			<input type="text" id="title" name="title" value="">
		</p>		
		<p>
			<label for="content">Alert Content</label>			
			<textarea id="content" rows="5" cols="20"></textarea>
		</p>
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}


/*======================================================
  BUTTON SHORTCODE PANEL
======================================================*/
function bright_button_shortcode_panel(){
	bright_init_html("Insert Button");
?>
	<!-- BEGIN SHORTCODE PANEL -->
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$("#nofollow").click(function(){
			if($(this).is(":checked"))
				$(this).val("1");
			else
				$(this).val("0");
		})
	})
	</script>
	<input id="shortcode_type" type="hidden" value="button">
	<div class="block">
		<p>
			<label for="style">Button Style</label>
			<select id="style">
				<option value="">Default</option>
				<option value="btn-primary">Button Primary</option>
				<option value="btn-info">Button Info</option>
				<option value="btn-success">Button Success</option>
				<option value="btn-warning">Button Warning</option>
				<option value="btn-danger">Button Danger</option>
				<option value="btn-inverse">Button Inverse</option>
			</select>
		</p>
		<p>
			<label for="size">Button Size</label>
			<select id="size">
				<option value="">Default</option>
				<option value="btn-large">Large</option>				
				<option value="btn-small">Small</option>
				<option value="btn-mini">Mini</option>
			</select>
		</p>	
		<p>
			<label for="link">Destination Link URL</label>
			<input type="text" id="link" name="link" value="">
		</p>
		<p>
			<label for="text">Button Text</label>
			<input type="text" id="text" name="text" value="">
		</p>
		<p>
			<label for="icon">Button Icon (optional)</label>
			<input type="text" id="icon" name="icon">
			<span class="howto">Icon is using Font Awesome, enter the icon code above. use <code>icon-[icon-code]</code>. <strong><a href="<?php echo 'http://fortawesome.github.com/Font-Awesome/'; ?>" target="_blank" rel="external nofollow">Read Documentation</a>.</strong></span>
		</p>	
		<p>
			<label for="icon_position">Icon Position</label>
			<select id="icon_position">
				<option value="">Left</option>
				<option value="right">Right</option>								
			</select>
		</p>	
		<p>
			<label for="target">Target Link</label>			
			<select id="target">
				<option value="_blank">_Blank</option>
				<option value="_self">_Self</option>
				<option value="_parent">_Parent</option>
				<option value="_top">_Top</option>
			</select>
		</p>
		<p>
			<label for="nofollow"><input checked="checked" type="checkbox" id="nofollow" name="button_text" value="1"> Use <code>rel="external nofollow"</code></label>			
		</p>	
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}

/*======================================================
  TABS SHORTCODE PANEL
======================================================*/
function bright_tabs_shortcode_panel(){
	bright_init_html("Insert Tabs");
?>
	<!-- BEGIN SHORTCODE PANEL -->		
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.core.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo (get_template_directory_uri() . '/assets/js/jquery.ui.widget.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.mouse.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.sortable.min.js'); ?>"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($){		
		var numberTab = 0;

		/* ADD NEW TAB */
		$("#new_tab").click(function(){
			$(".block-form.master").clone().appendTo(".block-container").slideDown(function(){
				$(this).removeClass("master");
			})
			return false;
		});

		/* DELETE FORM */
		$(".delete_form").live("click", function(){
			$(this).parents(".block-form:first").slideUp(function(){
				$(this).remove();
			});
			return false;
		})

		/* HANDLE SHOW/HIDE */
		$(".block-handle").live("click", function(){
			$(this).parents(".block-form:first").find(".block-content").slideToggle();
		});

		// SORTABLE CRITERIA ITEM
		if ( jQuery( ".block-container" ).length > 0 ) {		
			jQuery( ".block-container" ).sortable({
				revert: true
			});			
		}

		/* TITLE FOCUS OUT */
		$(".tab-title").live("focusout", function(){
			var val = $(this).val();
			if(val !== ""){
				$(this).parents(".block-form:first").find(".block-title").html(val);
			}
		})

	})
	</script>
	<input id="shortcode_type" type="hidden" value="tabs">
	<div class="block">
		<ul class="block-container">
			
			<li class="block-form master">
				<div class="block-bar">
					<p class="block-title">New Tab</p>
					<span class="block-handle" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/tab-arrows.png) no-repeat top center;"></span>
				</div>
				<div class="block-content">
					<input type="hidden" id="tab-1">
					<p>
						<label>Tab Title</label>
						<input type="text" class="tab-title">
					</p>
					<p>
						<label>Tab Content</label>
						<textarea cols="20" rows="5" class="tab-content"></textarea>
					</p>
					<hr>
					<div class="control"><a class="delete_form button button-2" href="#">Delete</a></div>
				</div>				
			</li>

		</ul>
		<a class="button button-1" id="new_tab" href="#">New Tab</a>	
		<hr>
		<p>
			<label for="tabstyle">Tab Style</label>
			<select id="tabstyle">
				<option value="1">Style 1</option>
				<option value="2">Style 2</option>								
			</select>
		</p>	
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}


/*======================================================
  GOOGLE MAP SHORTCODE PANEL
======================================================*/
function bright_googlemap_shortcode_panel(){
	bright_init_html("Insert Google Map");
?>
	<!-- BEGIN SHORTCODE PANEL -->
	<input id="shortcode_type" type="hidden" value="googlemap">
	<div class="block">
		<p>
			<label for="latitude">Latitude</label>
			<input type="text" id="latitude">
		</p>
		<p>
			<label for="longitude">Longitude</label>
			<input type="text" id="longitude">
		</p>
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}


/*======================================================
  ACCORDION SHORTCODE PANEL
======================================================*/
function bright_accordion_shortcode_panel(){
	bright_init_html("Insert Accordion");
?>
	<!-- BEGIN SHORTCODE PANEL -->		
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.core.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo (get_template_directory_uri() . '/assets/js/jquery.ui.widget.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.mouse.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.sortable.min.js'); ?>"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($){		
		var numberTab = 0;

		/* ADD NEW TAB */
		$("#new_accordion").click(function(){
			$(".block-form.master").clone().appendTo(".block-container").slideDown(function(){
				$(this).removeClass("master");
			})
			return false;
		});

		/* DELETE FORM */
		$(".delete_form").live("click", function(){
			$(this).parents(".block-form:first").slideUp(function(){
				$(this).remove();
			});
			return false;
		})

		/* HANDLE SHOW/HIDE */
		$(".block-handle").live("click", function(){
			$(this).parents(".block-form:first").find(".block-content").slideToggle();
		});

		// SORTABLE CRITERIA ITEM
		if ( jQuery( ".block-container" ).length > 0 ) {		
			jQuery( ".block-container" ).sortable({
				revert: true
			});			
		}

		/* TITLE FOCUS OUT */
		$(".accordion_title").live("focusout", function(){
			var val = $(this).val();
			if(val !== ""){
				$(this).parents(".block-form:first").find(".block-title").html(val);
			}
		})

	})
	</script>
	<input id="shortcode_type" type="hidden" value="accordion">
	<div class="block">
		<ul class="block-container">
			
			<li class="block-form master">
				<div class="block-bar">
					<p class="block-title">New Accordion</p>
					<span class="block-handle" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/tab-arrows.png) no-repeat top center;"></span>
				</div>
				<div class="block-content">
					<input type="hidden" id="accordion-1">
					<p>
						<label>Accordion Title</label>
						<input type="text" class="accordion_title">
					</p>
					<p>
						<label>Accordion Content</label>
						<textarea cols="20" rows="5" class="accordion_content"></textarea>
					</p>
					<p>
						<label>Accordion State</label>
						<select class="accordion_state">
							<option value="close">Close</option>
							<option value="open">Open</option>								
						</select>
					</p>
					<hr>
					<div class="control"><a class="delete_form button button-2" href="#">Delete</a></div>
				</div>				
			</li>

		</ul>		
		<a class="button button-1" id="new_accordion" href="#">New Accordion</a>			
		<hr>
		<p>
			<label for="align">Pull</label>
			<select id="align">
				<option>None</option>
				<option value="left">Left</option>
				<option value="right">Right</option>								
			</select>
		</p>	
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}


/*======================================================
  COLUMN SHORTCODE PANEL
======================================================*/
function bright_column_shortcode_panel(){
	bright_init_html("Insert Grid Column");
?>
	<!-- BEGIN SHORTCODE PANEL -->		
	<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$("#source .row").draggable({
			connectToSortable: "#destination",
			helper: "clone",
			revert: "invalid",
			cursor: "move",
        });

        $(".col").draggable({
			connectToSortable: ".block-row",
			helper: "clone",
			revert: "invalid",
			cursor: "move",
        });

        $("#destination").sortable({
			revert: false,
			//handle: '.handle',
			cursor: 'move',	
			items: 'li.row',
            receive: function (event, ui) {
				var e = $(this).data().sortable.currentItem;
				e.removeClass("ui-draggable");  
				var rowBlock = $(e).find(".block-row");                                    
				if (e.attr('class') === 'row') {                    	
					$(e).find(".info").html("Drag and drop column on the container below.");
					rowBlock.sortable({cursor: "move"}).droppable({
						/*
						greedy: true,      
						accept: '#source .col',
						drop: function (event, ui) {
							var e = $(ui.draggable);//.clone().removeClass("ui-draggable");																						
							$(this).append(e);
						}
						*/
						drop: function(event, ui){
							var e = $(ui.draggable);							
						}
					});
				}
			}
		});

        $("#destination li").each().live("dblclick", function(){
        	$(this).remove();
        })
		
		$(".gridsetcontent").live("click", function(){			
			$(this).parents(".col:first").find(".gridcontentwrap").show();
			$('#destination').css({"margin-top":"350px"});
			return false;
		})
		$(".done").live("click", function(){
			var $gridcontent = $(this).parents(".col:first").find(".gridcontent");
			$(".gridcontentwrap").hide();
			$('#destination').css({"margin-top":"0"});		
			if($gridcontent.val() !== ""){
				$(this).parents(".col:first").find(".gridsetcontent").html("Update Content");
			}else{
				$(this).parents(".col:first").find(".gridsetcontent").html("Set Content");
			}
		})

		$(".closecol").live("click", function(){
			$(this).parents(".col:first").remove();
		})

		$(".closerow").live("click", function(){
			$(this).parents(".row:first").remove();
		})

	})
	</script>
	<input id="shortcode_type" type="hidden" value="column">
	<div class="block" style="width: 750px;">
		<ul id="destination" class="block-container drop-blocks">
			
		</ul>

		<ul id="source" class="available-blocks">			
			<li class="row">
				<span class="closerow">&times;</span>
				<span class="handle"></span>
				<span class="info">Row</span>
				<ul class="block-row"></ul>
			</li>
			<li class="col col1">
				<span class="closecol">&times;</span>
				<span class="gridlabel">Column 1</span>
				<a href="#" class="gridsetcontent">Set Content</a>
				<input type="hidden" class="gridcol" value="1">		
				<div class="gridcontentwrap">
					<label>Set Content</label>
					<textarea class="gridcontent" cols="20" rows="5"></textarea>
					<div style="text-align: right"><span class="done">Done</span></div>
				</div>
			</li>
			<li class="col col2">
				<span class="closecol">&times;</span>
				<span class="gridlabel">Column 2</span>
				<a href="#" class="gridsetcontent">Set Content</a>
				<input type="hidden" class="gridcol" value="2">
				<div class="gridcontentwrap">
					<label>Set Content</label>
					<textarea class="gridcontent" cols="20" rows="5"></textarea>
					<div style="text-align: right"><span class="done">Done</span></div>
				</div>
			</li>
			<li class="col col3">
				<span class="closecol">&times;</span>
				<span class="gridlabel">Column 3</span>
				<a href="#" class="gridsetcontent">Set Content</a>
				<input type="hidden" class="gridcol" value="3">
				<div class="gridcontentwrap">
					<label>Set Content</label>
					<textarea class="gridcontent" cols="20" rows="5"></textarea>
					<div style="text-align: right"><span class="done">Done</span></div>
				</div>
			</li>
			<li class="col col4">
				<span class="closecol">&times;</span>
				<span class="gridlabel">Column 4</span>
				<a href="#" class="gridsetcontent">Set Content</a>
				<input type="hidden" class="gridcol" value="4">
				<div class="gridcontentwrap">
					<label>Set Content</label>
					<textarea class="gridcontent" cols="20" rows="5"></textarea>
					<div style="text-align: right"><span class="done">Done</span></div>
				</div>
			</li>
			<li class="col col5">
				<span class="closecol">&times;</span>
				<span class="gridlabel">Column 5</span>
				<a href="#" class="gridsetcontent">Set Content</a>
				<input type="hidden" class="gridcol" value="5">
				<div class="gridcontentwrap">
					<label>Set Content</label>
					<textarea class="gridcontent" cols="20" rows="5"></textarea>
					<div style="text-align: right"><span class="done">Done</span></div>
				</div>
			</li>
			<li class="col col6">
				<span class="closecol">&times;</span>
				<span class="gridlabel">Column 6</span>
				<a href="#" class="gridsetcontent">Set Content</a>
				<input type="hidden" class="gridcol" value="6">
				<div class="gridcontentwrap">
					<label>Set Content</label>
					<textarea class="gridcontent" cols="20" rows="5"></textarea>
					<div style="text-align: right"><span class="done">Done</span></div>
				</div>
			</li>
		</ul>
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}


/*======================================================
  ACCORDION SLIDER PANEL
======================================================*/
function bright_slider_shortcode_panel(){
	bright_init_html("Insert Slideshow");
?>
	<!-- BEGIN SHORTCODE PANEL -->		
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.core.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo (get_template_directory_uri() . '/assets/js/jquery.ui.widget.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.mouse.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo includes_url('js/jquery/ui/jquery.ui.sortable.min.js'); ?>"></script>
	<script type="text/javascript">
	jQuery(document).ready(function($){		
		var numberTab = 0;

		/* ADD NEW TAB */
		$("#new_slider").click(function(){
			$(".block-form.master").clone().appendTo(".block-container").slideDown(function(){
				$(this).removeClass("master");
			})
			return false;
		});

		/* DELETE FORM */
		$(".delete_form").live("click", function(){
			$(this).parents(".block-form:first").slideUp(function(){
				$(this).remove();
			});
			return false;
		})

		/* HANDLE SHOW/HIDE */
		$(".block-handle").live("click", function(){
			$(this).parents(".block-form:first").find(".block-content").slideToggle();
		});

		// SORTABLE CRITERIA ITEM
		if ( jQuery( ".block-container" ).length > 0 ) {		
			jQuery( ".block-container" ).sortable({
				revert: true
			});			
		}

		/* TITLE FOCUS OUT */
		$(".slideshow_title").live("focusout", function(){
			var val = $(this).val();
			if(val !== ""){
				$(this).parents(".block-form:first").find(".block-title").html(val);
			}
		})

	})
	</script>
	<input id="shortcode_type" type="hidden" value="slider">
	<div class="block">
		<ul class="block-container">
			
			<li class="block-form master">
				<div class="block-bar">
					<p class="block-title">New Slideshow Item</p>
					<span class="block-handle" style="background: url(<?php echo get_template_directory_uri(); ?>/assets/images/tab-arrows.png) no-repeat top center;"></span>
				</div>
				<div class="block-content">
					<input type="hidden" id="accordion-1">
					<p>
						<label>Image URL</label>
						<input type="text" class="slideshow_image">						
					</p>
					<p>
						<label>Slideshow Caption</label>
						<input type="text" class="slideshow_title">
						
					</p>
					<p>
						<label>Slideshow Description</label>
						<textarea cols="20" rows="5" class="slideshow_description"></textarea>
					</p>
					<hr>
					<div class="control"><a class="delete_form button button-2" href="#">Delete</a></div>
				</div>				
			</li>

		</ul>		
		<a class="button button-1" id="new_slider" href="#">New Slideshow Item</a>			
		<hr>
		<p>
			<label for="align">Pull</label>
			<select id="align">
				<option value="">None</option>
				<option value="left">Left</option>
				<option value="right">Right</option>								
			</select>
		</p>	
		<hr>
		<button id="insert_shortcode" class="button">Insert Shortcode</button>
	</div>
	<!-- END SHORTCODE PANEL -->
<?php
	bright_end_html();
	die();
}
