<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationModel extends Model
{
    use HasFactory;

    protected $fillable = ['application_id', 'name', 'url'];

    public function application(): BelongsTo {
        return $this->belongsTo(Application::class);
    }

    public function classDescription(array $options = []): array {
        if (! empty($options['context'])) {
            $this->validateContext($options['context']);

            return [
                '@context' => 'https://www.w3.org/ns/solid/oidc-context.jsonld',
                '@type' => 'http://activitypods.org/ns/core#ClassDescription',
                'client_id' => route('jsonld.applications.models.class-description', [$this->application, $this]),
                'http://activitypods.org/ns/core#describedBy' => [
                    'client_id' => route('jsonld.applications.profile', $this->application),
                ],
                'http://activitypods.org/ns/core#describedClass' => [
                    'client_id' => $this->url,
                ],
                'http://activitypods.org/ns/core#labelPredicate' => [
                    'client_id' => 'https://www.w3.org/ns/activitystreams#name',
                ],
                'http://purl.org/dc/terms/created' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->created_at->toJSString(),
                ],
                'http://purl.org/dc/terms/modified' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->updated_at->toJSString(),
                ],
                'http://www.w3.org/2004/02/skos/core#prefLabel' => $this->name,
            ];
        }

        return [
            '@context' => [
                'https://www.w3.org/ns/activitystreams',
                route('jsonld.context'),
            ],
            'type' => 'apods:ClassDescription',
            'id' => route('jsonld.applications.models.class-description', [$this->application, $this]),
            'apods:describedBy' => route('jsonld.applications.profile', $this->application),
            'apods:describedClass' => $this->url,
            'apods:labelPredicate' => 'as:name',
            'dc:created' => $this->created_at->toJSString(),
            'dc:modified' => $this->updated_at->toJSString(),
            'skos:prefLabel' => $this->name,
        ];
    }

    public function accessNeed(array $options = []): array {
        if (! empty($options['context'])) {
            $this->validateContext($options['context']);

            return [
                '@context' => 'https://www.w3.org/ns/solid/oidc-context.jsonld',
                '@type' => 'http://www.w3.org/ns/solid/interop#AccessNeed',
                'client_id' => route('jsonld.applications.models.access-need', [$this->application, $this]),
                'http://activitypods.org/ns/core#registeredClass' => [
                    'client_id' => $this->url,
                ],
                'http://purl.org/dc/terms/created' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->created_at->toJSString(),
                ],
                'http://purl.org/dc/terms/modified' => [
                    '@type' => 'xsd:dateTime',
                    '@value' => $this->updated_at->toJSString(),
                ],
                'http://www.w3.org/ns/solid/interop#accessMode' => [
                    ['client_id' => 'http://www.w3.org/ns/auth/acl#Read'],
                    ['client_id' => 'http://www.w3.org/ns/auth/acl#Write'],
                ],
                'http://www.w3.org/ns/solid/interop#accessNecessity' => [
                    'client_id' => 'http://www.w3.org/ns/solid/interop#AccessRequired',
                ],
            ];
        }

        return [
            '@context' => [
                'https://www.w3.org/ns/activitystreams',
                route('jsonld.context'),
            ],
            'type' => 'interop:AccessNeed',
            'id' => route('jsonld.applications.models.access-need', [$this->application, $this]),
            'apods:registeredClass' => $this->url,
            'dc:created' => $this->created_at->toJSString(),
            'dc:modified' => $this->updated_at->toJSString(),
            'interop:accessMode' => ['acl:Read', 'acl:Write'],
            'interop:accessNecessity' => 'interop:AccessRequired',
        ];
    }

    protected function validateContext(string $context) {
        if ($context !== 'https://www.w3.org/ns/solid/oidc-context.jsonld') {
            throw new Exception("Unsupported JSON-LD Context: $context");
        }
    }
}
