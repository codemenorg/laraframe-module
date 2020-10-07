<?php

namespace Codemen\Modules\Commands;

use Codemen\Modules\Support\Config\GenerateConfigReader;
use Codemen\Modules\Support\Stub;
use Codemen\Modules\Traits\ModuleCommandTrait;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ControllerMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument being used.
     *
     * @var string
     */
    protected $argumentName = 'controller';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new restful controller for the specified module.';

    /**
     * Get controller name.
     *
     * @return string
     */
    public function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $controllerPath = GenerateConfigReader::read('controller')->getPath();

        if ($this->option('web')) {
            $controllerPath .= '/Web';
        }elseif ($this->option('api')){
            $controllerPath .= '/Api';
        }
        return $path . $controllerPath . '/' . $this->getControllerName() . '.php';
    }

    /**
     * @return array|string
     */
    protected function getControllerName()
    {
        $controller = Str::studly($this->argument('controller'));

        if (Str::contains(strtolower($controller), 'controller') === false) {
            $controller .= 'Controller';
        }

        return $controller;
    }

    public function getDefaultNamespace(): string
    {
        $module = $this->laravel['modules'];

        if ($module->config('paths.generator.controller.namespace')) {
            return $module->config('paths.generator.controller.namespace');
        } else {
            $defaultNamespace = $module->config('paths.generator.controller.path', 'Http/Controllers');
            if ($this->option('web')) {
                $defaultNamespace .= '/Web';
            }elseif ($this->option('api')){
                $defaultNamespace .= '/Api';
            }
            return $defaultNamespace;
        }
    }

    /**
     * @return string
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        return (new Stub($this->getStubName(), [
            'MODULENAME' => $module->getStudlyName(),
            'CONTROLLERNAME' => $this->getControllerName(),
            'NAMESPACE' => $module->getStudlyName(),
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => $this->getControllerNameWithoutNamespace(),
            'LOWER_NAME' => $module->getLowerName(),
            'MODULE' => $this->getModuleName(),
            'NAME' => $this->getModuleName(),
            'STUDLY_NAME' => $module->getStudlyName(),
            'MODULE_NAMESPACE' => $this->laravel['modules']->config('namespace'),
        ]))->render();
    }

    /**
     * Get the stub file name based on the options
     * @return string
     */
    protected function getStubName()
    {
        if ($this->option('resource') === true && !$this->option('api')) {
            $stub = '/controller-resource.stub';
        } elseif ($this->option('api') === true && $this->option('resource')) {
            $stub = '/controller-api-resource.stub';
        } else {
            $stub = '/controller.stub';
        }

        return $stub;
    }

    /**
     * @return array|string
     */
    private function getControllerNameWithoutNamespace()
    {
        return class_basename($this->getControllerName());
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['controller', InputArgument::REQUIRED, 'The name of the controller class.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['resource', 'r', InputOption::VALUE_NONE, 'Generate a resource controller', null],
            ['web', 'w', InputOption::VALUE_NONE, 'Generate a controller into Web directory.'],
            ['api', 'a', InputOption::VALUE_NONE, 'Generate a controller into Api directory and exclude the create and edit methods from the controller.'],
        ];
    }
}
