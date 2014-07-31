<?php
/*===================================================================
COMMENTS.PHP
Template for displaying comments.
=================================================================== */	

/* if post with password */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area margin-t30 clearfix">

	<?php if ( have_comments() ) : ?>
		<h3 class="margin-b20"><i class="icon-comments"></i>  
			<?php
				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'arsene' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>		

		<!-- COMMENT LIST -->
		<ol class="comment-list">
			<?php
				wp_list_comments( array( 'callback' => 'arsene_comment_callback' ) );
			?>
		</ol>
		<!-- END COMMENT LIST -->

		<!-- COMMENT NAV -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :?>
		<div class="clearfix"></div>
		<nav role="navigation" id="comment-nav" class="pull-right site-navigation comment-navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '<i class="icon-arrow-left"></i> Older Comments', 'arsene' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <i class="icon-arrow-right"></i>', 'arsene' ) ); ?></div>
		</nav>
		<div class="clearfix"></div>

		<?php endif; ?>
		<!-- END COMMENT NAV -->

	<?php endif; // have_comments() ?>

	<?php
		/* Comment Close */
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'arsene' ); ?></p>
	<?php endif; ?>

	<?php comment_form(array('cancel_reply_link' => '<i class="icon-remove"></i> Cancel Reply')); ?>

</div><!-- #comments .comments-area -->
