<?php declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\ExtendedBackedEnumInterface;
use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\NotResponseCode;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\Enum\ExtendedBackedEnum::isNot()
 */
final class IsNotTest extends TestCase
{
    /**
     * @dataProvider notSameDataProvider
     */
    public function testWhenIsNotSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isNotSame = $enum->isNot($compare);

        // assert
        fact($isNotSame)->true();
    }

    /**
     * @dataProvider sameDataProvider
     */
    public function testWhenSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isNotSame = $enum->isNot($compare);

        // assert
        fact($isNotSame)->false();
    }

    private function notSameDataProvider(): array
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

    private function sameDataProvider(): array
    {
        return [
            [CardSuit::CLUBS, 'clubs'],
            [CardSuit::CLUBS, CardSuit::CLUBS],
            [ResponseCode::HTTP_OK, NotResponseCode::HTTP_OK->value],
        ];
    }
}
