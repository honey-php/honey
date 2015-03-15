# HoneyPHP

Honey is a lightweight, easy way to create powerful applications.

It's a few components organized and mixed together to make the developing process easier.

Laravel is awesome, but too complex for some people, while Slim is too micro.

Honey shows the advantages of both in a mini environment.

## Uses

* Slim micro-framework(2.6.1, extended by a custom package called `Berry`) - routing, DI container, flash messages, input/cookies, logging, error handling, middleware/hook architecture
* Eloquent ORM(5.0) - connecting to database(MySQL, SQLite, etc.), interacting with tables(models), querying
* Twig(1.18.1) - rendering views(templates)

## Setup

### Install

*The best way to install Honey is to use Composer.*

1. Install `composer`(in your project directory):

        curl -s https://getcomposer.org/installer | php

2. Create a **Honey** project:

        php composer.phar create-project honey/honey:dev-master {DIRECTORY}

3. **Profit**!

### Requirements

Because of its nature, Honey relies on different components, thus it requires to meet their needs.

You need **PHP >= 5.4.0** to use Honey without problems. If you use encrypted cookies, you'll also need `mcrypt` PHP extension(Slim framework).

### First touch

Honey comes with one controller(two routes - "/" and 404), one model("Guest", contains last IPs), two views.

They show an example usage of all components together, in this case shows last IPs that visited the site.

**If you want to start from scratch:**

* remove:

        app/controllers/404.php
        app/controllers/example.php
        app/models/Guest.php
        app/views/404.twig
        app/views/index.twig

* *(not really needed)* overwrite `app/config/filters.php` with:

        <?php
        return array();

### Setup your web server

<https://github.com/slimphp/Slim/blob/master/README.markdown#setup-your-web-server>

#### Apache

Honey comes with a ready-to-use `.htaccess` file, so you don't have to configure it.

---
**Remember!** You should set Apache's `DocumentRoot` to `/path/to/your/project/public` to get rid of "public/" in the URL.

Then restart Apache by typing: `sudo service apache2 restart` in the console.

---
*(not recommended)* If you don't have access to `httpd.conf`, you may paste this into `.htaccess` as a workaround:

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ public/$1 [QSA,L]

    AllowOverride All

#### Nginx

The nginx configuration `location` block should contain this code:

    try_files $uri $uri/ /index.php?$args;

**Remember!** You should set nginx `root` to `/path/to/your/project/public` in the `server` block:

    server {
        ...
        root /path/to/your/project/public;
        ...
    }

Also remember to restart nginx:

    sudo service nginx restart

## Getting started

Honey's structure is similar to MVC architecture. Instead of "real controllers", you create an unique-named route:

### Controllers(routes)

1. Add a controller file(`app/controllers/myController.php`):

        <?php
        $app->get('/something', function() use($app){
            echo 'Hello world!';
        })->name('something');
*You can place as many routes as you want in one file.*

2. Add the controller(filename) to the configuration(`app/config/controllers.php`):

        <?php
        return array(
            'myController'
        );

3. Go to(in this case) <http://localhost/something> in your browser. You should see:

        Hello world!

---
####More information:

<http://docs.slimframework.com/#Routing-Overview>

<http://docs.slimframework.com/#Request-Overview>

### Configuration

1. Configure database connection(`app/config/database.php`), here is a configuration for MySQL and SQLite:

        <?php
        return array(
            'default' => 'mysql',
            'connections' => array(
                'mysql' => array(
                    'driver'    => 'mysql',
                    'host'      => 'localhost',         # change
                    'database'  => 'example',           # change
                    'username'  => 'root',              # change
                    'password'  => '',                  # change
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => ''
                ),
                'sqlite' => array(
                    'driver' => 'sqlite',
                    'database' => DATABASE_PATH . '/production.sqlite',
                    'prefix' => ''
                )
            )
        );
    
    In this case, if you set "mysql" as the default connection, you can use it later like this:

    **Queries**:
    
        Capsule::connection()->select('select * from guests')
        Capsule::connection()->insert(...)
        Capsule::connection()->update(...)
        Capsule::connection()->delete(...)
        and more...
    
    If you set up more than one connection, for example MySQL and SQLite and you name them, respectively, "mysql"(set to default) and "sqlite", then use SQLite this way:
    
        Capsule::connection('sqlite')->...
    
    Use connection other than the default one in a model:
    
        class Book extends Model
        {
            protected $connection = 'sqlite';
        }
    
    See <http://laravel.com/docs/5.0/queries> for more information.    

### Models(database)

1. Add a model file(`app/models/Book.php`):

        <?php namespace App\Models;
        use Model;
        class Book extends Model
        {
            protected $table = 'books';
            public $timestamps = false;
        }

2. Either:
    * Add a table called `books` in your database with columns `id`, `title`, for example in phpMyAdmin
    
    or...
    
    * Add a simple "migration" and seed next to your model definition, it'll create the table if it doesn't exist, then add two books:
    
            <?php namespace App\Models;
            use Model, Capsule;
            class Book extends Model
            {
                ...
            }
            if (Capsule::schema()->hasTable('books')) return;
            Capsule::schema()->create('books', function($table){
                $table->increments('id');
                $table->string('title');
            });
            Book::create(array('title' => 'PHP vs. Python'));
            Book::create(array('title' => 'Jeremy Clarkson and his food'));

3. Use the model in controller(`app/controllers/myController.php`):

        <?php
        use App\Models\Book;
        $app->get('/books', function() use($app){
            $books = Book::all();
            echo '<h1>Books</h1><ul>';
            foreach ($books as $book) {
                echo '<li>'.$book->title.'</li>';
            }
            echo '</ul>';
        })->name('books');

4. Go to <http://localhost/books>, you should see something similar to:

    ### Books
    * PHP vs. Python
    * Jeremy Clarkson and his food

---
####More information:

<http://laravel.com/docs/5.0/eloquent>

### Views(templates)

1. Create a new view(`app/views/myView.twig`):

        <h1>Books</h1>
        <ul>
        {% for book in books %}
            <li>{{ book.title }}</li>
        {% endfor %}
        </ul>

2. Use the view in your controller(`app/controllers/myController.php`):

        <?php
        use App\Models\Book;
        $app->get('/books', function() use($app){
            $books = Book::all();
            $app->render('myView.twig', array(
                'books' => $books
            ));
        })->name('books');

---
####More information:

<http://twig.sensiolabs.org/documentation>

### Custom

Honey has a reserved place for your custom code. Instead of editing Honey's code manually, keep it organized and extend the functionality by placing it in `custom/custom.php`. Use it as a bootstrap file, that is, include all other needed files/libaries from there.

You can use hooks to extend some of the Honey's functions:

* **database.connection.before** - called before the database connection
* **database.connection.added( string $name, $connection )** - called when a connection starts
* **database.connection.after** - called after the database connection
* **ready( Berry\Berry $app )** - called when everything is done and ready to go

**Keep in mind**, that `custom/custom.php` is included before the database connection, so if you want to use all the components properly, hook up to `ready`:

    $app->hook('ready', function() use($app){
        ...
    });

### Helpers

Honey implements some of Laravel's helper functions:

* <http://laravel.com/docs/5.0/helpers#strings>

* <http://laravel.com/docs/5.0/helpers#arrays>

---
#### We hope that Honey will help some developers.