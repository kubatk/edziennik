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
            'account_code' => ['vcq6C4', 'G2vcre', 'Cdwo3j', 'Pclp7d'],
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
        
        //classes
        DB::table('classes')->insert([
            'name'=>'2A',
            'school_year'=>'2022/2023',
        ]);

        //lessons
        DB::table('lessons')->insert([
            'name'=>'język polski',
            'school_year'=>'2022/2023',
            'lecturer'=>2,
            'class'=>1,
        ]);

        //marks
        $marks = [
            'sign'=>['6+', '6', '6-', '5+', '5', '5-', '4+', '4', '4-', '3+', '3', '3-', '2+', '2', '2-', '1+', '1', '1-', '0', 'bz', 'np'],
            'name'=>['plus celujący', 'celujący', 'minus celujący', 'plus bardzo dobry', 'bardzo dobry', 'minus bardzo dobry', 'plus dobry', 'dobry', 'minus dobry', 'plus dostateczny', 'dostateczny', 'minus dostateczny', 'plus dopuszczający', 'dopuszczający', 'minus dopuszczający', 'plus niedostateczny', 'niedostateczny', 'minus niedostateczny', 'nie przystąpił/a', 'brak zadania', 'nieprzygotowany'],
            'value'=>[6.25, 6, 5.75, 5.25, 5, 4.75, 4.25, 4, 3.75, 3.25, 3, 2.75, 2.25, 2, 1.75, 1.25, 1, 0.75, 0, 0, 0],
        ];
        for($i=0; $i<count($marks['sign']); $i++) {
            DB::table('marks')->insert([
                'sign'=>$marks['sign'][$i],
                'name'=>$marks['name'][$i],
                'value'=>$marks['value'][$i],
            ]);
        }

        //attendance_status
        $presence = [
            'name'=>['Obecność', 'Nieobecność nieusprawiedliwiona', 'Nieobecność usprawiedliwiona', 'Zwolnienie', 'Spóźnienie'],
            'sign'=>['+', '—', 'U', 'Z', 'S'],
            'presence'=>[1, 0, 0, 1, 1],
        ];
        for($i=0; $i<count($presence['name']); $i++) {
            DB::table('presence_status')->insert([
                'name'=>$presence['name'][$i],
                'sign'=>$presence['sign'][$i],
                'presence'=>$presence['presence'][$i],
            ]);
        }

    }
}
