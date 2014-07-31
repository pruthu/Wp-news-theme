<?php

$prefix = "arsene_";

$review_metabox = array(
    'id' => 'arsene_review_metabox',
    'title' => __('Review', 'arsene'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'term' => '',
    'fields' => array(
        array(
            'name' => __('Criteria Name', 'arsene'),
            'desc' => __('Enter review criteria name', 'arsene'),
            'id' => $prefix . 'review_criteria',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => __('Score', 'arsene'),
            'desc' => __('Enter criteria score', 'arsene'),
            'id' => $prefix . 'criteria_score',
            'type' => 'slider',
            'std' => ''
        )
    ),
    'review_result' => array(
        array(
            'name' => __('Review Text', 'arsene'),
            'desc' => __('Review result text ex: Excellent, Good, Bad', 'arsene'),
            'id' => $prefix . 'review_result_text',
            'type' => 'text',
            'std' => ''
        ),        
        array(
            'name' => __('Review Summary/Description', 'arsene'),
            'desc' => __('Review summary description', 'arsene'),
            'id' => $prefix . 'review_summary',
            'type' => 'textarea',
            'std' => ''
        )
    )
);

/*===================================================================
Add Meta Box Review
=================================================================== */

add_action( 'add_meta_boxes', 'arsene_add_review_metabox' );
function arsene_add_review_metabox() {
    global $review_metabox;
    add_meta_box($review_metabox['id'], $review_metabox['title'], 'arsene_review_metabox_callback', $review_metabox['page'], $review_metabox['context'], $review_metabox['priority']);
}

function arsene_review_metabox_callback() {
    global $review_metabox, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="arsene_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<div class="form-criteria">';
    echo '<ul class="criteria-container">';

    $review_meta =  get_post_meta($post->ID, $review_metabox['id'], true);
    
    if( !empty($review_meta) ){        
        $review_data =  json_decode( $review_meta['review_criteria'], 1);
    } else {
        $review_data =  '';
    }

    $x = ($review_data == "") ? 0 : -1;
    
    while ( $x < sizeof( $review_data ) ) {
        
        /*
        echo '<li class="criteria-item', ( ( !empty($review_meta) && $x < 0 ) ? ' single-master' : '') ,'">
            <div class="postbox"><div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Criteria</span><span class="criteria-name">: ',$review_data[$x]['arsene_review_criteria'],'</span></h3>
            <div class="inside"><div class="submitbox">';   
        */
        echo '<li class="criteria-item', ( ( !empty($review_meta) && $x < 0 ) ? ' single-master' : '') ,'">
            <div class="criteria-title-bar">
            <div class="criteria-title">', ( ( !empty($review_meta) && $x > -1) ? $review_data[$x]['arsene_review_criteria']: 'New Criteria') ,'</div>
            <a href="#" class="criteria-toggle">Toggle</a>
            </div><div class="criteria-inner-control">';     
        
        ?>
        <script>
        
            jQuery(function(){
            
                jQuery( ".review-score" ).slider({
                    range: "max",
                    min: 0,
                    max: 10,
                    slide: function( event, ui ) {
                        jQuery(this).closest('.wrap-review-slider').prev('.review-slider-input').val( ui.value )
                        .closest('.criteria-inner-content-2').find('strong.result-review').text( ui.value );
                    },
                    create: function() {
                        var value = jQuery(this).closest('.wrap-review-slider').prev('.review-slider-input').val();
                        jQuery(this).slider( "value" , value )
                        .closest('.criteria-inner-content-2').find('strong.result-review').text( value );

                    }
                });
            
            });
        
        </script>
        <?php

        $i = 0; // reset border-bottom
        foreach ($review_metabox['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
            
            $i == 0 ? $first = "first" : $first = "";
            $i++;
            
            if ( $x == -1 ) {
                $field['std'] = "";
            } else {
                $field['std'] = !empty($review_data) ? $review_data[$x][ $field['id'] ] : "";
            }
            
            switch ($field['type']){

                //If Text       
                case 'text':

                    echo '<div class="criteria-inner-content-1">',
                        '<label for="', $field['id'], '"><strong>', $field['name'], '</strong></label>';
                    echo '<input class="criteria-input" type="text" name="', $field['id'], '[]" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '"/>';
                    echo '<span class="howto">' . $field['desc'] . '</span>';
                    echo '</div>';

                    break;
                    
                case 'slider':
                
                    $sliderValue = $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES));
                
                    echo '<div class="criteria-inner-content-2"><label for="', $field['id'], '"><strong>', $field['name'], ' : </strong><strong class="result-review"></strong></label>';
                    echo '<input class="review-slider-input" type="hidden" name="', $field['id'], '[]" id="', $field['id'], '" value="', ( $sliderValue == '' ? 0 : $sliderValue ) , '"/>';
                    echo '<div class="wrap-review-slider">';
                    echo '<div class="review-score"></div>';
                    echo '</div>';
                    echo '<span class="howto">' . $field['desc'] . '</span>';
                    echo '</div>';
                    
                    break;
            }
        }

        echo '<div class="criteria-footer"><a href="" class="delete-criteria">Delete</a></div></div></li>';
        
        $x++;
        
    }
    
    echo '</ul><input type="button" class="button" id="add_new_criteria" value="Add New Criteria"></div>';

    echo '<div class="review_block">';
    
    $i = 0;
    
    foreach ($review_metabox['review_result'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);
        
        $i == 0 ? $first = "first" : $first = "";
        $i++;
        
        switch ($field['type']) {

            //If Text       
            case 'text':

                echo '<div><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label>';
                echo '<input class="review_value" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '"/>';
                echo '<span>' . $field['desc'] . '</span>';
                echo '</div>';
                
                break;
                
            case 'select':

                echo '<div><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label>';
                echo '<select style="width:60%; text-transform: capitalize;" name="' . $field['id'] . '">';

                foreach ($field['options'] as $option) {

                    echo'<option';
                    if ($meta == $option) {
                        echo ' selected="selected"';
                    }
                    echo'>' . $option . '</option>';
                }

                echo '</select>';
                echo '</div>';

                break;
                
            //If Text       
            case 'textarea':

                echo '<div><label for="', $field['id'], '"><strong>', $field['name'], '</strong></label>';
                echo '<textarea rows="4" name="', $field['id'], '" id="', $field['id'], '">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
                echo '<span>' . $field['desc'] . '</span>';
                echo '</div>';

                break;
        }
    }
    
    echo '</div>';
}

