<?php declare(strict_types=1);

namespace K2gl\Enum\Tests\Examples;

use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\ExtendedBackedEnumInterface;

enum CardSuit: string implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    case HEARTS = 'hearts';
    case DIAMONDS = 'diamonds';
    case CLUBS = 'clubs';
    case SPADES = 'spades';
}