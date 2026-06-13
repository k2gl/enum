<?php

declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;

use function K2gl\PHPUnitFluentAssertions\fact;

final class NotInTest extends TestCase
{
    public function testTrueWhenAbsent(): void
    {
        // act
        $notIn = CardSuit::CLUBS->notIn(CardSuit::HEARTS, 'spades');

        // assert
        fact($notIn)->true();
    }

    public function testFalseWhenPresentByCase(): void
    {
        // act
        $notIn = CardSuit::CLUBS->notIn(CardSuit::HEARTS, CardSuit::CLUBS);

        // assert
        fact($notIn)->false();
    }

    public function testFalseWhenPresentByBackingValue(): void
    {
        // act
        $notIn = ResponseCode::HTTP_OK->notIn(100, 200);

        // assert
        fact($notIn)->false();
    }

    public function testEmptySetIsTrue(): void
    {
        // act
        $notIn = CardSuit::CLUBS->notIn();

        // assert
        fact($notIn)->true();
    }
}
