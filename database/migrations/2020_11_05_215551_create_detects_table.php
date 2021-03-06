<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')
                ->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->string('created_by');
            $table->string('title')->unique();
            $table->string('text');
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
        Schema::dropIfExists('detects');
    }
}
