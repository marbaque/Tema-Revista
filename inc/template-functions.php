<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Revista-politica
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function rev_politica_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
		$classes[] = 'archive-view';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'rev_politica_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rev_politica_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'rev_politica_pingback_header' );


//quitar titulo por defecto de diputados cpt
function remove_post_type_title() {
	remove_post_type_support( 'diputado', 'title' );
	remove_post_type_support( 'diputado', 'editor' );
}
add_action( 'init', 'remove_post_type_title' );

// Sincronizar custom fields
 
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

// Auto-populate post title with ACF.
function jb_update_postdata( $value, $post_id, $field ) {
	
	$name = get_field('nombre', $post_id);
	
	$slug = sanitize_title( $title );
  
	$postdata = array(
	     'ID'          => $post_id,
         'post_title'  => $name,
	     'post_type'   => 'diputado',
	     'post_name'   => $slug
  	);
  
	wp_update_post( $postdata );
	
	return $value;
	
}
add_filter('acf/update_value/name=nombre', 'jb_update_postdata', 10, 3);

/* * ********************************************************************* */
// Dar a categorias del curso el mismo template de archivo de cursos page-capacitacion.php
/* * ********************************************************************* */
add_filter('template_include', function( $template ) {
	if ( is_tax('fraccion') ) {
		$locate = locate_template('archive-diputado.php', false, false);
		if (!empty($locate)) {
			$template = $locate;
		}
	}
	return $template;
});


/**
 * Show all Diputados CPT items on archive
 *
 */

add_action( 'pre_get_posts', 'revista_show_all_work' );

function revista_show_all_work( $query ) {
    
    if ( ! is_admin() && $query->is_main_query() ) {
    
        if ( is_post_type_archive( 'diputado' ) ) {
            
            $query->set('posts_per_page', -1 );
    
        }
    }
}


add_filter( 'hf_form_markup', function( $markup ) {
	$email = get_field('email');

	if ($email) {
		$markup .= '<input type="hidden" name="HIDDEN_EMAIL" value="' . $email . '" />';
		return $markup;
	}
	
});