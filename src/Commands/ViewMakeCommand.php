<?php

namespace Codemen\Modules\Commands;

use Illuminate\Support\Str;
use Codemen\Modules\Support\Config\GenerateConfigReader;
use Codemen\Modules\Support\Migrations\NameParser;
use Codemen\Modules\Support\Migrations\SchemaParser;
use Codemen\Modules\Support\Stub;
use Codemen\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ViewMakeCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-view';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The view name will be created.'],
            ['module', InputArgument::OPTIONAL, 'The name of module will be created.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['list', 'l', InputOption::VALUE_OPTIONAL, 'Create list view.', null],
        ];
    }


    protected function getTemplateContents()
    {
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());

        if ($this->option('list')) {
            return Stub::create('/views/index.stub',[
                'MODULE_NAME' => $module->getLowerName(),
            ]);
        }

        return Stub::create('/views/plain.stub');
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = GenerateConfigReader::read('views');

        return $path . $generatorPath->getPath() . '/' . $this->getFileName() . '.blade.php';
    }

}
