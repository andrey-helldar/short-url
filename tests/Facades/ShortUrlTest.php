<?php

namespace Tests\Facades;

use Helldar\ShortUrl\Facades\ShortUrl;
use Helldar\ShortUrl\Models\Short;
use Helldar\Support\Exceptions\NotValidUrlException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

final class ShortUrlTest extends TestCase
{
    public function testSet()
    {
        $this->assertDatabaseHasTable('shorts');
        $this->assertDatabaseCount('shorts', 0);

        ShortUrl::set('https://example.com/foo');
        ShortUrl::set('https://example.com/bar');
        ShortUrl::set('https://example.com/baz');

        $this->assertDatabaseCount('shorts', 3);

        ShortUrl::set('https://example.com/foo');
        ShortUrl::set('https://example.com/bar');
        ShortUrl::set('https://example.com/baz');

        $this->assertDatabaseCount('shorts', 3);

        $this->assertDatabaseHasLike('shorts', 'key', 'b');
        $this->assertDatabaseHasLike('shorts', 'key', 'c');
        $this->assertDatabaseHasLike('shorts', 'key', 'd');

        $this->assertDatabaseHasLike('shorts', 'url', 'https://example.com/foo');
        $this->assertDatabaseHasLike('shorts', 'url', 'https://example.com/bar');
        $this->assertDatabaseHasLike('shorts', 'url', 'https://example.com/baz');
    }

    public function testSetIncorrect()
    {
        $this->expectException(NotValidUrlException::class);
        $this->expectExceptionMessage('The "foo.bar" is not a valid URL.');

        ShortUrl::set('foo.bar');
    }

    public function testGet()
    {
        $this->assertDatabaseHasTable('shorts');
        $this->assertDatabaseCount('shorts', 0);

        $key1 = ShortUrl::set('https://example.com/foo');
        $key2 = ShortUrl::get('b');

        $this->assertDatabaseCount('shorts', 1);

        $this->assertSame('http://localhost/go/b', $key1);
        $this->assertSame('http://localhost/go/b', $key2);
    }

    public function testGetIncorrect()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->expectExceptionMessage('No query results for model [Helldar\ShortUrl\Models\Short].');

        ShortUrl::get('foo');
    }

    public function testSearch()
    {
        $this->assertDatabaseHasTable('shorts');
        $this->assertDatabaseCount('shorts', 0);

        ShortUrl::set('https://example.com/foo');

        $model = ShortUrl::search('b');

        $this->assertDatabaseCount('shorts', 1);

        $this->assertInstanceOf(Short::class, $model);

        $this->assertSame('b', $model->key);
        $this->assertSame('https://example.com/foo', $model->url);
    }

    public function testSearchIncorrect()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->expectExceptionMessage('No query results for model [Helldar\ShortUrl\Models\Short].');

        ShortUrl::search('foo');
    }
}
