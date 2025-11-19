<?php

namespace Backpack\Generators\Console\Commands\Views;

use Backpack\CRUD\ViewNamespaces;
use Illuminate\Support\Str;

class ChipBackpackCommand extends PublishOrCreateViewBackpackCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'backpack:chip';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:chip {name?} {--from=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a Backpack chip';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Chip';

    /**
     * View Namespace.
     *
     * @var string
     */
    protected $viewNamespace = 'chips';

    /**
     * Stub file name.
     *
     * @var string
     */
    protected $stub = 'chip.stub';

    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->setupChipSourceFile();

        if ($this->sourceFile === false) {
            return false;
        }

        $name = Str::of($this->getNameInput());
        $path = Str::of($this->getPath($name));
        $pathRelative = $path->after(base_path())->replace('\\', '/')->trim('/');

        $this->infoBlock("Creating {$name->replace('_', ' ')->title()} {$this->type}");
        $this->progressBlock("Creating view <fg=blue>{$pathRelative}</>");

        if ($this->alreadyExists($name)) {
            $this->closeProgressBlock('Already existed', 'yellow');

            return false;
        }

        $this->makeDirectory($path);

        if ($this->sourceFile) {
            $this->files->copy($this->sourceFile, $path);
        } else {
            $this->files->put($path, $this->buildClass($name));
        }

        $this->closeProgressBlock();
    }

    /**
     * Setup the source file for the --from option.
     * This method extends the parent functionality to also look in vendor chip directories.
     */
    private function setupChipSourceFile()
    {
        if ($this->option('from')) {
            $from = $this->option('from');

            // First, try the standard view namespaces (parent behavior)
            $namespaces = ViewNamespaces::getFor($this->viewNamespace);
            foreach ($namespaces as $namespace) {
                $viewPath = "$namespace.$from";

                if (view()->exists($viewPath)) {
                    $this->sourceFile = view($viewPath)->getPath();
                    $this->sourceViewNamespace = $viewPath;

                    return;
                }
            }

            // Second, check vendor chip directory
            $vendorChipPath = base_path("vendor/backpack/crud/src/resources/views/crud/chips/{$from}.blade.php");
            if (file_exists($vendorChipPath)) {
                $this->sourceFile = $vendorChipPath;

                // Don't set sourceViewNamespace so it uses the default path logic
                return;
            }

            // Third, try full or relative file paths (parent behavior)
            if (file_exists($from)) {
                $this->sourceFile = realpath($from);

                return;
            }
            // remove the first slash to make absolute paths relative in unix systems
            elseif (file_exists(substr($from, 1))) {
                $this->sourceFile = realpath(substr($from, 1));

                return;
            }

            // If nothing found, show error
            $this->errorProgressBlock();
            $this->note("$this->type '$from' does not exist!", 'red');
            $this->newLine();

            $this->sourceFile = false;
        }
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        if ($this->sourceViewNamespace) {
            $themePath = Str::contains($this->sourceViewNamespace, '::') ?
                            Str::before($this->sourceViewNamespace, '::') :
                            Str::beforeLast($this->sourceViewNamespace, '.');

            $themePath = Str::replace('.', '/', $themePath);

            $path = 'views/vendor/'.$themePath.'/'.$this->viewNamespace.'/'.$name.'.blade.php';

            return resource_path($path);
        }

        $path = 'views/vendor/backpack/crud/'.$this->viewNamespace.'/'.$name.'.blade.php';

        return resource_path($path);
    }
}
