<?php

namespace Backpack\Generators\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class RequestBackpackCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backpack:make:request';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:make:request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a backpack templated request';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/request.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }
}
