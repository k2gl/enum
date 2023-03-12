<?php declare(strict_types=1);

namespace App\Tests\ExtendedBackedEnum;

use App\Tests\Examples\CardSuit;
use App\Tests\Examples\NotResponseCode;
use App\Tests\Examples\ResponseCode;
use K2gl\Enum\ExtendedBackedEnumInterface;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\EnumHelper\BackedEnumTrait::not
 */
final class NotTest extends TestCase
{
    /**
     * @dataProvider notSameDataProvider
     */
    public function testNotSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isNotSame = $enum->not($compare);

        // assert
        fact($isNotSame)->true();
    }

    /**
     * @dataProvider sameDataProvider
     */
    public function testSame(ExtendedBackedEnumInterface $enum, mixed $compare): void
    {
        // act
        $isNotSame = $enum->not($compare);

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
