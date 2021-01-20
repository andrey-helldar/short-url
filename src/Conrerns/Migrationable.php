<?php

namespace Helldar\ShortUrl\Conrerns;

use Closure;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;

trait Migrationable
{
    protected $connection;

    protected $table;

    public function __construct()
    {
        $this->connection = config('short_url.connection');

        $this->table = config('short_url.table', 'shorts');
    }

    protected function createTable(Closure $callback): void
    {
        $this->tableConnection()->create($this->table, $callback);
    }

    protected function tableConnection(): Builder
    {
        return Schema::connection($this->connection);
    }
}
