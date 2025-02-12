FROM php:8.3-rc-cli-alpine3.21

COPY ./ /app/

WORKDIR /app

EXPOSE "8000"

CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]
