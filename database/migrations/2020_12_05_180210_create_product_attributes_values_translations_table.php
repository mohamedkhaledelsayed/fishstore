<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesValuesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes_values_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_attributes_values_id', false, true);
            $table->string('locale')->index();
            $table->unique(['product_attributes_values_id','locale'],'attribute_value_id_locale_unique');
            $table->foreign('product_attributes_values_id','attribute_val_trans_index')->references('id')->on('product_attributes_values')->onDelete('cascade');
            $table->longText('name');
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
        Schema::dropIfExists('product_attributes_values_translations');
    }
}
