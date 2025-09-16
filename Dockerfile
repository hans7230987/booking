# 使用 PHP 8.2 FPM 官方映像
FROM php:8.2-fpm

# 安裝系統套件與 PHP 擴展
RUN apt-get update && apt-get install -y \
    libicu-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install intl zip pdo_mysql

# 設定工作目錄
WORKDIR /var/www

# 複製 Composer 相關檔案並安裝依賴
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --optimize-autoloader --no-interaction

# 複製整個專案
COPY . .

# 開放容器埠號
EXPOSE 9000

# 啟動 PHP-FPM
CMD ["php-fpm"]
