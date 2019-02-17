<?php

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
        // $this->call(UsersTableSeeder::class);

        //since this is a template
        //this seeder need to be run only once for template app
        //and expanded further into the development
         $this->call(LaratrustSeeder::class);
         $this->call(PostSeeder::class);
    }
}
