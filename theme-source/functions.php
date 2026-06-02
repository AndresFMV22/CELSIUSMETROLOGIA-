<?php
/**
 * Celsius Theme - Mobile-First WordPress Functions
 * Tema personalizado para Celsius S.A.S. - Metrología e Ingeniería Biomédica
 * Arquitectura: Mobile-First Extremo con Glasmorphism
 */

// ============================================================================
// 1. SETUP INICIAL DEL TEMA
// ============================================================================

function celsius_theme_setup() {
    // Agregar soporte para características de WordPress
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );
    
    // Registrar menús
    register_nav_menus( array(
        'primary' => esc_html__( 'Menú Principal', 'celsius' ),
        'footer'  => esc_html__( 'Menú Footer', 'celsius' ),
    ) );
}
add_action( 'after_setup_theme', 'celsius_theme_setup' );

// ============================================================================
// 2. ENCOLADO DE ESTILOS Y SCRIPTS
// ============================================================================

require_once get_template_directory() . '/includes/scripts.php';

// ============================================================================
// 3. CONFIGURACIÓN DE WIDGETS
// ============================================================================

function celsius_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Principal', 'celsius' ),
        'id'            => 'primary-sidebar',
        'description'   => esc_html__( 'Widget area principal', 'celsius' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Area 1', 'celsius' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Primera columna del footer', 'celsius' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Area 2', 'celsius' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Segunda columna del footer', 'celsius' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Area 3', 'celsius' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Tercera columna del footer', 'celsius' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'celsius_widgets_init' );

// ============================================================================
// 4. CUSTOM POST TYPES - Servicios y Certificados
// ============================================================================

