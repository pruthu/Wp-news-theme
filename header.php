<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<!-- BASIC META -->
		<title><?php
            global $page, $paged;
            wp_title( '|', true, 'right' );
            bloginfo( 'name' );
            $site_description = get_bloginfo( 'description', 'display' );

            if ( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";

            if ( $paged >= 2 || $page >= 2 )
                echo ' | ' . sprintf( __( 'Page %s', 'arsene' ), max( $paged, $page ) );

            ?></title>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <?php /* since v1.0.2 */ ?>
        <?php if(get_arsene_option("arsene_seo_options") && (is_home() || is_front_page())): ?>
        <!-- WEBSITE META -->
            <meta name="description" content="<?php echo get_arsene_option("arsene_seo_description"); ?>">
            <meta name="keywords" content="<?php echo get_arsene_option("arsene_seo_keywords"); ?>">
        <?php elseif(is_category() || is_tag()): ?>
            <meta name="description" content="<?php echo strip_tags(category_description()); ?>">
        <?php elseif(is_single()): ?>
            <?php if(have_posts()): the_post(); ?>
                <meta name="description" content="<?php echo strip_tags(get_the_excerpt()); ?>">
            <?php endif; ?>
            <?php rewind_posts(); ?>
        <?php endif; ?>         

        <!-- RSS & PINGBACK -->
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo get_option('vpt_feedburner') != "" ? get_option('vpt_feedburner') : bloginfo('rss2_url'); ?>" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <!-- Webfonts -->
        <?php if(get_arsene_option("arsene_heading_font") != "Arial"): ?>
        <link href='http://fonts.googleapis.com/css?family=<?php echo arsene_select_google_webfonts(get_arsene_option("arsene_heading_font")); ?>' rel='stylesheet' type='text/css'>
        <?php endif; ?>
        
        <?php if(get_arsene_option("arsene_body_font") != "Arial"): ?>
        <link href='http://fonts.googleapis.com/css?family=<?php echo arsene_select_google_webfonts(get_arsene_option("arsene_body_font")); ?>' rel='stylesheet' type='text/css'>
        <?php endif; ?>

        <!-- FAVICON -->
        <link rel="shortcut icon" href="<?php echo get_arsene_option('arsene_favicon'); ?>">

        <?php if(get_arsene_option("arsene_analytic_code") != "") 
                echo get_arsene_option("arsene_analytic_code"); ?>       

        <!-- WP_HEAD FUNCTION -->
        <?php
            /* Always have wp_head() just before the closing </head>
             * tag of your theme, or you will break many plugins, which
             * generally use this hook to add elements to <head> such
             * as styles, scripts, and meta tags.
             */
            wp_head();
        ?>               

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/assets/css/ie.css">           
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js"></script>            
        <![endif]-->  

	</head>

    <body <?php body_class(); ?>>
        <div id="wrapper">
            <header id="header">
                <div class="top-bar">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span8">
                                <div class="top-menu-container">                                    
                                    <?php wp_nav_menu(array( 'theme_location' => 'top-menu', 'menu_class'=>'sf-menu' , 'container' => '', 'before' => ' ', 'fallback_cb' => '' )); ?>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="top-mobile-menu">
                                    <a class="show-menu" href=""><i class="icon-reorder"></i></a>
                                    <?php wp_nav_menu(array( 'theme_location' => 'top-menu', 'menu_class'=>'mobile-top-menu' , 'container' => '', 'before' => ' ', 'fallback_cb' => '' )); ?>
                                </div>
                                <div class="social-icon-container">
                                    <?php bt_social_menu(); ?>
                                </div>
                            </div>
                        </div><!-- /row-fluid -->
                    </div><!-- /container -->
                </div><!-- /top-bar -->

                <div id="main-header">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <?php if(get_arsene_option('arsene_website_logo') != ""): ?>
                                        <h1 id="logo">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_arsene_option('arsene_website_logo'); ?>" alt="<?php bloginfo('name'); ?>"></a>
                                        </h1>
                                        <?php else: ?>
                                        <hgroup>
                                            <h1 id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo('name'); ?></a></h1>
                                            <h2 id="description"><?php bloginfo('description'); ?></h2>
                                        </hgroup>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if(get_arsene_option("arsene_header_ads_code") != "" ): ?>
                             <div class="span8">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="header-banner">
                                            <?php echo get_arsene_option("arsene_header_ads_code"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php elseif((get_arsene_option("arsene_header_link") != "") && (get_arsene_option("arsene_header_image") != "") ): ?>
                            <div class="span8">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="header-banner">
                                            <a target="_blank" href="<?php echo get_arsene_option("arsene_header_link"); ?>"><img alt="" src="<?php echo get_arsene_option("arsene_header_image"); ?>"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- /main-header -->

                <nav class="main-menu <?php echo get_arsene_option('arsene_enable_floating_menu') == 1 ? "floating-menu":""; ?>">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="main-mobile-menu">
                                    <a class="show-menu" href=""><i class="icon-reorder"></i></a>
                                    <span class="placeholder"><?php _e("Menu","arsene"); ?></span>
                                    <?php wp_nav_menu(array( 'theme_location' => 'primary-menu', 'menu_class'=>'mobile-main-menu' , 'container' => '', 'before' => ' ', 'fallback_cb' => '' )); ?>
                                </div>                                
                                <?php wp_nav_menu(array( 'theme_location' => 'primary-menu', 'menu_class'=>'sf-menu' , 'container' => '', 'before' => ' ', 'fallback_cb' => '' )); ?>
                            </div>
                        </div>
                    </div>
                </nav><!-- /main-menu -->

                <?php if (get_arsene_option('arsene_enable_newsticker')): ?>
                <div class="bottom-menu">
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span9">
                                <div class="row-fluid">
                                    <?php bt_newsticker(); ?>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="row-fluid">
                                    <div class="span12">
                                       <?php get_search_form(); ?>
                                    </div>
                                </div>                      
                            </div>
                        </div>
                    </div>
                </div><!-- /bottom-menu -->
                <?php endif; ?>

            </header><!-- /header -->

            <div id="main-content" class="container margin-t40 clearfix">