<?php

use Helldar\ShortUrl\Conrerns\Migrationable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ChangeShortsTableAddIndexes extends Migration
{
    use Migrationable;

    public function up()
    {
        $this->changeTable(static function (Blueprint $table) {
            $table->index(['url']);
            $table->index(['key']);
        });
    }

    public function down()
    {
        $this->changeTable(static function (Blueprint $table) {
            $table->dropIndex(['url']);
            $table->dropIndex(['key']);
        });
    }
}
