<?php
declare(strict_types=1);

namespace K2gl\Enum\Tests\ExtendedBackedEnum;

use K2gl\Enum\ExtendedBackedEnum;
use K2gl\Enum\Tests\Examples\ResponseCode;
use PHPUnit\Framework\TestCase;

use ValueError;

use function K2gl\PHPUnitFluentAssertions\fact;

/**
 * @covers \K2gl\Enum\ExtendedBackedEnum::anyoneExcept()
 */
final class AnyoneExceptTest extends TestCase
{
    public function testExcludeOne(): void
    {
        // act
        $enum = ResponseCode::anyoneExcept([ResponseCode::HTTP_OK]);

        // assert
        fact($enum instanceof ResponseCode)->true();
        fact($enum->isNot(ResponseCode::HTTP_OK))->true();
        fact(
            $enum->is(ResponseCode::HTTP_CONTINUE) || $enum->is(ResponseCode::HTTP_I_AM_A_TEAPOT)
        )->true();
    }

    public function testExcludeFewCaseA(): void
    {
        // act
        $enum = ResponseCode::anyoneExcept([ResponseCode::HTTP_CONTINUE, ResponseCode::HTTP_I_AM_A_TEAPOT]);

        // assert
        fact($enum)->is(ResponseCode::HTTP_OK);
    }

    public function testExcludeFewCaseB(): void
    {
        // act
        $enum = ResponseCode::anyoneExcept([ResponseCode::HTTP_OK, ResponseCode::HTTP_I_AM_A_TEAPOT]);

        // assert
        fact($enum)->is(ResponseCode::HTTP_CONTINUE);
    }

    public function testExcludeFewCaseC(): void
    {
        // act
        $enum = ResponseCode::anyoneExcept([ResponseCode::HTTP_CONTINUE, ResponseCode::HTTP_OK]);

        // assert
        fact($enum)->is(ResponseCode::HTTP_I_AM_A_TEAPOT);
    }

    public function testExcludeFewCaseD(): void
    {
        // act
        $enum = ResponseCode::anyoneExcept([ResponseCode::HTTP_I_AM_A_TEAPOT]);

        // assert
        fact($enum instanceof ResponseCode)->true();
        fact($enum->isNot(ResponseCode::HTTP_I_AM_A_TEAPOT))->true();
        fact(
            $enum->is(ResponseCode::HTTP_CONTINUE) || $enum->is(ResponseCode::HTTP_OK)
        )->true();
    }

    public function testExcludeAll(): void
    {
        // assert
        $this->expectException(ValueError::class);
        $this->expectExceptionMessage('All possible values excluded');

        // act
        ResponseCode::anyoneExcept([
            ResponseCode::HTTP_CONTINUE,
            ResponseCode::HTTP_OK,
            ResponseCode::HTTP_I_AM_A_TEAPOT,
        ]);
    }
}
