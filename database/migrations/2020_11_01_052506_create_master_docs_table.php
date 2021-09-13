<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')
                ->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->string('created_by');
            $table->string('title')->unique();
            $table->longText('text');
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
        Schema::dropIfExists('master_docs');
    }
}
