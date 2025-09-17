# 使用 PHP 8.4 FPM 官方映像
FROM php:8.3-cli

# 設定工作目錄
WORKDIR /var/www

# 安裝系統套件與 PHP 擴展
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zlib1g-dev \
    unzip \
    git \
    curl \
    build-essential \
    pkg-config \
    && docker-php-ext-install intl zip pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 複製專案所有檔案
COPY . .

# 安裝 Composer 依賴
RUN composer install --optimize-autoloader --no-interaction

# 暴露容器埠號
EXPOSE $PORT

# 啟動 PHP-FPM
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=$PORT"]
