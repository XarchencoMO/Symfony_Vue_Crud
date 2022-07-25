# Symfony_vue_crud_app

## Compile project into Docker:
```
docker-compose up -d 
```
#### Apply migrations: 
```
docker exec -it back-end-app php bin/console doctrine:migrations:migrate --no-interaction
```
#### roll up fixtures:
```
docker exec -it back-end-app php bin/console doctrine:fixtures:load --no-interaction
```
### important
```
if you got error "connection refused", just wait a bit until the base is deployed
```
