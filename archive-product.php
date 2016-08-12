<?php get_header();  //include header.php ?>
<div class="wrapper">
	<main id="content" class="archive">
		<?php //THE LOOP
		if( have_posts() ){ ?>

			<h2>Products</h2>
		<div class="flex-container">
			<?php while( have_posts() ){ 
				the_post();  ?>
		<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?>
				</a>
			</h2>
			
				
			
			<div class="entry-content">
				<?php the_excerpt(); ?>
				
			</div>
			<?php $price = get_post_meta( get_the_id(), 'price', true ); 
			if($price){
			?>
			<div class="price">
				<?php 

				// display custom field 'price'
				echo '<span class="pmeta">'. $price . '</span>' ?>
				<?php the_terms( get_the_id(),'brand', '<h5>Brand: ', '', '</h5>' ); ?>
			</div>
			<?php } ?>


			
		</article>
		<!-- end post -->
		<?php }//end while 
		
			awesome_pagination();

		 }else{ ?>

			<h2>Sorry, no products to show</h2>
		<?php } //end of THE LOOP ?>
		

</div>
	</main>
	<!-- end #content -->



<?php get_sidebar('shop'); //include sidebar.php ?>
</div><!-- end wrapper -->
<?php get_footer(); //include footer.php ?>