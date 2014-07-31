<?php
/*===================================================================
WIDGET TWITTER
Displays Latest Tweets.
=================================================================== */

class Arsene_Widget_Twitter extends WP_Widget {

    function __construct() {
        $widget_ops = array( 'description' => __( "Displays Tweets.","arsene") );
        parent::__construct('twitter', __('Arsene Twitter',"arsene"), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = $instance['title'];
        $twitterID = $instance['twitterID'];
        $count = $instance['count'];
        
        echo $before_widget;
        if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
        $tweets = bt_get_recent_tweets($twitterID, $count);

        if(!empty($tweets)){
            print '<div class="bt_recent_tweets"><ul>';
            foreach($tweets as $tweet){                             
                print '<li><span>'.convert_links($tweet['text']).'</span><br /><a class="twitter_time" target="_blank" href="http://twitter.com/'.$twitterID.'/statuses/'.$tweet['status_id'].'"><small>'.relative_time($tweet['created_at']).'</small></a></li>';
            }                   
            print '</ul></div>';
        }
        echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['twitterID'] = strip_tags($new_instance['twitterID']);
        $instance['count'] = strip_tags($new_instance['count']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => 'Tweets', 'twitterID' => 'envato', 'count' => '3') );

        $title = strip_tags($instance['title']);
        $twitterID = strip_tags($instance['twitterID']);
        $count = strip_tags($instance['count']);

?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('twitterID'); ?>"><?php _e('Twitter Username:',"arsene"); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('twitterID'); ?>" name="<?php echo $this->get_field_name('twitterID'); ?>" type="text" value="<?php echo esc_attr($twitterID); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of tweets:',"arsene"); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo esc_attr($count); ?>" /></p>
        
<?php
    }

}

function bt_get_recent_tweets( $screen_name = 'envato', $tweets_count = 3 ) {

    // some variables
    $consumer_key = get_arsene_option('arsene_twitter_consumer_key');
    $consumer_secret = get_arsene_option('arsene_twitter_consumer_secret');
    $token = get_option('btTwitterToken');

    // get recent tweets from cache
    $recent_tweets = get_transient('btRecentTweets');

    // cache version does not exist or expired
    if (false === $recent_tweets) {

        // getting new auth bearer only if we don't have one
        if(!$token) {

            // preparing credentials
            $credentials = $consumer_key . ':' . $consumer_secret;
            $toSend = base64_encode($credentials);
 
            // http post arguments
            $args = array(
                'method' => 'POST',
                'httpversion' => '1.1',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => 'Basic ' . $toSend,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
                ),
                'body' => array( 'grant_type' => 'client_credentials' )
            );
 
            add_filter('https_ssl_verify', '__return_false');
            $response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

            $keys = json_decode(wp_remote_retrieve_body($response));

            if($keys) {
                // saving token to wp_options table
                update_option('btTwitterToken', $keys->access_token);
                $token = $keys->access_token;
            }
        }

        // we have bearer token wether we obtained it from API or from options
        $args = array(
            'httpversion' => '1.1',
            'blocking' => true,
            'headers' => array(
                'Authorization' => "Bearer $token"
            )
        );

        add_filter('https_ssl_verify', '__return_false');
        $api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$screen_name&count=$tweets_count";
        $response = wp_remote_get($api_url, $args);
 
        if (!is_wp_error($response)) {
            $tweets = json_decode(wp_remote_retrieve_body($response));

            if(!empty($tweets)){
                for($i=0; $i<count($tweets); $i++){
                    $recent_tweets[] = array('text' => $tweets[$i]->text, 'created_at' => $tweets[$i]->created_at, 'status_id' => $tweets[$i]->id_str);
                }
            }           
        }
        
        // cache for an hour
        set_transient('btRecentTweets', $recent_tweets, 1*60*60);
    }

    return $recent_tweets;

}

function convert_links($status,$targetBlank=true,$linkMaxLen=250){
                         
    // the target
    $target=$targetBlank ? " target=\"_blank\" " : "";

    // convert link to url
    $status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
                             
    // convert @ to follow
    $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
                             
    // convert # to search
    $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
                             
    // return the status
    return $status;
}

function relative_time($a) {
    //get current timestampt
    $b = strtotime("now"); 
    //get timestamp when tweet created
    $c = strtotime($a);
    //get difference
    $d = $b - $c;
    //calculate different time values
    $minute = 60;
    $hour = $minute * 60;
    $day = $hour * 24;
    $week = $day * 7;
                                
    if(is_numeric($d) && $d > 0) {
    //if less then 3 seconds
    if($d < 3) return "right now";
    //if less then minute
    if($d < $minute) return floor($d) . " seconds ago";
    //if less then 2 minutes
    if($d < $minute * 2) return "about 1 minute ago";
    //if less then hour
    if($d < $hour) return floor($d / $minute) . " minutes ago";
    //if less then 2 hours
    if($d < $hour * 2) return "about 1 hour ago";
    //if less then day
    if($d < $day) return floor($d / $hour) . " hours ago";
    //if more then day, but less then 2 days
    if($d > $day && $d < $day * 2) return "yesterday";
    //if less then year
    if($d < $day * 365) return floor($d / $day) . " days ago";
    //else return more than a year
    return "over a year ago";
    }
}

?>