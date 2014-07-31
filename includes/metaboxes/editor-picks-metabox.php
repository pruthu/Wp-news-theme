<?php
/*
	Meta Box Editor Picks
 */

/*===================================================================
Add Meta Box Editor Picks
=================================================================== */
add_action('add_meta_boxes','arsene_add_editor_picks_metabox');

function arsene_add_editor_picks_metabox(){
	add_meta_box('arsene_editor_picks_metabox',__('Editor Picks','arsene'),'arsene_editor_picks_metabox_callback','post','side','high');
}

/*===================================================================
Callback
=================================================================== */
function arsene_editor_picks_metabox_callback(){
	global $post;

	$values = get_post_custom($post->ID);
	$check = isset( $values['arsene_editor_picks'] ) ? esc_attr( $values['arsene_editor_picks'][0] ) : '';
	wp_nonce_field( 'arsene_editor_picks_meta_box_nonce', 'meta_box_nonce' );  
?>
	<p>
	    <input type="checkbox" name="arsene_editor_picks" id="arsene_editor_picks" <?php checked( $check, 'on' ); ?> />
	    <label for="arsene_editor_picks"><?php _e('Editor Picks','satria'); ?></label>
	</p>
<?php
}

/*===================================================================
Saving
=================================================================== */
add_action( 'save_post', 'arsene_save_editor_picks' );
function arsene_save_editor_picks( $post_id ){
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'arsene_editor_picks_meta_box_nonce' ) ) return;
	if( !current_user_can( 'edit_post' ) ) return;

	$chk = ( isset( $_POST['arsene_editor_picks'] ) && $_POST['arsene_editor_picks'] ) ? 'on' : 'off';
  	
  	update_post_meta( $post_id, 'arsene_editor_picks', $chk );
}
?>