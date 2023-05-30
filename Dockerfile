# Define a imagem base
FROM php:7.4-fpm

# Define o diretório de trabalho dentro do container
WORKDIR /var/www/html

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl

# Instala as extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copia os arquivos do projeto para o container
COPY . .

# Instala as dependências do projeto Laravel
RUN composer install --optimize-autoloader --no-dev

# Define as variáveis de ambiente
ENV APP_NAME=Laravel
ENV APP_ENV=local
ENV APP_KEY=
ENV APP_DEBUG=true
ENV APP_URL=http://localhost

ENV DB_CONNECTION=${DB_CONNECTION}
ENV DB_HOST=${DB_HOST}
ENV DB_PORT=${DB_PORT}
ENV DB_DATABASE=${DB_DATABASE}
ENV DB_USERNAME=${DB_USERNAME}
ENV DB_PASSWORD=${DB_PASSWORD}

ENV JWT_SECRET=${JWT_SECRET}

# Executa o comando para iniciar o servidor web do Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
