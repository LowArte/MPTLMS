<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;
use InvalidArgumentException;
use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;

class ModificationMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:modification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new modification class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Modification';

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('create')) {
            $replace = $this->buildModelReplacements("create");

        }
        elseif ($this->option('update')) {
            $replace = $this->buildModelReplacements("update");

        }
        elseif ($this->option('delete')) {
            $replace = $this->buildModelReplacements("delete");
        }

        $replace["use {$controllerNamespace}{$this->getDefaultPath()};\n"] = '';

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
        /**
     * Build the replacements for a model controller.
     *
     * @return array
     */
    protected function buildModelReplacements($modelName)
    {
        $parentModelClass = $this->parseModel($this->option($modelName));
        if (! class_exists($parentModelClass)) {
            if ($this->confirm("A {$parentModelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $parentModelClass]);
            }
        }

        return [
            'DummyFullModelClass' => $parentModelClass,
            'DummyModel' => $this->option($modelName),
            'DummyVariableModel' => Str::lower($this->option($modelName)),
        ];
    }
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = null;

        if ($this->option('create')) {
            $stub = '/stubs/modification.create.stub';
        }
        else if ($this->option('delete')) {
            $stub = '/stubs/modification.delete.stub';
        }
        else if ($this->option('update')) {
            $stub = '/stubs/modification.update.stub';
        }

        $stub = $stub ??  '/stubs/modification.create.stub';

        return __DIR__ . $stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . $this->getDefaultPath();
    }
    
        /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultPath()
    {
        $path = null;
        if ($this->option('create')) {
            $path = '\Modifications\Create';
        }
        elseif ($this->option('update')) {
            $path = '\Modifications\Update';
        }
        elseif ($this->option('delete')) {
            $path = '\Modifications\Delete';
        }

        $path = $path ??  '\Modifications';

        return $path;
    }
    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        if (!Str::startsWith($model, $rootNamespace = $this->laravel->getNamespace().'Models\\')) {
            $model = $rootNamespace . $model;
        }

        return $model;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['create', 'c', InputOption::VALUE_OPTIONAL, 'Generate a modification only create'],
            ['delete', 'd', InputOption::VALUE_OPTIONAL, 'Generate a modification only delete'],
            ['update', 'u', InputOption::VALUE_OPTIONAL, 'Generate a modification only update'],
        ];
    }
}
