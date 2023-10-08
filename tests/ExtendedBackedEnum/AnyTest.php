<?php declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\Tests\Examples\CardSuit;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;
use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\Enum\ExtendedBackedEnum::any()
 */
final class AnyTest extends TestCase
{
    public function testOneOf(): void
    {
        // act
        $enum = ResponseCode::any();

        // assert
        fact($enum instanceof ResponseCode)->true();
        fact(
            $enum->is(ResponseCode::HTTP_CONTINUE)
            || $enum->is(ResponseCode::HTTP_OK)
            || $enum->is(ResponseCode::HTTP_I_AM_A_TEAPOT)
        )->true();
    }
}
