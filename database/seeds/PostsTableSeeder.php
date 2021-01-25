<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'name' => 'Alessio',
                'lastname' => 'Furio',
                'date_of_birth' => '1993-01-30'
            ],
            [
                'name' => 'Flavio',
                'lastname' => 'Furio',
                'date_of_birth' => '2003-01-15'
            ],
            [
                'name' => 'Cecilia',
                'lastname' => 'Brillante',
                'date_of_birth' => '1965-10-08'
            ],
        ];

        foreach ($posts as $item) {
            $new_post = new Post();
            $new_post->name = $item['name'];
            $new_post->lastname = $item['lastname'];
            $new_post->date_of_birth = $item['date_of_birth'];
            $new_post->save();
        }
    }
}
