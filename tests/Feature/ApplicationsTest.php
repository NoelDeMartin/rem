<?php

use App\Models\Application;
use Illuminate\Testing\Fluent\AssertableJson;

it('returns JSON-LD', function () {
    $application = Application::factory()->create();

    $response = $this->withHeader('Accept', 'application/ld+json')->get('/applications/' . $application->slug);

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->hasAll(['client_id', 'client_name', 'redirect_uris'])
                ->etc()
    );
});

it('returns JSON-LD with context header', function () {
    $application = Application::factory()->create();

    $response = $this
        ->withHeader('Accept', 'application/ld+json')
        ->withHeader('JsonLdContext', 'https://www.w3.org/ns/solid/oidc-context.jsonld')
        ->get('/applications/' . $application->slug);

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->hasAll(['id', 'name', 'oidc:redirect_uris'])
                ->etc()
    );
});
