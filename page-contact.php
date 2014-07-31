<?php
/*
Template Name: Contact
*/
/* send button clicked */
$error = array();
if(isset($_POST['contact-submit'])){

	if(trim($_POST['contact-name']) === ""){
		$error["error_name"] = __("Please enter your name.","arsene");
		$has_error = true;
	} else {
		$contact_name = trim($_POST['contact-name']);
	}

	if(trim($_POST['contact-email']) === ""){
		$error["error_email"] = __("Please enter your email address.","arsene");
		$has_error = true;
	} elseif (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['contact-email']))) {
		$error['invalid_email'] = __("You entered an invalid email address.","arsene");
		$has_error = true;
	} else {
		$contact_email = trim($_POST['contact-email']);
	}

	if(trim($_POST['contact-message']) === ""){
		$error["error_message"] = __("Please enter a message.","arsene");
		$has_error = true;
	} else {
		$contact_message = stripslashes(trim($_POST['contact-message']));
	}

	// valid
	if(!isset($has_error)){
		$email = get_arsene_option("arsene_contact_email");
		if($email == ""){
			$email = get_option("admin_email");
		}

		$subject = '[Contact Form] From '.$contact_name;
		$body = "Name: $contact_name \n\nEmail: $contact_email \n\nMessage: $contact_message";
		$headers = 'From: '.$contact_name.' <'.$contact_email.'>' . "\r\n" . 'Reply-To: ' . $contact_email;
			
		if(mail($email, $subject, $body, $headers)){
			$email_sent = true;
		}
	}

}

?>
<?php get_header(); ?>
<div class="row-fluid">

<?php 
/* LEFT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Left")
	get_sidebar('page');
?>

<!-- BEGIN SINGLE POST -->
<div class="span8">

<?php if(have_posts()): ?>
<?php while(have_posts()): the_post(); ?>
	

	<!-- BREADCRUMB -->
	<?php if(function_exists("dimox_breadcrumbs") && get_arsene_option('arsene_enable_breadcrumbs')) dimox_breadcrumbs(); ?>
	<!-- END BREADCRUMB -->
	<div class="widget single-post-container">
		<span class="paper-tape"></span>

		<!-- BEGIN ARTICLE -->
		<article class="page post post-single">

			<header class="post-header">				
				<h1 class="post-title"><?php the_title(); ?></h1>	
			</header>

			<div class="post-single-body clearfix margin-t20">				
				<?php the_content(); ?>		
				<!-- Begin Contact Form -->
				<?php if(isset($email_sent) && $email_sent): ?>
					<div class="alert alert-success"><?php _e("Thank you! Your message has been successfully sent.","arsene"); ?></div>
				<?php else: ?>
				<form method="post" action="<?php the_permalink(); ?>" id="contact-form">

					<p>
						<label for="name"> <?php _e("Name","arsene"); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="contact-name" id="name" value="<?php echo isset($_POST["contact-name"]) ? $_POST["contact-name"]:""; ?>">
						<?php if(isset($error["error_name"])): ?>
							<span class="alert alert-error"><?php echo $error["error_name"]; ?></span>
						<?php endif; ?>													
					</p>

					<p>
						<label for="email"> <?php _e("Email","arsene"); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="contact-email" id="email" value="<?php echo isset($_POST["contact-email"]) ? $_POST["contact-email"]:""; ?>">
						<?php if(isset($error["error_email"])): ?>
							<span class="alert alert-error"><?php echo $error["error_email"]; ?></span>
						<?php endif; ?>
						<?php if(isset($error["invalid_email"])): ?>
							<span class="alert alert-error"><?php echo $error["invalid_email"]; ?></span>
						<?php endif; ?>							
						
					</p>

					<p>
						<label for="message"> <?php _e("Message","arsene"); ?> <span class="required">*</span></label>
						<textarea id="message" name="contact-message" class="input-textarea" cols="20" rows="5"><?php echo isset($_POST["contact-message"]) ? $_POST["contact-message"]:""; ?></textarea>
						<?php if(isset($error["error_message"])): ?>
							<span class="alert alert-error"><?php echo $error["error_message"]; ?></span>
						<?php endif; ?>
					</p>

					<input type="submit" name="contact-submit" value="<?php _e("Send Message","arsene"); ?>" class="contact-submit">

				</form>	
				<?php endif; ?>
				<!-- End Contact Form -->

			</div>

			<footer class="post-single-footer clearfix">				
				<div class="pull-right">
					<?php edit_post_link(__('<i class="icon-edit"></i>&nbsp; Edit this')); ?>
				</div>				
			</footer>
		</article>
		<!-- END ARTICLE -->		

		<!-- BEGIN COMMENT AREA -->
		<?php 
		if ( comments_open() || '0' != get_comments_number() ) 
			comments_template( '', true ); 
		?>
		<!-- END COMMENT AREA -->	
		
	</div>	

<?php endwhile; ?>

<?php else: ?>
	<?php get_template_part("no-results"); ?>
<?php endif; ?>

</div>

<?php 
/* RIGHT SIDEBAR */
if(get_arsene_option("arsene_sidebar_position") == "Right")
	get_sidebar('page');
?>

<?php get_footer(); ?>