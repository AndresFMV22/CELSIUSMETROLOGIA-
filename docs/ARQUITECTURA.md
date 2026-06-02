# 🏗️ Arquitectura Técnica - Celsius Theme

Documento técnico detallado sobre la arquitectura del tema.

## Visión General

El Celsius Theme es un tema WordPress **Mobile-First** con arquitectura modular, diseñado específicamente para un servidor Windows (IIS/XAMPP).

```
┌─────────────────────────────────────┐
│     WordPress (Base)                │
│  - Posts, Pages, Users              │
└──────────────┬──────────────────────┘
               │
       ┌───────┴────────┐
       │                │
┌──────▼──────┐  ┌──────▼──────┐
│   Tema      │  │   Plugins   │
│ Mobile-First│  │   (Optional)│
└──────┬──────┘  └─────────────┘
       │
   ┌───┴────────────────────┐
   │                        │
┌──▼────┐  ┌──────┐  ┌────▼──┐
│  CSS  │  │ HTML │  │   JS  │
│Glass  │  │Glass │  │ Vanilla│
└───────┘  └──────┘  └───────┘
```

## Stack Tecnológico

### Backend
- **PHP 7.4+** - Lenguaje de servidor
- **WordPress 6.0+** - CMS
- **MySQL/MariaDB** - Base de datos
- **Windows Server / XAMPP** - Servidor

### Frontend
- **HTML5** - Semántico y accesible
- **SCSS/CSS3** - Estilos compilados
- **Vanilla JavaScript** - Sin jQuery ni librerías pesadas
- **Flexbox + CSS Grid** - Layout responsivo

### Herramientas
- **Git + GitHub** - Control de versiones
- **GitHub Actions** - CI/CD
- **FTP Deploy** - Automatización
- **Node.js + npm** - Build tools
- **SASS** - Compilador CSS

## Estructura de Directorios

```
theme-source/
├── assets/
│   ├── css/                          # CSS compilado (salida)
│   │   ├── main.css                  # Estilos compilados y minificados
│   │   ├── editor.css                # Estilos editor WordPress
│   │   └── legacy.css                # Fallback IE11
│   │
│   ├── scss/                         # SCSS fuente (EDITAR)
│   │   ├── main.scss                 # Compilador principal (@import)
│   │   ├── _variables.scss           # Paleta, tipografía, espaciado
│   │   ├── _mobile-first.scss        # Estilos base móvil
│   │   ├── _glasmorphism.scss        # Componentes glass
│   │   └── _animations.scss          # Keyframes y transiciones
│   │
│   ├── js/                           # JavaScript
│   │   ├── main.js                   # Inicialización y utilidades
│   │   ├── interactions.js           # Botones, menú, formularios
│   │   ├── dynamic-bg.js             # Parallax, animaciones scroll
│   │   └── cotizador.js              # Lógica del cotizador
│   │
│   ├── images/
│   │   ├── logo.svg
│   │   ├── icons/                    # Iconos SVG
│   │   └── patterns/                 # Patrones de fondo
│   │
│   └── fonts/
│       ├── inter.woff2
│       └── montserrat.woff2
│
├── includes/                         # Funciones PHP
│   ├── functions.php                 # Funciones principales
│   ├── setup.php                     # Setup del tema
│   ├── scripts.php                   # Encolado CSS/JS
│   ├── components.php                # Componentes reutilizables
│   ├── cotizador.php                 # Lógica cotizador
│   └── portal-clientes.php           # Portal clientes
│
├── templates/                        # Templates WordPress
│   ├── header.php                    # Header + navegación
│   ├── footer.php                    # Footer
│   ├── front-page.php                # Página inicio
│   ├── page-cotizador.php            # Página cotizador
│   ├── page-portal.php               # Página portal
│   ├── page.php                      # Página genérica
│   ├── single.php                    # Post individual
│   └── archive.php                   # Archivo de posts
│
├── functions.php                     # Punto de entrada del tema
├── style.css                         # Metadatos del tema
└── screenshot.png                    # Miniatura del tema (1200x900px)
```

## Flujo de Código

### 1. Carga Inicial (WordPress)

```
WordPress carga:
  ↓
functions.php
  ↓
require_once 'includes/functions.php'
  ↓
require_once 'includes/setup.php'        ← add_theme_support, register menus
  ↓
require_once 'includes/scripts.php'      ← wp_enqueue_style, wp_enqueue_script
```

### 2. Hook del Tema

```
do_action('after_setup_theme')
  ↓
celsius_theme_support()
  └── add_theme_support('post-thumbnails')
  └── add_theme_support('title-tag')
  └── add_theme_support('custom-logo')
```

### 3. Encolado de Estilos

```
wp_enqueue_scripts
  ↓
WordPress carga:
  ├── main.css         (Compilado de main.scss)
  ├── editor.css       (Editor blocks)
  └── legacy.css       (IE11 fallback)
```

### 4. Encolado de Scripts

```
wp_enqueue_scripts
  ↓
WordPress carga:
  ├── main.js          (IIFE + utilidades globales)
  ├── interactions.js  (defer: botones, menú)
  ├── dynamic-bg.js    (defer: parallax, scroll)
  └── cotizador.js     (defer: formulario)

Evento: document.addEventListener('celsius-ready')
  └── Dispara todas las inicializaciones
```

## Compilación SCSS

### Proceso

```
SCSS fuente
  ↓
Compilador Sass
  ↓
  ├── Parsea variables
  ├── Expande @import
  ├── Aplica mixins
  ├── Genera prefijos -webkit-, -moz-
  └── Minifica (elimina espacios)
  ↓
main.css (minificado)
  ↓
Encolado en WordPress
  ↓
Navegador descarga + parsea + renderiza
```

