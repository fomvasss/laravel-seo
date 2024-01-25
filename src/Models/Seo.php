<?php

namespace Fomvasss\Seo\Models;

use App\Models\Traits\HasUuidPrimaryKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tags' => 'array',
    ];

    public function scopeByPath(Builder $builder, string $path, ?string $group = null)
    {
        $builder->where('path', $path)
            ->when($group, fn($s) => $s->where(fn($s2) => $s2->where('group', $group)->orWhere('group', null)));
    }

    public function getSeoTags(): array
    {
        return $this->tags ?: [];
    }
}
