<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortsTable extends Migration
{
    protected $connection;

    private $table;

    public function __construct()
    {
        $this->connection = config('short_url.connection');

        $this->table = config('short_url.table', 'shorts');
    }

    public function up()
    {
        Schema::connection($this->connection)
            ->create($this->table, function (Blueprint $table) {
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
        Schema::connection($this->connection)
            ->dropIfExists($this->table);
    }
}
