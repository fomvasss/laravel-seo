<?php


trait HasSeoTrait
{
    public static function bootHasSeoTrait()
    {
        self::deleting(function ($model) {
            $model->seo()->delete();
        });
    }

    public function seo()
    {
        $modelClass = config('seo.model', \Fomvasss\Models\Seo::class);

        return $this->morphOne($modelClass, 'model');
    }
}