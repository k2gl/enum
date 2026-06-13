<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\Examples;

use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\ExtendedBackedEnumInterface;
use K2gl\Enum\Label;

enum OrderStatus: string implements ExtendedBackedEnumInterface
{
    use ExtendedBackedEnum;

    #[Label('Awaiting payment')]
    case PENDING = 'pending';

    #[Label('Paid')]
    case PAID = 'paid';

    // No #[Label] on purpose: label() falls back to the raw case name.
    case SHIPPED = 'shipped';
}
