<?php
/**
 * The template part for displaying pagination.
 */
?>

<?php

	$prev_link = get_previous_posts_link();
	$next_link = get_next_posts_link();
	
	$args = array(
		'prev_text' => esc_html__('Prev', 'q-shop'),
	  	'next_text' => esc_html__('Next', 'q-shop')
	);

	if ( $prev_link || $next_link ) { 
	
		echo '<div class="pagination group">';  
		
			echo paginate_links( $args );
		
		echo '</div>';

	}

?>