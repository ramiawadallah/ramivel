<?php

namespace Ramivel\Application\Console\Commands;

use Illuminate\Console\Command;

class SeedCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ramivel:seed {--r|role=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed one super admin for multiauth package
                            {--role= : Give any role name to create new role}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->roleModel            = config('multiauth.models.role');
        $this->adminModel           = config('multiauth.models.admin');
        $this->permissionModel      = config('multiauth.models.permission');
        $this->settingModel         = config('multiauth.models.setting');
        $this->langModel            = config('multiauth.models.lang');
        $this->PageModel            = config('multiauth.models.page');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->superAdminExists()) {
            $this->error('admin with email "super@admin.com" already exists!');
            return ;
        }

        if ($this->settingExists()) {
            $this->error('Setting are already exists!');
            return ;
        }

        $rolename = $this->option('role');
        if (!$rolename) {
            $this->error("please provide role as --role='roleName'");
            return;
        }

        $role      = $this->roleModel::whereName($rolename)->first();
        $admin     = $this->createSuperAdmin($role, $rolename);
        $admin     = $this->createFirstSetting();
        $admin     = $this->createMainLanguage();
        $admin     = $this->createFirstPage();

        $this->info("You have created an admin name '{$admin->name}' with role of '{$admin->roles->first()->name}' ");
        $this->info("Now log-in with {$admin->email} email and password as 'secret123'");
    }

    protected function createSuperAdmin($role, $rolename)
    {
        $prefix = config('multiauth.prefix');
        $admin  = $this->adminModel::create([
            'email'    => "super@{$prefix}.com",
            'name'     => 'Super ' . ucfirst($prefix),
            'password' => bcrypt('secret123'),
            'active'   => true,
        ]);
        if (!$role) {
            $role = $this->roleModel::create(['name' => $rolename]);
            $this->createAndLinkPermissionsTo($role);
        }
        $admin->roles()->attach($role);

        return $admin;
    }

    protected function createFirstSetting()
    {
        $setting = $this->settingModel::create([
            'title' => 'Ramivel',
            'subtitle' => 'Ramivel CMS',
            'email' => 'rami.moh.awadallah@gmail.com',
            'phone' => null,
            'address' => null,
            'fax' => null,
            'pobox' => '11118',
            'map' => null,
            'mainvideo' => null,
            // About your website
            'content' => null,
            'logo' => null,
            'icon' => null,
            'maintenance' => null,
            'keywords' => null,
            'copyright' => null,
            // Social media
            'facebook' => null,
            'twitter' => null,
            'instagram' => null,
            'linkedin' => null,
            'youtube' => null,

            'theme' => 'modern',

            'updated_by' => 'admin'
        ]);

        return $setting;
    }

    protected function createMainLanguage()
    {
        $lang = $this->langModel::create([
            'name'      =>  'English',
            'code'      =>  'en',
            'direction' =>  'ltr',
            'default'   =>  1,
        ]);

        return $lang;
    }

    protected function createFirstPage()
    {
        $page = $this->PageModel::create([
            'title'     => 'Home',
            'content'   => 'What is Lorem Ipsum?
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'uri'       => '/',
            'template'  => 'home',
            'status'    => 'active',
        ]);

        return $page;
    }

    protected function createAndLinkPermissionsTo($role)
    {
        $models        = ['Admin', 'Role'];
        $tasks         = ['Create', 'Read', 'Update', 'Delete'];
        foreach ($tasks as $task) {
            foreach ($models as $model) {
                $name       = "{$task}{$model}";
                $permission = $this->permissionModel::create(['name' => $name, 'parent'=>$model]);
                $role->addPermission([$permission->id]);
            }
        }
    }

    public function superAdminExists()
    {
        return $this->adminModel::where('email', 'super@admin.com')->exists();
    }

    public function settingExists()
    {
        return $this->settingModel::where('id', 1)->exists(); 
    }
}
