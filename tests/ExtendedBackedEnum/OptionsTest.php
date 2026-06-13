<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\OrderStatus;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

final class OptionsTest extends TestCase
{
    public function testMapsValueToLabelMixingAttributeAndFallback(): void
    {
        // act
        $options = OrderStatus::options();

        // assert
        fact($options)->is([
            'pending' => 'Awaiting payment',
            'paid'    => 'Paid',
            'shipped' => 'SHIPPED',
        ]);
    }

    public function testKeysAreBackingValuesInCaseOrderForIntEnum(): void
    {
        // act
        $options = ResponseCode::options();

        // assert
        fact($options)->is([
            100 => 'HTTP_CONTINUE',
            200 => 'HTTP_OK',
            418 => 'HTTP_I_AM_A_TEAPOT',
        ]);
    }
}
