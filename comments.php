<?php 
	if( post_password_required() ){
		return; //stop rest of file from loading
	}

	//split the comment count (by default includes comments and pings/trackbacks)
	$comments_by_type = separate_comments( $comments );
	$comment_count = count($comments_by_type['comment']);
	$pings_count = count($comments_by_type['pings']);
 ?>
<section class="comments">
	<h2><?php awesome_comments_number( $comment_count, 'No comments yet', '1 comment', ' comments' ); ?> <?php if( comments_open() ){?>| <a href="#respond">Leave a comment</a><?php } ?>
	</h2>
	
	<ol class="comm-list">
		<?php wp_list_comments( array(
			'type' => 'comment',
		)); ?>
	</ol>

	<?php if( get_option( 'page_comments' ) AND get_comment_pages_count() > 1 ){ ?>
	<div class="comment-pagination pagination">
		<?php previous_comments_link();
		next_comments_link(); ?>
	</div>
	<?php } ?>

	<?php comment_form(); ?>

</section>

<?php if( $pings_count != 0 ){ ?>
<section class="pingbacks">
<h2><?php echo $pings_count ?> sites mention this post:</h2>
	<ol class="pinglist">
		<?php wp_list_comments( array(
			'type' => 'pings',
		)); ?>
	</ol>
</section>
<?php }//end if there are pings ?>