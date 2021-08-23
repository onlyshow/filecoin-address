<?php

namespace FileCoin;

use ParagonIE\ConstantTime\Base32;

class Address
{
    const PayloadHashLength = 20;
    const ChecksumHashLength = 4;
    const BlsPublicKeyBytes = 48;

    private string $str;
    private int $protocol;
    private string $network;

    /**
     * @throws \Exception
     */
    public function __construct(string $str, string $network = Network::MAIN)
    {
        if (strlen($str) < 1) throw new \Exception('Missing str in address');
        $this->str = $str;
        $this->protocol = intval($this->str[0]);
        if (!Protocol::isValid($this->protocol)) {
            throw new \Exception("Invalid protocol {$this->protocol}");
        }
        $this->network = $network;
    }

    public function getProtocol(): int
    {
        return $this->protocol;
    }

    public function getPayload(): string
    {
        return substr($this->str, 1);
    }

    public function __toString(): string
    {
        return $this->network . $this->getProtocol() . Base32::encodeUnpadded($this->getPayload() . checksum($this->str));
    }

    public static function newIDAddress(int $id)
    {
        if ($id > PHP_INT_MAX) throw new \Exception('IDs must be less than 2^63');
        //todo varint编码实现
//        return self::newAddress(Protocol::ID, );
    }

    /**
     * @throws \Exception
     */
    public static function newSecp256k1Address(string $publicKey): Address
    {
        return self::newAddress(Protocol::SECP256K1, addressHash($publicKey));
    }

    /**
     * @throws \Exception
     */
    public static function newActorAddress(string $data): Address
    {
        return self::newAddress(Protocol::ACTOR, addressHash($data));
    }

    /**
     * @throws \Exception
     */
    public static function newBLSAddress(string $publicKey): Address
    {
        return self::newAddress(Protocol::BLS, $publicKey);
    }

    /**
     * @throws \Exception
     * @return Address
     */
    private static function newAddress($protocol, $payload): Address
    {
        $payloadArr = string2ByteArray($payload);

        switch ($protocol)
        {
            case Protocol::ID:
                break;
            case Protocol::SECP256K1:
            case Protocol::ACTOR:
                if (count($payloadArr) != self::PayloadHashLength) {
                    throw new \InvalidArgumentException('invalid payload');
                }
                break;
            case Protocol::BLS:
                if (count($payloadArr) != self::BlsPublicKeyBytes) {
                    throw new \InvalidArgumentException('invalid payload');
                }
                break;
            default:
                throw new \InvalidArgumentException('unknown protocol');
        }

//        $buf = string2ByteArray($protocol);
//        $buf = array_merge($buf, $payloadArr);
//        return new Address(byteArray2String($buf));

        return new Address($protocol . $payload);
    }
}