<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $routes = Route::getRoutes()->getRoutes();

        foreach ($routes as $route) {
            if (! array_key_exists('middleware', $route->getAction())) { continue; }

            if ($route->getName() != '' && $route->getAction()['middleware']['0'] == 'web') {
                $permission = Permission::where('name', $route->getName())->first();

                if (is_null($permission)) {
                    Permission::create(['name' => $route->getName()]);
                }
            }
        }

        $this->info('Permission routes added successfully.');
    }
}
