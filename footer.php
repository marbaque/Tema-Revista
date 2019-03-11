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
			<?= get_bloginfo( 'name' ) . '<br>' . get_bloginfo( 'description' ); ?>
		</div><!-- .site-info -->
	</div><!-- .footer__wrap -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
