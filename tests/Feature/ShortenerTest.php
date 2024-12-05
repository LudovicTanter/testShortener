<?php

namespace Tests\Feature;

use Tests\TestCase;

class ShortenerTest extends TestCase
{
    public function test_encode_invalid() : void {
        $response = $this->get('/encode');

        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
    }

    public function test_decode_invalid_empty() : void {
        $response = $this->get('/decode');

        $response->assertStatus(422);
        $response->assertJsonStructure(['error']);
    }

    public function test_decode_invalid_missing() : void {
        $response = $this->get('/decode?url=wrongUrl');

        $response->assertStatus(404);
        $response->assertJsonStructure(['error']);
    }

    public function test_encode_decode_valid() : void {
        $response = $this->get('/encode?url=https://www.google.com');

        $response->assertStatus(200);
        $response->assertJsonStructure(['url']);

        $short = $response->decodeResponseJson()['url'];
        $response = $this->get("/decode?url=$short");

        $response->assertStatus(200);
        $response->assertJsonStructure(['url']);
    }
}