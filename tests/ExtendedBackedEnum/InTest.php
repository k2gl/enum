<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

final class InTest extends TestCase
{
    public function testMatchesByCase(): void
    {
        // act
        $in = CardSuit::CLUBS->in(CardSuit::HEARTS, CardSuit::CLUBS);

        // assert
        fact($in)->true();
    }

    public function testMatchesByBackingValue(): void
    {
        // act
        $in = CardSuit::CLUBS->in('hearts', 'clubs');

        // assert
        fact($in)->true();
    }

    public function testMatchesInMixedSet(): void
    {
        // act
        $in = ResponseCode::HTTP_OK->in(CardSuit::HEARTS, 200, ResponseCode::HTTP_I_AM_A_TEAPOT);

        // assert
        fact($in)->true();
    }

    public function testDoesNotMatchWhenAbsent(): void
    {
        // act
        $in = CardSuit::CLUBS->in(CardSuit::HEARTS, 'spades', 'CLUBS');

        // assert
        fact($in)->false();
    }

    public function testAcceptsSpreadArray(): void
    {
        // arrange
        $allowed = [CardSuit::HEARTS, CardSuit::CLUBS];

        // act
        $in = CardSuit::CLUBS->in(...$allowed);

        // assert
        fact($in)->true();
    }

    public function testEmptySetIsFalse(): void
    {
        // act
        $in = CardSuit::CLUBS->in();

        // assert
        fact($in)->false();
    }
}
