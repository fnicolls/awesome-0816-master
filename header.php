<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" 
		href="<?php echo get_stylesheet_directory_uri(); ?>/css/normalize.css">
		
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); //hook. required for the admin bar and plugins to work ?>
</head>
<body <?php body_class(); ?>>

<?php if( has_header_image() ){ ?>
		<img src="<?php header_image(); ?>">
<?php } ?>

<div id="container">
	<header role="banner" id="header">

		<?php if( function_exists(the_custom_logo) ){
					the_custom_logo();
			} ?>
		<h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
		<h2><?php bloginfo( 'description' ); ?></h2>
		
		<?php wp_nav_menu( array(
				'theme_location' 	=> 'main_menu',
				'container' 		=> 'nav', //wraps in <nav>
				'container_class' 	=> 'menu', //adds class menu to nav
				'menu_class' 		=> '',
				'fallback_cb'		=> '',
			) ); ?>
		

		
	</header>