<?php

use Codemen\Modules\Activators\FileActivator;

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Modules',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => false,
        'path' => base_path() . '/vendor/nwidart/laravel-modules/src/Commands/stubs',
        'files' => [
            'routes/web' => 'Routes/web.php',
            'routes/api' => 'Routes/api.php',
            'scaffold/config' => 'Config/config.php',
            'scaffold/appsettings' => 'Config/appsettings.php',
            'scaffold/webpermissions' => 'Config/webpermissions.php',
            'scaffold/apipermissions' => 'Config/apipermissions.php',
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME'],
            'routes/api' => ['LOWER_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'PROVIDER_NAMESPACE','MODULE_PRIORITY'],
            'scaffold/config' => ['STUDLY_NAME'],
            'scaffold/appsettings' => ['STUDLY_NAME'],
            'scaffold/webpermissions' => ['STUDLY_NAME'],
            'scaffold/apipermissions' => ['STUDLY_NAME'],
        ],
        'gitkeep' => false,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path used for save the generated module. This path also will be added
        | automatically to list of scanned folders.
        |
        */

        'modules' => base_path('Modules'),

        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Set the generate key to false to not generate that folder
        */
        'generator' => [
            'config' => ['path' => 'Config', 'generate' => true],
            'command' => ['path' => 'Console', 'generate' => false],
            'migration' => ['path' => 'Database/Migrations', 'generate' => true],
            'seeder' => ['path' => 'Database/Seeders', 'generate' => true],
            'factory' => ['path' => 'Database/Factories', 'generate' => true],
            'model' => ['path' => 'Models', 'generate' => true],
            'routes' => ['path' => 'Routes', 'generate' => true],
            'controller' => ['path' => 'Http/Controllers', 'generate' => true],
            'filter' => ['path' => 'Http/Middleware', 'generate' => false],
            'request' => ['path' => 'Http/Requests', 'generate' => true],
            'provider' => ['path' => 'Providers', 'generate' => true],
            'lang' => ['path' => 'Resources/lang', 'generate' => true],
            'views' => ['path' => 'Resources/views', 'generate' => true],
            'event' => ['path' => 'Events', 'generate' => false],
            'listener' => ['path' => 'Listeners', 'generate' => false],
            'policies' => ['path' => 'Policies', 'generate' => false],
            'rules' => ['path' => 'Rules', 'generate' => false],
            'jobs' => ['path' => 'Jobs', 'generate' => false],
            'emails' => ['path' => 'Emails', 'generate' => false],
            'notifications' => ['path' => 'Notifications', 'generate' => false],
            'resource' => ['path' => 'Transformers', 'generate' => false],
            'service' => ['path' => 'Services', 'generate' => true],
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan Modules
    | directory.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('Modules'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
    */
    'activators' => [
        'file' => [
            'class' => FileActivator::class,
            'statuses-file' => base_path('modules_statuses.json'),
            'cache-key' => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator' => 'file',
];
