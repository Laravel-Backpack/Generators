<?php

namespace Backpack\Generators\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class CrudRequestBackpackCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backpack:crud-request';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:crud-request {name} {folder?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Backpack CRUD request';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Request';

    /**
     * Get the destination class path.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);
        $path = $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Request.php';
        if ($this->hasArgument('folder')) {
            $folderName = ucfirst($this->argument('folder'));
            $path = $this->laravel['path'].'/'.$folderName.'/'.str_replace('\\', '/', $name).'Request.php';
        }
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'Request.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/../stubs/crud-request.stub';
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
        $currentNamespace = $rootNamespace.'\Http\Requests';
        if ($this->hasArgument('folder')) {
            $folderName = ucfirst($this->argument('folder'));
            $currentNamespace =$rootNamespace.'\Http\Requests\\'.$folderName;

        }
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
