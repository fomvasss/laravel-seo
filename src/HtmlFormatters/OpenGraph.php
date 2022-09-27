<?php

namespace Fomvasss\Seo\HtmlFormatters;

class OpenGraph
{
    public function title(string $value): string
    {
        return $this->default('title', $value);
    }

    public function description(string $value): string
    {
        return $this->default('description', $value);
    }

    public function url(string $value): string
    {
        return $this->default('url', $value);
    }

    public function type(string $value): string
    {
        return $this->default('type', $value);
    }

    public function determiner(string $value): string
    {
        return $this->default('determiner', $value);
    }

    public function locale(string $value): string
    {
        return $this->default('locale', $value);
    }

    public function locale_alternate($values): string
    {
        $values = is_array($values) ? $values : [$values];
        $res = '';
        foreach ($values as $value) {
            $res .=  $this->default('locale:alternate', $value) . "\n";
        }

        return $res;
    }

    public function site_name(string $value): string
    {
        return $this->default('site_name', $value);
    }

    public function image($values, ?int $height = null, ?int $weight = null, ?string $type = null): string
    {
        $values = is_array($values) ? $values : [$values];
        $res = '';
        foreach ($values as $value) {
            $res .=  $this->default('image', $value);
        }

        return $res;
    }

    public function image_height(string $value): string
    {
        return $this->default('image:height', $value);
    }
    public function image_width(string $value): string
    {
        return $this->default('image:width', $value);
    }
    public function image_type(string $value): string
    {
        return $this->default('image:type', $value);
    }

    public function video($values, ?int $height = null, ?int $weight = null, ?string $type = null): string
    {
        $values = is_array($values) ? $values : [$values];
        $res = '';
        foreach ($values as $value) {
            $res .=  '<meta property="og:video" content="' . $value . '">';
            if ($type) {
                $res .= '<meta property="og:video:type" content="' . $type . '" />';
            }
            if ($height) {
                $res .= '<meta property="og:video:height" content="' . $height . '" />';
            }
            if ($weight) {
                $res .= '<meta property="og:video:weight" content="' . $weight . '" />';
            }
        }

        return $res;
    }

    public function audio(string $value, ?string $type = null): string
    {
        $res = '<meta property="og:audio" content="' . $value . '" />';

        if ($type) {
            $res .= '<meta property="og:audio:type" content="' . $type . '" />';
        }

        return $res;
    }

    public function default(string $key, string $value): string
    {
        return '<meta property="og:' . $key . '" content="' . $value . '" />';
    }
}