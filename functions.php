<?php 
//wordpress will include this file at the top of every page 
//of the theme, admin, login, feeds...

if ( ! isset( $content_width ) ) $content_width = 590;

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
add_theme_support( 'automatic-feed-links' );

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
// function awesome_scripts(){
// 	//attach jQuery
// 	wp_enqueue_script( 'jquery' );
// 	//attach custom js
// 	$js = get_stylesheet_directory_uri() . '/js/main.js';
// 	wp_enqueue_script( 'awesome-js', $js, array('jquery') );
// }
// add_action( 'wp_enqueue_scripts', 'awesome_scripts' );


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


function awesome_products( $number = 5){
	//custom query to get up to 5 newest products
	$product_query = new WP_Query( array(
		'post_type'		 => 'product',
		'posts_per_page' => $number,
		));

	if( $product_query->have_posts() ){

	 ?>
	<section class="feat-products">
		<h2>newest products</h2>
		<ul>
		<?php while( $product_query->have_posts() ){
			$product_query->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<h3><?php the_title(); ?></h3>
					<div><?php echo get_post_meta( get_the_id(), 'price', true ); ?></div>
				</a>
			</li>
		<?php }//end while ?>
		</ul>
	</section>
	<?php 	
		}//end custom loop
		//clean up
		wp_reset_postdata();

}



function awesome_blog_exclude_cat( $query ){
	if( is_home() ){
	$query->set( 'category__not_in', array(30) );
	}
}
add_action( 'pre_get_posts', 'awesome_blog_exclude_cat' );


/**
 * Theme customization options
 * 1. container color 
 * 2. custom link color
 * 3. border color
 * 4. sidebar location
 * 5. choose fonts
 */
add_action( 'customize_register', 'awesome_customizer' );
function awesome_customizer($wp_customize){
	//1. register the setting
	$wp_customize->add_setting('awesome_container_color', array('default'=> '#ffffff'));
	//add the form control
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'awesome_container_color_ui', 
		array(
			'label'   => 'Container Color',
			'section' => 'colors', //built in
			'settings'=> 'awesome_container_color',
		) 
	));

	//2. register the setting
	$wp_customize->add_setting('awesome_link_color', array('default'=> '#4682B4'));
	//add the form control
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'awesome_link_color_ui', 
		array(
			'label'   => 'Link Color',
			'section' => 'colors', //built in
			'settings'=> 'awesome_link_color',
		) 
	));

	//3. register the setting
	$wp_customize->add_setting('awesome_border_color', array('default'=> '#4682B4'));
	//add the form control
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'awesome_border_color_ui', 
		array(
			'label'   => 'Border Color',
			'section' => 'colors', //built in
			'settings'=> 'awesome_border_color',
		) 
	));

	//4. sidebar location
	//add new section
	$wp_customize->add_section( 'awesome_design_section', array(
			'title'		=> 'Design',
			'priority' 	=> 30,
		) );
	$wp_customize->add_setting('awesome_sidebar_position', array('default'=>'right'));
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'awesome_sidebar_position_ui',
		array(
			'label'		=> 'Sidebar Position',
			'section'	=> 'awesome_design_section',
			'settings'	=> 'awesome_sidebar_position',
			'type'		=> 'radio',
			'choices'	=> array(
				'left'	=> 'Left Side',
				'right'	=> 'Right Side',
				),
			)
		));

	//5. fonts
	$wp_customize->add_setting('awesome_custom_fonts', array('default'=>'Lato') );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'awesome_custom_fonts_ui',
		array(
			'label'		=> 'Fonts',
			'section'	=> 'awesome_design_section',
			'settings'	=> 'awesome_custom_fonts',
			'type'		=> 'select',
			'choices'	=> array(
				'Lato'	 => 'Lato',
				'Oswald' => 'Oswald',
				'Droid Serif' => 'Droid Serif',
				),
			)
		));
}

//embedded css for the customization
add_action( 'wp_head', 'awesome_custom_css' );
function awesome_custom_css(){ ?>
	<style>
		article{
			background-color: <?php echo get_theme_mod( 'awesome_container_color' ); ?> ;
		}
		a{
			color:<?php echo get_theme_mod( 'awesome_link_color' ); ?>;
		}
		.current-menu-item, article, .h-widg{
			border-color: <?php echo get_theme_mod( 'awesome_border_color' ); ?> ;
		}
		<?php 
			if( get_theme_mod( 'awesome_sidebar_position' ) == 'left' ){ ?>
				@media screen and (min-width: 600px){
					#sidebar{
						float: left;
					}
					#content{
						float: right;
					}	
				}

		<?php }	?>

		h1, h2, h3, h4{
			font-family: '<?php echo get_theme_mod('awesome_custom_fonts'); ?>', sans-serif;
		}

	</style>
<?php
}

//enqueue the google fonts
add_action( 'wp_enqueue_scripts', 'awesome_google_fonts' );
function awesome_google_fonts(){
	//converts spaces to + for the google url
	$font = str_replace(' ', '+', get_theme_mod('awesome_custom_fonts') );
	$url = 'https://fonts.googleapis.com/css?family=' . $font;
	wp_enqueue_style('awesome_font', $url );
}











//no close php!