<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) {

            $new_tag = new Tag();
            $new_tag->name = $faker->words(3, true);

            $slug = Str::slug($new_tag->name);
            $slug_base = $slug; // slavo la "radice base " dello slug

            $current_tag = Tag::where('slug', $slug)->first();  // controllo se nella colonna slug e' gia' presente lo $slug (con Post::where) e ::first mi restituisce un oggetto di tipo post o restituisce null

            //se la query in $current_pos restituisce un valore e quindi diverso da null, verifico che il post corrente sia uguale ad un post esistente, se si allora concateno un -1, -2 etc....
            $contatore = 1;
            while($current_tag){

                $slug = $slug_base . '-' . $contatore; // concateno il contatore x rendere diverso lo slug
                $contatore++;
                $current_tag = Tag::where('slug', $slug)->first(); // rifaccio la query x cercare che il nuovo slug, al primo giro sara' .-1, non sia presente nel DB finche' il while non diventa falso

            }

            $new_tag->slug = $slug;
            $new_tag->save();
        }
    }
}
