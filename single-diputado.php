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

                echo '<a href="' . $facebook . '" title="' . __('Facebook Page', 'rev-politica') .'">' . rev_politica_get_svg( array( 'icon' => 'facebook' , 'fallback' => true ) ) .'</a>';
                echo '<a href="' . $twitter . '" title="'. __('Twitter Account', 'rev-politica') . '">' . rev_politica_get_svg( array( 'icon' => 'twitter' , 'fallback' => true ) ) .'</a>';
                echo '<a href="mailto:' . $email . '" title"' . __('Send email', 'rev-politica') .'">' . rev_politica_get_svg( array( 'icon' => 'envelope-o' , 'fallback' => true ) ) .'</a>';

                ?>
            </nav>

            <?php
            $nombre = get_field( 'nombre' );
            $frac = get_field( 'fraccion' );            
            ?>

            <h2><?= $nombre; ?></h2>

            <ul>
                <?php 
                
                echo get_the_term_list(
                $post->ID, 'fraccion', __('<li>', 'pemscores'), ', ', '</li>' ); 
                
                $provincia = get_field('provincia');
                if ($provincia) {
                    echo '<li>' . $provincia . '</li>';
                }
                if ($email) {
                    echo '<li>' . __( 'Email:', 'rev-politica' ) . ' ' . $email . '</li>';
                }
                $telA = get_field('tel_a');
                $telB = get_field('tel_b');
                $fax = get_field('fax');
                if($telA) {
                    echo '<li>' . __( 'Teléfono 1:', 'rev-politica' ) . ' ' . $telA . '</li>';
                }
                if($telB) {
                    echo '<li>' . __( 'Teléfono 2:', 'rev-politica' ) . ' ' . $telB . '</li>';
                }
                if($fax) {
                    echo '<li>' . __( 'Fax:', 'rev-politica' ) . ' ' . $fax . '</li>';
                }
                
                
                
                ?>


            </ul>


        </div>
    </div><!-- #secondary -->

    <div id="primary" class="content-area">
		<main id="main" class="site-main">

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
