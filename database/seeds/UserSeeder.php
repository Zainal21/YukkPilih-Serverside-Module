<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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

        \App\user::create([
            'username' => 'user',
            'password' => bcrypt('user'),
            'role' => 'user',
            'division_id' => 1
        ]);
        
        \App\user::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'division_id' => 2
        ]);
        
        \App\Poll::create([
           'title' => 'Mau Makan apa hari ini ?',
           'description' => '
           Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus vitae accusamus asperiores! Doloremque doloribus rerum quam deserunt, quis quae dolorem ut similique nisi ipsa adipisci expedita qui, provident optio magnam!',
           'deadline' => '2021-02-26 15:42:11', 
           'created_by' => 1,
        ]);

        \App\Choice::create([
            'choices' => 'bubur',
            'poll_id' => 1
        ]);

        \App\Choice::create([
            'choices' => 'nasi goreng',
            'poll_id' => 1
        ]);
    }
}
