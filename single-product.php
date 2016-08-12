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

				the_post_thumbnail( 'large' );

				the_content();


				?>
				</div>

		<?php $price = get_post_meta( get_the_id(), 'price', true ); 
			if($price){
			?>
			<div class="price">
				<?php 

				// display custom field 'price'
				echo 'Price: <span class="pmeta">' . $price . '</span>' ?>
			</div>
			<?php } ?>

			<?php $size = get_post_meta( get_the_id(), 'size', true ); 
			if($size){
			?>
			<div class="size">
				<?php 

				// display custom field 'size'
				echo 'Size: <span class="pmeta-s">' . $size . '</span>' ?>
			</div>
			<?php } ?>


			<?php the_terms( get_the_id(),'brand', '<h5>Brand: ', '', '</h5>' ); ?>
			<?php the_terms( get_the_id(),'feature', '<h5>Features: ', ', ', '</h5>' ); ?>
		
	</article>
	<!-- end post -->

	<?php }//end while

		awesome_pagination();

	 }else{ ?>
		<h2>Sorry, no products to show</h2>
		<?php } //end of THE LOOP ?>



	</main>
	<!-- end #content -->


	<?php get_sidebar('shop'); //include sidebar.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>