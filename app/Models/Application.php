<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name', 'description', 'has_logo', 'url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLogoUrlAttribute(): string {
        return $this->has_logo
            ? url("images/applications/{$this->slug}.png")
            : url('images/default-application.png');
    }

    public function models(): HasMany {
        return $this->hasMany(ApplicationModel::class);
    }

    public function accessDescriptionSet(array $options = []): array {
        if (! empty($options['context'])) {
            $this->validateContext($options['context']);

            return [
                '@context' => 'https://www.w3.org/ns/solid/oidc-context.jsonld',
                '@type' => 'http://www.w3.org/ns/solid/interop#AccessDescriptionSet',
                'client_id' => route('jsonld.applications.access-description-set', $this),
                'http://activitypods.org/ns/core#hasClassDescription' =>
                    $this
                        ->models
                        ->map(fn ($model) => [
                            'client_id' => route('jsonld.applications.models.class-description', [$this, $model]),
                        ])
                        ->all(),
                'http://purl.org/dc/terms/created' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->created_at->toJSString(),
                ],
                'http://purl.org/dc/terms/modified' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->updated_at->toJSString(),
                ],
                'http://www.w3.org/ns/solid/interop#usesLanguage' => [
                    '@type' => 'xsd:language',
                    '@value' => 'en',
                ],
            ];
        }

        return [
            '@context' => [
                'https://www.w3.org/ns/activitystreams',
                route('jsonld.context'),
            ],
            'type' => 'interop:AccessDescriptionSet',
            'id' => route('jsonld.applications.access-description-set', $this),
            'apods:hasClassDescription' =>
                $this
                    ->models
                    ->map(fn ($model) => route('jsonld.applications.models.class-description', [$this, $model]))
                    ->all(),
            'dc:created' => $this->created_at->toJSString(),
            'dc:modified' => $this->updated_at->toJSString(),
            'interop:usesLanguage' => 'en',
        ];
    }

    public function accessNeedGroup(array $options = []): array {
        if (! empty($options['context'])) {
            $this->validateContext($options['context']);

            return [
                '@context' => 'https://www.w3.org/ns/solid/oidc-context.jsonld',
                '@type' => 'http://www.w3.org/ns/solid/interop#AccessNeedGroup',
                'client_id' => route('jsonld.applications.access-need-group', $this),
                'http://activitypods.org/ns/core#hasSpecialRights' => [
                    ['client_id' => 'http://activitypods.org/ns/core#QuerySparqlEndpoint'],
                    ['client_id' => 'http://activitypods.org/ns/core#CreateCollection'],
                ],
                'http://purl.org/dc/terms/created' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->created_at->toJSString(),
                ],
                'http://purl.org/dc/terms/modified' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->updated_at->toJSString(),
                ],
                'http://www.w3.org/ns/solid/interop#accessNecessity' => [
                    'client_id' => 'http://www.w3.org/ns/solid/interop#AccessRequired',
                ],
                'http://www.w3.org/ns/solid/interop#accessScenario' => [
                    'client_id' => 'http://www.w3.org/ns/solid/interop#PersonalAccess',
                ],
                'http://www.w3.org/ns/solid/interop#authenticatedAs' => [
                    'client_id' => 'http://www.w3.org/ns/solid/interop#SocialAgent',
                ],
                'http://www.w3.org/ns/solid/interop#hasAccessNeed' =>
                    $this
                        ->models
                        ->map(fn ($model) => [
                            'client_id' => route('jsonld.applications.models.access-need', [$this, $model]),
                        ])
                        ->all(),
            ];
        }

        return [
            '@context' => [
                'https://www.w3.org/ns/activitystreams',
                route('jsonld.context'),
            ],
            'type' => 'interop:AccessNeedGroup',
            'id' => route('jsonld.applications.access-need-group', $this),
            'apods:hasSpecialRights' => [
                'apods:QuerySparqlEndpoint',
                'apods:CreateCollection',
            ],
            'dc:created' => $this->created_at->toJSString(),
            'dc:modified' => $this->updated_at->toJSString(),
            'interop:accessNecessity' => 'interop:AccessRequired',
            'interop:accessScenario' => 'interop:PersonalAccess',
            'interop:authenticatedAs' => 'interop:SocialAgent',
            'interop:hasAccessNeed' =>
                $this
                    ->models
                    ->map(fn ($model) => route('jsonld.applications.models.access-need', [$this, $model]))
                    ->all(),
        ];
    }

    public function profile(array $options = []): array {
        if (! empty($options['context'])) {
            $this->validateContext($options['context']);

            return [
                '@context' => 'https://www.w3.org/ns/solid/oidc-context.jsonld',
                '@type' => [
                    'http://www.w3.org/ns/solid/interop#Application',
                    'https://www.w3.org/ns/activitystreams#Application',
                ],
                'client_id' => route('jsonld.applications.profile', $this),
                'client_name' => $this->name,
                'client_uri' => $this->url,
                'grant_types' => ['refresh_token', 'authorization_code'],
                'logo_uri' => $this->logo_url,
                'redirect_uris' => [
                    '@none' => [$this->url],
                ],
                'response_types' => 'code',
                'scope' => 'openid profile offline_access webid',
                'http://purl.org/dc/terms/language' => 'en',
                'http://purl.org/dc/terms/created' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->created_at->toJSString(),
                ],
                'http://purl.org/dc/terms/modified' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->updated_at->toJSString(),
                ],
                'http://www.w3.org/ns/solid/interop#applicationDescription' => $this->description,
                'http://www.w3.org/ns/solid/interop#applicationName' => $this->name,
                'http://www.w3.org/ns/solid/interop#applicationThumbnail' => $this->logo_url,
                'http://www.w3.org/ns/solid/interop#hasAccessDescriptionSet' => [
                    ['client_id' => route('jsonld.applications.access-description-set', $this)],
                ],
                'http://www.w3.org/ns/solid/interop#hasAccessNeedGroup' => [
                    'client_id' => route('jsonld.applications.access-need-group', $this),
                ],
                'oidc:default_max_age' => 3600,
                'oidc:require_auth_time' => true,
            ];
        }

        return [
            '@context' => [
                'https://www.w3.org/ns/activitystreams',
                route('jsonld.context'),
            ],
            'id' => route('jsonld.applications.profile', $this),
            'type' => ['interop:Application', 'Application'],
            'name' => $this->name,
            'dc:language' => 'en',
            'dc:created' => $this->created_at->toJSString(),
            'dc:modified' => $this->updated_at->toJSString(),
            'interop:applicationDescription' => $this->description,
            'interop:applicationName' => $this->name,
            'interop:applicationThumbnail' => $this->logo_url,
            'interop:hasAccessDescriptionSet' => [
                route('jsonld.applications.access-description-set', $this),
            ],
            'interop:hasAccessNeedGroup' => route('jsonld.applications.access-need-group', $this),
            'oidc:client_name' => $this->name,
            'oidc:client_uri' => $this->url,
            'oidc:default_max_age' => 3600,
            'oidc:grant_types' => ['refresh_token', 'authorization_code'],
            'oidc:logo_uri' => $this->logo_url,
            'oidc:redirect_uris' => [$this->url],
            'oidc:require_auth_time' => true,
            'oidc:response_types' => 'code',
            'preferredUsername' => 'app',
            'oidc:scope' => 'openid profile offline_access webid',
        ];
    }

    protected function validateContext(string $context) {
        if ($context !== 'https://www.w3.org/ns/solid/oidc-context.jsonld') {
            throw new Exception("Unsupported JSON-LD Context: $context");
        }
    }
}
