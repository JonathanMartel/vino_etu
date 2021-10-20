<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBouteillesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouteilles', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->char('pays',50)->nullable();
            $table->char('url_img', 200)->nullable();
            $table->text('description')->nullable();
            $table->char('code_saq',50)->nullable();
            $table->float('prix_saq')->nullable();
            $table->char('url_saq', 200)->nullable();
            $table->timestamps();

            /* Contraintes et clefs étrangères */

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->unsignedBigInteger('format_id');
            $table->foreign('format_id')->references('id')->on('formats');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouteilles');
    }
}
