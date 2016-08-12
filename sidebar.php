<aside id="sidebar">
<?php if(!dynamic_sidebar('Blog Sidebar') ){ ?>

<?php get_search_form(); //include searchform.php OR WP's default search form ?>

	<?php wp_nav_menu( array(
		'theme_location' => 'social_menu',
		'fallback_cb' 	 => '',
		'container_class'=> 'social-icons'
	) ); ?>
		<section id="categories" class="widget">
			<h3 class="widget-title"> Categories </h3>
			<ul>
				<?php 
				//show up to 15 categories. 
				//make sure the most popular by post count are shown first
				wp_list_categories( array(
					'title_li' 		=> '',
					'depth'    		=> 1,
					'show_count' 	=> 1,
					'orderby' 		=> 'count',
					'order'			=> 'DESC',
					'number'		=> 15,
				) ); ?>
			</ul>
		</section>
		<section id="archives" class="widget">
			<h3 class="widget-title"> Archives </h3>
			<ul>
				<?php 
				//show yearly archive links
				wp_get_archives( array(
					'type' => 'yearly',
					'show_post_count' => 1,
				) ); ?>
			</ul>
		</section>
		<section id="tags" class="widget">
			<h3 class="widget-title"> Tags </h3>
			<ul>
				 <?php 
				 wp_list_categories( array(
					'taxonomy' 		=> 'post_tag', //show tags instead of categories
					'title_li' 		=> '',
					'show_count'	=> 1,
					'orderby'		=> 'count',
					'order'			=> 'DESC',
					'number'		=> 15,
				) ); 

				 // wp_tag_cloud( array(
				 // 	'smallest' 	=> 0.8,
				 // 	'largest'	=> 0.8,
				 // 	'unit'		=> 'em',
				 // ) ); 
				 ?>
			</ul>
		</section>
		<section id="meta" class="widget">
			<h3 class="widget-title"> Meta </h3>
			<ul>
				<?php //show link to admin if the user is logged in
				if( is_user_logged_in() ){ ?>
				<li><a href="<?php echo admin_url(); ?>">Site Admin</a></li>
				<?php } ?>

				<li><?php wp_loginout( home_url() ); ?> </li>
			</ul>

			<?php 
			if( ! is_user_logged_in() ){
				wp_login_form();
			} 
			?>
		</section>
	<?php } ?>	
	</aside>
	<!-- end #sidebar -->