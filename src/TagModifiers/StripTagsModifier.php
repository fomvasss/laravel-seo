<?php

namespace Fomvasss\Seo\TagModifiers;

final class StripTagsModifier
{
    public function modify($key, $value): string
    {
        return strip_tags($value);
    }
}