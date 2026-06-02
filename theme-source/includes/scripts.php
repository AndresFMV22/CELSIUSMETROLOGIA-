<?php
/**
 * Celsius S.A.S. - Mobile-First Theme
 * Encolado de CSS y JavaScript
 * 
 * @package celsius-theme-mobilefirst
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * ============================================
 * ENCOLADO DE ESTILOS
 * ============================================
 */
function celsius_enqueue_styles() {
    // Meta viewport (asegurar responsive)
    wp_enqueue_meta( 'viewport' );
    
    // Estilos principales compilados de SCSS
    wp_enqueue_style(
        'celsius-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/main.css' ),
        'all'
    );
    
    // Estilos del editor de WordPress
    wp_enqueue_style(
        'celsius-editor',
        get_template_directory_uri() . '/assets/css/editor.css',
        array( 'celsius-main' ),
        filemtime( get_template_directory() . '/assets/css/editor.css' ),
        'all'
    );
    
    // Soporte para navegadores antiguos (IE11)
    wp_enqueue_style(
        'celsius-legacy',
        get_template_directory_uri() . '/assets/css/legacy.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/legacy.css' )
    );
}
add_action( 'wp_enqueue_scripts', 'celsius_enqueue_styles' );

/**
 * ============================================
 * ENCOLADO DE SCRIPTS
 * ============================================
 */
function celsius_enqueue_scripts() {
    // JavaScript principal
    wp_enqueue_script(
        'celsius-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/main.js' ),
        true // En footer
    );
    
    // JavaScript de interacciones
    wp_enqueue_script(
        'celsius-interactions',
        get_template_directory_uri() . '/assets/js/interactions.js',
        array( 'celsius-main' ),
        filemtime( get_template_directory() . '/assets/js/interactions.js' ),
        true
    );
    
    // JavaScript de fondo dinámico
    wp_enqueue_script(
        'celsius-dynamic-bg',
        get_template_directory_uri() . '/assets/js/dynamic-bg.js',
        array( 'celsius-main' ),
        filemtime( get_template_directory() . '/assets/js/dynamic-bg.js' ),
        true
    );
    
    // Cotizador si estamos en esa página
    if ( is_page_template( 'templates/page-cotizador.php' ) ) {
        wp_enqueue_script(
            'celsius-cotizador',
            get_template_directory_uri() . '/assets/js/cotizador.js',
            array( 'celsius-main' ),
            filemtime( get_template_directory() . '/assets/js/cotizador.js' ),
            true
        );
    }
    
    // Pasar variables PHP a JavaScript
    wp_localize_script( 'celsius-main', 'celsiusData', array(
        'ajaxurl'       => admin_url( 'admin-ajax.php' ),
        'nonce'         => wp_create_nonce( 'celsius_nonce' ),
        'homeUrl'       => home_url(),
        'isMobile'      => wp_is_mobile(),
        'themeUrl'      => get_template_directory_uri(),
    ) );
    
    // Remover jquery si no se necesita
    wp_deregister_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'celsius_enqueue_scripts' );

/**
 * ============================================
 * ENCOLADO DE ESTILOS DEL EDITOR
 * ============================================
 */
function celsius_enqueue_editor_styles() {
    // Estilos para el editor de bloques
    add_editor_style( get_template_directory_uri() . '/assets/css/editor.css' );
    
    // Configurar ancho máximo del editor
    add_theme_support( 'editor-max-width', 800 );
}
add_action( 'admin_init', 'celsius_enqueue_editor_styles' );

/**
 * ============================================
 * CRITICAL CSS (Optimización)
 * ============================================
 */
function celsius_critical_css() {
    // CSS crítico inline para mejorar LCP (Largest Contentful Paint)
    ?>
    <style>
        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
        }
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            color: #1A1A1A;
            background: #FFFFFF;
        }
        * {
            box-sizing: border-box;
        }
    </style>
    <?php
}
add_action( 'wp_head', 'celsius_critical_css', 1 );

/**
 * ============================================
 * PRECONNECT A FUENTES EXTERNAS
 * ============================================
 */
function celsius_preconnect() {
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php
}
add_action( 'wp_head', 'celsius_preconnect', 5 );

/**
 * ============================================
 * REMOVER SCRIPTS/ESTILOS NO NECESARIOS
 * ============================================
 */
function celsius_remove_unnecessary() {
    // Remover wp-embed
    wp_deregister_script( 'wp-embed' );
    
    // Remover css de bloques de WordPress si no se necesita
    wp_deregister_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'celsius_remove_unnecessary' );

/**
 * ============================================
 * ASYNC/DEFER PARA SCRIPTS
 * ============================================
 */
function celsius_script_attributes( $tag, $handle, $src ) {
    // Scripts que no necesitan cargar inmediatamente
    $defer_scripts = array( 'celsius-interactions', 'celsius-dynamic-bg' );
    
    if ( in_array( $handle, $defer_scripts, true ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    
    return $tag;
}
add_filter( 'script_loader_tag', 'celsius_script_attributes', 10, 3 );

/**
 * ============================================
 * OPTIMIZAR LOADING DE IMAGES
 * ============================================
 */
function celsius_lazy_loading( $html, $post_id ) {
    // Agregar loading="lazy" a imágenes
    $html = str_replace( '<img ', '<img loading="lazy" ', $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'celsius_lazy_loading', 10, 2 );

/**
 * ============================================
 * ENQUEUE GOOGLE FONTS (Optimizado)
 * ============================================
 */
function celsius_google_fonts() {
    // Cargar fonts directamente en el head (ya está en SCSS @import)
    // Esto es un backup si necesitas cargarlas por separado
}
add_action( 'wp_head', 'celsius_google_fonts', 8 );
