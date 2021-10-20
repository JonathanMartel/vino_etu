<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCellierBouteillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cellier_bouteilles', function (Blueprint $table) {

            /* Tables */

            $table->date('date_achat')->nullable();
            $table->string('garde_jusqua')->nullable();
            $table->tinyInteger('note')->nullable();
            $table->text('commentaire')->nullable();
            $table->float('prix')->nullable();
            $table->integer('quantité',4)->nullable();
            $table->year('millesime')->nullable();
            $table->timestamps();

            /* Contraintes et clefs étrangères */

            $table->unsignedBigInteger('cellier_id');
            $table->foreign('cellier_id')->references('id')->on('celliers')->onDelete('cascade');
            $table->unsignedBigInteger('bouteille_id');
            $table->foreign('bouteille_id')->references('id')->on('bouteilles')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cellier_bouteilles');
    }
}
