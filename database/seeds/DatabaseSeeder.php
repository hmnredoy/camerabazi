<?php

use App\Models\Location;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // Reset cached roles and permissions
//        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
//
//        Permission::query()->delete();
//        Role::query()->delete();
//
//        // create permissions
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'publish articles']);
//        Permission::create(['name' => 'unpublish articles']);
//
//        // create roles and assign created permissions
//
//        // this can be done as separate statements
//        $role = Role::create(['name' => 'writer']);
//        $role->givePermissionTo('edit articles');
//
//        // or may be done by chaining
//        $role = Role::create(['name' => 'moderator'])
//            ->givePermissionTo(['publish articles', 'unpublish articles']);
//
//        $role = Role::create(['name' => 'super-admin']);
//        $role->givePermissionTo(Permission::all());
        $this->call(JobSeeder::class);
        /*$this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        factory(Location::class,10)->create();
        $this->call(TestSeeder::class);*/

    }
}
