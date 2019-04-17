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
    $frac = get_field( 'fraccion' );
    
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php 

    $foto = get_field( 'foto' );
    $size = 'thumbnail';

    if( $foto ) {

        echo '<a href="' . esc_url( get_permalink() ) .'" title="' . $nombre . '">';
        echo wp_get_attachment_image( $foto, $size );
        echo '</a>';

    } else {

        echo '<a href="' . esc_url( get_permalink() ) .'" title="' . $nombre . '"><img src="' . get_template_directory_uri() . '/img/usuario.png" alt="imagen genérica de usuario"></a>';
    }

    ?>

	<div class="post_content">

        <h2 class="entry-title"><a href="<?= esc_url( get_permalink() ); ?>" rel="bookmark"><?= $nombre; ?></a></h2>

        <?php 
        // get the current taxonomy term
        $term = get_field('fraccion');
        $termUrl = get_category_link( $term );
        
        if( $term ): ?>

            <a href="<?= $termUrl;  ?>"><p><?= $term->name; ?> <img class="bandera" src="<?php the_field('bandera', $term); ?>" aria-hidden></p></a>
            

        <?php endif; ?>

		<div class="continue-reading">
			<?php
			$read_more_link = sprintf(
				/* translators: %s: Name of current post. */
				rev_politica_get_svg( array( 'icon' => 'arrow-long-right' , 'fallback' => true ) ),
				'<span class="screen-reader-text">Leer más de ' . $nombre .'</span>'
			);
			?>

			<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
				<?php echo $read_more_link; ?>
			</a>
		</div><!-- .continue-reading -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
