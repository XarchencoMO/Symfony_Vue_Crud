FROM bitnami/php-fpm:7.4

WORKDIR /app/backend

COPY . .

RUN apt-get update && composer install

RUN ["apt-get", "install", "-y", "vim"]
#RUN ["rm",".env.local"]
#ENTRYPOINT [ "entrypoint.sh" ]
#CMD ["echo", "!!!!!!!! Database is available now !!!!!!!!"]
