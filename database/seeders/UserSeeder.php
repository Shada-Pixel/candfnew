<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // admin user
        $adminuser = User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('admin123'),
        ]);
        $adminrole = Role::where('name','admin')->first();
        $adminuser->assignRole([$adminrole->id]);


        // user  reciver user
        $reciver = User::create([
            'name'=>'Receiver',
            'email'=>'receiver@app.com',
            'password'=> Hash::make('user123')
        ]);
        $reciverrole = Role::where('name','receiver')->first();
        $reciver->assignRole([$reciverrole->id]);

        // user  operator user
        $operator = User::create([
            'name'=>'Operator',
            'email'=>'operator@app.com',
            'password'=> Hash::make('user123')
        ]);
        $operatorrole = Role::where('name','operator')->first();
        $operator->assignRole([$operatorrole->id]);



        // user  deliver user
        $deliver = User::create([
            'name'=>'Deliver',
            'email'=>'deliver@app.com',
            'password'=> Hash::make('user123')
        ]);
        $deliverrole = Role::where('name','deliver')->first();
        $deliver->assignRole([$deliverrole->id]);

        // user  extra user
        $extra = User::create([
            'name'=>'Extra',
            'email'=>'extra@app.com',
            'password'=> Hash::make('user123')
        ]);
        $extrarole = Role::where('name','extra')->first();
        $extra->assignRole([$extrarole->id]);

    }
}
