FROM bitnami/php-fpm:7.4

WORKDIR /app/backend

COPY . .

#ENTRYPOINT [ "entrypoint.sh" ]
#CMD ["echo", "!!!!!!!! Database is available now !!!!!!!!"]
