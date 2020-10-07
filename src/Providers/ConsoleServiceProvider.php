<?php

namespace Codemen\Modules\Providers;

use Codemen\Modules\Commands\CommandMakeCommand;
use Codemen\Modules\Commands\ControllerMakeCommand;
use Codemen\Modules\Commands\DisableCommand;
use Codemen\Modules\Commands\DumpCommand;
use Codemen\Modules\Commands\EnableCommand;
use Codemen\Modules\Commands\EventMakeCommand;
use Codemen\Modules\Commands\FactoryMakeCommand;
use Codemen\Modules\Commands\JobMakeCommand;
use Codemen\Modules\Commands\LaravelModulesV6Migrator;
use Codemen\Modules\Commands\ListCommand;
use Codemen\Modules\Commands\ListenerMakeCommand;
use Codemen\Modules\Commands\MailMakeCommand;
use Codemen\Modules\Commands\MiddlewareMakeCommand;
use Codemen\Modules\Commands\MigrateCommand;
use Codemen\Modules\Commands\MigrateRefreshCommand;
use Codemen\Modules\Commands\MigrateResetCommand;
use Codemen\Modules\Commands\MigrateRollbackCommand;
use Codemen\Modules\Commands\MigrateStatusCommand;
use Codemen\Modules\Commands\MigrationMakeCommand;
use Codemen\Modules\Commands\ModelMakeCommand;
use Codemen\Modules\Commands\ModuleDeleteCommand;
use Codemen\Modules\Commands\ModuleMakeCommand;
use Codemen\Modules\Commands\NotificationMakeCommand;
use Codemen\Modules\Commands\PolicyMakeCommand;
use Codemen\Modules\Commands\ProviderMakeCommand;
use Codemen\Modules\Commands\RequestMakeCommand;
use Codemen\Modules\Commands\ResourceMakeCommand;
use Codemen\Modules\Commands\RouteProviderMakeCommand;
use Codemen\Modules\Commands\RuleMakeCommand;
use Codemen\Modules\Commands\SeedCommand;
use Codemen\Modules\Commands\SeedMakeCommand;
use Codemen\Modules\Commands\ServiceMakeCommand;
use Codemen\Modules\Commands\ViewMakeCommand;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * The available commands
     *
     * @var array
     */
    protected $commands = [
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        FactoryMakeCommand::class,
        PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        SeedCommand::class,
        SeedMakeCommand::class,
        ResourceMakeCommand::class,
        ServiceMakeCommand::class,
        ViewMakeCommand::class
    ];

    /**
     * Register the commands.
     */
    public function register()
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides()
    {
        $provides = $this->commands;

        return $provides;
    }
}
