<?php

require __DIR__ . '/../vendor/autoload.php';

use Elliptic\EC;

$ec = new EC('secp256k1');

// Generate keys
$key = $ec->genKeyPair();

var_dump($key->getPrivate('hex'), $key->getPublic('hex'));

$address = FileCoin\Address::newSecp256k1Address($key->getPublic('hex'));

var_dump((string) $address, 'f177n6plyyfnvc24raori6gqvem74jqqbs2ofd2lq');