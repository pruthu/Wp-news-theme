<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		global $data;
		//echo "<pre>"; print_r($data); echo "</pre>";
		
		/* AQUA PAGE BUILDER TEMPLATES */
		$templates = array("0" => "Select Templates");
		$aqua_templates = get_posts( array( 
					'post_type' 		=> 'template', 
					'posts_per_page'	=> -1,
					'post_status' 		=> 'publish',
					'order'				=> 'ASC',
					'orderby'			=> 'title'
		    		));

		foreach($aqua_templates as $template){
			$templates[$template->ID] = $template->post_title;
		}

		/* Google Webfonts */
		$webfonts = arsene_get_google_webfonts();


		/* WIDGET STYLE */
		$widget_styles = array(
				'1'	=> 'Layered Paper',
				'2'	=> 'Folded Paper',
			);

		/* Background Patterns */
		$pattern_url  = get_template_directory_uri().'/assets/patterns/';
		$pattern_path = get_template_directory().'/assets/patterns/';
		$patterns = array();
		$pattern_files = scandir($pattern_path);
		if(!empty($pattern_files)){
			for($i = 2; $i < count($pattern_files); $i++){
				if(is_file($pattern_path.$pattern_files[$i])){					
					$patterns[$pattern_url.$pattern_files[$i]] = $pattern_url.$pattern_files[$i];
				}
			}
		}

		// Set the Options Array
		global $of_options;
		$of_options = array();

		/* BEGIN GENERAL OPTIONS */
		$of_options[] = array( "name" => "General",
							"type" => "heading");

		$of_options[] = array( "name" => "Website Logo",
							"desc" => "Set the website logo using the media uploader, or define the image URL directly.",
							"id" => "arsene_website_logo",
							"std" => get_template_directory_uri().'/assets/images/logo.png',
							"type" => "media");

		$of_options[] = array( "name" => "Favicon",
							"desc" => "Set the favicon using the media uploader, or define the icon URL directly.",
							"id" => "arsene_favicon",
							"std" => get_template_directory_uri().'/assets/images/favicon.ico',
							"type" => "media");

		$of_options[] = array( "name" => "Enable Responsive Design",
							"desc" => "By default responsive design is enabled, to disable uncheck this option.",
							"id" => "arsene_enable_responsive",
							"std" => 1,
							"type" => "checkbox");

		$of_options[] = array( "name" => "Enable Breadcrumbs",
							"desc" => "By default breadcrumbs is enabled, to disable uncheck this option.",
							"id" => "arsene_enable_breadcrumbs",
							"std" => 1,
							"type" => "checkbox");  

		$of_options[] = array( "name" => "Enable Newsticker",
							"desc" => "By default newsticker is enabled, to disable uncheck this option.",
							"id" => "arsene_enable_newsticker",
							"std" => 1,
							"type" => "checkbox");    

		$of_options[] = array( "name" => "Enable Floating Main Menu",
							"desc" => "By default floating main menu is disabled, to enable check this option.",
							"id" => "arsene_enable_floating_menu",
							"std" => 0,
							"type" => "checkbox");  

		$of_options[] = array( "name" => "Sidebar Position",
							"desc" => "Select your website sidebar position",
							"id" => "arsene_sidebar_position",
							"std" => "Right",
							"type" => "select",
							"options" => array("Right","Left"));

		$of_options[] = array( "name" => "SEO Options",
							"desc" => "By default SEO options are disabled, to enable check this option.",
							"id" => "arsene_seo_options",
							"std" => 0,
		          			"folds" => 1,
							"type" => "checkbox");    

		$of_options[] = array( "name" => "Website Description",
							"desc" => "Enter the website description",
							"id" => "arsene_seo_description",
							"std" => "",
		          			"fold" => "arsene_seo_options", // the checkbox hook
							"type" => "textarea");

		$of_options[] = array( "name" => "Website Keywords",
							"desc" => "Enter the website keywords",
							"id" => "arsene_seo_keywords",
							"std" => "",
		          			"fold" => "arsene_seo_options", // the checkbox hook
							"type" => "textarea");

		$of_options[] = array( "name" => "Analytic Code",
							"desc" => "Paste your Google Analytic code or other analytic code here.",
							"id" => "arsene_analytic_code",
							"std" => "",
							"type" => "textarea");


		/* END GENERAL OPTIONS */

		/* BEGIN HOMEPAGE OPTIONS */
		$of_options[] = array( "name" => "Homepage",
							"type" => "heading");

		$of_options[] = array( "name" => "Show Popular Posts Carousel?",
							"desc" => "By default, popular posts carousel is enabled, to disable uncheck this option.",
							"id" => "arsene_show_popular_carousel",
							"std" => 1,
							"type" => "checkbox"); 

		$of_options[] = array( "name" => "Select Homepage Template",
							"desc" => "Select the template you have created. You don't have any template? Build your templates now <a href='".admin_url('themes.php?page=aq-page-builder')."'>here</a>. But make sure plugin Aqua Page Builder is activated.",
							"id" => "arsene_homepage_template",
							"std" => "",
							"type" => "select2",
							"options" => $templates);

		/* END HOMEPAGE OPTIONS */

		/* BEGIN SINGLE POST OPTIONS */
		$of_options[] = array( "name" => "Single Post",
							"type" => "heading");

		$of_options[] = array( "name" => "Show Author Info",
							"desc" => "Check to show the author info or uncheck to hide.",
							"id" => "arsene_show_author_info",
							"std" => 1,
							"type" => "checkbox");

		$of_options[] = array( "name" => "Show Social Media Share Buttons",
							"desc" => "Check to show social media share buttons or uncheck to hide.",
							"id" => "arsene_show_social_share",
							"std" => 1,
							"type" => "checkbox");

		$of_options[] = array( "name" => "Show Related Posts",
							"desc" => "Check to show the related posts or uncheck to hide.",
							"id" => "arsene_show_related_posts",
							"std" => 1,
							"type" => "checkbox");

		$of_options[] = array( "name" => "Show Featured Image",
							"desc" => "Check to show featured image or uncheck to hide.",
							"id" => "arsene_show_featured_image",
							"std" => 1,
							"type" => "checkbox");

		$of_options[] = array( "name" => "Enable Slider Image",
							"desc" => "If post has more than one image, they will be displayed as slider. By default is enabled, to disable uncheck this option.",
							"id" => "arsene_slider_image",
							"std" => 1,
							"type" => "checkbox");

		$of_options[] = array( "name" => "Review Position",
							"desc" => "Select review position",
							"id" => "arsene_review_position",
							"std" => "Right",
							"type" => "select",
							"options" => array("Right","Left"));

		/* END SINGLE POST OPTIONS */

		/* BEGIN ARCHIVE OPTIONS */
		$of_options[] = array( "name" => "Archives",
							"type" => "heading");

		$of_options[] = array( "name" => "Select Archive Template",
							"desc" => "Select the template you have created. You don't have any template? Build your templates now <a href='".admin_url('themes.php?page=aq-page-builder')."'>here</a>. But make sure plugin Aqua Page Builder is activated.",
							"id" => "arsene_archive_template",
							"std" => "",
							"type" => "select2",
							"options" => $templates);

		/* END ARCHIVE OPTIONS */	

		/* BEGIN STYLING OPTIONS */	
		$of_options[] = array( "name" => "Styling",
							"type" => "heading");

		$of_options[] = array( "name" =>  "Accent Color",
							"desc" => "Pick a color for the accent color (default: #7DA351).",
							"id" => "arsene_accent_color",
							"std" => "#7DA351",
							"type" => "color");

		$of_options[] = array( "name" =>  "Body Text Color",
							"desc" => "Pick a color for the body text color (default: #333333).",
							"id" => "arsene_body_text_color",
							"std" => "#333333",
							"type" => "color");

		$of_options[] = array( "name" => "Select Widget Style",
							"desc" => "Select your widget accent style.",
							"id" => "arsene_widget_style",
							"std" => "1",
							"type" => "select2",
							"options" => $widget_styles);

		$of_options[] = array( "name" => "Heading Font",
							"desc" => "Select your heading font. Default is Roboto Condensed.",
							"id" => "arsene_heading_font",
							"std" => "Roboto Condensed",
							"type" => "select_google_font",
							"options" => $webfonts);

		$of_options[] = array( "name" => "Body Font",
							"desc" => "Select your body font. Default is \"Helvetica Neue\", Helvetica, Arial, sans-serif.",
							"id" => "arsene_body_font",
							"std" => "Arial",
							"type" => "select_google_font",
							"options" => $webfonts);   

		$of_options[] = array( "name" => "Custom CSS",
							"desc" => "Write your custom CSS here.",
							"id" => "arsene_custom_css",
							"std" => "",
							"type" => "textarea");

		$of_options[] = array( "name" => "Background Pattern",
							"desc" => "Select background pattern. You can add more patterns by dropping the patterns to /assets/patterns/ in the theme directory.",
							"id" => "arsene_background_pattern",
							"std" => $pattern_url."debut_light.png",
							"type" => "images",
							"options" => $patterns);

		$of_options[] = array( "name" => "Header Background",
							"desc" => "Select header background.",
							"id" => "arsene_header_background_pattern",
							"std" => $pattern_url."header_bg.png",
							"type" => "images",
							"options" => $patterns);

		$of_options[] = array( "name" => "Footer Background Pattern",
							"desc" => "Select footer background pattern.",
							"id" => "arsene_footer_background_pattern",
							"std" => $pattern_url."dark_brick_wall.png",
							"type" => "images",
							"options" => $patterns);

		/* END STYLING OPTIONS */	

		/* BEGIN CONTACT OPTIONS */
		$of_options[] = array( "name" => "Contact",
							"type" => "heading");

		$of_options[] = array( "name" => "Contact Email Address",
							"desc" => "Enter your contact email address here. This email address will be used in Contact page template.",
							"id" => "arsene_contact_email",
							"std" => "",
							"type" => "text"); 

		/* END CONTACT OPTIONS */

		/* BEGIN SOCIAL MEDIA */
		$social_media = array("Twitter", "Facebook", "Google+", "Pinterest","Youtube","Vimeo","Flickr","Dribbble","DeviantArt","LinkedIn","RSS");
		$of_options[] = array( "name" => "Social Media",
							"type" => "heading");

		for($i=0; $i<count($social_media); $i++){
			$of_options[] = array( "name" => $social_media[$i],
							"desc" => "Enter your full ".$social_media[$i]." URL.",
							"id" => "arsene_".str_replace("+","plus",strtolower($social_media[$i]))."_profile",
							"std" => "#",
							"type" => "text"); 
		}		

		$of_options[] = array( "name" => "Email",
							"desc" => "Enter your email address.",
							"id" => "arsene_email_profile",
							"std" => "",
							"type" => "text"); 


		/* END SOCIAL MEDIA */

		/* BEGIN ADVERTISEMENT */
		$of_options[] = array( "name" => "Banner",
							"type" => "heading");

		$of_options[] = array( "name" => "Header Banner Link",
							"desc" => "Enter header banner URL.",
							"id" => "arsene_header_link",
							"std" => "",
							"type" => "text"); 

		$of_options[] = array( "name" => "Header Banner Image",
							"desc" => "Upload the banner image or define directly the image URL in the textbox.",
							"id" => "arsene_header_image",
							"std" => "",
							"type" => "media");

		$of_options[] = array( "name" => "Header Ads Code",
							"desc" => "Paste your header ads code (ex: adsense code)",
							"id" => "arsene_header_ads_code",
							"std" => "",
							"type" => "textarea");


		/* END ADVERTISEMENT */

		/* BEGIN FOOTER */
		$of_options[] = array( "name" => "Footer",
							"type" => "heading");

		$of_options[] = array( "name" => "Copyright Text",
							"desc" => "Enter Footer copyright text.",
							"id" => "arsene_copyright_text",
							"std" => "Copyright &copy; ".date('Y')." ".get_bloginfo("name"). " | ". get_bloginfo("description")."<br>All rights reserved.",
							"type" => "textarea");

		$of_options[] = array( "name" => "Show Footer Credit",
							"desc" => "Uncheck to hide footer credit.",
							"id" => "arsene_show_footer_credit",
							"std" => 1,
							"type" => "checkbox"); 

		/* END FOOTER */

		/* BEGIN BACKUP/RESTORE */
		$of_options[] = array( "name" => "Backup",
							"type" => "heading");
					
		$of_options[] = array( "name" => "Backup and Restore Options",
		                    "id" => "arsene_backup_option",
		                    "std" => "",
		                    "type" => "backup",
							"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
							);
						
		$of_options[] = array( "name" => "Transfer Theme Options Data",
		                    "id" => "arsene_transfer_option",
		                    "std" => "",
		                    "type" => "transfer",
							"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
							); 
		/* END BACKUP/RESTORE */

		$of_options[] = array( 	"name" 	=> "Twitter Options",
							"type" 		=> "heading"
						);

		$of_options[] = array( "name" => "information",
								"desc" => "",
								"id" => "introduction",
								"std" => "<h3 style=\"margin: 0 0 10px;\">Your Info!.</h3>
								Because the Twitter API 1.0 is no longer active, and replaced with Twitter API 1.1, you need to fill these fields in order to use the following widgets: <strong>Arsene Social</strong> and <strong>Arsene Twitter</strong>.
								To get the Twitter Consumer Key & Secret, please follow these steps: <br><br>
								<ol style='margin-left: 30px'>
								<li>Open <a href='https://dev.twitter.com/apps' target='_blank'>https://dev.twitter.com/apps</a> and login with your Twitter account.</li>
								<li>Create a new application.</li>
								<li>Fill the form fields and create your app.</li>
								<li>On the application page, click 'Create my access token'</li>
								<li>Also on the application page, you will see your Consumer Key & Consumer Secret. Paste the code to the fields below.</li>
								</ol>",
								"icon" => true,
								"type" => "info"
								);

		$of_options[] = array( 	"name" 		=> __('Twitter Consumer Key', 'arsene'),
								"desc" 		=> __('Enter your Twitter consumer key', 'arsene'),
								"id" 		=> "arsene_twitter_consumer_key",
								"std" 		=> "",
								"type" 		=> "text"
						);

		$of_options[] = array( 	"name" 		=> __('Twitter Consumer Secret', 'arsene'),
								"desc" 		=> __('Enter your Twitter consumer secret', 'arsene'),
								"id" 		=> "arsene_twitter_consumer_secret",
								"std" 		=> "",
								"type" 		=> "text"
						);
					
