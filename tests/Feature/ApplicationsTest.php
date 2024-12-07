<?php

use App\Models\Application;
use Illuminate\Testing\Fluent\AssertableJson;

it('returns JSON-LD', function () {
    $application = Application::factory()->create();

    $response = $this->withHeader('Accept', 'application/ld+json')->get('/applications/' . $application->slug);

    $response->assertStatus(200);
    $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['client_id', 'client_name', 'redirect_uris']));
});
