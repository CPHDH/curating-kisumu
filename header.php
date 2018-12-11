<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>


		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#73A049">
		<meta name="theme-color" content="#fff">

		<?php
		// Social meta	
		$meta_title = ( $post && !( is_home() || is_front_page() )) ? get_the_title($post->ID).' | '. get_bloginfo( 'name' ) : get_bloginfo( 'name' );
		$meta_img = ( $post && has_post_thumbnail() ) ? get_the_post_thumbnail_url($post, 'large' ) : get_template_directory_uri().'/screenshot.png';
		$meta_excerpt=get_bloginfo( 'description' );	
		?>

		<!-- FB Open Graph stuff -->
		<meta property="og:title" content="<?php echo $meta_title;?>"/>
		<meta property="og:image" content="<?php echo $meta_img;?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' );?>"/>
		<meta property="og:description" content="<?php echo $meta_excerpt;?>"/>
		
		<!-- Twitter Card stuff-->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?php echo $meta_title;?>">
		<meta name="twitter:description" content="<?php echo $meta_excerpt;?>">
		<meta name="twitter:image" content="<?php echo $meta_img;?>">
		<meta name="twitter:site" content="@curatingkisumu">  

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">



			<header role="banner" itemscope itemtype="http://schema.org/WPHeader">
				<div id="header-padding">
				<div id="header-content">
					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<div id="logo" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.png" alt="LOGO"/></a></div>

					<nav class="main-menu" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
								'container' => false,                           // remove nav container
								'container_class' => 'menu',                 // class of container (should you choose to use it)
								'menu' => __( 'The Main Menu', 'sepalandseedtheme' ),  // nav name
								'menu_class' => 'nav',               // adding custom nav class
								'theme_location' => 'main-nav',                 // where it's located in the theme
								'before' => '',                                 // before the menu
								'after' => '',                                  // after the menu
								'link_before' => '',                            // before each link
								'link_after' => '',                             // after each link
								'depth' => 0,                                   // limit the depth of the nav
								'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
						<?php get_search_form();?>
					</nav>

				</div> <!-- end header content -->
				</div> <!-- end header padding -->

			</header>
