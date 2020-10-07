# Laraframe-Modules

`codemenorg/laraframe-modules` is a Laravel package which created to manage your large Laraframe app using modules. Module is like a Laravel package, it has some views, controllers or models. This package is supported in Laravel 8.

This package is a re-published, re-organised and maintained version of [nwidart/laravel-modules](https://nwidart.com/laravel-modules).

## Install

To install through Composer, by run the following command:

``` bash
composer require codemenorg/laraframe-modules
```

The package will automatically register a service provider and alias.

Optionally, publish the package's configuration file by running:

``` bash
php artisan vendor:publish --provider="Codemen\Modules\LaravelModulesServiceProvider"
```

### Autoloading

By default, the module classes are not loaded automatically. You can autoload your modules using `psr-4`. For example:

``` json
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "Modules/"
    }
  }
}
```

**Tip: don't forget to run `composer dump-autoload` afterwards.**

## Documentation

You'll find installation instructions and full documentation on [https://laraframe-module-doc.codemen.org](https://laraframe-module-doc.codemen.org).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
