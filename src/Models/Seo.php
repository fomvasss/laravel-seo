<?php

namespace Fomvasss\Models\Seo;


class Seo extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tags' => 'array',
    ];
}