/*$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
					This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Media Uploader",
					"desc" => "Upload images using the native media uploader, or define the URL directly",
					"id" => "media_upload",
					"std" => "",
					"type" => "media");
					
$of_options[] = array( "name" => "Media Uploader Min",
					"desc" => "Upload images using native media uploader. This is a min version, meaning it has no url to copy paste. Perfect for logo.",
					"id" => "media_upload_2",
					"std" => "",
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => "Homepage Layout Manager",
					"desc" => "Organize how you want the layout to appear on the homepage",
					"id" => "homepage_blocks",
					"std" => $of_options_homepage_blocks,
					"type" => "sorter");
					
$of_options[] = array( "name" => "Slider Options",
					"desc" => "Unlimited slider with drag and drop sortings.",
					"id" => "pingu_slider",
					"std" => "",
					"type" => "slider");
					
$of_options[] = array( "name" => "Background Images",
					"desc" => "Select a background pattern.",
					"id" => "custom_bg",
					"std" => $bg_images_url."bg0.png",
					"type" => "tiles",
					"options" => $bg_images,
					);
					
$of_options[] = array( "name" => "Typography",
					"desc" => "Typography option with each property can be called individually.",
					"id" => "custom_type",
					"std" => array('size' => '12px','style' => 'bold italic'),
					"type" => "typography");

$of_options[] = array( "name" => "General Settings",
                    "type" => "heading");
					
$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( "name" => "Main Layout",
					"desc" => "Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
					"id" => "layout",
					"std" => "2c-l-fixed.css",
					"type" => "images",
					"options" => array(
						'1col-fixed.css' => $url . '1col.png',
						'2c-r-fixed.css' => $url . '2cr.png',
						'2c-l-fixed.css' => $url . '2cl.png',
						'3c-fixed.css' => $url . '3cm.png',
						'3c-r-fixed.css' => $url . '3cr.png')
					);
$of_options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => "custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$of_options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => "google_analytics",
					"std" => "",
					"type" => "textarea");        


$of_options[] = array( "name" => "Footer Text",
                    "desc" => "You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]",
                    "id" => "footer_text",
                    "std" => "Powered by [wp-link]. Built on the [theme-link].",
                    "type" => "textarea");                                                          
    
$of_options[] = array( "name" => "Styling Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Theme Stylesheet",
					"desc" => "Select your themes alternative color scheme.",
					"id" => "alt_stylesheet",
					"std" => "default.css",
					"type" => "select",
					"options" => $alt_stylesheets);
					
$of_options[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a background color for the theme (default: #fff).",
					"id" => "body_background",
					"std" => "",
					"type" => "color");
					
$of_options[] = array( "name" =>  "Header Background Color",
					"desc" => "Pick a background color for the header (default: #fff).",
					"id" => "header_background",
					"std" => "",
					"type" => "color");   

$of_options[] = array( "name" =>  "Footer Background Color",
					"desc" => "Pick a background color for the footer (default: #fff).",
					"id" => "footer_background",
					"std" => "",
					"type" => "color");
					
$of_options[] = array( "name" => "Body Font",
					"desc" => "Specify the body font properties",
					"id" => "body_font",
					"std" => array('size' => '12px','face' => 'arial','style' => 'normal','color' => '#000000'),
					"type" => "typography");  
					
$of_options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => "custom_css",
                    "std" => "",
                    "type" => "textarea");

$of_options[] = array( "name" => "Example Options",
					"type" => "heading"); 	   

$of_options[] = array( "name" => "Typography",
					"desc" => "This is a typographic specific option.",
					"id" => "typography",
					"std" => array('size' => '12px','face' => 'verdana','style' => 'bold italic','color' => '#123456'),
					"type" => "typography");  
					
$of_options[] = array( "name" => "Border",
					"desc" => "This is a border specific option.",
					"id" => "border",
					"std" => array('width' => '2','style' => 'dotted','color' => '#444444'),
					"type" => "border");      
					
$of_options[] = array( "name" => "Colorpicker",
					"desc" => "No color selected.",
					"id" => "example_colorpicker",
					"std" => "",
					"type" => "color"); 
					
$of_options[] = array( "name" => "Colorpicker (default #2098a8)",
					"desc" => "Color selected.",
					"id" => "example_colorpicker_2",
					"std" => "#2098a8",
					"type" => "color");          
                  
$of_options[] = array( "name" => "Upload",
					"desc" => "An image uploader without text input.",
					"id" => "uploader",
					"std" => "",
					"type" => "upload");  
					
$of_options[] = array( "name" => "Upload Min",
					"desc" => "An image uploader with text input.",
					"id" => "uploader2",
					"std" => "",
					"mod" => "min",
					"type" => "upload");     
                                
$of_options[] = array( "name" => "Input Text",
					"desc" => "A text input field.",
					"id" => "test_text",
					"std" => "Default Value",
					"type" => "text"); 
                                  
$of_options[] = array( "name" => "Input Checkbox (false)",
					"desc" => "Example checkbox with false selected.",
					"id" => "example_checkbox_false",
					"std" => 0,
					"type" => "checkbox");    
                                        
$of_options[] = array( "name" => "Input Checkbox (true)",
					"desc" => "Example checkbox with true selected.",
					"id" => "example_checkbox_true",
					"std" => 1,
					"type" => "checkbox"); 
                                                                           
$of_options[] = array( "name" => "Normal Select",
					"desc" => "Normal Select Box.",
					"id" => "example_select",
					"std" => "three",
					"type" => "select",
					"options" => $of_options_select);                                                          

$of_options[] = array( "name" => "Mini Select",
					"desc" => "A mini select box.",
					"id" => "example_select_2",
					"std" => "two",
					"type" => "select2",
					"class" => "mini", //mini, tiny, small
					"options" => $of_options_radio); 

$of_options[] = array( "name" => "Google Font Select",
					"desc" => "Some description.",
					"id" => "g_select",
					"std" => "Select a font",
					"type" => "select_google_font",
					"options" => array("Select a font"=>"Select a font","Lato"=>"Lato","Loved by the King"=>"Loved By the King","Tangerine"=>"Tangerine","Terminal Dosis"=>"Terminal Dosis"));   

$of_options[] = array( "name" => "Input Radio (one)",
					"desc" => "Radio select with default of 'one'.",
					"id" => "example_radio",
					"std" => "one",
					"type" => "radio",
					"options" => $of_options_radio);
					
$url =  ADMIN_DIR . 'assets/images/';
$of_options[] = array( "name" => "Image Select",
					"desc" => "Use radio buttons as images.",
					"id" => "images",
					"std" => "warning.css",
					"type" => "images",
					"options" => array(
						'warning.css' => $url . 'warning.png',
						'accept.css' => $url . 'accept.png',
						'wrench.css' => $url . 'wrench.png'));
                                        
$of_options[] = array( "name" => "Textarea",
					"desc" => "Textarea description.",
					"id" => "example_textarea",
					"std" => "Default Text",
					"type" => "textarea"); 
                                      
$of_options[] = array( "name" => "Multicheck",
					"desc" => "Multicheck description.",
					"id" => "example_multicheck",
					"std" => array("three","two"),
				  	"type" => "multicheck",
					"options" => $of_options_radio);
                                      
$of_options[] = array( "name" => "Select a Category",
					"desc" => "A list of all the categories being used on the site.",
					"id" => "example_category",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $of_categories);

//Advanced Settings
$of_options[] = array( "name" => "Advanced Settings",
					"type" => "heading");
          
$of_options[] = array( "name" => "Folding Checkbox",
					"desc" => "This checkbox will hide/show a couple of options group. Try it out!",
					"id" => "offline",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox");    

$of_options[] = array( "name" => "Hidden option 1",
					"desc" => "This is a sample hidden option 1",
					"id" => "hidden_option_1",
					"std" => "Hi, I\'m just a text input",
          			"fold" => "offline", // the checkbox hook
					"type" => "text");
					
$of_options[] = array( "name" => "Hidden option 2",
					"desc" => "This is a sample hidden option 2",
					"id" => "hidden_option_2",
					"std" => "Hi, I\'m just a text input",
          			"fold" => "offline", // the checkbox hook
					"type" => "text");
					
$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "introduction_2",
					"std" => "<h3 style=\"margin: 0 0 10px;\">Grouped Options.</h3>
					You can group a bunch of options under a single heading by removing the 'name' value from the options array except for the first option in the group.",
					"icon" => true,
					"type" => "info");
					
					$of_options[] = array( "name" => "Some pretty colors for you",
										"desc" => "Color 1.",
										"id" => "example_colorpicker_3",
										"std" => "#2098a8",
										"type" => "color"); 
					
					$of_options[] = array( "name" => "",
										"desc" => "Color 2.",
										"id" => "example_colorpicker_4",
										"std" => "#2098a8",
										"type" => "color");
										
					$of_options[] = array( "name" => "",
										"desc" => "Color 3.",
										"id" => "example_colorpicker_5",
										"std" => "#2098a8",
										"type" => "color"); 
										
					$of_options[] = array( "name" => "",
										"desc" => "Color 4.",
										"id" => "example_colorpicker_6",
										"std" => "#2098a8",
										"type" => "color"); 
					
// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					); */
					
	}
}
?>
