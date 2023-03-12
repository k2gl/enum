<?php declare(strict_types=1);

namespace App\Tests\ExtendedBackedEnum;

use App\Tests\Examples\CardSuit;
use App\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\EnumHelper\BackedEnumTrait::names
 */
final class NamesTest extends TestCase
{

    public function testNamesOfCardSuit(): void
    {
        // act
        $names = CardSuit::names();

        // assert
        fact($names)->is([
            0 => 'HEARTS',
            1 => 'DIAMONDS',
            2 => 'CLUBS',
            3 => 'SPADES',
        ]);
    }

    public function testNamesResponseCode(): void
    {
        // act
        $names = ResponseCode::names();

        // assert
        fact($names)->is([
            0 => 'HTTP_CONTINUE',
            1 => 'HTTP_OK',
            2 => 'HTTP_I_AM_A_TEAPOT',
        ]);
    }
}
