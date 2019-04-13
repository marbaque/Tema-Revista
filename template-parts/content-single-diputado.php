<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Revista-politica
 */

?>

<?php 
$nombre = get_field( 'nombre' ); 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_content">

		<header class="entry-header">
			<h1 class="entry-title"><?= __( 'Contact ', 'rev-politica' ) . $nombre; ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
				<?php the_content(); ?>
		</div><!-- .entry-content -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
