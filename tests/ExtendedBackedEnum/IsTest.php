<?php declare(strict_types=1);

namespace App\Tests\ExtendedBackedEnum;

use App\Tests\Examples\CardSuit;
use App\Tests\Examples\NotResponseCode;
use App\Tests\Examples\ResponseCode;
use K2gl\Enum\ExtendedBackedEnumInterface;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\EnumHelper\BackedEnumTrait::is
 */
final class IsTest extends TestCase
{
    /**
     * @dataProvider sameDataProvider
     */
    public function testSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isSame = $enum->is($compare);

        // assert
        fact($isSame)->true();
    }

    /**
     * @dataProvider notSameDataProvider
     */
    public function testNotSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isSame = $enum->is($compare);

        // assert
        fact($isSame)->false();
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
