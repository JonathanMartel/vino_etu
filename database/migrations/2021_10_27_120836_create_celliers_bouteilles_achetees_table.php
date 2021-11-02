<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelliersBouteillesAcheteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celliers_bouteilles_achetees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("celliers_id")->constrained();
            $table->foreignId("bouteilles_achetees_id")->constrained("bouteilles_achetees");
            $table->smallInteger("inventaire", false, true)->unsigned();
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
        Schema::dropIfExists('cellier_bouteille');
    }
}
