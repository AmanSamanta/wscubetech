<?php if ( have_comments() && post_password_required( $post ) == false ) { ?>

	<?php

		$qshop_num_comments = get_comments_number();

		if ( comments_open() ) {

			if ( $qshop_num_comments > 1 ) {

				$qshop_comments = $qshop_num_comments . esc_html__(' Comments', 'q-shop');

			} else {

				$qshop_comments = esc_html__('1 Comment', 'q-shop');
			}

		} else {

			$qshop_comments =  esc_html__('Comments closed', 'q-shop');

		}

	?>

	<div class="section-title group">
		<h2 class="w-thin-text"><?php echo esc_html( $qshop_comments ); ?></h2>
	</div>

	<?php if ( !comments_open() ) { ?>
	
		<div id="comments" class="comment-entry group comments-closed">
		
			<ol class="commentlist">
				<?php wp_list_comments( array( 'type' => 'all', 'callback' => 'qshop_comments' ) ); ?>
			</ol>
		
		</div>

	<?php } else { ?>

		<div id="comments" class="comment-entry group">
		
			<ol class="commentlist">
				<?php wp_list_comments( array( 'type' => 'all', 'callback' => 'qshop_comments' ) ); ?>
			</ol>
		
		</div>

	<?php } ?>
	
	 <?php
	 
		$qshop_paginate_args = array (
			'echo' => false,	
		);
	 
		paginate_comments_links( $qshop_paginate_args ); ?> 
	
<?php }


$qshop_comments_args = array (
	'title_reply_before' => '',
	'title_reply_after' => '',
	'title_reply'=> '<div class="section-title group"><h2 class="w-thin-text">' . esc_html__( 'Leave Reply', 'q-shop' ) . '</h2></div>',
	'title_reply_to' => esc_html__( 'Leave a Reply to %s', 'q-shop' ),
	'label_submit' => esc_html__( 'Submit', 'q-shop' ),
	'comment_notes_after' => '' );

comment_form($qshop_comments_args);