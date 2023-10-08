<?php declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\Enum\ExtendedBackedEnum::values()
 */
final class ValuesTest extends TestCase
{
    public function testValuesOfCardSuit(): void
    {
        // act
        $values = CardSuit::values();

        // assert
        fact($values)->is([
            0 => 'hearts',
            1 => 'diamonds',
            2 => 'clubs',
            3 => 'spades',
        ]);
    }

    public function testValuesOfResponseCode(): void
    {
        // act
        $values = ResponseCode::values();

        // assert
        fact($values)->is([
            0 => 100,
            1 => 200,
            2 => 418,
        ]);
    }
}
