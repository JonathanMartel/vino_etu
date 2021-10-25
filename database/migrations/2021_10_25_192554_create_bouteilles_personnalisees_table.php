<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouteillesPersonnaliseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles_personnalisees', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->text("description")->nullable();
            $table->string("url_image")->nullable();
            $table->string("url_achat")->nullable();
            $table->string("url_infos")->nullable();
            $table->string("conservation")->nullable();
            $table->text("notes")->nullable();
            $table->string("format")->nullable();
            $table->foreignId("pays_id")->constrained();
            $table->foreignId("categories_id")->constrained();
            $table->foreignId("users_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouteilles_personnalisees');
    }
}
