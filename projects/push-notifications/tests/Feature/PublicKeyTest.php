<?php

namespace Tests\Feature;

use App\RsaKey;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PublicKeyTest extends TestCase
{
    use RefreshDatabase;
    private $latestKey = NULL;

    protected function setUp():void {
        parent::setUp();
        $this->latestKey = factory(RsaKey::class,2)->create()->last();
    }

    public function testGetPublicKeyVersion()
    {
        $response = $this->get('/api/v1/public-key/version');
        $data = $response->decodeResponseJson();

        $this->assertEquals($data['version'],$this->latestKey->version);
        $response->assertStatus(200);
    }
}
