				</div><!-- /row-fluid -->
			</div><!-- /main-content -->

			<footer id="footer" class="margin-t40">

				<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>										
				<div class="footer-widget">
					<div class="container">
						<div class="row-fluid">
							<div class="span12">

								<div class="row-fluid">
									<?php dynamic_sidebar( 'sidebar-footer' ); ?>
								</div>

							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<div class="footer-copyright">
					<div class="container">
						<div class="row-fluid">
							<div class="span12">

								<p class="copyright-text">
									<?php echo get_arsene_option("arsene_copyright_text"); ?>
								</p>
								<?php if(get_arsene_option("arsene_show_footer_credit")): ?>
								<p class="credit">
									<a href="<?php echo 'http://bright-theme.com/arsene'; ?>" target="_blank">Arsene WP Theme</a> by <a href="<?php echo 'http://bright-theme.com'; ?>" target="_blank">Bright Theme</a>.<br>
									<a href="<?php echo 'https://github.com/sy4mil/Aqua-Page-Builder'; ?>" target="_blank" rel="nofollow external">Aqua Page Builder</a> & <a href="<?php echo 'https://github.com/sy4mil/Options-Framework'; ?>" target="_blank" rel="nofollow external">Slightly Modified Options Framework</a> by <a href="<?php echo 'http://themeforest.net/user/SyamilMJ'; ?>" target="_blank" rel="nofollow external">Syamil MJ.</a>
								</p>
								<?php endif; ?>

							</div><!-- /span12 -->
						</div><!-- /row-fluid -->
					</div><!-- /container -->
				</div><!-- /footer-copyright -->
			</footer>
			
		</div><!-- /wrapper -->

		<!-- FACEBOOK -->
		<div id="fb-root"></div>
		<script type="text/javascript">
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- END FACEBOOK -->

		<!-- WP Footer -->
		<?php wp_footer(); ?>
	</body>
</html>      