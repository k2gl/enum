<?php declare(strict_types=1);

namespace App\Tests\ExtendedBackedEnum;

use App\Tests\Examples\CardSuit;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\EnumHelper\BackedEnumTrait::random
 */
final class RandomTest extends TestCase
{
    public function testOneOf(): void
    {
        // act
        $enum = CardSuit::random();

        // assert
        fact($enum instanceof CardSuit)->true();
    }
}
