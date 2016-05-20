<?php

require_once 'vendor/autoload.php';

use Ignittion\Kong\Kong;


// User e-mail, representing authentication

if (!isset($_GET['email'])) {
    die('No email set');
}

$email = $_GET['email'];

echo '<pre>';


// Getting or creating consumer in Kong

$kong = new Kong('http://192.168.99.100', 8001);
$consumer = $kong->consumer()->get($email);

if ($consumer->code == 404) {
    echo "\n\nKong Consumer Criado\n";
    $consumer = $kong->consumer()->create(['username'=>$email, 'custom_id' => rand()]);
}

echo "\n\nKong Consumer\n";
print_r($consumer);


// Getting or creating JWT Key/Secret in Kong

$jwtClient = new JWTClient;

$response = $jwtClient->getOne($consumer->data->id);
if (!$response) {
    echo "Kong Key/Secret Criado\n";
    $response = $jwtClient->create($consumer->data->id);
}

echo "\n\nKong Key/Secret\n";
print_r($response);


// Generating JWT Token

$tokenizer = new JWTTokenizer;

$token = $tokenizer->encode($response['key'], $response['secret']);
$decoded = $tokenizer->decode($token, $response['secret']);

echo "\n\nJWT Token\n";
print_r($token); // Authorizarion: Bearer $token

echo "\n\nJWT Decoded Token\n";
var_dump($decoded); // Accessing Payload
