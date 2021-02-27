<?php

use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Division::create([
            'name' => 'IT'
        ]);
        \App\Division::create([
            'name' => 'HR'
        ]);
    }
}
