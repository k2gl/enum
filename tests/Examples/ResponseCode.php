<?php declare(strict_types=1);

namespace K2gl\Enum\Tests\Examples;

use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\ExtendedBackedEnumInterface;

enum ResponseCode: int implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    case HTTP_CONTINUE = 100;
    case HTTP_OK = 200;
    case HTTP_I_AM_A_TEAPOT = 418;
}