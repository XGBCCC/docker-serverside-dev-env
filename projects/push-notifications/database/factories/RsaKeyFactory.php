<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RsaKey;
use Faker\Generator as Faker;

$keyVer = 0;

$factory->define(RsaKey::class, function (Faker $faker) use(&$keyVer) {
    $public = "-----BEGIN PUBLIC KEY-----
        MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsvM8YO2gS+nR8/bkyz6o
        +qS6wtT6qmd6I4tKB20iLGdmdrpLo/hLGh4ccZdAXmNJmoTosBNtLMZ6zSQN4/sG
        lGkxe71+YVHcBxkCDssCoBteS4nj9k79fzeENr0cLUlFN5DXK7x2ILwGuEKpJkOn
        ...
        -----END PUBLIC KEY-----";
    $private = "-----BEGIN RSA PRIVATE KEY-----
        Proc-Type: 4,ENCRYPTED
        DEK-Info: DES-EDE3-CBC,D904893B986856A0

        QHuCwkr/C1q53Bcu1qP6z9k2dm7wRzrkyISfk9KGefPdbNX8N2SQykRmk51tG/KW
        otekb9EXZc6L5hx1pwLvyEXr3gv2bIfanifs5HUVMF2u1pWL32e5r2YHOrHSUZ9j
        hFyPiwzTxYWiiPmzgXqkmAm7ntByzz1il7WVA8bKGtpozfDbn9bUHJBwbZh9hFot
        /q85nB1NGTzb3uZ2VH2y+sfnJB4x5uo9YD2P63ZSGuLEdJbSxU1Rqx4nEU+JeIzc
        ...
        -----END RSA PRIVATE KEY-----";

    $passcode = "boxue";
    $keyVer += 1;
    return [
        'public' => $public,
        'private' => $private,
        'version' => $keyVer,
        'passcode' => $passcode
    ];
});
