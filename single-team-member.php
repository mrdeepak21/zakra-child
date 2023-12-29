<?php
/**
 * Template Name: Team Member Single
 * The template for displaying team member single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zakra
 */
get_header();
?>
	<main id="zak-primary" class="zak-primary">
		<?php echo apply_filters( 'zakra_after_primary_start_filter', false ); // WPCS: XSS OK. 
     echo do_shortcode('[elementor-template id="4661"]');
		 the_content();
		echo apply_filters( 'zakra_after_primary_end_filter', false ); // // WPCS: XSS OK. ?>
	</main><!-- /.zak-primary -->
<?php
get_sidebar();
get_footer();