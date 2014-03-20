Clear database: demo

# Laravel API App

Provision a new Laravel application for our **bookstore** with Foreman

    (DONE ALREADY) foreman build ~/Desktop/myApp ~/Desktop/foreman.json
    
    
    
Investigate what Foreman created

Copy to `bookstore` folder for Blacksmith generation demo


    cp -R ~/Desktop/myApp ~/Desktop/bookstore && cd ~/Desktop/bookstore

    
    
    
Generate a **book** scaffold with Blacksmith

	blacksmith generate book scaffold --fields="title:string, author:string, price:integer, published_on:date"  
	
	
	
	
Update service provider: **RepositoriesServiceProvider.php**

    $this->app->bind(
            'Contracts\Repositories\BookRepositoryInterface',
            'Repositories\DbBookRepository'
        );	
       
       
        
Add to `providers` array in **app.php**

	'Providers\RepositoriesServiceProvider',

Run

    composer dump-autoload



Dump some seed data into **BooksTableSeeder.php** (and uncomment)

```
[
                'title'        => 'The Great Gatsby',
                'author'       => 'F. Scott Fitzgerald',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'The Grapes of Wrath',
                'author'       => 'John Steinbeck',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Nineteen Eighty-Four',
                'author'       => 'George Orwell',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Ulysses',
                'author'       => 'James Joyce',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Lolita',
                'author'       => 'Vladimir Nabokov',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Catch-22',
                'author'       => 'Joseph Heller',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'The Catcher in the Rye',
                'author'       => 'J. D. Salinger',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Beloved',
                'author'       => 'Toni Morrison',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'The Sound and the Fury',
                'author'       => 'William Faulkner',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'To Kill a Mockingbird',
                'author'       => 'Harper Lee',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ]                     
```    

Migrate and Seed the database:

    php artisan migrate --seed
    
Boot the internal webserver and look at http://localhost:8000/books

    php artisan serve    


---
### Now for an API

---

        
Generate a **author** scaffold with custom Blacksmith templates

    blacksmith generate author scaffold ~/Desktop/blksm_cust_tpl/config.json --fields="name:string"


Update service provider

    $this->app->bind(
            'Contracts\Repositories\BookRepositoryInterface',
            'Repositories\DbBookRepository'
        ); 

        $this->app->bind(
            'Contracts\Repositories\AuthorRepositoryInterface',
            'Repositories\DbAuthorRepository'
        ); 


Dump some seed data into **AuthorsTableSeeder.php** (and uncomment)

```
[
                'name'       => 'F. Scott Fitzgerald',
            ],
            [
                'name'       => 'John Steinbeck',
            ],
            [
                'name'       => 'George Orwell',
            ],
            [
                'name'       => 'James Joyce',
            ],
            [
                'name'       => 'Vladimir Nabokov',
            ],
            [
                'name'       => 'Joseph Heller',
            ],
            [
                'name'       => 'J. D. Salinger',
            ],
            [
                'name'       => 'Toni Morrison',
            ],
            [
                'name'       => 'William Faulkner',
            ],
            [
                'name'       => 'Harper Lee',
            ]
```    

### Stop the webserver if its running w/ CTRL+C

Dump composer autoload files

    composer dump-autoload


Run the migrations & seed:

    php artisan migrate --seed
    
Start the webserver again

    php artisan serve    

Hit the `/authors` and `/authors/1` to verify things are working

    http://localhost:8000/authors    

----


Create a trucker consumer app:

    (DONE ALREADY) foreman build ~/Desktop/truckerApp ~/Desktop/truckerapp.json
    
    
    (DONE ALREADY) cd ~/Desktop/truckerApp && composer update
    
Get to the app directory if your not there

    cd ~/Desktop/truckerApp    
    
Publish configs:

    php artisan config:publish indatus/trucker
    
Update providers array in **app.php**:

	'Trucker\TruckerServiceProvider'        
	
	
Update **app/config/packages/indatus/trucker/request.php**:

    'base_uri' => 'http://localhost:8000',
    
Make a controller

    php artisan controller:make AuthorsController
    
Stub out the index:

```
$authors = Author::all();

        foreach ($authors as $author) {

            echo "<h1>{$author->name}</h1>";
            var_dump($author->attributes());
        	echo "<hr />";
        }
```

Add the route:

    Route::resource('authors', 'AuthorsController');    
    
Make a model

    touch app/models/Author.php
    
With code

```
<?php

class Author extends Trucker\Resource\Model
{
    
}
```                


Start a second server:

    php -S localhost:4000 -t ./public/
    
Checkout the index action

    http://localhost:4000/authors    
    
Maybe now you want to go back to the `AuthorsController::show()` method and add...

    $author = Author::find($id);
		var_dump($author->attributes());
		
Now checkout the `AuthorsController::index()` action

    http://localhost:4000/authors/1  		
    

<br /><br />
---    
    
> If you want to see calls to the api getting logged when you hit the client URL you could re-run the api server with:

    php -S localhost:8000 -t ./public/