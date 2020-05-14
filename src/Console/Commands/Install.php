<?php

namespace Ramivel\Multiauth\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ramivel:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will publishing migration and factories, running all migration and seeding initial super admin with role and permissions.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->publishAssets();

        $this->runMigration();

        $this->seedSuperAdmin();

        $this->runSeed();

        $this->publishAndCompileUI();
    }

    protected function publishAssets()
    {
        $this->warn('1. Publishing Configurations');
        Artisan::call('vendor:publish --tag=ramivel:publish');
        $this->info(Artisan::output());

    }

    protected function runMigration()
    {
        $this->warn('2. Running Migrations');
        Artisan::call('migrate');
        $this->info(Artisan::output());
    }

    protected function seedSuperAdmin()
    {
        $this->warn('3. Seeding New Super Admin');
        Artisan::call('multiauth:seed --role=super');
        $this->info(Artisan::output());
    }

    protected function runSeed()
    {
        $this->warn('4. Seeding New Super Admin');
        Artisan::call('db:seed');
        $this->info(Artisan::output());
    }

    protected function publishAndCompileUI()
    {
        $this->warn('5. Publishing UI bootstrap copmonent');
        Artisan::call('ui bootstrap');
        $this->info(Artisan::output());
        $this->warn('Running npm, please wait...');
        $this->info(shell_exec('npm install && npm run dev'));
    }
}
