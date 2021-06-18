<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Reset cached roles and permissions
       app()[PermissionRegistrar::class]->forgetCachedPermissions();

       // create permissions
       Permission::create(['name' => 'todos']);

       // UACI
       $role1 = Role::create(['name' => 'uaci']);
       $role1->givePermissionTo('todos');
       // UACI
       $role4 = Role::create(['name' => 'jefeuaci']);
       $role4->givePermissionTo('todos');
       //PRESUPUESTO
       $role2 = Role::create(['name' => 'presupuesto']);
       $role2->givePermissionTo('todos');
       //INGENIERIA
       $role3 = Role::create(['name' => 'Formulador']);
       $role3->givePermissionTo('todos');

       User::truncate();

       $user1 = User::create([
           'nombre' => 'Heidi',
           'apellido' => 'Monzon',
           'usuario' => 'uaci',            
           'password' => bcrypt('1234'),
           'telefono' => '24027633'
       ]);

       $user2 = User::create([
           'nombre' => 'Rina',
           'apellido' => 'Tejada',
           'usuario' => 'presupuesto',            
           'password' => bcrypt('1234'),
           'telefono' => '24027665'
       ]);
       $user3 = User::create([
           'nombre' => 'Giovany',
           'apellido' => 'Rosales',
           'usuario' => 'ingenieria',            
           'password' => bcrypt('1234'),
           'telefono' => '75335897'
       ]);
       $user4 = User::create([
        'nombre' => 'Heidi',
        'apellido' => 'Chinchilla',
        'usuario' => 'jefeuaci',            
        'password' => bcrypt('1234'),
        'telefono' => '24027621'
    ]);
     
       $user1->assignRole($role1);
       $user2->assignRole($role2);
       $user3->assignRole($role3);
       $user4->assignRole($role4);
    }
}
