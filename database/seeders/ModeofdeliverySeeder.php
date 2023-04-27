<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModeofdeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('streets')->insert([
            [
                'mod' => 'Deliver',
                'fee' => 50,
            ],
            [
                'mod' => 'Pickup',
                'fee' => 0,
            ],
        ]);
    }
}
