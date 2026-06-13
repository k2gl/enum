<?php

declare(strict_types=1);

namespace K2gl\Enum;

use Attribute;

/**
 * Human-readable label for a backing enum case, read by label()/options().
 */
#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
final class Label
{
    public function __construct(
        public readonly string $text,
    ) {}
}
