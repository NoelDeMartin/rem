<?php

namespace App\Http\Controllers;

class JsonLDContextController extends Controller
{
    public function __invoke()
    {
        return response([
            '@context' => [
                'apods' => 'http://activitypods.org/ns/core#',
                'notify' => 'http://www.w3.org/ns/solid/notifications#',
                'interop' => 'http://www.w3.org/ns/solid/interop#',
                'oidc' => 'http://www.w3.org/ns/solid/oidc#',
                'sec' => 'https://w3id.org/security#',
                'acl' => 'http://www.w3.org/ns/auth/acl#',
                'vcard' => 'http://www.w3.org/2006/vcard/ns#',
                'rdfs' => 'http://www.w3.org/2000/01/rdf-schema#',
                'ldp' => 'http://www.w3.org/ns/ldp#',
                'semapps' => 'http://semapps.org/ns/core#',
                'dc' => 'http://purl.org/dc/terms/',
                'foaf' => 'http://xmlns.com/foaf/0.1/',
                'schema' => 'http://schema.org/',
                'skos' => 'http://www.w3.org/2004/02/skos/core#',
                'xsd' => 'http://www.w3.org/2001/XMLSchema#',
                'apods:closingTime' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'apods:hasFormat' => [ '@type' => '@id' ],
                'apods:hasStatus' => [ '@type' => '@id' ],
                'apods:contacts' => [ '@type' => '@id' ],
                'apods:contactRequests' => [ '@type' => '@id' ],
                'apods:ignoredContacts' => [ '@type' => '@id' ],
                'apods:rejectedContacts' => [ '@type' => '@id' ],
                'apods:announces' => [ '@type' => '@id' ],
                'apods:announcers' => [ '@type' => '@id' ],
                'apods:attendees' => [ '@type' => '@id' ],
                'apods:preferredForTypes' => [ '@type' => '@id' ],
                'apods:application' => [ '@type' => '@id' ],
                'apods:hasSpecialRights' => [ '@type' => '@id' ],
                'apods:acceptedAccessNeeds' => [ '@type' => '@id' ],
                'apods:acceptedSpecialRights' => [ '@type' => '@id' ],
                'apods:registeredClass' => [ '@type' => '@id' ],
                'apods:registeredContainer' => [ '@type' => '@id' ],
                'apods:hasClassDescription' => [ '@type' => '@id' ],
                'apods:preferredForClass' => [ '@type' => '@id' ],
                'apods:describedClass' => [ '@type' => '@id' ],
                'apods:describedBy' => [ '@type' => '@id' ],
                'apods:labelPredicate' => [ '@type' => '@id' ],
                'apods:defaultApp' => [ '@type' => '@id' ],
                'apods:availableApps' => [ '@type' => '@id' ],
                'notify:channel' => [ '@type' => '@id' ],
                'notify:endAt' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'notify:rate' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#duration' ],
                'notify:receiveFrom' => [ '@type' => '@id' ],
                'notify:sender' => [ '@type' => '@id' ],
                'notify:sendTo' => [ '@type' => '@id' ],
                'notify:startAt' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'notify:subscription' => [ '@type' => '@id' ],
                'notify:topic' => [ '@type' => '@id' ],
                'notify:state' => [ '@type' => '@id' ],
                'notify:feature' => [ '@type' => '@id' ],
                'notify:channelType' => [ '@type' => '@id' ],
                'notify:accept' => [ '@type' => '@id' ],
                'notify:EventSourceChannel2023' => [ '@type' => '@id' ],
                'notify:LDNChannel2023' => [ '@type' => '@id' ],
                'notify:StreamingHTTPChannel2023' => [ '@type' => '@id' ],
                'notify:WebhookChannel2023' => [ '@type' => '@id' ],
                'notify:WebSocketChannel2023' => [ '@type' => '@id' ],
                'interop:accessNecessity' => [ '@type' => '@id' ],
                'interop:accessMode' => [ '@type' => '@id' ],
                'interop:accessScenario' => [ '@type' => '@id' ],
                'interop:applicationAuthor' => [ '@type' => '@id' ],
                'interop:authenticatedAs' => [ '@type' => '@id' ],
                'interop:dataOwner' => [ '@type' => '@id' ],
                'interop:grantedAt' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'interop:grantedBy' => [ '@type' => '@id' ],
                'interop:grantee' => [ '@type' => '@id' ],
                'interop:hasAccessGrant' => [ '@type' => '@id' ],
                'interop:hasAccessNeed' => [ '@type' => '@id' ],
                'interop:hasAccessNeedGroup' => [ '@type' => '@id' ],
                'interop:hasAccessDescriptionSet' => [ '@type' => '@id' ],
                'interop:hasDataGrant' => [ '@type' => '@id' ],
                'interop:satisfiesAccessNeed' => [ '@type' => '@id' ],
                'interop:scopeOfGrant' => [ '@type' => '@id' ],
                'interop:registeredAgent' => [ '@type' => '@id' ],
                'interop:registeredAt' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'interop:registeredBy' => [ '@type' => '@id' ],
                'interop:updatedAt' => [ '@type' => '@id' ],
                'interop:usesLanguage' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#language' ],
                'oidc:client_uri' => [ '@type' => '@id' ],
                'oidc:logo_uri' => [ '@type' => '@id' ],
                'oidc:policy_uri' => [ '@type' => '@id' ],
                'oidc:tos_uri' => [ '@type' => '@id' ],
                'oidc:redirect_uris' => [ '@type' => '@id' ],
                'EcdsaKoblitzSignature2016' => 'sec:EcdsaKoblitzSignature2016',
                'Ed25519Signature2018' => 'sec:Ed25519Signature2018',
                'EncryptedMessage' => 'sec:EncryptedMessage',
                'GraphSignature2012' => 'sec:GraphSignature2012',
                'LinkedDataSignature2015' => 'sec:LinkedDataSignature2015',
                'LinkedDataSignature2016' => 'sec:LinkedDataSignature2016',
                'CryptographicKey' => 'sec:Key',
                'authenticationTag' => 'sec:authenticationTag',
                'assertionMethod' => [ '@id' => 'sec:assertionMethod', '@type' => '@id' ],
                'canonicalizationAlgorithm' => 'sec:canonicalizationAlgorithm',
                'cipherAlgorithm' => 'sec:cipherAlgorithm',
                'cipherData' => 'sec:cipherData',
                'cipherKey' => 'sec:cipherKey',
                'digestAlgorithm' => 'sec:digestAlgorithm',
                'digestValue' => 'sec:digestValue',
                'controller' => [ '@id' => 'sec:controller', '@type' => '@id' ],
                'domain' => 'sec:domain',
                'encryptionKey' => 'sec:encryptionKey',
                'expiration' => [ '@id' => 'sec:expiration', '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'expires' => [ '@id' => 'sec:expiration', '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'initializationVector' => 'sec:initializationVector',
                'iterationCount' => 'sec:iterationCount',
                'nonce' => 'sec:nonce',
                'normalizationAlgorithm' => 'sec:normalizationAlgorithm',
                'owner' => [ '@id' => 'sec:owner', '@type' => '@id' ],
                'password' => 'sec:password',
                'privateKey' => [ '@id' => 'sec:privateKey', '@type' => '@id' ],
                'privateKeyPem' => 'sec:privateKeyPem',
                'publicKey' => [ '@id' => 'sec:publicKey', '@type' => '@id' ],
                'publicKeyBase58' => 'sec:publicKeyBase58',
                'publicKeyMultibase' => [ '@type' => 'sec:multibase', '@id' => 'sec:publicKeyMultibase' ],
                'publicKeyPem' => 'sec:publicKeyPem',
                'publicKeyWif' => 'sec:publicKeyWif',
                'publicKeysService' => [ '@id' => 'sec:publicKeysService', '@type' => '@id' ],
                'revoked' => [ '@id' => 'sec:revoked', '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'salt' => 'sec:salt',
                'secretKeyMultibase' => [ '@type' => 'sec:multibase', '@id' => 'sec:secretKeyMultibase' ],
                'signature' => 'sec:signature',
                'signatureAlgorithm' => 'sec:signingAlgorithm',
                'signatureValue' => 'sec:signatureValue',
                'acl:accessTo' => [ '@type' => '@id' ],
                'acl:agent' => [ '@type' => '@id' ],
                'acl:agentGroup' => [ '@type' => '@id' ],
                'acl:agentClass' => [ '@type' => '@id' ],
                'acl:default' => [ '@type' => '@id' ],
                'acl:mode' => [ '@type' => '@id' ],
                'vcard:hasAddress' => [ '@type' => '@id' ],
                'vcard:hasGeo' => [ '@type' => '@id' ],
                'vcard:photo' => [ '@type' => '@id' ],
                'rdfs:seeAlso' => [ '@type' => '@id' ],
                'semapps:sortPredicate' => [ '@type' => '@id' ],
                'semapps:sortOrder' => [ '@type' => '@id' ],
                'dc:created' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'dc:modified' => [ '@type' => 'http://www.w3.org/2001/XMLSchema#dateTime' ],
                'dc:creator' => [ '@type' => '@id' ],
                'dc:source' => [ '@type' => '@id' ],
                'skos:broader' => [ '@type' => '@id' ],
                'skos:narrower' => [ '@type' => '@id' ],
            ],
        ])
        ->withHeaders(['Content-Type' => 'application/ld+json']);
    }
}