<?php

require __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;

$key = "your-secret-key";
$payload = [
    "iss" => "http://example.org",
    "aud" => "http://example.com",
    "data" => [
        "user_id" => 4,
        "role" => "banner_owner"
    ],
    "iat" => 1356999524,
    "nbf" => 1357000000,
];

$jwt = JWT::encode($payload, $key, 'HS256');
echo "Token: " . $jwt;
