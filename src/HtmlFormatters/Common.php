<?php

namespace Fomvasss\Seo\HtmlFormatters;

class Common
{
    public function title(string $value): string
    {
        return '<title>' . $value . '</title>';
    }

    public function description(string $value): string
    {
        return '<meta name="description" content="' . $value . '" />';
    }

    public function keywords(string $value): string
    {
        return '<meta name="keywords" content="' . $value . '" />';
    }

    public function author(string $value): string
    {
        return '<meta name="author" content="' . $value . '" />';
    }

    public function viewport(string $value): string
    {
        return '<meta name="viewport" content="' . $value . '" />';
    }

    public function robots(string $value): string
    {
        return '<meta name="robots" content="' . $value . '" />';
    }

    public function fb_page_id(string $value): string
    {
        return '<meta property="fb:page_id" content="' . $value . '" />';
    }

    public function canonical(string $value): string
    {
        return '<link rel="canonical" href="' . $value . '" />';
    }

    public function default(string $key, string $value): string
    {
        return '<meta name="' . $key . '" content="' . $value . '" />';
    }
}