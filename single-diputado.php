<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Revista-politica
 */

get_header();
?>

	<div class="widget-area" role="sidebar">
    
        <div class="widget widget-personal">
        
            <?php 

            $foto = get_field( 'foto' );
            $size = 'thumbnail';

            if( $foto ) {
                echo '<figure class="avatar">';
                echo wp_get_attachment_image( $foto, $size );
                echo '</figure>';

            } else {
                echo '<figure class="avatar">';
                echo '<img src="' . get_template_directory_uri() . '/img/usuario.png" alt="imagen genérica de usuario">';
                echo '</figure>';
            }
            ?>

            <nav class="redes">
                <?php

                $facebook = get_field('facebook');
                $twitter = get_field('twitter');
                $email = get_field('email');

                echo '<a href="' . $facebook . '" title="' . __('Facebook Page', 'rev_politica') .'">' . rev_politica_get_svg( array( 'icon' => 'facebook' , 'fallback' => true ) ) .'</a>';
                echo '<a href="' . $twitter . '" title="'. __('Twitter Account', 'rev_politica') . '">' . rev_politica_get_svg( array( 'icon' => 'twitter' , 'fallback' => true ) ) .'</a>';
                echo '<a href="mailto:' . $email . '" title"' . __('Send email', 'rev_politica') .'">' . rev_politica_get_svg( array( 'icon' => 'envelope-o' , 'fallback' => true ) ) .'</a>';

                ?>
            </nav>

            <?php
            $nombre = get_field( 'nombre' );
            $frac = get_field( 'fraccion' );            
            ?>

            <h2><?= $nombre; ?></h2>

            <ul>
            <?php 
                // get the current taxonomy term
                $term = get_field('fraccion');
                $termUrl = get_category_link( $term );
                
                if( $term ): ?>

                    <a href="<?= $termUrl;  ?>"><p><?= $term->name; ?> <img class="bandera" src="<?php the_field('bandera', $term); ?>" aria-hidden></p></a>
                    
                <?php endif;
                
                $provincia = get_field('provincia');
                if ($provincia) {
                    echo '<li>' . $provincia . '</li>';
                }
                if ($email) {
                    echo '<li>' . __( 'Email:', 'rev_politica' ) . ' ' . $email . '</li>';
                }
                $telA = get_field('tel_a');
                $telB = get_field('tel_b');
                $fax = get_field('fax');
                if($telA) {
                    echo '<li>' . __( 'Teléfono 1:', 'rev_politica' ) . ' ' . $telA . '</li>';
                }
                if($telB) {
                    echo '<li>' . __( 'Teléfono 2:', 'rev_politica' ) . ' ' . $telB . '</li>';
                }
                if($fax) {
                    echo '<li>' . __( 'Fax:', 'rev_politica' ) . ' ' . $fax . '</li>';
                }
                
                
                
                ?>


            </ul>


        </div>
    </div><!-- #secondary -->

    <div id="primary" class="content-area">
		<main id="main" class="site-main">
        <a class="back-link" href="<?php echo get_post_type_archive_link( 'diputado' ); ?>"><?php echo __('Diputados' , 'rev_politica'); ?></a>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-single', get_post_type() );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
    </div><!-- #primary -->
    
<?php

get_footer();
