<?php
/*===================================================================
WIDGET SOCIAL
Display Facebook, Twitter, Google+ and RSS
=================================================================== */

class Arsene_Widget_Social extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( "Displays social media counter.","arsene") );
		parent::__construct('social_count', __('Arsene Social Counter',"arsene"), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = $instance['title'];
		$twitter = $instance['twitter'];
        $facebook = $instance['facebook'];
        $googleplus = $instance['googleplus'];
        $rss = $instance['rss'];

        echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
		<ul class="social-count">

			<?php if(!empty($twitter)): ?>
			<li>
				<div class="social-count-item">
					<a href="http://twitter.com/<?php echo $twitter; ?>" target="_blank" class="tip" title="<?php _e('Follow us on Twitter','arsene'); ?>">
						<span class="social-icon"><i class="icon-twitter"></i></span>			
						<span class="count-info"><?php twitter_counter($twitter); ?><br>Followers</span>
					</a>										
				</div>
			</li>	
			<?php endif; ?>

			<?php if(!empty($facebook)): ?>
			<li>
				<div class="social-count-item">
					<a href="http://facebook.com/<?php echo $facebook; ?>" target="_blank" class="tip" title="<?php _e('Follow us on Facebook','arsene'); ?>">
						<span class="social-icon"><i class="icon-facebook"></i></span>			
						<span class="count-info"><?php facebook_counter($facebook); ?><br>Fans</span>
					</a>										
				</div>
			</li>
			<?php endif; ?>

			<?php if(!empty($googleplus)): ?>
			<li>
				<div class="social-count-item">
					<a href="https://plus.google.com/<?php echo $googleplus; ?>" target="_blank" class="tip" title="<?php _e('Follow us on Google+','arsene'); ?>">
						<span class="social-icon"><i class="icon-google-plus"></i></span>			
						<span class="count-info"><?php googleplus_counter('https://plus.google.com/'.$googleplus); ?><br>Followers</span>
					</a>										
				</div>
			</li>
			<?php endif; ?>

			<?php if(!empty($rss)): ?>
			<li>
				<div class="social-count-item">
					<a href="<?php echo $rss; ?>" target="_blank" class="tip" title="<?php _e('Subscribe our RSS/Feed','arsene'); ?>">
						<span class="social-icon"><i class="icon-rss"></i></span>			
						<span class="count-info">Subscribe<br>RSS/Feed</span>
					</a>										
				</div>
			</li>
			<?php endif; ?>

		</ul>
<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['googleplus'] = strip_tags($new_instance['googleplus']);
        $instance['rss'] = strip_tags($new_instance['rss']);

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'facebook' => '', 'twitter' => '', 'googleplus' => '', 'rss' => '' ) );
		$title = strip_tags($instance['title']);
		$facebook = strip_tags($instance['facebook']);
		$twitter = strip_tags($instance['twitter']);
		$googleplus = strip_tags($instance['googleplus']);
		$rss = strip_tags($instance['rss']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook Page Username:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter Username:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('googleplus'); ?>"><?php _e('Google+ ID:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('googleplus'); ?>" name="<?php echo $this->get_field_name('googleplus'); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('Full RSS URL:',"arsene"); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>" /></p>

		
<?php
	}

}

/*===================================================================
Twitter Counter
=================================================================== */
function twitter_counter($twitter_id){
	if(empty($twitter_id))
		return;

	$twitter_followers = get_transient("arsene_twitter_followers_count");
	if( false === $twitter_followers || empty($twitter_followers) ){

		// getting new auth bearer only if we don't have one
		$token = get_option('btTwitterToken');
		$consumer_key = get_arsene_option('arsene_twitter_consumer_key');
		$consumer_secret = get_arsene_option('arsene_twitter_consumer_secret');	

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
		$api_url = "https://api.twitter.com/1.1/users/show.json?screen_name=$twitter_id";
		$response = wp_remote_get($api_url, $args);
		 
		if (!is_wp_error($response)) {
			$twitter_info = json_decode(wp_remote_retrieve_body($response));

			if(!empty($twitter_info)){
				$twitter_followers = isset($twitter_info->followers_count) ? intval($twitter_info->followers_count) : "";	
			}
		 
			// cache for an hour
			set_transient('arsene_twitter_followers_count', $twitter_followers, 1*60*60);
		}
	}

	if( $twitter_followers && $twitter_followers > 0 )
		echo number_format($twitter_followers);
}

/*===================================================================
Facebook Counter
=================================================================== */
function facebook_counter($fb_id){
	
	$like_count = get_transient("arsene_facebook_count");

	if( false === $like_count ) {

		$ch = curl_init();	
		curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/".$fb_id);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);
		curl_close($ch);

		//$result = wp_remote_retrieve_body(wp_remote_get("http://graph.facebook.com/$fb_id"));
		$json = json_decode($result, true);
		
		$like_count = $json['likes'];

		set_transient('arsene_facebook_count', $like_count, 3600);

	}

	if ($like_count == false) { echo '0'; }
	else { echo number_format($like_count); }
}

/*===================================================================
Google+ Counter
=================================================================== */
function googleplus_counter($url){

	$googleplus_count =  get_transient("arsene_googleplus_count");

	if( false === $googleplus_count ) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p",
		"params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},
		"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

		$result = curl_exec ($ch);
		curl_close ($ch);

		$json = json_decode($result, true);
		$googleplus_count = intval($json[0]['result']['metadata']['globalCounts']['count']);	
		set_transient('arsene_googleplus_count', $googleplus_count, 3600);	
	}
	echo number_format( $googleplus_count );
}
?>