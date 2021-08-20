<?php

require __DIR__ . '/../vendor/autoload.php';

use Elliptic\EC;

$ec = new EC('secp256k1');

// Generate keys
$key = $ec->genKeyPair();

//var_dump($key->getPrivate('hex'), $key->getPublic('hex'));

$address = FileCoin\Address::newSecp256k1Address($key->getPublic('hex'));


//use Mdanter\Ecc\EccFactory;
//use Mdanter\Ecc\Serializer\PrivateKey\PemPrivateKeySerializer;
//use Mdanter\Ecc\Serializer\PrivateKey\DerPrivateKeySerializer;
//use Mdanter\Ecc\Serializer\PublicKey\DerPublicKeySerializer;
//
//$adapter = EccFactory::getAdapter();
//$generator = EccFactory::getSecgCurves()->generator256k1();
//$private = $generator->createPrivateKey();

//$derSerializer = new DerPrivateKeySerializer($adapter);
//$der = $derSerializer->serialize($private);
//var_dump(base64_encode($der));
//
//$pemSerializer = new PemPrivateKeySerializer($derSerializer);
//$pem = $pemSerializer->serialize($private);
//var_dump($pem);
//
//$private = phpseclib3\Crypt\EC::createKey('secp256k1');
///** @var \phpseclib3\Crypt\EC\PublicKey $public */
//$public = $private->getPublicKey();

//var_dump(($private));
////var_dump($public->getContext());
//
//var_dump($private->getEncodedCoordinates());

//$derSerializer = new DerPrivateKeySerializer($adapter);
//$der = $derSerializer->serialize($private);

//$publicKeySerializer = new DerPublicKeySerializer($adapter);
//$public = $publicKeySerializer->getUncompressedKey($private->getPublicKey());

//$address = FileCoin\Address::newSecp256k1Address(hex2bin($public));

//var_dump(gmp_strval($private->getSecret(), 16));

//var_dump($public);


//var_dump(bin2hex($der));
//var_dump(gmp_strval(gmp_init(bin2hex($der), 16), 16));
//var_dump('f1rrq3zwopkj5xv23nt7bv3blend6qamjffrq3emq', '428b38fd6b3f47d439a6834bd312feb7562817525fc4eb0c4e372e72b222052f', '0471975e47c9a6d3481ec188580e2439dce0911a55f577ca9b6dbb6d6677c39fc53f652264779d0877980e9f643eaf699ce94f3fe64bf632351ccf3f5853455458');

////new \FileCoin\Address(['1']);
//
//function string2ByteArray($string) {
//    return unpack('C*', $string);
//}
//
//function byteArray2String($byteArray) {
//    $chars = array_map("chr", $byteArray);
//    return join($chars);
//}
//
//$str = 'hello';
//
//var_dump(substr($str, 1));
//
//var_dump(string2ByteArray(1));
//
//var_dump(byteArray2String(string2ByteArray($str)));
//
//var_dump(\FileCoin\Protocol::isValid('0'));
//
//switch (0) {
//    case \FileCoin\Protocol::ID:
//        var_dump('id');
//        break;
//    default:
//        var_dump('default');
//        break;
//}