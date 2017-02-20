## Laravel Monolog MySQL Handler.

MySQL driver for Laravel Monolog.

### Installation

- [Packagist](https://packagist.org/packages/markhilton/monolog-mysql)
- [GitHub](https://github.com/markhilton/monolog-mysql)

To get the lastest version of this package simply require it in your `composer.json` file.

~~~
"markhilton/monolog-mysql": "dev-master"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Update your `config/app.php` file `providers` array to include the package service provider:

~~~
'providers' => array(
    // ...
    Logger\Laravel\Provider\MonologMysqlHandlerServiceProvider::class,
);
~~~

Publish config using artisan CLI:

~~~
php artisan vendor:publish --provider="Logger\Laravel\Provider\MonologMysqlHandlerServiceProvider"
~~~

Migrate tables:

~~~
php artisan migrate
~~~

## Usage

~~~php
Log::getMonolog()->pushHandler(new Logger\Monolog\Handler\MysqlHandler());
~~~

Or in `bootstrap/app.php`:

~~~php
$app->configureMonologUsing(function($monolog) use($app) {
    $monolog->pushHandler(new Logger\Monolog\Handler\MysqlHandler());
});
~~~

## Credits

Based on:

- [Pedro Fornaza] (https://github.com/pedrofornaza/monolog-mysql)
