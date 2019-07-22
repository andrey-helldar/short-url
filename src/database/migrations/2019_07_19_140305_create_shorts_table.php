<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortsTable extends Migration
{
    public function up()
    {
        Schema::create('shorts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('key')->nullable()->index();
            $table->string('host');
            $table->text('url');

            $table->unsignedBigInteger('visited')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shorts');
    }
}
