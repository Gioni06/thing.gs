<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_send_an_url_to_the_api()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('http://api.' . env('APP_DOMAIN') . '/create?url=http://google.com');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'source_url' => 'http://google.com'
        ]);
    }

    /**
     * @test
     */
    public function a_user_sees_an_error_when_url_is_invalid()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('http://api.' . env('APP_DOMAIN') . '/create?url=invalid');
        $response->assertStatus(400);
        $response->assertJsonFragment([
            'url' => [
                "The url format is invalid."
            ]
        ]);
    }

    /**
     * @test
     */
    public function a_user_sees_an_error_when_url_is_missing()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('http://api.' . env('APP_DOMAIN') . '/create');
        $response->assertStatus(400);
        $response->assertJsonFragment([
            'url' => [
                "The url field is required."
            ]
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_create_a_short_url()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('http://api.' . env('APP_DOMAIN') . '/create?url=http://google.com');
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'source_url' => 'http://google.com',
            'short_code' => 'cJinsNv1',
            'short_url' => 'http://' . env('APP_DOMAIN') . '/cJinsNv1'
        ]);
    }
}
