<?php
	/*
		Template Name: Home Page
	*/
?>

<?php 

	get_header();

	if ( class_exists( 'WooCommerce' ) ) {

		get_template_part('template-parts/home/first', 'home');

	} else {

		get_template_part('template-parts/posts/posts-loop');

	}

	get_footer();

?>
