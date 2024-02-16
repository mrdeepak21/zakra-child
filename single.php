<?php
/**
 * Template Name: Single Post 
 * The template for displaying single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zakra
 */
get_header();
?>
	<main id="zak-primary" class="zak-primary">
		<?php echo apply_filters( 'zakra_after_primary_start_filter', false ); // WPCS: XSS OK. 
    echo do_shortcode('[elementor-template id="7042"]'); 
		 the_content();
		 do_action( 'zakra_after_single_post_content' );
		echo apply_filters( 'zakra_after_primary_end_filter', false ); // // WPCS: XSS OK. ?>
	</main><!-- /.zak-primary -->
<?php
get_sidebar();
get_footer();
