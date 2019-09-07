<?php namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 * {
 *  "alg" : "ES256",
 *  "kid" : "ABC123DEFG"
 * }
 * {
 *  "iss": "DEF123GHIJ",
 *  "iat": 1437179036
 * }
 */


trait apn
{
    public function generateAPNKeyHeader()
    {
        return base64_encode(json_encode([
            'alg' => 'ES256',
            'kid' => env('AUTH_KEY_ID')
        ]));
    }

    public function generateAPNKeyClaims()
    {
        return base64_encode(json_encode([
            'iss' => env('TEAM_ID'),
            'iat' => time()
        ]));
    }

    public function getPrivateKey()
    {
        $keyPath = 'file://'.storage_path(env('AUTH_KEY_PATH'));
        return openssl_pkey_get_private($keyPath);
    }

    public function generateAuthenticationHeader()
    {
        $header = $this->generateAPNKeyHeader();
        $claims = $this->generateAPNKeyClaims();
        $orig = $header.'.'.$claims;
        $key = $this->getPrivateKey();

        if ($key == FALSE) {
            throw new \Exception("Open private key failed");
        }

        openssl_sign($orig, $signature, $key, 'sha256');
        $signed = base64_encode($signature);

        return $orig.'.'.$signed;
    }

    public function generateAPNUri(int $environment)
    {
        switch ($environment) {
            case config('variables.sandbox'):
                $prefix = 'api.development';
                break;
            default:
                $prefix = 'api';
        }

        return "https://".$prefix.".push.apple.com/3/device/";
    }

    public function generateAPNHeader()
    {
        return [
            'apns-topic' => env('BUNDLE_ID'),
            'Accept' => 'application/json',
            'authorization' => 'bearer ' . $this->generateAuthenticationHeader()
        ];
    }

    public function generateAPNPayload($title, $body, $badge = -1, $sound = "")
    {
        $payload = [
            'aps' => [
                'alert' => [
                    'title' => $title,
                    'body' => $body
                ]
            ]
        ];

        if ($badge != -1) {
            $payload['aps'] += [ 'badge' => $badge ];
        }

        if ($sound != "") {
            $payload['aps'] += [ 'sound' => $sound ];
        }

        return json_encode($payload);
    }
}
