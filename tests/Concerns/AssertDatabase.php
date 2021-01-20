<?php

namespace Tests\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/** @mixin \Tests\TestCase */
trait AssertDatabase
{
    protected function assertDatabaseCount($table, int $count, $connection = null): void
    {
        $actual = DB::connection($connection)->table($table)->count();

        $this->assertEquals($count, $actual);
    }

    protected function assertDatabaseHasTable(string $table): void
    {
        $this->assertTrue(
            $this->hasTable($table)
        );
    }

    protected function assertDatabaseHasLike(string $table, string $column, $value, $connection = null): void
    {
        $exists = DB::connection($connection)
            ->table($table)
            ->where($column, $value)
            ->exists();

        $this->assertTrue($exists);
    }

    protected function assertDatabaseDoesntLike(string $table, string $column, $value, $connection = null): void
    {
        $exists = DB::connection($connection)
            ->table($table)
            ->where($column, $value)
            ->doesntExist();

        $this->assertTrue($exists);
    }

    protected function hasTable(string $table): bool
    {
        return Schema::hasTable($table);
    }
}
