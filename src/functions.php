<?php

namespace FileCoin {

    use deemru\Blake2b;
    use Softwarewisdom\LEB128\Unsigned\Decode;

    function string2ByteArray($string): array
    {
        return unpack('C*', $string);
    }

    function byteArray2String(array $byteArray): string
    {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }

    function addressHash(string $ingest): string
    {
        // PayloadHashLength defines the hash length taken over addresses using the Actor and SECP256K1 protocols.
        $payloadHashLength = 20;
        return (new Blake2b($payloadHashLength))->hash($ingest);
    }

    function getChecksum(string $ingest): string
    {
        // ChecksumHashLength defines the hash length used for calculating address checksums.
        $checksumHashLength = 4;
        return (new Blake2b($checksumHashLength))->hash($ingest);
    }

    function decode(string $address): Address
    {

    }

    /**
     * @throws \Exception
     */
    function encode(string $network, Address $address): string
    {
        if (!$address || !$address->str) throw new \Exception('Invalid address');
        $payload = $address->getPayload();

        switch ($address->getProtocol()) {
            case Protocol::ID:
                $decode = new Decode($address->getPayload());
                $decode->decode();
                return $network . $address->getProtocol() . $decode->value();
            default:
                $protocolByte = '';
                $checksum = getChecksum(array_merge(string2ByteArray($address->getProtocol()), $address->getPayload()));

                return $network . $address->getProtocol();
        }
    }
}