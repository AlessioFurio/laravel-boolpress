<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $posts = [
        //     [
        //         'name' => 'Alessio',
        //         'lastname' => 'Furio',
        //         'date_of_birth' => '1993-01-30'
        //     ],
        //     [
        //         'name' => 'Flavio',
        //         'lastname' => 'Furio',
        //         'date_of_birth' => '2003-01-15'
        //     ],
        //     [
        //         'name' => 'Cecilia',
        //         'lastname' => 'Brillante',
        //         'date_of_birth' => '1965-10-08'
        //     ],
        // ];

        // foreach ($posts as $item) {
        //     $new_post = new Post();
        //     $new_post->name = $item['name'];
        //     $new_post->lastname = $item['lastname'];
        //     $new_post->date_of_birth = $item['date_of_birth'];
        //     $new_post->save();
        // }

        for ($i=0; $i < 10 ; $i++) {
            $new_post = new Post();
            $new_post->title = $faker->sentence();
            $new_post->content = $faker->text(500);

            $slug = Str::slug($new_post->title);
            $slug_base = $slug; // slavo la "radice base " dello slug

            $current_post = Post::where('slug', $slug)->first();  // controllo se nella colonna slug e' gia' presente lo $slug (con Post::where) e ::first mi restituisce un oggetto di tipo post o restituisce null

            //se la query in $current_pos restituisce un valore e quindi diverso da null, verifico che il post corrente sia uguale ad un post esistente, se si allora concateno un -1, -2 etc....
            $contatore = 1;
            while($current_post){

                $slug = $slug_base . '-' . $contatore; // concateno il contatore x rendere diverso lo slug
                $contatore++;
                $current_post = Post::where('slug', $slug)->first(); // rifaccio la query x cercare che il nuovo slug, al primo giro sara' .-1, non sia presente nel DB finche' il while non diventa falso

            }

            $new_post->slug = $slug;

            $new_post->save();
        }
    }
}
