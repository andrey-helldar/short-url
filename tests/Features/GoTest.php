<?php

namespace Tests\Features;

use Helldar\ShortUrl\Facades\ShortUrl;
use Tests\TestCase;

final class GoTest extends TestCase
{
    public function testRoute()
    {
        $this->assertDatabaseHasTable('shorts');
        $this->assertDatabaseCount('shorts', 0);

        ShortUrl::set('https://example.com/foo');

        $this->assertDatabaseCount('shorts', 1);

        $this->assertDatabaseHasLike('shorts', 'key', 'b');
        $this->assertDatabaseDoesntLike('shorts', 'key', 'v');

        $this->assertSame('http://localhost/go/b', route('short_url', ['key' => 'b']));
    }

    public function testRedirect()
    {
        $this->assertDatabaseHasTable('shorts');
        $this->assertDatabaseCount('shorts', 0);

        ShortUrl::set('https://example.com/foo');

        $this->assertDatabaseCount('shorts', 1);

        $this->assertDatabaseHasLike('shorts', 'key', 'b');
        $this->assertDatabaseDoesntLike('shorts', 'key', 'v');

        $response = $this->get('/go/b');

        $response->assertStatus(302);
        $response->assertRedirect('https://example.com/foo');
    }
}
