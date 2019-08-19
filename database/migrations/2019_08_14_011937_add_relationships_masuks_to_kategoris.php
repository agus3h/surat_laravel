<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsMasuksToKategoris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masuks',function (Blueprint $table){
            $table->integer('kategori_id')->unsigned()->change();
            $table->foreign('kategori_id')->references('id')->on('kategoris')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masuks', function(Blueprint $table){
            $table->dropForeign('masuks_kategori_id_foreign');
        });
        Schema::table('masuks', function(Blueprint $table){
            $table->dropIndex('masuks_kategori_id_foreign');
        });
        Schema::table('masuks', function(Blueprint $table){
            $table->integer('kategori_id')->change();
        });
    }
}
