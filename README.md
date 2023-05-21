# faragir task

## getting start

````
git clone https://github.com/aryaOlya/faragir
````

````
cp .env.example .env
````

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

## description

this project has to major models named `Course` and `Lesson`. there are Many-To-Many relation 
between these two models. also Price has been seperated from courses and lesson for mysql 
normalize so price has its own model named `Price`; because of being more than one model that need price
there is polymorph relation between price and other models that have price.
<div>

</div>

