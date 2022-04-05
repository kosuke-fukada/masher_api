FROM nginx:1.20

WORKDIR /var/www/src

ENV TZ=UTC

COPY ./infra/docker/nginx/*.conf /etc/nginx/conf.d/
