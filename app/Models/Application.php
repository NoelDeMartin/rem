<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name', 'description', 'url'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function profileDocument(array $options = []): array {
        if (! empty($options['context'])) {
            return [
                '@context' => [
                    'https://www.w3.org/ns/activitystreams',
                    // TODO `${baseUrl}context.jsonld`
                ],
                'id' => route('applications.show', $this),
                'type' => ['interop:Application', 'Application'],
                'name' => $this->name,
                'dc:created' => '2024-11-11T20:17:31.282Z',
                'dc:language' => 'en',
                'dc:modified' => '2024-11-11T20:17:51.21Z',
                'interop:applicationDescription' => $this->description,
                'interop:applicationName' => $this->name,
                // TODO 'interop:applicationThumbnail' => logoUrl,
                'interop:hasAccessDescriptionSet' => [
                    // TODO `${baseUrl}access-description-set.jsonld`
                ],
                // TODO 'interop:hasAccessNeedGroup' => `${baseUrl}acccess-need-group.jsonld`,
                'oidc:client_name' => $this->name,
                'oidc:client_uri' => $this->url,
                'oidc:default_max_age' => 3600,
                'oidc:grant_types' => ['refresh_token', 'authorization_code'],
                // TODO 'oidc:logo_uri' => logoUrl,
                'oidc:redirect_uris' => [$this->url],
                'oidc:require_auth_time' => true,
                'oidc:response_types' => 'code',
                'oidc:scope' => 'openid profile offline_access webid',
            ];
        }

        return [
            '@context' => 'https://www.w3.org/ns/solid/oidc-context.jsonld',
            '@type' => [
                'http://www.w3.org/ns/solid/interop#Application',
                'https://www.w3.org/ns/activitystreams#Application',
            ],
            'client_id' => route('applications.show', $this),
            'client_name' => $this->name,
            'client_uri' => $this->url,
            'grant_types' => ['refresh_token', 'authorization_code'],
            // TODO 'logo_uri' => $this->logo,
            'redirect_uris' => [
                '@none' => [$this->url],
            ],
            'response_types' => 'code',
            'scope' => 'openid profile offline_access webid',
            'http://purl.org/dc/terms/created' => [
                '@type' => 'xsd:dateTime',
                '@value' => '2024-11-11T20:17:31.282Z',
            ],
            'http://purl.org/dc/terms/language' => 'en',
            'http://purl.org/dc/terms/modified' => [
                '@type' => 'xsd:dateTime',
                '@value' => '2024-11-11T20:17:51.21Z',
            ],
            'http://www.w3.org/ns/solid/interop#applicationDescription' => $this->description,
            'http://www.w3.org/ns/solid/interop#applicationName' => $this->name,
            // TODO 'http://www.w3.org/ns/solid/interop#applicationThumbnail' => $this->logo,
            'http://www.w3.org/ns/solid/interop#hasAccessDescriptionSet' => [
                // TODO { client_id => `${baseUrl}access-description-set.jsonld` },
            ],
            'http://www.w3.org/ns/solid/interop#hasAccessNeedGroup' => [
                // TODO client_id => `${baseUrl}acccess-need-group.jsonld`,
            ],
            'oidc:default_max_age' => 3600,
            'oidc:require_auth_time' => true,
        ];
    }
}
