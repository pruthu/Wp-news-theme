<div class="widget widget-no-results">
	<span class="paper-tape"></span>
	<h3 class="widget-title"><span>
	<?php
	if(is_search()){
		echo (__('Nothing found for: ','arsene').'<span class="search-query">'.get_search_query().'</span>');
	}else{
		_e('Nothing Found','arsene');
	}
	?>
	</span></h3>

	<article id="post-0" class="post no-results not-found">	
		<div class="entry-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'arsene' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			<?php elseif ( is_search() ) : ?>
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'arsene' ); ?></p>
				<?php get_search_form(); ?>
			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'arsene' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 .post .no-results .not-found -->
</div>
