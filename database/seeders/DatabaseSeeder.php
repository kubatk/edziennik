<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users=[
            'first_name' => ['Marian', 'Katarzyna', 'Tomasz', 'Elżbieta'],
            'last_name' => ['Kopytko', 'Górka', 'Walec', 'Walec'],
            'address' => ['Podkarpacka 13', 'Kopernika 29', 'Słoneczna 14/8', 'Słoneczna 14/8'],
            'class' => [NULL, NULL, 1, NULL],
            'group' => ['H', 'T', 'S', 'P'],
            'account_code' => ['demo1', 'demo2', 'demo3', 'demo4'],
            'email' => ['marian@szkola.pl','kasia@szkola.pl','tomek@szkola.pl','ela@szkola.pl'],
            'password' => Hash::make('demo'),
        ];

        for($i=0; $i<4; $i++){
            DB::table('user_data')->insert([
                'first_name' => $users['first_name'][$i],
                'last_name' => $users['last_name'][$i],
                'address' => $users['address'][$i],
                'class' => $users['class'][$i],
                'group' => $users['group'][$i],
                'account_code' => $users['account_code'][$i],
            ]);

            DB::table('users')->insert([
                'email' => $users['email'][$i],
                'password' => $users['password'],
                'user' => $i+1,
            ]);
        }

    }
}
