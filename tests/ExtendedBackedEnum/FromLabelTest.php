<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\ExtendedBackedEnumInterface;
use K2gl\Enum\Tests\Examples\OrderStatus;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ValueError;

use function K2gl\PHPUnitFluentAssertions\fact;

final class FromLabelTest extends TestCase
{
    #[DataProvider('validLabelDataProvider')]
    public function testResolvesCaseByLabel(string $label, ExtendedBackedEnumInterface $expected): void
    {
        // act
        $case = $expected::fromLabel($label);

        // assert
        fact($case)->is($expected);
    }

    #[DataProvider('unknownLabelDataProvider')]
    public function testThrowsOnUnknownLabel(string $enumClass, string $label): void
    {
        // assert
        $this->expectException(ValueError::class);

        // act
        $enumClass::fromLabel($label);
    }

    public static function validLabelDataProvider(): array
    {
        return [
            'attribute label'         => ['Awaiting payment', OrderStatus::PENDING],
            'another attribute label' => ['Paid', OrderStatus::PAID],
            'name fallback'           => ['SHIPPED', OrderStatus::SHIPPED],
            'int enum name fallback'  => ['HTTP_OK', ResponseCode::HTTP_OK],
        ];
    }

    public static function unknownLabelDataProvider(): array
    {
        return [
            'unknown label'      => [OrderStatus::class, 'Refunded'],
            'name behind label'  => [OrderStatus::class, 'PENDING'],
            'backing value'      => [OrderStatus::class, 'pending'],
            'empty string'       => [OrderStatus::class, ''],
            'int enum, unknown'  => [ResponseCode::class, 'HTTP_TEAPOT'],
        ];
    }
}
