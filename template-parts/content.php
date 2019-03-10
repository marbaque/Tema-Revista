<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revista-politica
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="index-image">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	        <?php the_post_thumbnail('index'); ?>
	    </a>
		</figure>
	<?php endif; ?>

	<div class="post_content">

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					rev_politica_posted_on();
					rev_politica_posted_by();
					$categories_list = get_the_category_list( esc_html__( ', ', 'rev-politica' ) );
					if ( $categories_list ) {
						/* translators: 1: list of categories. */
						printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rev-politica' ) . '</span>', $categories_list ); // WPCS: XSS OK.
					}
					//rev_politica_entry_footer();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
				<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<div class="continue-reading">
			<?php
			$read_more_link = sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s', 'rev_politica' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			);
			?>

			<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
				<?php echo $read_more_link; ?>
			</a>
		</div><!-- .continue-reading -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
