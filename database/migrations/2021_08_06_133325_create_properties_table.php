<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('prop_type_id')->unsigned();
            $table->string('proj_name');
            $table->string('slug');
            $table->tinyInteger('stat_view');
            $table->tinyInteger('status')->default(1);  //status if property is active or disabled, 0 for active
            $table->tinyInteger('publish')->default(0);//status if property is publish or not , 1 for Unpublish

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
        Schema::dropIfExists('properties');
    }
}
