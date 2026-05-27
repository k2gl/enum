<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\ExtendedBackedEnumInterface;
use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\NotResponseCode;
use K2gl\Enum\Tests\Examples\ResponseCode;

use function K2gl\PHPUnitFluentAssertions\fact;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class IsTest extends TestCase
{
    #[DataProvider('sameDataProvider')]
    public function testSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isSame = $enum->is($compare);

        // assert
        fact($isSame)->true();
    }

    #[DataProvider('notSameDataProvider')]
    public function testNotSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isSame = $enum->is($compare);

        // assert
        fact($isSame)->false();
    }

    public static function notSameDataProvider(): array
    {
        return [
            [CardSuit::CLUBS, null],
            [CardSuit::CLUBS, true],
            [CardSuit::CLUBS, false],
            [CardSuit::CLUBS, 1],
            [CardSuit::CLUBS, 0],
            [CardSuit::CLUBS, '1'],
            [CardSuit::CLUBS, '0'],
            [CardSuit::CLUBS, 'diamonds'],
            [CardSuit::CLUBS, CardSuit::DIAMONDS],
            [CardSuit::CLUBS, 'CLUBS'],
            [ResponseCode::HTTP_OK, NotResponseCode::HTTP_OK],
        ];
    }

    public static function sameDataProvider(): array
    {
        return [
            [CardSuit::CLUBS, 'clubs'],
            [CardSuit::CLUBS, CardSuit::CLUBS],
            [ResponseCode::HTTP_OK, NotResponseCode::HTTP_OK->value],
        ];
    }
}
