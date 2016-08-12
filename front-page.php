<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content">
		<?php //THE LOOP
		if( have_posts() ){ 
			while( have_posts() ){ 
				the_post();  ?>

		<?php the_post_thumbnail('banner'); //custom image size - functions.php ?>	

		<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="entry-content">
				
				<?php the_content();	?>
			</div>
			
		</article>
		<!-- end post -->
		<?php 
			}//end while
		}else{ ?>
			<h2>Sorry, no posts to show</h2>
		<?php } //end of THE LOOP ?>

	<?php get_template_part('section', 'homewidgets'); //includes section-homewidgets.php ?>


	</main>
	<!-- end #content -->


	<?php get_sidebar(); //include sidebar.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>