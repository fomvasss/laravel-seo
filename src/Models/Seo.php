<?php

final class Seo extends \Illuminate\Database\Eloquent\Model
{
    protected $casts = [
        'tags' => 'array',
    ];
}