<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignsDimensionMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designs_dimension_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('DM_id')->references('id')->on('dim_mats');
            $table->foreignId('design_id')->references('id')->on('designs');
            $table->double('price');
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
        Schema::dropIfExists('designs_dimension_materials');
    }
}
