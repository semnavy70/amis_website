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
        try {

//            $accessToken = $this->getAccessToken();
            $accessToken = "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";

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
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    private function getAccessToken()
    {
        $jsonString = '
{
  "type": "service_account",
  "project_id": "unique-provider-335305",
  "private_key_id": "1aba2c46e0798b1c655e445af1a0c7e19f354b65",
  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQC9kxxERNqxQhQv\nxuHya1Al1A6VYgSTpyeXGoHFd8KQetd46p9FIwqFv35ySOoIU+GNGIv+5ICUJ3PD\nyJmnTB0VXiveAtyEMdktomkeo2N/s+OXptQ8HNg6wBURGMbPcSRjliiNLr4Q3zMY\nooVLof2eIEAg3AKH40AEVADRTJTEO2lmTLCPyNh/EToRwgpWdmIL13b+ArOZD/28\nizQG81h5R3pWZSSBJjbBqnk3Rnd+pcRZGxJFYTWM+pcRLQ3Y4AQQB6gMZKfBeqV0\n7wp5YEGvEhufdR9sutVcfutec2yV/JCbmLKq/qRsM02mp0NIooDdZo4OGhjOstmU\nKlIsxiY9AgMBAAECggEALW+iYTxte/md8/uDcQJGceKa4jPda/QuuXkZbFYxVEaU\n+T6mkL/+yCKm8EZIjVlpYFNnTl6+8INqLB0asq279MCe2/Wsm6SE7HqWHklD0jov\nzMun54Z0TtR12CSrldGEyreVHY178XhFe1yMfR2kty78n8OLeb0+PStTDNcBeuxl\nqA5UOx74hQuUSImESj+n0Gwc0FLKSHxk9LU8BesZBi2KHcHK7AJz95XCj5RFytDG\nvmFRkd+VB0Koonn/bcOEunOs04qtWwojS9DbAZDtM4bx7smL+T8x7n7vvsD99mGE\n71hoMNXzYuXASuKLw0zWh170Om4IErAwbHlTzl2CEQKBgQD/m5khKihyrnsR4x1h\ng7DPp3Bz77r0V3HALXs+ah2xp90kXUbE91iaNRwJxbrANwugrC7fzFCbka8ymsgk\nQE4CKbRBAoUHVPa9So2SIgl4ie3CKmL6+eIJwKjYpF34y/rkBi0nDYX1m9quS6aH\n23DnA72vs3shhDhhT0718Qs1+QKBgQC93ZMdSafu55sU7J2GFowzuWv8s1xH4KR3\nnEbhNph4VwZgL+XEe5wVGrYmquznFpnpBEERzPCT31k/VWOBFtsYf07b5kMxRske\naf05bJnMa/Zbd2CaxmuDw6d9XHsXRp714sn9y2m76Wbru8yLL+dXmH4Z5GyMWS7a\niOek9bNzZQKBgErjSpUF5f3bkuElulj0nVvpga/l/89Qw1n7uU0LCBIhzU+3KGHS\n2hmsD7/pN5LTTcvQRpd5I/DAWSUpZhQA5xoJH++gDluckAHbkujKoh23w3oMsx03\nEvuqf42hcorPMH2YNahodOQFuqcwMOVC7KwyU2Pj4OJr+5y/ALJb4d35AoGADUNH\nHYqhonynRqTotA8rKAnR00ssLREyK/DMurq3l+BsX5e48yq3UnoVM0pJVjMr+S0E\n5ptsSsgVUelDFCdmkqWB+rZxByYssmUw/Svq6m64PNdv9h/aLtAiCQ3Gw295dy+q\ncIIfFrNNLzZlKWvlOyc519EvC/bG4RkjJVDMgkkCgYEArBeo/a+6u59mNziQ7mqP\nii4cBIkLNuStQ4foY2T5QxI1LuvcSVRk/+CXRId7/RwpRxXbIU605tQdkpcy2KeA\nIUN7SAQA8nF8kV6FdthHa0euffFfeP4ZDMkqKD/V+6V+E9bBBSJ5YSR5aUMbm0rr\nqof8NdwUPPOT/U1yDYHSkpQ=\n-----END PRIVATE KEY-----\n",
  "client_email": "analytic-service-account@unique-provider-335305.iam.gserviceaccount.com",
  "client_id": "114660864646863532759",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/analytic-service-account%40unique-provider-335305.iam.gserviceaccount.com",
  "universe_domain": "googleapis.com"
}
        ';
        $serviceAccountKey = json_decode($jsonString, true);

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
