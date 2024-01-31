<?php

namespace Vanguard\Http\Controllers\Api\GA;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use GuzzleHttp\Client;

class GoogleAnalyticController
{
    public function index()
    {
        $accessToken = $this->getAccessToken();

        $client = new Client();
        $response = $client->request('POST', 'https://analyticsreporting.googleapis.com/v4/reports:batchGet', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
            'json' => [
                'reportRequests' => [
                    [
                        'viewId' => 'G-9QVHC41MHV',
                        'dateRanges' => [
                            ['startDate' => '7daysAgo', 'endDate' => 'today'],
                        ],
                        'metrics' => [
                            ['expression' => 'ga:sessions'],
                        ],
                    ]
                ]
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

    private function getAccessToken()
    {
        $serviceAccountKey = json_decode(file_get_contents(storage_path('app/google-service-account.json')), true);

        // Configure JWT library with RSA SHA256 signer and your service account's private key
        $config = Configuration::forAsymmetricSigner(new Sha256(), InMemory::plainText($serviceAccountKey['private_key']), InMemory::empty());
        $now = new \DateTimeImmutable();

        // Create a token according to Google's OAuth 2.0 expectations
        $token = $config->builder()
            ->issuedBy($serviceAccountKey['client_email']) // iss claim
            ->permittedFor('https://oauth2.googleapis.com/token') // aud claim
            ->issuedAt($now) // iat claim
            ->expiresAt($now->modify('+1 hour')) // exp claim
            ->withClaim('scope', 'https://www.googleapis.com/auth/analytics.readonly') // additional claims
            ->getToken($config->signer(), $config->signingKey()); // Sign the token with your service account's private key

        // Use GuzzleHttp client to send a request for exchanging JWT for an access token
        $client = new Client();
        $response = $client->post('https://oauth2.googleapis.com/token', [
            'form_params' => [
                'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                'assertion' => $token->toString(),
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['access_token'];
    }

}
