<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('slug'); // mettiamo nullable perche' un post puo non avere una categoria, bisogna impostare il tipo per category_id == al tipo dell'id della tabella category che in questo caso sara' bigInteger unsigned (da vedere nel db) ->after('slug') lo metto x impostare la tabella dopo la tabella 'slug'
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // indico che category_id e' una FOREIGN, e che fa riferimento all'id (->references('id')) della tabella categories (->on('categories'))
            // ->onDelete('set null') settera' a null la category_id qualora un post sara' cancellato
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_category_id_foreign'); // bisogna eliminare prima foreign e poi la colonna, e il dropForeign si usa con ('nomeTabellaCorrente_nomeColonna_id_foreign')
            $table->dropColumn('category_id'); // dopo il dropForeign, il dropColumn funzionera'
        });
    }
}
