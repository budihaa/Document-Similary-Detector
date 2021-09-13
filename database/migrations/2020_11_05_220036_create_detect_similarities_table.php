<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetectSimilaritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detect_similarities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detect_id')
                ->foreign('detect_id')
                ->references('id')
                ->on('detecs');
            $table->unsignedInteger('master_doc_id')
                ->foreign('master_doc_id')
                ->references('id')
                ->on('master_docs');
            $table->double('result');
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
        Schema::dropIfExists('detect_similarities');
    }
}
