<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Str;
use InvalidArgumentException;


class GeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = null;
        $model = $this->ask('Model name');
        $this->checkInvalid($model);

        if ($this->confirm('Need to create controller ?')) {
            $this->call('make:controller', ['name' => $model."Controller","-r"=>$model]);
        }
        
        $this->call('make:repository', ['name' => $model."Repository","-m"=>$model]);

        $this->call('make:modification', ['name' => "Create".$model."Modification","-c"=>$model]);
        $this->call('make:modification', ['name' => "Delete".$model."Modification","-d"=>$model]);
        $this->call('make:modification', ['name' => "Update".$model."Modification","-u"=>$model]);

    }

    protected function checkInvalid($model)
    {
        $parentModelClass = $this->parseModel($model);
        if (! class_exists($parentModelClass)) {
            if ($this->confirm("A {$parentModelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $parentModelClass]);
            }
        }
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
}
