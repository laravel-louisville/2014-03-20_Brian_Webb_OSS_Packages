<?php

class AuthorsTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('authors')->truncate();

        $authors = array(
            [
                'name'       => 'F. Scott Fitzgerald',
            ],
            [
                'name'       => 'John Steinbeck',
            ],
            [
                'name'       => 'George Orwell',
            ],
            [
                'name'       => 'James Joyce',
            ],
            [
                'name'       => 'Vladimir Nabokov',
            ],
            [
                'name'       => 'Joseph Heller',
            ],
            [
                'name'       => 'J. D. Salinger',
            ],
            [
                'name'       => 'Toni Morrison',
            ],
            [
                'name'       => 'William Faulkner',
            ],
            [
                'name'       => 'Harper Lee',
            ]
        );

        // Uncomment the below to run the seeder
        DB::table('authors')->insert($authors);
    }

}
