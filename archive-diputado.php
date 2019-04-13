<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revista-politica
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				?>
			</header><!-- .page-header -->

			<?php
			// WP_Query arguments
			$args = array (
				'post_type'              => 'diputado',
				'post_status'            => 'publish',
				'order'                  => 'DESC',
				'orderby'                => 'meta_value=name',
				'posts_per_page' 		=> -1 
			);

			// The Query
			$diputados = new WP_Query( $args );

			// The Loop
			if ( $diputados->have_posts() ) {
				while ( $diputados->have_posts() ) {
					$diputados->the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				}
			} else {
				// no posts found
			}

			// Restore original Post Data
			wp_reset_postdata();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
