<?php

namespace FileCoin;

use MyCLabs\Enum\Enum;

final class Protocol extends Enum
{
    const ID = 0;
    const SECP256K1 = 1;
    const ACTOR = 2;
    const BLS = 3;
}