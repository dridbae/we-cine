FROM php:8.0-cli

COPY . /app
WORKDIR /app

# Install unzip utility and libs needed by zip PHP extension
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer && \
    composer install
RUN cd /app
RUN curl -sL https://deb.nodesource.com/setup_14.x > setup_14.x \
            && chmod +x setup_14.x \
            && ./setup_14.x \
            && apt-get install -y nodejs \
            && npm install yarn -g
RUN yarn install
RUN yarn encore production
EXPOSE 80
CMD ["bin/console", "c:c"]
CMD ["php", "-S", "0.0.0.0:8888", "-t", "/app/public/"]
