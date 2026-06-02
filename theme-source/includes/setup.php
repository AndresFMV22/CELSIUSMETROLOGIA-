<?php
/**
 * Celsius S.A.S. - Mobile-First Theme
 * Setup y Configuración Base
 * 
 * @package celsius-theme-mobilefirst
 * @version 1.0.0
 */

// Prevenir acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ============================================
 * SOPORTE DE CARACTERÍSTICAS DEL TEMA
 * ============================================
 */
function celsius_theme_support() {
    // Permitir featured images
    add_theme_support( 'post-thumbnails' );
    
    // Soporte de HTML5 en forms y markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );
    
    // Soporte de títulos de sitio dinámicos
    add_theme_support( 'title-tag' );
    
    // Soporte de logo personalizado
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    
    // Soporte de colores personalizados
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => __( 'Azul Principal', 'celsius' ),
            'slug'  => 'blue-primary',
            'color' => '#0052CC',
        ),
        array(
            'name'  => __( 'Cyan Acento', 'celsius' ),
            'slug'  => 'cyan-accent',
            'color' => '#00D9FF',
        ),
        array(
            'name'  => __( 'Verde Éxito', 'celsius' ),
            'slug'  => 'green-success',
            'color' => '#00A651',
        ),
        array(
            'name'  => __( 'Gris Claro', 'celsius' ),
            'slug'  => 'gray-light',
            'color' => '#F5F6F7',
        ),
        array(
            'name'  => __( 'Texto Oscuro', 'celsius' ),
            'slug'  => 'text-dark',
            'color' => '#1A1A1A',
        ),
    ) );
    
    // Soporte de bloques personalizados
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'celsius_theme_support' );

/**
 * ============================================
 * REGISTRAR MENUS
 * ============================================
 */
function celsius_register_menus() {
    register_nav_menus( array(
        'primary'   => __( 'Menú Principal', 'celsius' ),
        'secondary' => __( 'Menú Secundario', 'celsius' ),
        'footer'    => __( 'Menú Pie de Página', 'celsius' ),
    ) );
}
add_action( 'init', 'celsius_register_menus' );

/**
 * ============================================
 * REGISTRAR ÁREAS DE WIDGETS
 * ============================================
 */
function celsius_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Barra Lateral Principal', 'celsius' ),
        'id'            => 'primary-sidebar',
        'description'   => __( 'Widgets en la barra lateral principal', 'celsius' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s glass-card">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Pie de Página', 'celsius' ),
        'id'            => 'footer-widget',
        'description'   => __( 'Widgets en el pie de página', 'celsius' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'celsius_widgets_init' );

/**
 * ============================================
 * TAMAÑOS DE IMÁGENES PERSONALIZADOS
 * ============================================
 */
function celsius_custom_image_sizes() {
    // Para hero sections
    add_image_size( 'celsius-hero', 1200, 600, true );
    
    // Para tarjetas
    add_image_size( 'celsius-card', 400, 300, true );
    
    // Para thumbnails
    add_image_size( 'celsius-thumb', 200, 200, true );
}
add_action( 'after_setup_theme', 'celsius_custom_image_sizes' );

/**
 * ============================================
 * REMOVER EMOJIS (Optimización)
 * ============================================
 */
function celsius_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'celsius_disable_emojis' );

/**
 * ============================================
 * PERMITIR SUBIDA DE ARCHIVOS (PDF, Excel)
 * ============================================
 */
function celsius_custom_mime_types( $mimes ) {
    $mimes['xlsx'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    $mimes['xls']  = 'application/vnd.ms-excel';
    $mimes['csv']  = 'text/csv';
    return $mimes;
}
add_filter( 'upload_mimes', 'celsius_custom_mime_types' );

/**
 * ============================================
 * AJUSTES DE SEGURIDAD
 * ============================================
 */
function celsius_security_headers() {
    // Header para prevenir XSS
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
}
add_action( 'send_headers', 'celsius_security_headers' );

/**
 * ============================================
 * BODY CLASS PERSONALIZADO
 * ============================================
 */
function celsius_body_class( $classes ) {
    // Agregar clase si es móvil
    if ( wp_is_mobile() ) {
        $classes[] = 'is-mobile';
    }
    
    // Agregar clase si es front page
    if ( is_front_page() ) {
        $classes[] = 'is-front-page';
    }
    
    return $classes;
}
add_filter( 'body_class', 'celsius_body_class' );
