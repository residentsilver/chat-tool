FROM php:8.2-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# PHPの拡張機能のインストール
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Node.jsとnpmのインストール（Laravel Mix用）
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# ワーキングディレクトリの設定
WORKDIR /var/www/html

# PHPのタイムゾーンを設定
RUN echo "date.timezone = Asia/Tokyo" > /usr/local/etc/php/conf.d/timezone.ini

# ユーザー権限の設定
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# 所有権の変更
RUN chown -R www:www /var/www

# ユーザーの切り替え
USER www

# コンテナの起動時にPHP-FPMを実行
CMD ["php-fpm"]