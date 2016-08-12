<?php 
//wordpress will include this file at the top of every page 
//of the theme, admin, login, feeds...

add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array( 'quote', 'image', 'gallery', 'audio', 'video', 'chat', 'aside', 'status', 'link' ) );

				//name 	  width  height  crop?
add_image_size( 'banner', 1200, 300, true );
add_image_size( 'skinny-banner', 1200, 150, true );
//use force regenerate thumbnails to resize all your images!

add_theme_support('custom-background');

//don't forget to add header_image() somewhere in your templates
add_theme_support( 'custom-header', array(
					'width' => 960,
					'height' => 200,
					) );

//put the_custom_logo() anywhere to show it
add_theme_support( 'custom-logo', array(
					'width' => 120,
					'height' => 80	
					) );	

add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );

//SEO friendly <title> tags, delete <title> from your header first. also needs wp_head()
add_theme_support( 'title-tag' );

//adds RSS feeds for every tag, category, author, post
add_theme_support( 'automatic_feed_links' );

//support for editor-style.css
add_editor_style();




/**
 * Make the EXCERPT better
 */
function awesome_ex_length(){
	//default is 55 words
	if( is_search() ){
		return 25;
	}else{
		return 75;
	}
}
add_filter( 'excerpt_length', 'awesome_ex_length' );

//replace the ... with a read more button
function awesome_ex_more(){
	return '&hellip; <a class="button" href="' . get_permalink() .'">read more</a>';
}
add_filter( 'excerpt_more', 'awesome_ex_more' );

/**
 * improve comment UX with javascript
 */
function awesome_comm_reply(){
	if( is_single() AND comments_open() ){
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'awesome_comm_reply' );


/**
 * add 2 menu areas
 * don't forget to put wp_nav_menu in templates
 * then go to appearance > menus to configure
 */

function awesome_menu_areas(){
	register_nav_menus( array(
		'main_menu' => 'Main Navigation Area',
		'footer_menu' => 'Footer Navigation Area',
		'social_menu' => 'Social Media Links',
		) );
}
add_action( 'init', 'awesome_menu_areas' );



/**
 * helper function: cleaner archive pagination
 * just call this wherever you want pagination links
 */
function awesome_pagination(){
	if( is_singular( 'product') ){
	
		$next_product = get_next_post();
		$prev_product = get_previous_post();
	?>
	<div class="prod-pag">
	<h3>more products</h3>
	<?php if($prev_product){?>
	<a href="<?php echo get_permalink( $prev_product ); ?>">
		<?php echo get_the_post_thumbnail( $prev_product, 'thumbnail' );?>
		<h4><?php echo $prev_product->post_title; ?></h4>
	</a>
	<?php }
	if($next_product){
	?>	
	<a href="<?php echo get_permalink( $next_product ); ?>">
		<?php echo get_the_post_thumbnail( $next_product, 'thumbnail' );?>
		<h4><?php echo $next_product->post_title; ?></h4>
	</a>
	<?php } ?>
	</div>
	<?php
	}elseif( is_singular('post') ){
	echo '<div class="pn-pag">';
		previous_post_link('%link', '&laquo; %title'); //older post
		next_post_link('%link', '%title &raquo;'); //newer post
	echo '</div>';
	}else{
		echo '<div class="pag-num">';
		if( function_exists('the_posts_pagination') ){
					the_posts_pagination( array(
						'next_text' => 'Next &rarr;',
						'prev_text' => '&larr;',
						'mid_size' => 2, //show more numbers in middle
						));
				}else{
					previous_posts_link('&larr; Newer Posts');
					next_posts_link('Older Posts &rarr;');
				}
		echo '</div>';
	}
}

/**
 * register the widget areas
 * call dynamic_sidebar() in templates to display
 */

function awesome_widget_areas(){
	register_sidebar( array(
		'name' 	=> 'Home Area',
		'id'	=> 'home-area',
		'description'=> 'widgets for home area',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
		) );

	register_sidebar( array(
		'name' 	=> 'Blog Sidebar',
		'id'	=> 'blog-sidebar',
		'description'=> 'sidebar for widgets',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
		) );

	register_sidebar( array(
		'name' 	=> 'Page Sidebar',
		'id'	=> 'page-sidebar',
		'description'=> 'sidebar for page view',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title' 	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>'
		) );

	register_sidebar( array(
		'name' 	=> 'Footer Area',
		'id'	=> 'footer-area',
		'description'=> 'appears at the bottom of everything',
		'before_widget' => '<section id="%1$s" class="foot-widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title' 	=> '<h3 class="foot-widget-title">',
		'after_title'	=> '</h3>'
		) );	
}
add_action('widgets_init', 'awesome_widget_areas' );


//add jquery
function awesome_scripts(){
	//attach jQuery
	wp_enqueue_script( 'jquery' );
	//attach custom js
	$js = get_stylesheet_directory_uri() . '/js/main.js';
	wp_enqueue_script( 'awesome-js', $js, array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'awesome_scripts' );


/**
 * helper function for comment number (to not include pings)
 */
function awesome_comments_number( $number, $zero, $one, $many ){
	if( $number == 0 ){
		echo $zero;
	}elseif( $number == 1 ){
		echo $one;
	}else{
		echo $number . $many;
	}
}


//no close php!