<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Fak\Factory as Faker;


class Address extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 400; $i++) {
            DB::table('addresses')->insert([
                'city' => Str::random(15),
                'street' => Str::random(6),
                'customer_id' => mt_rand(1, 100),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        $this->command->info('Address seeding successful.');
    }
}
