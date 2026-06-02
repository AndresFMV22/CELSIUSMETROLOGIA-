# 🏭 Celsius S.A.S. - Rediseño Mobile-First

**Metrología e Ingeniería Biomédica | Sitio Web Moderno con Glassmorphism**

---

##  Tabla de Contenidos

1. [Descripción General](#descripción-general)
2. [Arquitectura del Proyecto](#arquitectura-del-proyecto)
3. [Stack Tecnológico](#stack-tecnológico)
4. [Configuración Inicial](#configuración-inicial)
5. [Estructura Mobile-First](#estructura-mobile-first)
6. [Componentes Principales](#componentes-principales)
7. [Despliegue Automatizado CI/CD](#despliegue-automatizado-cicd)
8. [Guía de Lanzamiento (El Cambiazo)](#guía-de-lanzamiento-el-cambiazo)
9. [Cómo Hacer Cambios y Verlos Reflejados](#cómo-hacer-cambios-y-verlos-reflejados)
10. [Troubleshooting](#troubleshooting)

---

##  Descripción General

Este proyecto implementa un rediseño total del sitio web de **Celsius S.A.S.**, con enfoque extremo en **Mobile-First**, glassmorphism de clase Apple, y funcionalidades industriales avanzadas:

✅ **Diseño Responsivo Radical**: Optimizado primero para móviles (320px), escalable a desktop  
✅ **Glassmorphism Moderno**: Efectos visuales premium con bordes translúcidos y fondos desenfocados  
✅ **Interactividad Completa**: Botones animados, fondos dinámicos que responden al scroll  
✅ **Portal de Clientes**: Descarga segura de certificados de calibración PDF  
✅ **Cotizador Técnico**: Formulario condicional para magnitudes físicas y biomédicas  
✅ **Tablas Responsivas**: Scroll horizontal nativo en móviles con indicadores visuales  
✅ **CI/CD Automatizado**: GitHub Actions para despliegue automático a servidor Windows IIS/XAMPP  

---

##  Arquitectura del Proyecto

```
CELSIUSMETROLOGIA-/
│
├── .github/
│   └── workflows/
│       └── deploy.yml                    # GitHub Actions - CI/CD
│
├── theme-source/                         # Tema WordPress personalizado
│   ├── assets/
│   │   ├── css/
│   │   │   ├── main.css                  # Estilos Mobile-First compilados
│   │   │   ├── glasmorphism.css          # Componentes glasmorphism
│   │   │   ├── responsive.css            # Media queries
│   │   │   └── animations.css            # Animaciones interactivas
│   │   ├── scss/
│   │   │   ├── main.scss                 # SCSS principal
│   │   │   ├── _variables.scss           # Variables de diseño
│   │   │   ├── _mobile-first.scss        # Estilos móviles
│   │   │   ├── _glasmorphism.scss        # Efecto glass
│   │   │   └── _animations.scss          # Keyframes
│   │   ├── js/
│   │   │   ├── main.js                   # JavaScript principal
│   │   │   ├── interactions.js           # Interactividades
│   │   │   ├── cotizador.js              # Lógica cotizador
│   │   │   └── dynamic-bg.js             # Fondo dinámico
│   │   ├── images/
│   │   │   ├── logo.svg
│   │   │   ├── icons/
│   │   │   └── patterns/
│   │   └── fonts/
│   │       ├── inter.woff2
│   │       └── montserrat.woff2
│   │
│   ├── includes/
│   │   ├── functions.php                 # Hook y funciones del tema
│   │   ├── setup.php                     # Configuración básica
│   │   ├── scripts.php                   # Enqueue de CSS/JS
│   │   ├── components.php                # Funciones de componentes
│   │   ├── cotizador.php                 # Lógica del cotizador
│   │   ├── portal-clientes.php           # Portal de descargas
│   │   └── tabla-responsiva.php          # Tablas dinámicas
│   │
│   ├── templates/
│   │   ├── header.php                    # Encabezado
│   │   ├── footer.php                    # Pie de página
│   │   ├── front-page.php                # Página de inicio
│   │   ├── page-cotizador.php            # Página cotizador
│   │   ├── page-portal.php               # Página portal clientes
│   │   └── magnitudes.php                # Página de magnitudes
│   │
│   ├── style.css                         # Metadatos del tema
│   ├── functions.php                     # Punto de entrada
│   └── screenshot.png                    # Miniatura del tema
│
├── config/
│   ├── ftp-config.example.json           # Ejemplo de configuración FTP
│   └── wp-config-subdirectory.php        # Config para subdirectorio
│
├── docs/
│   ├── INSTALACION.md                    # Guía de instalación
│   ├── ARQUITECTURA.md                   # Detalles arquitectónicos
│   ├── GLASMORPHISM.md                   # Guía de glasmorphism
│   └── DESPLIEGUE.md                     # Guía de despliegue
│
├── scripts/
│   ├── setup.sh                          # Script de setup (Linux/Mac)
│   ├── setup.bat                         # Script de setup (Windows)
│   └── build-css.js                      # Builder SCSS
│
├── .github/workflows/
│   └── deploy.yml                        # Flujo CI/CD
│
├── package.json                          # Dependencias Node.js
├── scss-compile.config.json              # Config SCSS
└── README.md                             # Este archivo
```

---

## 💻 Stack Tecnológico

| Componente | Tecnología | Justificación |
|---|---|---|
| **CMS** | WordPress 6.4+ | Flexibilidad y ecosistema robusto |
| **Tema** | Custom Theme (Child Theme compatible) | Control total, performance |
| **Estilos** | SCSS + CSS3 | Mobile-First, variables, mixins |
| **JS** | Vanilla JS + GSAP (opcional) | Sin dependencias pesadas, animaciones fluidas |
| **Fuentes** | Inter + Montserrat | Legibilidad extrema en 6" |
| **Diseño** | Glasmorphism (CSS backdrop-filter) | Moderno, profesional, premium |
| **Responsivo** | Flexbox + CSS Grid | Flexible, sin Bootstrap pesado |
| **Servidor** | Windows (IIS/XAMPP) | Requisito de producción |
| **CI/CD** | GitHub Actions + FTP Deploy | Despliegue automático |
| **Control Versión** | Git + GitHub | Colaboración y documentación |

---

## ⚙️ Configuración Inicial

### Requisitos Previos

- **WordPress 6.0+** instalado en `C:\inetpub\wwwroot` o `C:\xampp\htdocs`
- **Node.js 16+** (opcional, para compilación SCSS)
- **Cliente FTP/SFTP** o credenciales para servidor Windows
- **Git** instalado en máquina local

### 1. Clonar el Repositorio

```bash
git clone https://github.com/AndresFMV22/CELSIUSMETROLOGIA-.git
cd CELSIUSMETROLOGIA-
```

### 2. Instalar Dependencias (Opcional)

```bash
npm install
```

### 3. Compilar SCSS (Opcional)

```bash
# En máquina local para desarrollo
npm run build:css

# O usar herramienta online: https://jsoncrack.com/
```

### 4. Configurar Archivo `.env` (Para Desarrollo Local)

Crea `.env.local` en la raíz:

```bash
WORDPRESS_DB_HOST=localhost
WORDPRESS_DB_USER=root
WORDPRESS_DB_PASSWORD=
WORDPRESS_DB_NAME=celsius_rediseno
WP_HOME=http://localhost/rediseño
WP_SITEURL=http://localhost/rediseño/wp
```

---

## 📱 Estructura Mobile-First

### Filosofía de Breakpoints

```scss
// Estilos por defecto: Móvil (320px - 480px)
.elemento {
  font-size: 16px;
  padding: 16px;
  display: flex;
  flex-direction: column;
}

// Tablet (481px - 1023px)
@media (min-width: 481px) {
  .elemento {
    padding: 20px;
  }
}

// Desktop (1024px+) - ENCAPSULADO ESTRICTAMENTE
@media (min-width: 1024px) {
  .elemento {
    font-size: 18px;
    padding: 24px;
    flex-direction: row;
  }
}
```

### Tipografía Responsiva

**Móvil (6"):**
- Títulos H1: 28px
- Títulos H2: 24px
- Cuerpo: 16px
- Pequeño: 14px

**Desktop:**
- Títulos H1: 42px
- Títulos H2: 32px
- Cuerpo: 18px
- Pequeño: 16px

### Paleta de Colores (Línea Gráfica Clean Tech)

```scss
// Variables principales
$white-clean: #FFFFFF;
$gray-light: #F5F6F7;        // Fondo gris texturizado
$gray-medium: #E8EAED;       // Bordes y divisores
$gray-dark: #4A4A4A;         // Texto secundario
$text-dark: #1A1A1A;         // Texto principal

// Azul Industrial Metálico (Brand)
$blue-primary: #0052CC;      // Principal
$blue-dark: #003A99;         // Hover
$blue-light: #E8F0FF;        // Fondo luz

// Verde/Cian (CTA y Estados)
$cyan-accent: #00D9FF;       // Botones de acción
$green-success: #00A651;     // Estados aprobados
$orange-warning: #FF9500;    // Advertencias
$red-error: #E63946;         // Errores
```

### Glasmorphism Implementación

```scss
// Efecto Glass premium (Apple-style)
.glass-effect {
  background: rgba(255, 255, 255, 0.7);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.8);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
  border-radius: 16px;
}

// Variante oscura
.glass-effect-dark {
  background: rgba(10, 20, 40, 0.6);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
}
```

---

## 🎨 Componentes Principales

### 1. Hero Section (Parallax dinámico)

- Fondo blanco con gradiente sutil
- Imagen de fondo que se mueve con scroll
- Titular y CTA que flotan elegantemente
- En móvil: Stack vertical, imagen 100% ancho

### 2. Navegación Glasmorphic

- Header sticky con efecto glass
- Menú desplegable táctil (hamburguesa)
- Icono de usuario en portal de clientes
- En móvil: Full-width drawer

### 3. Cotizador Técnico Interactivo

- **Paso 1**: Seleccionar magnitud (Masa, Presión, Temperatura, etc.)
- **Paso 2**: Definir cantidad de equipos
- **Paso 3**: Cargar inventario (Excel/PDF)
- **Confirmación**: Adjuntar email y teléfono
- Campo de archivo nativo táctil
- Validación en tiempo real

### 4. Portal de Clientes Seguro

- Login integrado (Ultimate Member compatible)
- Carpetas por cliente con certificados PDF
- Descarga directa sin scripts externos
- En móvil: Interfaz táctil grande

### 5. Tabla de Magnitudes Responsiva

```
Móvil (scroll horizontal nativo):
┌─────────────────┐
│ Magnitud ← → │ Rango
│ Presión  ← →│ 0-1000 PSI
│ Temp.    ← → │ -40 a +140°C
└─────────────────┘

Desktop (tabla normal):
Magnitud | Rango | Precisión | Costo Base
─────────┼───────┼───────────┼──────────
Presión  | 0-1000 PSI | ±0.1% | $150
```

### 6. Animaciones Interactivas

- **Botones**: Scale + glow al hover (backdrop-filter)
- **Backgrounds**: Gradientes que se desplazan al scroll
- **Iconos**: Rotación suave al interactuar
- **Transiciones**: 0.3s ease-out (fluidas)

---

## 🚀 Despliegue Automatizado CI/CD

### Flujo de Trabajo

```
Desarrollador
     ↓
  git push origin main
     ↓
GitHub Actions (ubuntu-latest)
     ↓
  Checkout código
     ↓
  FTP Deploy Action v4.3.4
     ↓
  Sube a: C:\inetpub\wwwroot\wp-content\themes\celsius-theme-mobilefirst
     ↓
  Servidor Windows listo
     ↓
  Activar tema en WordPress Admin
```

### Configurar GitHub Secrets

1. Ve a: `https://github.com/AndresFMV22/CELSIUSMETROLOGIA-/settings/secrets/actions`

2. Crea los siguientes secretos:

```
FTP_SERVER        = tu-servidor-windows.com (o IP)
FTP_USERNAME      = usuario-ftp
FTP_PASSWORD      = contraseña-ftp
FTP_PORT          = 21 (o 22 para SFTP)
```

### Archivo `.github/workflows/deploy.yml`

Ya incluido en el repositorio. Cada `push` a `main` dispara el despliegue automático.

### Monitorear Despliegues

En GitHub: `Actions` → `Despliegue Automático a Servidor Windows` → Ver logs en tiempo real.

---

## 📦 Guía de Lanzamiento (El Cambiazo)

### ⚠️ IMPORTANTE: Sin Tiempo de Inactividad

Esta guía permite cambiar a la nueva web sin que los usuarios noten nada.

### Paso 1: Preparar la Carpeta de Subdirectorio

**En servidor Windows (`C:\inetpub\wwwroot` o `C:\xampp\htdocs`):**

1. Crea carpeta: `rediseño` (exacto, con tilde)
2. Obtén los archivos del tema desde el repositorio GitHub
3. Sube la carpeta completa del tema a: `C:\inetpub\wwwroot\rediseño\wp-content\themes\celsius-theme-mobilefirst`

**Estructura esperada:**
```
C:\inetpub\wwwroot
├── wp-admin/
├── wp-content/
├── wp-includes/
├── wp-load.php
├── wp-config.php
├── index.php
│
└── rediseño/  ← NUEVA CARPETA (copia completa de WordPress + tema)
    ├── wp-admin/
    ├── wp-content/
    │   └── themes/
    │       └── celsius-theme-mobilefirst/  ← El tema nuevo
    ├── wp-includes/
    ├── wp-config.php  ← Configuración compartida o separada
    └── index.php
```

### Paso 2: Configurar WordPress para el Subdirectorio

**Opción A: Base de Datos Compartida (Recomendado - sin downtime)**

1. En `C:\inetpub\wwwroot\rediseño\wp-config.php`:

```php
// Usar la misma BD que el sitio principal
define('DB_NAME', 'wordpress_principal');
define('DB_USER', 'root');
define('DB_PASSWORD', 'tu-contraseña');
define('DB_HOST', 'localhost');

// URLs del subdirectorio
define('WP_HOME', 'http://www.celsiusmetrologia.com/rediseño');
define('WP_SITEURL', 'http://www.celsiusmetrologia.com/rediseño');

// Prefijo de tabla diferente para evitar conflictos
$table_prefix = 'wp_rediseno_';
```

2. Accede a: `http://www.celsiusmetrologia.com/rediseño/wp-admin`

3. Login con credenciales y **deja activado el tema** `celsius-theme-mobilefirst`

**Opción B: Base de Datos Separada (Si quieres completa independencia)**

1. Crea BD nueva: `celsius_metrologia_rediseno`

2. Modifica `wp-config.php` del subdirectorio

3. La sincronización manual de contenido es responsabilidad tuya

### Paso 3: Cambiar URLs en WordPress (El Cambiazo Final)

**Cuando estés 100% seguro de que todo funciona en `/rediseño`:**

1. **En el WordPress Principal** (`C:\inetpub\wwwroot\`):
   - Ve a: `Ajustes` → `Generales`
   - Dirección de WordPress (URL): Cámbiala de `http://www.celsiusmetrologia.com` a `http://www.celsiusmetrologia.com/rediseño`
   - Dirección del sitio: Ídem
   - Clic en **Guardar cambios**
   - Espera 10-20 segundos

**O usar WP-CLI (recomendado para automatización):**

```bash
wp option update siteurl 'http://www.celsiusmetrologia.com/rediseño'
wp option update home 'http://www.celsiusmetrologia.com/rediseño'
wp cache flush
```

2. **Activeactivar el Tema Nuevo**:
   - `Apariencia` → `Temas`
   - Busca `Celsius Theme Mobile-First`
   - Clic en **Activar**

3. **Verificar Todo Funciona**:
   - Abre `http://www.celsiusmetrologia.com` en navegador
   - Deberías ver el diseño nuevo
   - Prueba funcionalidades: Cotizador, Portal, Contacto

### Paso 4: Limpiar y Optimizar (Post-Lanzamiento)

```php
// En wp-config.php, desactiva modo debug después de verificar
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Borra logs si los hay
unlink(WP_CONTENT_DIR . '/debug.log');
```

### Rollback Rápido (Si algo va mal)

```php
// Revierte URLs al sitio anterior
wp option update siteurl 'http://www.celsiusmetrologia.com/wp'
wp option update home 'http://www.celsiusmetrologia.com/wp'

// Activa el tema anterior
wp theme activate twentythree
```

---

## 🛠️ Cómo Hacer Cambios y Verlos Reflejados

### Flujo de Desarrollo Local

#### 1. Configurar Entorno Local (Recomendado: XAMPP)

**Windows:**

```bash
# Descargar XAMPP desde https://www.apachefriends.org/
# Instalar en C:\xampp

# Iniciar Apache y MySQL
C:\xampp\xampp-control.exe

# Crear BD
http://localhost/phpmyadmin
# Crea: celsius_local

# Descargar WordPress
cd C:\xampp\htdocs
git clone https://github.com/WordPress/WordPress.git rediseño

# Configurar wp-config.php
cd rediseño
cp wp-config-sample.php wp-config.php

# Edita wp-config.php:
# DB_NAME: celsius_local
# DB_USER: root
# DB_PASSWORD: (vacío por defecto en XAMPP)
```

**Mac/Linux:**

```bash
# Usar Homebrew o Docker
brew install xampp
# o
docker run -it -p 80:80 -v /ruta/a/codigo:/var/www/html wordpress:latest
```

#### 2. Clonar Tema Localemente

```bash
cd C:\xampp\htdocs\rediseño\wp-content\themes
git clone https://github.com/AndresFMV22/CELSIUSMETROLOGIA-.git celsius-theme-mobilefirst
```

#### 3. Editar Archivos Localmente

USA TU EDITOR FAVORITO:

**VS Code (Recomendado):**

```bash
code C:\xampp\htdocs\rediseño\wp-content\themes\celsius-theme-mobilefirst
```

**Estructura de archivos a editar:**

```
theme-source/
├── assets/
│   ├── css/           # Estilos compilados (NO editar, edita SCSS)
│   ├── scss/          # ← EDITA AQUÍ para cambios visuales
│   │   ├── _variables.scss
│   │   ├── _mobile-first.scss
│   │   └── _glasmorphism.scss
│   └── js/            # ← EDITA AQUÍ para funcionalidades
│       ├── main.js
│       ├── interactions.js
│       └── dynamic-bg.js
└── templates/         # ← EDITA AQUÍ para estructura HTML
    ├── header.php
    ├── front-page.php
    └── footer.php
```

#### 4. Compilar SCSS (Si modificaste estilos)

**Opción A: Automático con Live Server**

```bash
cd C:\xampp\htdocs\rediseño\wp-content\themes\celsius-theme-mobilefirst
npm run watch
# Los cambios se compilan automáticamente
```

**Opción B: Manual (One-time)

```bash
npm run build:css
```

**Opción C: Online (Sin Node.js instalado)**

1. Ve a: https://sass-lang.com/playground
2. Pega contenido de `theme-source/assets/scss/main.scss`
3. Copia CSS compilado a `theme-source/assets/css/main.css`

#### 5. Ver Cambios en Navegador

```
http://localhost/rediseño
```

**Fuerza refresh sin caché:**
- `Ctrl + Shift + Delete` (Firefox)
- `Ctrl + Shift + R` (Chrome)
- `Cmd + Shift + R` (Mac)

#### 6. Limpiar Caché de WordPress

En `wp-config.php` (solo desarrollo):

```php
define('WP_DEBUG', true);
define('WP_CACHE', false);
```

O plugin: "WP Super Cache" → Purgar caché

---

### Flujo de Commit y Push

#### 1. Verificar Cambios

```bash
cd C:\xampp\htdocs\rediseño\wp-content\themes\celsius-theme-mobilefirst
git status
```

#### 2. Añadir Cambios

```bash
# Añadir todos los cambios
git add .

# O añadir archivos específicos
git add assets/scss/main.scss
git add templates/header.php
```

#### 3. Commit con Mensaje Descriptivo

```bash
git commit -m "feat: Añade glasmorphism al header y hover animations en botones"
```

**Convención de mensajes:**
- `feat:` Nueva funcionalidad
- `fix:` Corrección de bug
- `style:` Cambios de estilos (CSS/SCSS)
- `refactor:` Refactorización de código
- `docs:` Cambios en documentación
- `perf:` Mejoras de performance

#### 4. Push a GitHub

```bash
git push origin main
```

🚀 **¡GitHub Actions se ejecuta automáticamente!**

#### 5. Monitorear Despliegue

1. Ve a: https://github.com/AndresFMV22/CELSIUSMETROLOGIA-/actions
2. Haz clic en el workflow que dice "Despliegue Automático a Servidor Windows"
3. Observa los logs en tiempo real
4. Si es verde ✅: El código se subió exitosamente al servidor Windows
5. Si es rojo ❌: Revisa los logs para diagnosticar el error (credenciales FTP, permisos, etc.)

---

### Ediciones Rápidas Directo en WordPress

Si necesitas cambios pequeños SIN tocar código:

1. **Textos y Contenido**:
   - `http://www.celsiusmetrologia.com/wp-admin`
   - `Páginas` → Edita la página
   - Cambia textos directamente
   - Clic en **Actualizar**

2. **Colores y Tipografía** (Personalización de Tema):
   - `Apariencia` → `Personalizar`
   - Aquí puedes cambiar colores, tipografías, espaciados
   - Los cambios se guardan en la BD de WordPress

3. **Logo y Favicon**:
   - `Apariencia` → `Logo del sitio`
   - Sube logo (SVG recomendado)
   - O usa `Personalizar` → `Identidad del sitio`

---

### Troubleshooting Común

#### Problema: Los cambios en SCSS no aparecen

**Solución:**
1. ¿Compilaste SCSS a CSS? `npm run build:css`
2. ¿Limpiaste caché? `Ctrl + Shift + R` o plugin de caché
3. ¿Editaste el archivo correcto? (Edita `scss/`, no `css/`)
4. Revisa la consola del navegador: `F12` → `Console` → busca errores

#### Problema: GitHub Actions falla al subir

**Verificar:**
1. ¿Credenciales FTP correctas en GitHub Secrets?
2. ¿El servidor FTP está activo y accesible?
3. ¿La carpeta destino en Windows existe?
4. ¿Permisos de escritura en esa carpeta?

**Debug:**
```bash
# Prueba conexión FTP desde tu máquina
ftp -h 
Open [FTP_SERVER]
user [FTP_USERNAME]
password [FTP_PASSWORD]
ls  # Listar carpetas
cd /wwwroot/wp-content/themes/
quit
```

#### Problema: El sitio se ve roto en móvil

**Verificar:**
1. ¿Meta viewport está en `header.php`?
   ```html
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   ```
2. ¿CSS está cargando correctamente? (`F12` → `Network` → busca `.css`)
3. ¿Breakpoints están bien?
   - Abre DevTools → `Ctrl + Shift + M` (responsive mode)
   - Prueba en 320px, 480px, 768px, 1024px

---

## 📚 Documentación Adicional

- **ARQUITECTURA.md**: Detalles técnicos profundos
- **GLASMORPHISM.md**: Guía de componentes glass
- **DESPLIEGUE.md**: Troubleshooting avanzado de CI/CD
- **INSTALACION.md**: Guía paso a paso para fresh install

---

## 👥 Equipo y Contacto

**Desarrollado por**: Andres Felipe Martinez Velasquez (@AndresFMV22)  
**Cliente**: Celsius S.A.S. (Metrología e Ingeniería Biomédica)  
**Repositorio**: https://github.com/AndresFMV22/CELSIUSMETROLOGIA-  
**Servidor de Producción**: Windows IIS / XAMPP (C:\inetpub\wwwroot)

---

## 📄 Licencia

Código fuente © 2026 Andres Felipe Martinez Velasquez. Todos los derechos reservados.

---

**Última actualización**: Junio 2, 2026  
**Versión del Tema**: 1.0.0-mobile-first
