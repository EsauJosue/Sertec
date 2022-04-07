<?php
/* Setup */
function sertec_setup(){
/* Let WordPress manage the document title */
add_theme_support('title-tag');

/*Register location of menus*/
register_nav_menus(array(
	'catalogo' => __('Catalogo Menu Slide','sertec'),
	
));
}
add_theme_support('post-thumbnails');
// add_action('after_setup_theme','sertec_setup');
/*Add styles*/
    function sertec_enqueue_style(){
        wp_enqueue_style('style-local', get_template_directory_uri().'/style.css');
        // wp_enqueue_style('style-mobile', get_template_directory_uri() . '/assets/css/mobile.css', array(), '1.0', 'all and (min-width: 320px)');
        wp_enqueue_style('style-tablet', get_template_directory_uri() . '/assets/css/tablet.css', array(), '1.0', 'all and (min-width: 768px)');
        wp_enqueue_style('style-desktop', get_template_directory_uri() . '/assets/css/desktop.css', array(), '1.0', 'all and (min-width: 1110px)');
/* 		wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/fontawesome.min.css');
        wp_enqueue_style('Animation', get_template_directory_uri().'/assets/css/animationElements.css'); */
    	wp_enqueue_style('Bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css');		 	
    }add_action( 'wp_enqueue_scripts', 'sertec_enqueue_style');
    /*Add Scripts*/
 	function sertec_scripts() {
 		wp_enqueue_script( 'script-jquery', get_template_directory_uri() . '/assets/js/jquery.js');
		wp_enqueue_script( 'script-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js');
        //  wp_enqueue_script( 'script-arriba', get_template_directory_uri() . '/assets/js/arriba.js');
		 
 	}
 	add_action( 'wp_enqueue_scripts', 'sertec_scripts' );

/*Agregar diferentes single.php para diferentes categorias*/
function wpse_category_single_template( $single_template ) {
    global $post;
    $all_cats = get_the_category();

    if ( $all_cats[0]->cat_ID == '794' ) {
        if ( file_exists(get_template_directory() . "/single-blog.php") ) return get_template_directory() . "/single-blog.php";
    } elseif ( $all_cats[0]->cat_ID == '' ) {
        if ( file_exists(get_template_directory() . "/single.php") ) return get_template_directory() . "/single.php";
    }
    return $single_template;
}
add_filter( 'single_template', 'wpse_category_single_template' );
/* Activar el uso de widgets*/

if(function_exists('register_sidebar')){
	/*register_sidebar(
	 array(
	 	'name'          => __('Links','FertyCareTheme'),
		'before_widget' => '',
 		'after_widget' => ''
	  ) );*/
	/* register_sidebar(
	array(
	'name'          => __('Search','jmcsoluciones' ),
	'before_widget' => '',
	'after_widget'  => ''
   		)); */


	/*register_sidebar(
	array(
	'name'          => __('Recientes','sertec' ),
    'cat' => 7,
	'before_widget' => '<aside class="widget electro_recent_posts_widget">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title"><strong>',
	'after_title'   => '</strong></h3>',

    ));*/
       }

       /* function dmc_add_svg_mime_types($mimes) {
        if ( current_user_can('jmc_user') ){
            $mimes['svg'] = 'assets/images/svg+xml';	
        }
        return $mimes;
    }
    add_filter('upload_mimes', 'dmc_add_svg_mime_types'); */
// Remove the version number from Javascript & CSS files that are
// enqueued using either `wp_enqueue_script()` or `wp_enqueue_style()`
function microdot_remove_scripts_styles_version( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
// Remove the version from enqueued stylesheets (CSS)
add_filter( 'style_loader_src', 'microdot_remove_scripts_styles_version', 9999 );

// Remove the version from enqueued javascript files
add_filter( 'script_loader_src', 'microdot_remove_scripts_styles_version', 9999 );
?>
