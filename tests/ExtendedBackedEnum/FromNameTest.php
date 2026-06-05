<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\ExtendedBackedEnumInterface;
use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ValueError;

use function K2gl\PHPUnitFluentAssertions\fact;

final class FromNameTest extends TestCase
{
    #[DataProvider('validNameDataProvider')]
    public function testResolvesCaseByName(string $name, ExtendedBackedEnumInterface $expected): void
    {
        // act
        $case = $expected::fromName($name);

        // assert
        fact($case)->is($expected);
    }

    #[DataProvider('unknownNameDataProvider')]
    public function testThrowsOnUnknownName(string $enumClass, string $name): void
    {
        // assert
        $this->expectException(ValueError::class);

        // act
        $enumClass::fromName($name);
    }

    public static function validNameDataProvider(): array
    {
        return [
            ['HEARTS', CardSuit::HEARTS],
            ['SPADES', CardSuit::SPADES],
            ['HTTP_OK', ResponseCode::HTTP_OK],
            ['HTTP_I_AM_A_TEAPOT', ResponseCode::HTTP_I_AM_A_TEAPOT],
        ];
    }

    public static function unknownNameDataProvider(): array
    {
        return [
            'missing name'      => [CardSuit::class, 'JOKER'],
            'wrong case'        => [CardSuit::class, 'hearts'],
            'backing value'     => [CardSuit::class, 'spades'],
            'empty string'      => [CardSuit::class, ''],
            'int enum, missing' => [ResponseCode::class, 'HTTP_TEAPOT'],
        ];
    }
}
