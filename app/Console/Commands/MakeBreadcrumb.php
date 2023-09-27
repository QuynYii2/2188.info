<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeBreadcrumb extends Command
{
    protected $signature = 'make:breadcrumb {name}';
    protected $description = 'Create a new breadcrumb';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $breadcrumbName = ucfirst($name) . 'Breadcrumb';

        Artisan::call('make:file', [
            'name' => "Breadcrumbs -> {$breadcrumbName}",
        ]);

        $this->info("Breadcrumb '{$breadcrumbName}' created successfully.");
    }
}
