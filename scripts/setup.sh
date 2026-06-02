#!/bin/bash

# Celsius S.A.S. - Setup Script para Linux/Mac
# Este script configura el entorno de desarrollo

echo "🚀 Setup Celsius Theme Mobile-First"
echo "======================================"

# Verificar si Node.js está instalado
if ! command -v node &> /dev/null; then
    echo "❌ Node.js no está instalado"
    echo "📥 Descárgalo desde: https://nodejs.org/"
    exit 1
fi

echo "✅ Node.js encontrado: $(node -v)"
echo "✅ NPM encontrado: $(npm -v)"

# Instalar dependencias
echo ""
echo "📦 Instalando dependencias..."
npm install

# Compilar SCSS
echo ""
echo "🔨 Compilando SCSS..."
npm run build:css

# Crear directorios necesarios
echo ""
echo "📁 Creando directorios..."
mkdir -p theme-source/assets/css
mkdir -p theme-source/assets/js
mkdir -p theme-source/assets/images/icons
mkdir -p theme-source/assets/images/patterns
mkdir -p theme-source/assets/fonts

# Dar permisos
chmod -R 755 theme-source/

echo ""
echo "✅ Setup completado!"
echo ""
echo "Próximos pasos:"
echo "1. Copiar la carpeta 'theme-source' a: wp-content/themes/celsius-theme-mobilefirst"
echo "2. Activar el tema en WordPress Admin > Apariencia > Temas"
echo "3. Para desarrollo: npm run watch"
echo ""
