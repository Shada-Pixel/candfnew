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
            'name' => 'Raju Ahmed',
            'email' => 'associationbpl@gmail.com',
            'password' => Hash::make('admin123cnf'),
        ]);
        $adminrole = Role::where('name','admin')->first();
        $adminuser->assignRole([$adminrole->id]);


        // developer user
        $developreuser = User::create([
            'name' => 'Sabbir',
            'email' => 'hussainasabbir3@gmail.com',
            'password' => Hash::make('admin123cnf'),
        ]);
        $developerrole = Role::where('name','developer')->first();
        $developreuser->assignRole([$developerrole->id]);


        // Accountant user
        $accountant = User::create([
            'name'=>'Muntasir',
            'email'=>'muntasiralmamun@gmail.com',
            'password'=> Hash::make('muntasir123cnf')
        ]);
        $accountantrole = Role::where('name','accountant')->first();
        $accountant->assignRole([$accountantrole->id]);


        // Creating operators
        $operators = [
            ['name' => 'MD.RASHADUR  RAHMAN RIAD', 'email' => 'reyad.bpl@gmail.com', 'password' => 'rashedur123cnf'],
            ['name' => 'MOHON BISWAS', 'email' => 's.mohon108@gmail.com', 'password' => 'mohon123cnf'],
            ['name' => 'IMON HOSSAIN', 'email' => 'imondti2014@gmail.com', 'password' => 'imon123cnf'],
            ['name' => 'MD. HABIBUR RAHMAN', 'email' => 'habibdti@gmail.com', 'password' => 'habibur123cnf'],
            ['name' => 'FARHANA YESMEEN  HIRA', 'email' => 'farhanahira.bpl@gmail.com', 'password' => 'hira123cnf'],
            ['name' => 'ABDULLAH AL MAMUN SHUVO', 'email' => 'shuvodti@gmail.com', 'password' => 'shuvo123cnf'],
            ['name' => 'SHEAK FAYSAL', 'email' => 'faysaldti@gmail.com', 'password' => 'faysal123cnf']
        ];

        $operatorRole = Role::where('name', 'operator')->first();

        if ($operatorRole) {
            foreach ($operators as $operator) {
                $newOperator = User::updateOrCreate(
                    ['email' => $operator['email']], // Check if user already exists by email
                    [
                        'name' => $operator['name'],
                        'password' => Hash::make($operator['password']), // Hash password securely
                    ]
                );

                $newOperator->assignRole($operatorRole);
            }
        }

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
            'email'=>'dtibranch@gmail.com',
            'password'=> Hash::make('extra123cnf')
        ]);
        $extrarole = Role::where('name','extra')->first();
        $extra->assignRole([$extrarole->id]);

    }
}
