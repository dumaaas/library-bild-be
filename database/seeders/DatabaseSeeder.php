<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $faker = Faker::create();

        //SEEDING USER TYPES
        DB::table('user_types')->insert([
            'id' => '1',
            'name' => 'admin',
        ]);

        DB::table('user_types')->insert([
            'id' => '2',
            'name' => 'librarian',
        ]);

        DB::table('user_types')->insert([
            'id' => '3',
            'name' => 'student',
        ]);

        //SEEDING GENRE
        DB::table('genres')->insert([
            'id' => '1',
            'name' => 'Drama',
            'photo' => 'default.jpg',
            'description' => $faker->sentence,
        ]);

        DB::table('genres')->insert([
            'id' => '2',
            'name' => 'Poetry',
            'photo' => 'default.jpg',
            'description' => $faker->sentence,
        ]);

        DB::table('genres')->insert([
            'id' => '3',
            'name' => 'Romance',
            'photo' => 'default.jpg',
            'description' => $faker->sentence,
        ]);

        //SEEDING CATEGORY
        DB::table('categories')->insert([
            'id' => '1',
            'name' => 'Food & Drink',
            'photo' => 'default.jpg',
            'description' => $faker->sentence,
        ]);

        DB::table('categories')->insert([
            'id' => '2',
            'name' => 'History',
            'photo' => 'default.jpg',
            'description' => $faker->sentence,
        ]);

        DB::table('categories')->insert([
            'id' => '3',
            'name' => 'Law',
            'photo' => 'default.jpg',
            'description' => $faker->sentence,
        ]);

        //SEEDING LANGUAGE
        DB::table('languages')->insert([
            'id' => '1',
            'name' => 'English',
        ]);

        DB::table('languages')->insert([
            'id' => '2',
            'name' => 'Montenegrin',
        ]);

        DB::table('languages')->insert([
            'id' => '3',
            'name' => 'Spanish',
        ]);

        //SEEDING SCRIPT
        DB::table('scripts')->insert([
            'id' => '1',
            'name' => 'Latin',
        ]);

        DB::table('scripts')->insert([
            'id' => '2',
            'name' => 'Cyrillic',
        ]);

        //SEEDING FORMAT
        DB::table('formats')->insert([
            'id' => '1',
            'name' => 'A1',
        ]);

        DB::table('formats')->insert([
            'id' => '2',
            'name' => 'A2',
        ]);

        DB::table('formats')->insert([
            'id' => '3',
            'name' => 'A3',
        ]);

        DB::table('formats')->insert([
            'id' => '4',
            'name' => 'A4',
        ]);

        //SEEDING BINDING
        DB::table('bindings')->insert([
            'id' => '1',
            'name' => 'Hardcover',
        ]);

        DB::table('bindings')->insert([
            'id' => '2',
            'name' => 'Paperback',
        ]);

        //SEEDING PUBLISHER
        DB::table('publishers')->insert([
            'id' => '1',
            'name' => 'Babun',
        ]);

        DB::table('publishers')->insert([
            'id' => '2',
            'name' => 'BeoBook',
        ]);

        //SEEDING GLOBAL_VARIABLES
        DB::table('global_variables')->insert([
            'id' => 1,
            'variable' => 'RETURN_DUE_DATE',
            'value' => '20',
        ]);

        DB::table('global_variables')->insert([
            'id' => 2,
            'variable' => 'RESERVATION_PERIOD',
            'value' => '20',
        ]);

        DB::table('global_variables')->insert([
            'id' => 3,
            'variable' => 'OVERDRAFT_PERIOD',
            'value' => '5',
        ]);

        //SEEDING ADMIN
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'userType_id' => 1,
            'jmbg' => 12121212121212,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'photo' => 'default.jpg',
            'email' => 'admin@gmail.com',
        ]);

        //SEEDING LIBRARIANS
        DB::table('users')->insert([
            'name' => 'Marko Dumnic',
            'username' => 'dumaaas',
            'userType_id' => 2,
            'jmbg' => 12121212121213,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'photo' => 'default.jpg',
            'email' => 'dumaaas@gmail.com',
        ]);

        DB::table('users')->insert([
            'name' => 'Emilija Pribanovic',
            'username' => 'emilija',
            'userType_id' => 2,
            'jmbg' => 12121212121214,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'photo' => 'default.jpg',
            'email' => 'emilija@gmail.com',
        ]);

        DB::table('users')->insert([
            'name' => 'Pavle Tijanic',
            'username' => 'pavle',
            'userType_id' => 2,
            'jmbg' => 12121212121215,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
            'photo' => 'default.jpg',
            'email' => 'pavle@gmail.com',
        ]);

        //SEEDING STATUS_BOOK
        DB::table('status_books')->insert([
            'id' => 1,
            'name' => 'Returned'
        ]);

        DB::table('status_books')->insert([
            'id' => 2,
            'name' => 'Rented'
        ]);

        DB::table('status_books')->insert([
            'id' => 3,
            'name' => 'Returned with delay'
        ]);

        DB::table('status_books')->insert([
            'id' => 4,
            'name' => 'Reserved'
        ]);


        DB::table('status_reservations')->insert([
            'id' => 1,
            'name' => 'Reserved'
        ]);

        DB::table('status_reservations')->insert([
            'id' => 2,
            'name' => 'Rented'
        ]);

        DB::table('status_reservations')->insert([
            'id' => 3,
            'name' => 'Reservation refused'
        ]);


        //SEEDING CLOSE RESERVATIONS
        DB::table('close_reservations')->insert([
            'id' => 1,
            'name' => 'Reservation expired'
        ]);

        DB::table('close_reservations')->insert([
            'id' => 2,
            'name' => 'Reservation refused'
        ]);

        DB::table('close_reservations')->insert([
            'id' => 3,
            'name' => 'Reservation canceled'
        ]);

        DB::table('close_reservations')->insert([
            'id' => 4,
            'name' => 'Book rented'
        ]);

        DB::table('close_reservations')->insert([
            'id' => 5,
            'name' => 'Reservation accepted'
        ]);


        // //SEEDING AUTHORS
        // \App\Models\Author::factory(30)->create();

        //SEEDING USERS
        \App\Models\User::factory(10)->create();

        // //SEEDING RENT_STATUS
        // \App\Models\RentStatus::factory(300)->create();

        // //SEEDING RESERVATION_STATUS
        // \App\Models\ReservationStatus::factory(300)->create();

        \App\Models\Book::factory(10)->create();

        //SEEDING BOOK_CATEGORY
        \App\Models\BookCategory::factory(30)->create();

        //SEEDING BOOK_GENRE
        \App\Models\BookGenre::factory(30)->create();

        // //SEEDING BOOK_AUTHOR
        // \App\Models\BookAuthor::factory(30)->create();

    }
}