### Tamaño de Archivos

| Archivo | Tamaño | Gzipped |
|---------|--------|---------|
| main.scss | ~15KB | - |
| main.css (compilado) | ~45KB | ~8KB |
| main.css (minificado) | ~42KB | ~7KB |

## Mobile-First Strategy

### Breakpoints

```
┌──────────┬─────────┬────────────┬──────────┐
│  Mobile  │ Tablet  │   Desktop  │   UHD    │
├──────────┼─────────┼────────────┼──────────┤
│ 320-480px│ 481-767 │ 768-1023px │ 1024px+  │
└──────────┴─────────┴────────────┴──────────┘

Defecto: 320px (mobile)
@media (min-width: 481px) { /* tablet */ }
@media (min-width: 1024px) { /* desktop */ }
```

### Tipografía Escalada

```
Mobile (6")    → Desktop
─────────────────────────
H1: 28px       → 42px
H2: 24px       → 32px
Body: 16px     → 18px
Small: 14px    → 16px
```

### Espaciado

```
Escala 8px:
4px, 8px, 16px, 24px, 32px, 48px, 64px

Mobile padding:    16px
Tablet padding:    24px
Desktop padding:   32px+
```

## Glasmorphism Implementación

### CSS Base

```css
.glass {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
  border-radius: 16px;
}
```

### Navegadores Soportados

```
✅ Chrome 76+       (100%)
✅ Firefox 103+     (100%)
✅ Safari 9+        (100%)
✅ Edge 79+         (100%)
⚠️ IE 11            (Fallback opaco)
```

### Performance

```
GPU aceleration: Sí (backdrop-filter usa GPU)
will-change:     backdrop-filter
FPS objetivo:    60fps
```

## JavaScript Modular

### Estructura IIFE

```javascript
(function() {
  'use strict';
  
  // Variables locales (no contamina global)
  const data = {};
  
  // Funciones privadas
  function privateFunc() { }
  
  // Funciones públicas en window
  window.publicFunc = function() { }
  
  // Inicialización
  document.addEventListener('DOMContentLoaded', init);
})();
```

### Event System

```
celsius-ready
  ├── Dispara después de DOM listo
  ├── inicializa interactions
  ├── inicializa dynamic-bg
  └── inicializa cotizador

document.addEventListener('celsius-ready', () => {
  console.log('Sistema listo');
});
```

### AJAX Helper

```javascript
window.celsiusAjax('action_name', {
  param1: 'value',
  param2: 'value'
}).then(response => {
  if (response.success) {
    console.log(response.data);
  }
});
```

## WordPress Hooks Utilizados

### Filters

```php
body_class          → Agrega clases personalizadas al body
the_excerpt         → Formatea excerpt con div
wp_link_pages_args  → Personaliza links de paginación
get_search_form     → Formulario búsqueda glasmorphic
```

### Actions

```php
after_setup_theme   → Setup inicial del tema
wp_enqueue_scripts  → Encolado de CSS/JS
init                → Registra post types, menus
wp_head             → Agrega meta tags, preconnect
wp_body_open        → Analytics, conversión
wp_footer           → Scripts al pie
```

## AJAX Endpoints

### Cotizador

```
URL: /wp-admin/admin-ajax.php
Action: celsius_cotizador
Método: POST
Parámetros:
  - magnitud (string)
  - cantidad (int)
  - email (email)
  - telefono (string)
  - archivo (file)
```

**Respuesta exitosa:**
```json
{
  "success": true,
  "data": {
    "message": "Cotización enviada",
    "post_id": 123
  }
}
```

## SEO Optimizaciones

### Meta Tags

```html
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="...">
<meta name="theme-color" content="#0052CC">
```

### Schema.org

```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Celsius S.A.S.",
  "image": "https://...",
  "description": "Metrología...",
  "address": { }
}
```

### Canonical Tag

```html
<link rel="canonical" href="https://www.celsiusmetrologia.com">
```

## Performance Metrics

### Objetivo

```
LCP: < 2.5s       (Largest Contentful Paint)
FID: < 100ms      (First Input Delay)
CLS: < 0.1        (Cumulative Layout Shift)
```

### Optimizaciones

```
Critical CSS:       Inline en <head>
Lazy loading:       loading="lazy"
Preconnect:         Fuentes, CDNs
Prefetch:           Recursos secundarios
```

## Seguridad

### Nonces WordPress

```php
wp_nonce_field('action', 'nonce_field');
check_ajax_referer('action');
```

### Sanitización

```php
sanitize_text_field()
sanitize_email()
wp_kses_post()
```

### Escapado

```php
esc_html()
esc_attr()
esc_url()
esc_js()
```

## Accesibilidad (WCAG 2.1 AA)

### Elementos

```html
<a href="#main" class="skip-to-main">...</a>
<button aria-expanded="false" aria-controls="menu">
<img alt="Descripción">
<label for="input">
```

### Keyboard Navigation

```
Tab      → Navegar elementos
Enter    → Activar botones
Escape   → Cerrar menú/modal
Arrow    → Navegar en menú
```

## Testing Recomendado

### Navegadores

```
Chrome 90+      (Desktop + Mobile)
Firefox 88+     (Desktop + Mobile)
Safari 14+      (Desktop + iOS)
Edge 90+        (Desktop)
```

### Dispositivos

```
iPhone 12       (6.1")
Samsung S21     (6.2")
iPad Pro        (12.9")
Desktop 1920x1080
```

---

**Última actualización:** Junio 2, 2026  
**Versión:** 1.0.0
