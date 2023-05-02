<?php

namespace Fomvasss\Seo\TagModifiers;

class StripTagsModifier
{
    public function modify(string $key, string $value): string
    {
        return preg_replace('/\s\s+/', ' ', html_entity_decode(strip_tags($value)));
    }
}