jQuery(document).ready(function($){
	// shortcode type
	var shortcodeType = $("#shortcode_type").val();

	/* ===================================================
		CLICK ACTION
	====================================================== */
	$("#insert_shortcode").live("click", function(){

		var shortcodeData = "";

		var instance = tinyMCE.getInstanceById('content');
		var selectionData = instance.selection.getContent();

		switch(shortcodeType){
			case 'quote':
				shortcodeData = insertShortcodeQuote();
			break;
			case 'alert':
				shortcodeData = insertShortcodeAlert();
			break;
			case "button":
				shortcodeData = insertShortcodeButton();
			break;
			case "tabs":
				shortcodeData = insertShortcodeTabs();
			break;
			case "googlemap":
				shortcodeData = insertShortcodeGoogleMap();
			break;
			case "accordion":
				shortcodeData = insertShortcodeAccordion();
			break;
			case "column":
				shortcodeData = insertShortcodeColumn();
			break;
			case "slider":
				shortcodeData = insertShortcodeSlideshow();
			break;
			default:
				shortcodeData = "";
			break;
		}
		
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeData);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		// Close tinymce popup
		tinyMCEPopup.close();
	})

	/* PARSE ATTR FUNCTION */
	function parseAttr(attr){
		var returnData = "";
		for(var i=0; i<attr.length; i++){
			if( $("#"+attr[i]).val() !== "" )
				returnData += ' '+ attr[i] + '="' + $("#"+attr[i]).val() +'"';
		}
		return returnData;
	}

	function nl2br (str) {   
		var breakTag = '<br>';    
		return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag);
	}


	/* ===================================================
		SHORTCODE QUOTE
	====================================================== */
	function insertShortcodeQuote(){
		var content 	= $("#content").val();
		var attr		= ["cite","citeurl","align"];

		var returnData 	= '[quote';
		returnData 		+= parseAttr(attr);
		returnData 		+= ']'+content+'[/quote]';

		return returnData;
	}


	/* ===================================================
		SHORTCODE ALERT
	====================================================== */
	function insertShortcodeAlert(){
		var content 	= $("#content").val();
		var attr		= ["style","title"];

		var returnData 	= '[alert';
		returnData 		+= parseAttr(attr);
		returnData 		+= ']'+content+'[/alert]';

		return returnData;
	}


	/* ===================================================
		SHORTCODE BUTTON
	====================================================== */
	function insertShortcodeButton(){

		var attr = ["style","text","link","icon","target","nofollow","size","icon_position"];

		var returnData 	= '[button';
		returnData 		+= parseAttr(attr);
		returnData 		+= ']';

		return returnData;
	}


	/* ===================================================
		SHORTCODE TABS
	====================================================== */
	function insertShortcodeTabs(){

		var returnData = '[tabs style="'+$("#tabstyle").val()+'"]';

		$(".block-container").children("li:not(.master)").each(function(){
			returnData += '[tab title="'+$(this).find('.tab-title').val()+'"]'+$(this).find(".tab-content").val()+'[/tab]';
		})

		returnData += '[/tabs]';
		return returnData;
	}


	/* ===================================================
		SHORTCODE GOOGLEMAP
	====================================================== */
	function insertShortcodeGoogleMap(){

		var attr = ["latitude","longitude"];

		var returnData 	= '[googlemap';
		returnData 		+= parseAttr(attr);
		returnData 		+= ']';

		return returnData;
	}


	/* ===================================================
		SHORTCODE ACCORDION
	====================================================== */
	function insertShortcodeAccordion(){

		var returnData = '[accordions align="'+$("#align").val()+'"]';

		$(".block-container").children("li:not(.master)").each(function(){
			returnData += '[accordion state="'+$(this).find('.accordion_state').val()+'" title="'+$(this).find('.accordion_title').val()+'"]'+$(this).find(".accordion_content").val()+'[/accordion]';
		})

		returnData += '[/accordions]';
		return returnData;
	}


	/* ===================================================
		SHORTCODE COLUMN
	====================================================== */
	function insertShortcodeColumn(){

		var returnData = '[grid]';

		$("#destination").children("li").each(function(){
			returnData += '[row]';
			$(this).find(".block-row").children("li").each(function(){
				returnData += '[col span="'+$(this).find('.gridcol').val()+'"]'+nl2br($(this).find(".gridcontent").val())+'[/col]';
			})
			returnData += '[/row]';
		})

		returnData += '[/grid]';
		return returnData;
	}


	/* ===================================================
		SHORTCODE SLIDESHOW
	====================================================== */
	function insertShortcodeSlideshow(){

		var returnData = '[slideshow align="'+$("#align").val()+'"]';

		$(".block-container").children("li:not(.master)").each(function(){
			returnData += '[slideitem image="'+$(this).find('.slideshow_image').val()+'" title="'+$(this).find('.slideshow_title').val()+'"]'+$(this).find(".slideshow_description").val()+'[/slideitem]';
		})

		returnData += '[/slideshow]';
		return returnData;
	}

})