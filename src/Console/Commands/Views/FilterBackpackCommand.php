<?php

namespace Backpack\Generators\Console\Commands\Views;

use Illuminate\Support\Str;

class FilterBackpackCommand extends PublishOrCreateViewBackpackCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backpack:filter';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:filter {name?} {--from=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Backpack filter';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Filter';

    /**
     * View Namespace.
     *
     * @var string
     */
    protected $viewNamespace = 'filters';

    /**
     * Stub file name.
     *
     * @var string
     */
    protected $stub = 'filter.stub';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $name = Str::of($name)->camel()->ucfirst()->value();
        $stub = $this->files->get($this->getStub());
        $stub = str_replace('__FILTER_NAME__', $name, $stub);

        return $stub;
    }
}
