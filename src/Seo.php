<?php

namespace Fomvasss\Seo;

use Illuminate\Database\Eloquent\Model;

class Seo
{
    protected $model;
    protected ?string $path = null;
    protected array $default = [];

    public function render()
    {
        return view('seo::tags', [
            'tags' => [],
        ])->render();
    }

    public function setModel(Model $model)
    {
        $this->model = $model;

        return $this;
    }

    public function setPath(string $path = null)
    {
        $this->path = $path ?: \Illuminate\Support\Facades\Request::path();

        return $this;
    }

    public function setDefault()
    {

    }

    public function getTags()
    {
        if ($this->model && $this->model->seo) {

        }

        if ($this->path) {

        }

        if ($this->default) {

        }

    }


}
