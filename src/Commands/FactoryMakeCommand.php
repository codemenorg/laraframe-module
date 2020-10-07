<?php

namespace Codemen\Modules\Commands;

use Codemen\Modules\Module;
use Codemen\Modules\Support\Config\GenerateConfigReader;
use Codemen\Modules\Support\Stub;
use Codemen\Modules\Traits\ModuleCommandTrait;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class FactoryMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the factory.'],
            ['module', InputArgument::REQUIRED, 'The name of module will be used.'],
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],
        ];
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());
        $namespaceModel = $this->option('model')
            ? $this->qualifyModel($this->option('model'))
            : $this->qualifyModel($this->guessModelName($this->argument('name')));

        $model = class_basename($namespaceModel);

        return (new Stub('/factory.stub', [
            'CLASS_NAMESPACE' => $this->getClassNamespace($module),
            'CLASS' => $this->getFactoryNameWithoutNamespace(),
            'MODEL' => $model,
            'MODEL_NAMESPACE' => $namespaceModel
        ]))->render();
    }

    /**
     * Qualify the given model class base name.
     *
     * @param string $model
     * @return string
     */
    protected function qualifyModel(string $model)
    {
        $model = ltrim($model, '\\/');

        $model = str_replace('/', '\\', $model);

        $rootNamespace = $this->getModelNamespace();

        if (Str::startsWith($model, $rootNamespace)) {
            return $model;
        }

        return  $rootNamespace . '\\' . $model;
    }

    /**
     * Guess the model name from the Factory name or return a default model name.
     *
     * @param string $name
     * @return string
     */
    protected function guessModelName(string $name)
    {
        if (Str::endsWith($name, 'Factory')) {
            $name = substr($name, 0, -7);
        }

        $modelName = $this->qualifyModel(class_basename($name));

        if (class_exists($modelName)) {
            return $modelName;
        }

        return "{$this->getModelNamespace()}\Model";
    }

    public function getDefaultNamespace(): string
    {
        $module = $this->laravel['modules'];

        return $module->config('paths.generator.factory.namespace') ?: $module->config('paths.generator.factory.path', 'Database/Factories');
    }

    /**
     * @return array|string
     */
    private function getFactoryNameWithoutNamespace()
    {
        return class_basename($this->getFactoryName());
    }

    /**
     * @return array|string
     */
    protected function getFactoryName()
    {
        $factory = Str::studly($this->argument('name'));

        if (Str::contains(strtolower($factory), 'factory') === false) {
            $factory .= 'Factory';
        }

        return $factory;
    }

    /**
     * Get class namespace.
     * @return string
     */
    public function getModelNamespace()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        $namespace = $this->laravel['modules']->config('namespace');

        $namespace .= '\\' . $module->getStudlyName();

        $namespace .= '\\Models';

        $namespace = str_replace('/', '\\', $namespace);

        return trim($namespace, '\\');
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $factoryPath = GenerateConfigReader::read('factory');

        return $path . $factoryPath->getPath() . '/' . $this->getFileName();
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name')) . '.php';
    }
}
