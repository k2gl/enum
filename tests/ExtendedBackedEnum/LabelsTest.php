<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\OrderStatus;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

final class LabelsTest extends TestCase
{
    public function testListsLabelsInCaseOrderMixingAttributeAndFallback(): void
    {
        // act
        $labels = OrderStatus::labels();

        // assert
        fact($labels)->is(['Awaiting payment', 'Paid', 'SHIPPED']);
    }

    public function testFallsBackToRawNamesForIntEnum(): void
    {
        // act
        $labels = ResponseCode::labels();

        // assert
        fact($labels)->is(['HTTP_CONTINUE', 'HTTP_OK', 'HTTP_I_AM_A_TEAPOT']);
    }
}
