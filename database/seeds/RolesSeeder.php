<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $system = new Role();
        $system->role_name = 'System Admin';
        $system->role_code = 'SYS_ADMIN';
        $system->role_status = 1;
        $system->save();

        $staff = new Role();
        $staff->role_name = 'Staff';
        $staff->role_code = 'STAFF';
        $staff->role_status = 1;
        $staff->save();

        $client = new Role();
        $client->role_name = 'Client';
        $client->role_code = 'CLIENT';
        $client->role_status = 1;
        $client->save();
    }
}
