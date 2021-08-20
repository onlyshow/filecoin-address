<?php

namespace FileCoin;

use Base32\Base32Hex;
use ParagonIE\ConstantTime\Base32;

class Address
{
    public static int $payloadHashLength = 20;
    public static int $checksumHashLength = 4;
    public static int $blsPublicKeyBytes = 48;

    public string $str;
    public int $protocol;
    public string $network;

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

    public function __toString(): string
    {
        $chsm = getChecksum($this->str);
        return Base32::encode(substr($this->str, 1) . ($chsm));
    }

    public static function newIDAddress()
    {

    }

    /**
     * @throws \Exception
     */
    public static function newSecp256k1Address(string $publicKey): Address
    {
        var_dump(Base32::encode(addressHash($publicKey)), 'yiek2s5wvaaecbffgabgombckm2aoj2j', string2ByteArray(Base32::decode('yiek2s5wvaaecbffgabgombckm2aoj2j')));
        return self::newAddress(Protocol::SECP256K1, addressHash($publicKey));
    }

    public static function newActorAddress()
    {

    }

    /**
     * @throws \Exception
     */
    public static function newBLSAddress(string $publicKey): Address
    {
        return self::newAddress(Protocol::BLS, addressHash($publicKey));
    }

    /**
     * @throws \Exception
     * @return Address
     */
    private static function newAddress($protocol, $payload): Address
    {
        switch ($protocol)
        {
            case Protocol::ID:
                break;
            case Protocol::SECP256K1:
            case Protocol::ACTOR:
                if (strlen($payload) != self::$payloadHashLength) {
                    throw new \InvalidArgumentException('invalid payload');
                }
                break;
            case Protocol::BLS:
                if (strlen($payload) != self::$blsPublicKeyBytes) {
                    throw new \InvalidArgumentException('invalid payload');
                }
                break;
            default:
                throw new \InvalidArgumentException('unknown protocol');
        }

        return new Address($protocol . ($payload));
    }
}