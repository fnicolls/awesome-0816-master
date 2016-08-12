<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content">
	<?php //THE LOOP
	if( have_posts() ){ 
		while( have_posts() ){ 
			the_post();  ?>
			<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
				<h2 class="entry-title"> 
					<a href="<?php the_permalink(); ?>"> 
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="entry-content">

					<?php 
			//if viewing a single post or page, show full content. 
			//otherwise show short content
					if( is_single() OR is_page() ){
				//show the featured image
						the_post_thumbnail('large');

						the_content();

						//for posts with <!--nextpage-->
						wp_link_pages( array(
							'before' => '<div class="post-pages">Continue ',
							'after' => '</div>',
							'next_or_number' => 'next',
							));
					}else{
				//show the featured image
						the_post_thumbnail('thumbnail');

				the_excerpt(); //first 55 words
			}
			?>
		</div>
		<div class="postmeta">
			<span class="author">Posted by: <?php the_author(); ?></span>
			<span class="date"><?php the_date(); ?> </span>
			<span class="num-comments"> <?php comments_number(); ?></span>
			<span class="categories"><?php the_category(); ?></span>
			<span class="tags"><?php the_tags(); ?></span>
		</div>
		<!-- end postmeta -->
	</article>
	<!-- end post -->

	<?php comments_template(); //include comments.php or default comments ?>

	<?php }//end while

		awesome_pagination();

	 }else{ ?>
		<h2>Sorry, no posts to show</h2>
		<?php } //end of THE LOOP ?>



	</main>
	<!-- end #content -->


	<?php get_sidebar(); //include sidebar.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>