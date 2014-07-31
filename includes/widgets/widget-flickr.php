<?php
/*===================================================================
WIDGET FLICKR
Displays Flickr Photostream.
=================================================================== */

class Arsene_Widget_Flickr extends WP_Widget {

    function __construct() {
        $widget_ops = array( 'description' => __( "Displays Flickr photostream.","arsene") );
        parent::__construct('flickr', __('Arsene Flickr',"arsene"), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = $instance['title'];
        $flickrID = $instance['flickrID'];
        $postcount = $instance['postcount'];
        $type = $instance['type'];
        $display = $instance['display'];
        
        echo $before_widget;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>      
        <div class="flickr-feed">
             <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
        </div>
<?php
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['flickrID'] = strip_tags($new_instance['flickrID']);
        $instance['postcount'] = strip_tags($new_instance['postcount']);
        $instance['type'] = strip_tags($new_instance['type']);
        $instance['display'] = strip_tags($new_instance['display']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Flickr Collection', 'flickrID' => '52617155@N08', 'postcount' => '9', 'type' => 'user', 'display' => 'latest',) );

        $title = strip_tags($instance['title']);
        $flickrID = strip_tags($instance['flickrID']);
        $postcount = strip_tags($instance['postcount']);
        $type = strip_tags($instance['type']);
        $display = strip_tags($instance['display']);

?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('flickrID'); ?>"><?php _e('Flickr ID:',"arsene"); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('flickrID'); ?>" name="<?php echo $this->get_field_name('flickrID'); ?>" type="text" value="<?php echo esc_attr($flickrID); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('postcount'); ?>"><?php _e('Number of Photos:',"arsene"); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('postcount'); ?>" name="<?php echo $this->get_field_name('postcount'); ?>" type="text" value="<?php echo esc_attr($postcount); ?>" /></p>

       <p><label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type (user or group):',"arsene") ?></label>
            <select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat">
                <option value="user" <?php if ('user' == $type) echo 'selected="selected"'; ?>>User</option>
                <option value="group" <?php if ('group' == $type) echo 'selected="selected"'; ?>>Group</option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display (random or latest):',"arsene") ?></label>
            <select id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>" class="widefat">
                <option value="random" <?php if ('random' == $display) echo 'selected="selected"'; ?>>Random</option>
                <option value="latest" <?php if ('latest' == $display) echo 'selected="selected"'; ?>>Latest</option>
            </select>
        </p>
        
<?php
    }

}
?>