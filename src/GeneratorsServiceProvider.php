<?php

namespace Backpack\Generators;

use Backpack\Generators\Console\Commands\BuildBackpackCommand;
use Backpack\Generators\Console\Commands\ChartBackpackCommand;
use Backpack\Generators\Console\Commands\ChartControllerBackpackCommand;
use Backpack\Generators\Console\Commands\ConfigBackpackCommand;
use Backpack\Generators\Console\Commands\CrudBackpackCommand;
use Backpack\Generators\Console\Commands\CrudControllerBackpackCommand;
use Backpack\Generators\Console\Commands\CrudFormOperationBackpackCommand;
use Backpack\Generators\Console\Commands\CrudModelBackpackCommand;
use Backpack\Generators\Console\Commands\CrudOperationBackpackCommand;
use Backpack\Generators\Console\Commands\CrudRequestBackpackCommand;
use Backpack\Generators\Console\Commands\ModelBackpackCommand;
use Backpack\Generators\Console\Commands\PageBackpackCommand;
use Backpack\Generators\Console\Commands\PageControllerBackpackCommand;
use Backpack\Generators\Console\Commands\RequestBackpackCommand;
use Backpack\Generators\Console\Commands\ViewBackpackCommand;
use Backpack\Generators\Console\Commands\Views\ButtonBackpackCommand;
use Backpack\Generators\Console\Commands\Views\ChipBackpackCommand;
use Backpack\Generators\Console\Commands\Views\ColumnBackpackCommand;
use Backpack\Generators\Console\Commands\Views\FieldBackpackCommand;
use Backpack\Generators\Console\Commands\Views\FilterBackpackCommand;
use Backpack\Generators\Console\Commands\Views\WidgetBackpackCommand;
use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider
{
    protected $commands = [
        BuildBackpackCommand::class,
        ButtonBackpackCommand::class,
        ChipBackpackCommand::class,
        ColumnBackpackCommand::class,
        ConfigBackpackCommand::class,
        CrudModelBackpackCommand::class,
        CrudControllerBackpackCommand::class,
        ChartControllerBackpackCommand::class,
        CrudOperationBackpackCommand::class,
        CrudFormOperationBackpackCommand::class,
        CrudRequestBackpackCommand::class,
        CrudBackpackCommand::class,
        ChartBackpackCommand::class,
        FieldBackpackCommand::class,
        FilterBackpackCommand::class,
        ModelBackpackCommand::class,
        PageBackpackCommand::class,
        PageControllerBackpackCommand::class,
        RequestBackpackCommand::class,
        ViewBackpackCommand::class,
        WidgetBackpackCommand::class,
    ];

    public function boot(): void
    {
        $this->commands($this->commands);

        $this->publishes([
            __DIR__.'/Console/stubs' => base_path('stubs/backpack/generators'),
        ], 'backpack-generators-stubs');
    }
}
