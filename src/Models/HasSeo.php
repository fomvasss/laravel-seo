<?php

namespace Fomvasss\Seo\Models;

use Fomvasss\Models\Seo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeo
{
    public array $defaultTags = [];
    
    public static function bootHasSeo()
    {
        self::deleting(function ($model) {
            $model->seos()->delete();
        });
    }

    /**
     * @return MorphMany
     */
    public function seos(): MorphMany
    {
        return $this->morphMany(config('seo.model', Seo::class), 'model');
    }

    /**
     * @param string|null $group
     * @return MorphOne
     */
    public function seo(?string $group = null): MorphOne
    {
        return $this->morphOne(config('seo.model', Seo::class), 'model')
            ->where('group', $group);
    }

    /**
     * Use in dashboard.
     *
     * @param string|null $group
     * @return array
     */
    public function getRawSeoTags(?string $group = null): array
    {
        $tags = [];
        if ($seo = $this->seo($group)->first()) {
            $tags = $seo->tags;
        }

        return $tags ?: $this->registerSeoDefaultTags();
    }

    /**
     * Use in client view.
     *
     * @param string|null $group
     * @return array
     */
    public function getSeoTags(?string $group = null): array
    {
        // Modify tags (prepare tokens, shortcodes, etc...)
        $res = $this->getRawSeoTags($group);
 
        return $res;
    }

    /**
     * @return array
     */
    public function registerSeoDefaultTags(): array
    {
        // Set default tokens
        return [];
    }
}