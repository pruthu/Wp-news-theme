jQuery(document).ready(function($){
	"use strict";

	// SHOW/HIDE CRITERIA
	$(".criteria-toggle").live("click", function(){
		var control = $(this).parents(".criteria-item:first").find(".criteria-inner-control");
		if(control.is(":visible")){
			control.slideUp();
		}else{
			control.slideDown();
		}
		return false;
	});

	// ADD NEW CRITERIA
	if (jQuery('.criteria-item.single-master').length === 0 ) { // for saved post
		jQuery('.criteria-item').hide().addClass('single-master');
		jQuery('.criteria-container.single-master').clone().appendTo('.criteria-container').show().removeClass('single-master');
	}
	if (jQuery('.criteria-item').length === 0 ) { // for saved post
		jQuery('.criteria-item').clone().prependTo('.criteria-container').hide().addClass('single-master');
	}

	// ADD NEW CRITERIA
	jQuery('#add_new_criteria').click( function() {
		jQuery('.criteria-item.single-master').find(".criteria-name").html("");
		jQuery('.criteria-item.single-master').clone().appendTo('.criteria-container').slideDown(function(){
			jQuery(this).removeClass('single-master');			
		});

	});
	
	// DELETE CRITERIA ITEM
	jQuery('.delete-criteria').live('click', function() {		
		jQuery(this).parents(".criteria-item:first").slideUp(function(){
			jQuery(this).remove();
		});
		return false;
	});

	// SET TITLE
	jQuery(".criteria-input").live("focusout", function(){		
		$(this).parents(".criteria-item:first").find('.criteria-title').html($(this).val());
	});

	// SORTABLE CRITERIA ITEM
	if ( jQuery( ".criteria-container" ).length > 0 ) {		
		jQuery( ".criteria-container" ).sortable({
			revert: true
		});		
		jQuery( ".criteria-container > criteria-item:not(.single-master)" ).draggable({
			connectToSortable: ".criteria-container",
			revert: "invalid"
		});		
	}


});