<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\OrderStatus;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

final class LabelTest extends TestCase
{
    public function testReturnsLabelFromAttribute(): void
    {
        // act
        $label = OrderStatus::PENDING->label();

        // assert
        fact($label)->is('Awaiting payment');
    }

    public function testFallsBackToRawNameWhenAttributeIsAbsent(): void
    {
        // act
        $label = OrderStatus::SHIPPED->label();

        // assert
        fact($label)->is('SHIPPED');
    }

    public function testFallsBackToRawNameOnIntBackedEnum(): void
    {
        // act
        $label = ResponseCode::HTTP_OK->label();

        // assert
        fact($label)->is('HTTP_OK');
    }
}
