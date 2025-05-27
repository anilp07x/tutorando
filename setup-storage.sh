#!/bin/bash

# Create storage directories for the application
mkdir -p storage/app/public/projetos/imagens
mkdir -p storage/app/public/projetos/pdfs
mkdir -p storage/app/public/publicacoes/livro
mkdir -p storage/app/public/publicacoes/artigo
mkdir -p storage/app/public/publicacoes/video
mkdir -p storage/app/public/publicacoes/curso
mkdir -p storage/app/public/publicacoes/sebenta

# Set appropriate permissions
chmod -R 775 storage/app/public

# Create the storage link
php artisan storage:link

echo "Storage directories created and symlink established!"
