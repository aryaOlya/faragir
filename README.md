# faragir task

## getting start

````
git clone https://github.com/aryaOlya/faragir
````

````
cp .env.example .env
````
run below command to up the containers and build `Dockerfile`
````
docker compose up --build
````
then run this command to go to the php container
````
docker exec -t code-challenge-php-1 bash
````
then run these commands
````
composer install
````

````
php artisan key:generate
````

````
php artisan migrate
````

````
php artisan db:seed
````

### or you can use make file

build images and up containers
````
make run 
````

go to the php container

````
make php 
````



## description

this project has to major models named `Course` and `Lesson`. there are Many-To-Many relation 
between these two models. also Price has been seperated from courses and lesson for mysql 
normalize so price has its own model named `Price`; because of being more than one model that need price
there is polymorph relation between price and other models that have price.
<div>

</div>