/*===================================================================
Save Review
=================================================================== */
add_action('save_post', 'arsene_save_review');
function arsene_save_review($post_id) {
    global $review_metabox;

    // verify nonce
    if ( !isset($_POST['arsene_meta_box_nonce']) || !wp_verify_nonce( $_POST['arsene_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }
    
    $element_box = array();
    $totalCriteria = sizeof( $_POST[ $review_metabox['fields'][0]['id'] ] );    
    
    for ( $i = 1; $i < $totalCriteria; $i++ ) {
    
        foreach ($review_metabox['fields'] as $field)
    
            $temp[ $field['id'] ] = $_POST[$field['id']][$i];
        
        array_push( $element_box , $temp );
    
    }
    
    
    $review_meta = array (
        'review_criteria' => is_array($element_box) ? json_encode( $element_box ) : '',
        'review_text' =>$_POST[ $review_metabox['review_result'][0]['id'] ],
        'review_summary' => $_POST[ $review_metabox['review_result'][1]['id'] ],
    );
    
    update_post_meta($post_id, $review_metabox['id'], $review_meta );
    
    foreach ( $review_metabox['review_result'] as $field ) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
    
}

/*===================================================================
Enqueue Styles & Scripts
=================================================================== */
function arsene_admin_scripts() {
    wp_enqueue_script('jquery-ui');
    wp_register_script('jquery-ui-widget', get_template_directory_uri() . '/assets/js/jquery.ui.widget.js');
    wp_register_script('jquery-ui-slider', get_template_directory_uri() . '/assets/js/jquery-ui-slider.js');
    wp_enqueue_script('jquery-ui-widget');
    wp_enqueue_script('jquery-ui-slider');
}

function arsene_admin_styles() {
    wp_enqueue_style('arsene-review-style', get_template_directory_uri() . '/includes/metaboxes/metabox-style.css', '', '');
}

add_action('admin_print_scripts', 'arsene_admin_scripts');
add_action('admin_print_styles', 'arsene_admin_styles');
?>