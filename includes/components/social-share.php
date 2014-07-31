<?php 
if(!function_exists("arsene_social_share")){
	function arsene_social_share(){
		global $post;
?>
	<div class="share-area">
		<h3><i class="icon-share"></i> <?php _e('Share','arsene'); ?></h3>
		<div class="share-blocks">
			<div class="share-item">
				<div class="fb-like" data-send="false" data-layout="button_count" data-width="180" data-show-faces="false"></div>
			</div>
			<div class="share-item">
				<a href="<?php echo 'https://twitter.com/share'; ?>" class="twitter-share-button">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<div class="share-item">
				<!-- Place this tag where you want the share button to render. -->
				<div class="g-plus" data-action="share" data-annotation="bubble"></div>

				<!-- Place this tag after the last share tag. -->
				<script type="text/javascript">
				  (function() {
				    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				    po.src = 'https://apis.google.com/js/plusone.js';
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</div>
			<div class="share-item">
				<a data-pin-config="beside" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>&description=<?php the_title(); ?>" data-pin-do="buttonPin" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
			</div>
		</div>
	</div>
<?php		
	}
}
?>