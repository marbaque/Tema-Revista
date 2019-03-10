<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Revista-politica
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer__wrap">

			<?php
			// Make sure there is a social menu to display.
			if ( has_nav_menu( 'social' ) ): ?>
			<nav class="social-menu">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . rev_politica_get_svg( array( 'icon' => 'chain' ) ),
					) );
				?>
			</nav>
		<?php endif; ?>

		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'rev-politica' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'rev-politica' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'rev-politica' ), 'rev-politica', '<a href="http://mariobadilla.com">Mario Badilla</a>' );
				?>
		</div><!-- .site-info -->
	</div><!-- .footer__wrap -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
