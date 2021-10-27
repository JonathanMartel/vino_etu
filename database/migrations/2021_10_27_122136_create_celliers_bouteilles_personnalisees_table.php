<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelliersBouteillesPersonnaliseesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celliers_bouteilles_personnalisees', function (Blueprint $table) {
            $table->id();
            $table->foreignId("celliers_id")->constrained();
            $table->bigInteger("bouteilles_personnalisees_id")->unsigned();
            $table->timestamps();

            $table->foreign("bouteilles_personnalisees_id", "cellier_bp_fk")->references("id")->on("bouteilles_personnalisees");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cellier_bouteille_personnalisee');
    }
}
