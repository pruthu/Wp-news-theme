<?php
/*===================================================================
404: Error Template
=================================================================== */
get_header(); ?>

<div class="row-fluid">
	<div class="span12">

		<div class="widget widget-404">
			<span class="paper-tape"></span>
			<h3 class="widget-title"><span><?php _e('Error 404 - Not found.','arsene'); ?></span></h3>

			<article class="post post-single post-404">				
				<h2 class="post-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'arsene' ); ?></h2>
				<p><?php _e('Sorry, but you are looking for something that isn&rsquo;t here.','arsene'); ?></p>

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="not-found-button"><i class="icon-reply"></i>&nbsp; <?php _e('Go back to homepage','arsene'); ?></a>

			</article>
		</div>
	</div>
</div>

<?php get_footer(); ?>