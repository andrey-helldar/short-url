<?php

use Helldar\ShortUrl\Conrerns\Migrationable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShortsTable extends Migration
{
    use Migrationable;

    public function up()
    {
        $this->createTable(static function (Blueprint $table) {
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
        $this->tableConnection()->dropIfExists($this->table);
    }
}
