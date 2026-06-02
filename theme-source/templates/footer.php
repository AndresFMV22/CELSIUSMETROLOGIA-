    </main>

    <!-- FOOTER GLASMORPHIC -->
    <footer class="footer-main glass-effect" role="contentinfo">
        <div class="footer-container">
            <!-- Footer Widgets - 3 Columnas -->
            <div class="footer-widgets">
                <div class="footer-column">
                    <?php
                    if ( is_active_sidebar( 'footer-1' ) ) {
                        dynamic_sidebar( 'footer-1' );
                    } else {
                        echo '<h3>' . esc_html__( 'Sobre Nosotros', 'celsius' ) . '</h3>';
                        echo '<p>' . esc_html__( 'Celsius S.A.S. - Soluciones de Metrología e Ingeniería Biomédica desde 1995', 'celsius' ) . '</p>';
                    }
                    ?>
                </div>

                <div class="footer-column">
                    <?php
                    if ( is_active_sidebar( 'footer-2' ) ) {
                        dynamic_sidebar( 'footer-2' );
                    } else {
                        echo '<h3>' . esc_html__( 'Enlaces Útiles', 'celsius' ) . '</h3>';
                        echo '<ul>';
                        echo '<li><a href="' . esc_url( home_url( '/servicios' ) ) . '">' . esc_html__( 'Servicios', 'celsius' ) . '</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/magnitudes' ) ) . '">' . esc_html__( 'Magnitudes', 'celsius' ) . '</a></li>';
                        echo '<li><a href="' . esc_url( home_url( '/contacto' ) ) . '">' . esc_html__( 'Contacto', 'celsius' ) . '</a></li>';
                        echo '</ul>';
                    }
                    ?>
                </div>

                <div class="footer-column">
                    <?php
                    if ( is_active_sidebar( 'footer-3' ) ) {
                        dynamic_sidebar( 'footer-3' );
                    } else {
                        echo '<h3>' . esc_html__( 'Contacto', 'celsius' ) . '</h3>';
                        echo '<p>';
                        echo '<strong>' . esc_html__( 'Teléfono:', 'celsius' ) . '</strong> +57 (1) 1234567<br>';
                        echo '<strong>' . esc_html__( 'Email:', 'celsius' ) . '</strong> info@celsiusmetrologia.com<br>';
                        echo '<strong>' . esc_html__( 'Dirección:', 'celsius' ) . '</strong> Bogotá, Colombia';
                        echo '</p>';
                    }
                    ?>
                </div>
            </div>

            <!-- Footer Bottom - Copyright & Links -->
            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <strong><?php bloginfo( 'name' ); ?></strong>. <?php esc_html_e( 'Todos los derechos reservados.', 'celsius' ); ?></p>
                </div>

                <div class="footer-links">
                    <a href="<?php echo esc_url( home_url( '/politica-privacidad' ) ); ?>"><?php esc_html_e( 'Política de Privacidad', 'celsius' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/terminos-condiciones' ) ); ?>"><?php esc_html_e( 'Términos y Condiciones', 'celsius' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/sitemap' ) ); ?>"><?php esc_html_e( 'Mapa del Sitio', 'celsius' ); ?></a>
                </div>

                <div class="footer-brand">
                    <p><?php esc_html_e( 'Diseño Mobile-First con Glasmorphism | Tema Celsius v1.0', 'celsius' ); ?></p>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
