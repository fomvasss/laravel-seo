<?php

namespace Fomvasss\Seo\HtmlFormatters;

class Twitter
{
    public function title(string $value): string
    {
        return $this->default('title', $value);
    }

    public function description(string $value): string
    {
        return $this->default('description', $value);
    }

    public function card(string $value): string
    {
        return $this->default('card', $value);
    }

    public function site(string $value): string
    {
        return $this->default('site', $value);
    }

    public function image(string $value): string
    {
        return $this->default('image', $value);
    }

    public function url(string $value): string
    {
        return $this->default('url', $value);
    }

    public function creator(string $value): string
    {
        return $this->default('creator', $value);
    }

    public function default(string $key, string $value): string
    {
        return '<meta property="twitter:' . $key . '" content="' . $value . '">';
    }
}