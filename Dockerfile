# Utiliza a imagem oficial do PHP 8.3 com Apache
FROM php:8.3-apache

# Define o diretório de trabalho dentro do container
WORKDIR /var/www/html/loja

# Instala as extensões necessárias para desenvolvimento de APIs
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install intl mbstring zip pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug\
    && a2enmod rewrite

# Instala o Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos do projeto para o diretório de trabalho
COPY . .

# Define permissões apropriadas
RUN chown -R www-data:www-data /var/www/html/loja

RUN docker-php-ext-install pdo pdo_mysql
# Exposição da porta 8080
EXPOSE 80

# Define o comando de entrada
CMD ["apache2-foreground"]


