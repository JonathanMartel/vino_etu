<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCelliersBouteillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('celliers_bouteilles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("celliers_id")->constrained();
            $table->foreignId("bouteilles_id")->constrained();
            $table->smallInteger("inventaire", false, true);
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
