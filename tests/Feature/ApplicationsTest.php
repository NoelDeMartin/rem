<?php

use App\Models\Application;
use App\Models\ApplicationModel;
use Illuminate\Testing\Fluent\AssertableJson;

it('returns profile JSON-LD', function () {
    $application = Application::factory()
        ->has(ApplicationModel::factory()->count(3), 'models')
        ->create();

    $response = $this->get("/applications/{$application->slug}.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('type', ['interop:Application', 'Application'])
                ->etc()
    );
});

it('returns profile JSON-LD with context header', function () {
    $application = Application::factory()
        ->has(ApplicationModel::factory()->count(3), 'models')
        ->create();

    $response = $this
        ->withHeader('JsonLdContext', 'https://www.w3.org/ns/solid/oidc-context.jsonld')
        ->get("/applications/{$application->slug}.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('@type', [
                    'http://www.w3.org/ns/solid/interop#Application',
                    'https://www.w3.org/ns/activitystreams#Application',
                ])
                ->etc()
    );
});

it('returns access description set JSON-LD', function () {
    $application = Application::factory()
        ->has(ApplicationModel::factory()->count(3), 'models')
        ->create();

    $response = $this->get("/applications/{$application->slug}/access-description-set.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('type', 'interop:AccessDescriptionSet')
                ->count('apods:hasClassDescription', $application->models->count())
                ->etc()
    );
});

it('returns access description set JSON-LD with context header', function () {
    $application = Application::factory()
        ->has(ApplicationModel::factory()->count(3), 'models')
        ->create();

    $response = $this
        ->withHeader('JsonLdContext', 'https://www.w3.org/ns/solid/oidc-context.jsonld')
        ->get("/applications/{$application->slug}/access-description-set.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('@type', 'http://www.w3.org/ns/solid/interop#AccessDescriptionSet')
                ->count('http://activitypods.org/ns/core#hasClassDescription', $application->models->count())
                ->etc()
    );
});

it('returns access need group JSON-LD', function () {
    $application = Application::factory()
        ->has(ApplicationModel::factory()->count(3), 'models')
        ->create();

    $response = $this->get("/applications/{$application->slug}/access-need-group.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('type', 'interop:AccessNeedGroup')
                ->count('interop:hasAccessNeed', $application->models->count())
                ->etc()
    );
});

it('returns access need group JSON-LD with context header', function () {
    $application = Application::factory()
        ->has(ApplicationModel::factory()->count(3), 'models')
        ->create();

    $response = $this
        ->withHeader('JsonLdContext', 'https://www.w3.org/ns/solid/oidc-context.jsonld')
        ->get("/applications/{$application->slug}/access-need-group.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('@type', 'http://www.w3.org/ns/solid/interop#AccessNeedGroup')
                ->count('http://www.w3.org/ns/solid/interop#hasAccessNeed', $application->models->count())
                ->etc()
    );
});

it('returns class description JSON-LD', function () {
    $model = ApplicationModel::factory()->has(Application::factory())->create();

    $response = $this->get("/applications/{$model->application->slug}/class-descriptions/{$model->id}.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('type', 'apods:ClassDescription')
                ->where('apods:describedClass', $model->url)
                ->etc()
    );
});

it('returns class description JSON-LD with context header', function () {
    $model = ApplicationModel::factory()->has(Application::factory())->create();

    $response = $this
        ->withHeader('JsonLdContext', 'https://www.w3.org/ns/solid/oidc-context.jsonld')
        ->get("/applications/{$model->application->slug}/class-descriptions/{$model->id}.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('@type', 'http://activitypods.org/ns/core#ClassDescription')
                ->where('http://activitypods.org/ns/core#describedClass', ['client_id' => $model->url])
                ->etc()
    );
});

it('returns access need JSON-LD', function () {
    $model = ApplicationModel::factory()->has(Application::factory())->create();

    $response = $this->get("/applications/{$model->application->slug}/access-needs/{$model->id}.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('type', 'interop:AccessNeed')
                ->where('apods:registeredClass', $model->url)
                ->etc()
    );
});

it('returns access need JSON-LD with context header', function () {
    $model = ApplicationModel::factory()->has(Application::factory())->create();

    $response = $this
        ->withHeader('JsonLdContext', 'https://www.w3.org/ns/solid/oidc-context.jsonld')
        ->get("/applications/{$model->application->slug}/access-needs/{$model->id}.jsonld");

    $response->assertStatus(200);
    $response->assertJson(
        fn (AssertableJson $json) =>
            $json
                ->where('@type', 'http://www.w3.org/ns/solid/interop#AccessNeed')
                ->where('http://activitypods.org/ns/core#registeredClass', ['client_id' => $model->url])
                ->etc()
    );
});
