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
$email = get_field( 'email' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_content">

		<header class="entry-header">
			<h1 class="entry-title"><?= __( 'Contact ', 'rev_politica' ) . $nombre; ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
		
		<p>En <strong>Adopte un diputado</strong> proporcionamos una herramienta para enviar mensajes a los diputados.</p>
		
		<p>Complete el siguiente formulario, para enviar escribirle a <strong><?= $nombre; ?></strong>. Recuerde mantener el respeto y la objetividad en sus apreciaciones.</p>

		<?= do_shortcode('[hf_form slug="contacte-un-diputado"]'); ?>
		
		<p>Los mensajes enviado por medio de este formulario serán revisados por un miembro de esta iniciativa, antes de enviarse al diputado o diputada.</p>
		</div><!-- .entry-content -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