function celsius_register_post_types() {
    // Post Type: Servicios de Metrología
    register_post_type( 'servicio', array(
        'labels'       => array(
            'name'          => esc_html__( 'Servicios', 'celsius' ),
            'singular_name' => esc_html__( 'Servicio', 'celsius' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'    => 'dashicons-wrench',
        'rewrite'      => array( 'slug' => 'servicios' ),
    ) );

    // Post Type: Certificados (Solo para admin)
    register_post_type( 'certificado', array(
        'labels'       => array(
            'name'          => esc_html__( 'Certificados', 'celsius' ),
            'singular_name' => esc_html__( 'Certificado', 'celsius' ),
        ),
        'public'       => false,
        'has_archive'  => false,
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'    => 'dashicons-media-document',
        'capability_type' => 'post',
    ) );
}
add_action( 'init', 'celsius_register_post_types' );

// ============================================================================
// 5. TAXONOMÍAS PERSONALIZADAS
// ============================================================================

function celsius_register_taxonomies() {
    // Taxonomía: Magnitudes de Medición
    register_taxonomy( 'magnitud', 'servicio', array(
        'labels'       => array(
            'name'          => esc_html__( 'Magnitudes', 'celsius' ),
            'singular_name' => esc_html__( 'Magnitud', 'celsius' ),
        ),
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'magnitudes' ),
    ) );

    // Taxonomía: Industrias
    register_taxonomy( 'industria', 'servicio', array(
        'labels'       => array(
            'name'          => esc_html__( 'Industrias', 'celsius' ),
            'singular_name' => esc_html__( 'Industria', 'celsius' ),
        ),
        'hierarchical' => true,
        'rewrite'      => array( 'slug' => 'industrias' ),
    ) );
}
add_action( 'init', 'celsius_register_taxonomies' );

// ============================================================================
// 6. METABOXES PARA SERVICIOS
// ============================================================================

function celsius_add_service_metabox() {
    add_meta_box(
        'servicio_detalles',
        esc_html__( 'Detalles Técnicos del Servicio', 'celsius' ),
        'celsius_render_service_metabox',
        'servicio',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'celsius_add_service_metabox' );

function celsius_render_service_metabox( $post ) {
    $rango_minimo = get_post_meta( $post->ID, '_rango_minimo', true );
    $rango_maximo = get_post_meta( $post->ID, '_rango_maximo', true );
    $incertidumbre = get_post_meta( $post->ID, '_incertidumbre', true );
    $unidad = get_post_meta( $post->ID, '_unidad', true );
    
    wp_nonce_field( 'celsius_service_nonce_action', 'celsius_service_nonce' );
    ?>
    <div class="celsius-metabox">
        <p>
            <label for="rango_minimo"><?php esc_html_e( 'Rango Mínimo:', 'celsius' ); ?></label>
            <input type="number" id="rango_minimo" name="rango_minimo" value="<?php echo esc_attr( $rango_minimo ); ?>" step="0.01" />
        </p>
        <p>
            <label for="rango_maximo"><?php esc_html_e( 'Rango Máximo:', 'celsius' ); ?></label>
            <input type="number" id="rango_maximo" name="rango_maximo" value="<?php echo esc_attr( $rango_maximo ); ?>" step="0.01" />
        </p>
        <p>
            <label for="incertidumbre"><?php esc_html_e( 'Incertidumbre (%):', 'celsius' ); ?></label>
            <input type="number" id="incertidumbre" name="incertidumbre" value="<?php echo esc_attr( $incertidumbre ); ?>" step="0.01" />
        </p>
        <p>
            <label for="unidad"><?php esc_html_e( 'Unidad de Medida:', 'celsius' ); ?></label>
            <input type="text" id="unidad" name="unidad" value="<?php echo esc_attr( $unidad ); ?>" placeholder="ej: °C, Pa, kg" />
        </p>
    </div>
    <?php
}

function celsius_save_service_metabox( $post_id ) {
    if ( ! isset( $_POST['celsius_service_nonce'] ) || ! wp_verify_nonce( $_POST['celsius_service_nonce'], 'celsius_service_nonce_action' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    foreach ( array( 'rango_minimo', 'rango_maximo', 'incertidumbre', 'unidad' ) as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
}
add_action( 'save_post', 'celsius_save_service_metabox' );

// ============================================================================
// 7. SISTEMA DE COTIZADOR - AJAX
// ============================================================================

function celsius_cotizador_ajax() {
    check_ajax_referer( 'celsius_cotizador_nonce', 'nonce' );

    $magnitud = isset( $_POST['magnitud'] ) ? sanitize_text_field( $_POST['magnitud'] ) : '';
    $cantidad = isset( $_POST['cantidad'] ) ? intval( $_POST['cantidad'] ) : 0;

    // Simular cálculo de cotización (en producción, conectar a BD)
    $precio_base = 500000; // COP
    $total = $precio_base * $cantidad;
    $iva = $total * 0.19;
    $total_con_iva = $total + $iva;

    wp_send_json_success( array(
        'magnitud'        => $magnitud,
        'cantidad'        => $cantidad,
        'precio_unitario' => $precio_base,
        'subtotal'        => $total,
        'iva'             => $iva,
        'total'           => $total_con_iva,
    ) );
}
add_action( 'wp_ajax_celsius_cotizador', 'celsius_cotizador_ajax' );
add_action( 'wp_ajax_nopriv_celsius_cotizador', 'celsius_cotizador_ajax' );

// ============================================================================
// 8. PORTAL DE CLIENTES - AUTENTICACIÓN PERSONALIZADA
// ============================================================================

function celsius_client_login_redirect( $redirect_to, $requested_redirect_to, $user ) {
    if ( ! is_wp_error( $user ) ) {
        // Redirigir a clientes al portal de descargas
        if ( in_array( 'cliente', (array) $user->roles ) ) {
            return home_url( '/portal-cliente/descargas' );
        }
        // Redirigir a admin al dashboard
        if ( in_array( 'administrator', (array) $user->roles ) ) {
            return admin_url();
        }
    }
    return $redirect_to;
}
add_filter( 'login_redirect', 'celsius_client_login_redirect', 10, 3 );

// ============================================================================
// 9. FILTRO DE SEGURIDAD - Case-Insensitive para Assets
// ============================================================================

function celsius_fix_asset_paths( $html, $handle, $src ) {
    // Convertir rutas de assets a minúsculas para Windows compatibility
    if ( defined( 'PHP_OS_FAMILY' ) && 'Windows' === PHP_OS_FAMILY ) {
        $src = strtolower( $src );
    }
    return $html;
}
add_filter( 'script_loader_src', 'celsius_fix_asset_paths', 10, 3 );
add_filter( 'style_loader_src', 'celsius_fix_asset_paths', 10, 3 );

// ============================================================================
// 10. SOPORTE PARA FORMULARIOS GRAVITY FORMS
// ============================================================================

function celsius_gravity_forms_init() {
    // Si Gravity Forms está instalado, cargar configuración personalizada
    if ( class_exists( 'GFForms' ) ) {
        // Aquí irían las configuraciones del cotizador
        add_filter( 'gform_field_value_magnitudes', function() {
            return array(
                'Masa',
                'Presión',
                'Temperatura',
                'Volumen',
                'Humedad',
                'Longitud',
                'Biomédica',
            );
        });
    }
}
add_action( 'wp_loaded', 'celsius_gravity_forms_init' );

// ============================================================================
// 11. HELPERS Y FUNCIONES UTILITARIAS
// ============================================================================

/**
 * Obtener URL del tema con soporte para Windows
 */
function celsius_get_template_url() {
    $url = get_template_directory_uri();
    if ( defined( 'PHP_OS_FAMILY' ) && 'Windows' === PHP_OS_FAMILY ) {
        $url = strtolower( $url );
    }
    return $url;
}

/**
 * Obtener ruta del tema con soporte para Windows
 */
function celsius_get_template_path() {
    $path = get_template_directory();
    if ( defined( 'PHP_OS_FAMILY' ) && 'Windows' === PHP_OS_FAMILY ) {
        $path = strtolower( $path );
    }
    return $path;
}

/**
 * Formatear precio en COP
 */
function celsius_format_price( $price ) {
    return '$' . number_format( $price, 0, ',', '.' ) . ' COP';
}

/**
 * Generar tabla responsiva de magnitudes
 */
function celsius_get_magnitudes_table() {
    $magnitudes = array(
        array(
            'nombre' => 'Temperatura',
            'rango'  => '-50 a 150 °C',
            'incertidumbre' => '±0.05 °C',
        ),
        array(
            'nombre' => 'Presión',
            'rango'  => '0 a 1000 bar',
            'incertidumbre' => '±0.1 bar',
        ),
        array(
            'nombre' => 'Masa',
            'rango'  => '1 g a 500 kg',
            'incertidumbre' => '±0.01%',
        ),
        array(
            'nombre' => 'Longitud',
            'rango'  => '0 a 2000 mm',
            'incertidumbre' => '±0.05 mm',
        ),
    );
    
    return $magnitudes;
}

// ============================================================================
// 12. ELIMINACIÓN SEGURA DE VERSIONES WORDPRESS
// ============================================================================

function celsius_remove_wp_version() {
    remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'celsius_remove_wp_version' );

// ============================================================================
// 13. PERMITIR SUBIDA DE ARCHIVOS INDUSTRIALES
// ============================================================================

function celsius_custom_upload_mimes( $mimes ) {
    $mimes['pdf']  = 'application/pdf';
    $mimes['xlsx'] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    $mimes['xls']  = 'application/vnd.ms-excel';
    return $mimes;
}
add_filter( 'upload_mimes', 'celsius_custom_upload_mimes' );

// ============================================================================
// FIN DEL ARCHIVO
// ============================================================================
?>
