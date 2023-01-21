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
            'first_name' => ['Marian', 'Katarzyna', 'Tomasz', 'Opiekun ucznia'],
            'last_name' => ['Rejewski', 'Nosowska', 'Karolak', 'Tomasz Karolak'],
            'address' => ['Podkarpacka 13', 'Kopernika 29', 'Słoneczna 14/8', null],
            'class' => [NULL, NULL, 1, NULL],
            'group' => ['H', 'T', 'S', 'P'],
            'children'=>[null, null, null, 3],
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
                'children' => $users['children'][$i],
                'account_code' => $users['account_code'][$i],
            ]);

            DB::table('users')->insert([
                'email' => $users['email'][$i],
                'password' => $users['password'],
                'user' => $i+1,
            ]);
        }

        //user data
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (5, 'Beata', 'Kozidrak', 'Sławna 16', 1, NULL, 'S', 'jb1vnf');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (6, 'Opiekun ucznia', 'Beata Kozidrak', NULL, NULL, 5, 'P', 'A82UsS');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (7, 'Adam', 'Kowalczyk', 'Kolejowa 13', NULL, NULL, 'T', 'OPNedo');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (8, 'Joanna', 'Zielińska', 'Przestrzenna 7/10', NULL, NULL, 'T', 'otgGsS');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (9, 'Daria', 'Wysocka', 'Poziomkowa 4', NULL, NULL, 'T', 'oTf5B6');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (10, 'Kacper', 'Bednarski', 'Żelazna 312', NULL, NULL, 'T', 'IoBOM1');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (11, 'Dominik', 'Pawłowski', 'Krótka 2/12', NULL, NULL, 'T', 'ItqWDH');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (12, 'Agata', 'Gajewska', 'Pogodna 8', NULL, NULL, 'T', '3zseOT');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (13, 'Michał', 'Wiśniewski', 'Zawiła 14/7', 1, NULL, 'S', 'DQ49Yk');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (14, 'Opiekun ucznia', 'Michał Wiśniewski', NULL, NULL, 13, 'P', 'Kb4zMB');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (15, 'Magda', 'Gessler', 'Kuchenna 39', 1, NULL, 'S', 'OiHrWA');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (16, 'Opiekun ucznia', 'Magda Gessler', NULL, NULL, 15, 'P', 'id2p97');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (17, 'Agata', 'Kulesza', 'Przyjacielska 2', 1, NULL, 'S', 'LN6ScR');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (18, 'Opiekun ucznia', 'Agata Kulesza', NULL, NULL, 17, 'P', 'xM6uCK');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (19, 'Dorota', 'Rabczewska', 'Muzyczna 40/12', 1, NULL, 'S', 'HLE4PV');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (20, 'Opiekun ucznia', 'Dorota Rabczewska', NULL, NULL, 19, 'P', '9Rb1du');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (21, 'Barbara', 'Kurdej-Szatan', 'Piekielna 7', 2, NULL, 'S', 'l9ymdH');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (22, 'Opiekun ucznia', 'Barbara Kurdej-Szatan', NULL, NULL, 21, 'P', 'TI0aG7');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (23, 'Katarzyna', 'Rooijens-Szczot', 'Długa 634', 1, NULL, 'S', '4rXjtS');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (24, 'Opiekun ucznia', 'Katarzyna Rooijens-Szczot', NULL, NULL, 23, 'P', 'n4EAjD');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (25, 'Cezary', 'Pazura', 'Filmowa 4', 2, NULL, 'S', 'QNzgZw');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (26, 'Opiekun ucznia', 'Cezary Pazura', NULL, NULL, 25, 'P', '21GdW6');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (28, 'Małgorzata', 'Socha', 'Malinowa 4', 2, NULL, 'S', 'Sl2PuN');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (29, 'Opiekun ucznia', 'Małgorzata Socha', NULL, NULL, 28, 'P', 'ZMvJyd');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (30, 'Remigiusz', 'Mróz', 'Kryminalna 9/25', 2, NULL, 'S', '1swgNj');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (31, 'Opiekun ucznia', 'Remigiusz Mróz', NULL, NULL, 30, 'P', '8TIMxA');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (32, 'Olga', 'Tokarczuk', 'Jakubowska 18', 1, NULL, 'S', '5nyPZV');");
        DB::insert("INSERT INTO `user_data` (`id`, `first_name`, `last_name`, `address`, `class`, `children`, `group`, `account_code`) VALUES (33, 'Opiekun ucznia', 'Olga Tokarczuk', NULL, NULL, 32, 'P', 'Qf2nKM');");

        //classes
        DB::insert("INSERT INTO `classes` (`id`, `name`, `school_year`) VALUES (1, '2A', '2022/2023');");
        DB::insert("INSERT INTO `classes` (`id`, `name`, `school_year`) VALUES (2, '2B', '2022/2023');");
        DB::insert("INSERT INTO `classes` (`id`, `name`, `school_year`) VALUES (3, '3C', '2022/2023');");
        DB::insert("INSERT INTO `classes` (`id`, `name`, `school_year`) VALUES (4, '4B', '2022/2023');");

        //lessons
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (1, 'język polski', '2022/2023', 2, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (2, 'język angielski', '2022/2023', 2, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (3, 'matematyka', '2022/2023', 7, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (4, 'informatyka', '2022/2023', 8, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (5, 'biologia', '2022/2023', 9, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (6, 'chemia', '2022/2023', 10, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (7, 'historia', '2022/2023', 11, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (8, 'przedsiębiorczość', '2022/2023', 12, 1);");
        DB::insert("INSERT INTO `lessons` (`id`, `name`, `school_year`, `lecturer`, `class`) VALUES (9, 'język polski', '2022/2023', 2, 2);");


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

        //categories
        DB::insert("INSERT INTO `categories` (`id`, `name`, `lesson`, `count_to_avg`, `weight`) VALUES (1, 'Zadanie domowe', 1, 1, 1);");
        DB::insert("INSERT INTO `categories` (`id`, `name`, `lesson`, `count_to_avg`, `weight`) VALUES (2, 'Sprawdzian - dział I', 1, 1, 1);");
        DB::insert("INSERT INTO `categories` (`id`, `name`, `lesson`, `count_to_avg`, `weight`) VALUES (3, 'Projekt semestralny', 1, 1, 2);");
        DB::insert("INSERT INTO `categories` (`id`, `name`, `lesson`, `count_to_avg`, `weight`) VALUES (4, 'Odpowiedź ustna', 3, 1, 1);");

        //grade
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (1, 3, 1, 9, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (2, 5, 1, 5, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (3, 17, 1, 5, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (4, 23, 1, 5, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (5, 19, 1, 7, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (6, 13, 1, 20, '2023-01-21 17:25:05', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (7, 15, 1, 9, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (8, 32, 1, 6, '2023-01-21 17:25:05', '2023-01-21 17:25:05');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (9, 19, 2, 10, '2023-01-21 17:25:10', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (10, 23, 2, 5, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (11, 17, 2, 7, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (12, 13, 2, 9, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (13, 5, 2, 7, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (14, 3, 2, 8, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (15, 15, 2, 11, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (16, 32, 2, 17, '2023-01-21 17:28:12', '2023-01-21 17:28:12');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (17, 3, 3, 5, '2023-01-21 17:28:22', '2023-01-21 17:28:22');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (18, 23, 3, 6, '2023-01-21 17:30:55', '2023-01-21 17:30:55');");
        DB::insert("INSERT INTO `grade` (`id`, `student`, `category`, `mark`, `created_at`, `updated_at`) VALUES (19, 3, 4, 6, '2023-01-21 17:48:26', '2023-01-21 17:48:26');");



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

        //attendance
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (1, 5, 2, '2023-01-23', 2, '2023-01-21 17:22:47', '2023-01-21 17:22:47');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (2, 17, 2, '2023-01-23', 5, '2023-01-21 17:22:47', '2023-01-21 17:22:47');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (3, 3, 2, '2023-01-23', 1, '2023-01-21 17:23:11', '2023-01-21 17:23:11');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (4, 13, 2, '2023-01-23', 1, '2023-01-21 17:23:11', '2023-01-21 17:23:11');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (5, 15, 2, '2023-01-23', 1, '2023-01-21 17:23:11', '2023-01-21 17:23:11');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (6, 19, 2, '2023-01-23', 1, '2023-01-21 17:23:11', '2023-01-21 17:23:11');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (7, 23, 2, '2023-01-23', 1, '2023-01-21 17:23:12', '2023-01-21 17:23:12');");
        db::insert("INSERT INTO `presence` (`id`, `student`, `timetable`, `date`, `status`, `created_at`, `updated_at`) VALUES (8, 32, 2, '2023-01-23', 1, '2023-01-21 17:23:12', '2023-01-21 17:23:12');");

        //news
        DB::insert("INSERT INTO `news` (`id`, `added_by`, `content`, `created_at`, `updated_at`) VALUES (1, 1, 'Najbliższy piątek, tj. 27.01.2023, jest dniem wolnym od zajęć dydaktycznych (z powodu święta patrona szkoły). Świetlica szkolna będzie czynna w godzinach 8:00 - 16:00', '2023-01-21 15:54:45', NULL);");

        //tests
        DB::insert("INSERT INTO `tests` (`id`, `lesson`, `description`, `date`, `created_at`, `updated_at`) VALUES (1, 1, 'Sprawdzian z działu \"Literatura antyczna\"', '2023-01-27', '2023-01-21 16:31:32', NULL);");

        //timetable
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (1, 1, 0, '08:00:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (2, 3, 0, '08:50:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (3, 7, 1, '08:50:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (4, 6, 1, '09:45:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (5, 2, 1, '10:45:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (6, 3, 2, '08:00:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (7, 8, 2, '08:50:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (8, 6, 3, '08:50:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (9, 5, 3, '09:45:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (10, 4, 2, '09:45:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (11, 2, 0, '09:45:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (12, 3, 4, '08:50:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (13, 1, 4, '09:45:00', 45);");
        DB::insert("INSERT INTO `timetable` (`id`, `lesson`, `day`, `start`, `duration`) VALUES (14, 9, 1, '08:50:00', 45);");
    }
}
