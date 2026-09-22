<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomFileTestSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Change this number for your test
        $totalRecords = 100000;

        // Insert this many records at a time
        $chunkSize = 1000;

        // Get existing agent IDs once
        $agentIds = Agent::pluck('id')->toArray();

        if (empty($agentIds)) {
            $this->command->error('No agents found. Please create some agents first.');
            return;
        }

        $this->command->info("Creating {$totalRecords} Custom Files...");

        for ($i = 0; $i < $totalRecords; $i += $chunkSize) {

            $records = [];

            $currentChunkSize = min(
                $chunkSize,
                $totalRecords - $i
            );

            for ($j = 0; $j < $currentChunkSize; $j++) {

                $records[] = [
                    'name' => $faker->name(),

                    'be_number' => 'BE-' .
                        $faker->unique()->numerify('########'),

                    'fees' => $faker->randomFloat(
                        2,
                        100,
                        100000
                    ),

                    'type' => $faker->randomElement([
                        'Import',
                        'Export',
                        'Transit',
                        'Other',
                    ]),

                    'status' => $faker->randomElement([
                        'Pending',
                        'Processing',
                        'Completed',
                        'Cancelled',
                    ]),

                    'date' => $faker
                        ->dateTimeBetween('-3 years', 'now')
                        ->format('Y-m-d'),

                    'year' => $faker->numberBetween(2023, 2026),

                    'agent_id' => $faker->randomElement($agentIds),

                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('custom_files')->insert($records);

            $inserted = min(
                $i + $currentChunkSize,
                $totalRecords
            );

            $this->command->info(
                "Inserted {$inserted} / {$totalRecords}"
            );
        }

        $this->command->info('Finished!');
    }
}
