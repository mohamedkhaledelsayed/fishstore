<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovernmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('government_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('government_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['government_id', 'locale']);
            $table->foreign('government_id')->references('id')->on('governments')->onDelete('cascade');
            $table->string('name');
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
        Schema::dropIfExists('government_translations');
    }
}
