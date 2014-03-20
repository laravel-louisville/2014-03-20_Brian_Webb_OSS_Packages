<?php

class BooksTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('books')->truncate();

        $books = array(
            [
                'title'        => 'The Great Gatsby',
                'author'       => 'F. Scott Fitzgerald',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'The Grapes of Wrath',
                'author'       => 'John Steinbeck',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Nineteen Eighty-Four',
                'author'       => 'George Orwell',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Ulysses',
                'author'       => 'James Joyce',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Lolita',
                'author'       => 'Vladimir Nabokov',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Catch-22',
                'author'       => 'Joseph Heller',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'The Catcher in the Rye',
                'author'       => 'J. D. Salinger',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'Beloved',
                'author'       => 'Toni Morrison',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'The Sound and the Fury',
                'author'       => 'William Faulkner',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ],
            [
                'title'        => 'To Kill a Mockingbird',
                'author'       => 'Harper Lee',
                'price'        => 1000,
                'published_on' => '2014-03-19'
            ]
        );

        // Uncomment the below to run the seeder
        DB::table('books')->insert($books);
    }

}
