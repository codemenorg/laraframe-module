<?php

use Codemen\Modules\Module;

if (!function_exists('module_path')) {
    function module_path($name, $path = '')
    {
        $module = app('modules')->find($name);

        return $module->getPath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param string $path
     * @return string
     */
    function public_path($path = '')
    {
        return app()->make('path.public') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}

if (!function_exists('get_modules')) {
    /**
     * Get the path to the public folder.
     *
     * @param string|null $status
     * @return array
     */
    function get_modules(string $status = null)
    {
        switch ($status) {
            case 'enabled':
                return Module::allEnabled();
            case 'disabled':
                return Module::allDisabled();
            default:
                return Module::all();
        }
    }
}
