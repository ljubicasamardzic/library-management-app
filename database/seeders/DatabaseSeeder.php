<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        AuthorSeeder::run();
        BookConditionSeeder::run();
        PublisherSeeder::run();
        RoleSeeder::run();
        UserSeeder::run();
        BookStatusSeeder::run();
        BookSeeder::run();
        BookCopySeeder::run();
        BookLoanSeeder::run();
    }
}
