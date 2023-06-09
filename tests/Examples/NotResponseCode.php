<?php declare(strict_types=1);

namespace K2gl\Enum\Tests\Examples;

use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\ExtendedBackedEnumInterface;

enum NotResponseCode: int implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    case HTTP_OK = 200;
}