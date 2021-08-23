<?php

namespace FileCoin {

    use deemru\Blake2b;

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
        return (new Blake2b(Address::PayloadHashLength))->hash($ingest);
    }

    function checksum(string $ingest): string
    {
        // ChecksumHashLength defines the hash length used for calculating address checksums.
        return (new Blake2b(Address::ChecksumHashLength))->hash($ingest);
    }
}