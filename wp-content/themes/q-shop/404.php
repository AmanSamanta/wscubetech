<?php get_header(); ?>

	<div class="wrapper group error-wrap">

		<div class="error-content-wrap">

			<h1><?php esc_html_e('404 Error', 'q-shop'); ?></h1>

			<h3><?php esc_html_e('Sorry but the page you requested could not be found.', 'q-shop'); ?></h3>

			<p><?php esc_html_e('Perhaps searching will help.', 'q-shop'); ?></p>

			<?php get_search_form(); ?>

		</div><!-- .error-content-wrap -->

	</div><!-- .wrapper -->

<?php get_footer(); ?>