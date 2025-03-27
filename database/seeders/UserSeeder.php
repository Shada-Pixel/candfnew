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
        $users = [
            [
                'name' => 'Raju Ahmed',
                'email' => 'associationbpl@gmail.com',
                'password' => 'admin123cnf',
                'role' => 'admin',
            ],
            [
                'name' => 'Sabbir',
                'email' => 'hussainasabbir3@gmail.com',
                'password' => 'admin123cnf',
                'role' => 'developer',
            ],
            [
                'name' => 'Muntasir',
                'email' => 'muntasiralmamun@gmail.com',
                'password' => 'muntasir123cnf',
                'role' => 'accountant',
            ],
            [
                'name' => 'Deliver',
                'email' => 'deliver@app.com',
                'password' => 'user123',
                'role' => 'deliver',
            ],
            [
                'name' => 'Extra',
                'email' => 'dtibranch@gmail.com',
                'password' => 'extra123cnf',
                'role' => 'extra',
            ],
        ];

        foreach ($users as $userData) {
            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user = User::updateOrCreate(
                    ['email' => $userData['email']],
                    [
                        'name' => $userData['name'],
                        'password' => Hash::make($userData['password']),
                    ]
                );
                $user->assignRole([$role->id]);
            }
        }

        $operators = [
            ['name' => 'MD.RASHADUR  RAHMAN RIAD', 'email' => 'reyad.bpl@gmail.com', 'password' => 'rashedur123cnf'],
            ['name' => 'MOHON BISWAS', 'email' => 's.mohon108@gmail.com', 'password' => 'mohon123cnf'],
            ['name' => 'IMON HOSSAIN', 'email' => 'imondti2014@gmail.com', 'password' => 'imon123cnf'],
            ['name' => 'MD. HABIBUR RAHMAN', 'email' => 'habibdti@gmail.com', 'password' => 'habibur123cnf'],
            ['name' => 'FARHANA YESMEEN  HIRA', 'email' => 'farhanahira.bpl@gmail.com', 'password' => 'hira123cnf'],
            ['name' => 'ABDULLAH AL MAMUN SHUVO', 'email' => 'shuvodti@gmail.com', 'password' => 'shuvo123cnf'],
            ['name' => 'SHEAK FAYSAL', 'email' => 'faysaldti@gmail.com', 'password' => 'faysal123cnf'],
        ];

        $operatorRole = Role::where('name', 'operator')->first();

        if ($operatorRole) {
            foreach ($operators as $operator) {
                $newOperator = User::updateOrCreate(
                    ['email' => $operator['email']],
                    [
                        'name' => $operator['name'],
                        'password' => Hash::make($operator['password']),
                    ]
                );
                $newOperator->assignRole($operatorRole);
            }
        }
    }
}
