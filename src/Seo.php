<?php

namespace Fomvasss\Seo;

use Illuminate\Database\Eloquent\Model;

class Seo
{
    protected string|null $group = null;
    protected string|null $path = null;
    protected Model|null $model = null;
    protected array $default = [];
    protected array $tags = [];

    /**
     * @param string $group
     * @return $this
     */
    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function usePath(?string $path = null)
    {
        $path = $path ?: \Illuminate\Support\Facades\Request::path();

        return $this->setPath($path);
    }

    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @param array $tags
     * @return $this
     */
    public function setDefault(array $tags): self
    {
        $this->default = array_merge($this->default, $tags);

        return $this;
    }

    /**
     * @param array $tags
     * @return $this
     */
    public function setTags(array $tags): self
    {
        $this->tags = array_merge($this->tags, $tags);

        return $this;
    }

    /**
     * @return Model|null
     */
    public function getSeopath(): ?Model
    {
        $model = config('seo.model');

        return $model::byPath($this->path, $this->group)->first();
    }

    /**
     * @return array
     */
    protected function getRawTags(): array
    {
        $defaultTags = [];
        if ($this->default) {
            $defaultTags = array_filter($this->default);
        }

        $modelTags = [];
        if ($this->model) {
            $modelTags = $this->model->getSeoTags($this->group);
            $modelTags = array_filter($modelTags);
        }

        $pathTags = [];
        if ($this->path) {
            if ($seoPathModel = $this->getSeopath()) {
                $pathTags = $seoPathModel->getSeoTags();
                $pathTags = array_filter($pathTags);
            }
        }

        $tags = [];
        if ($this->tags) {
            $tags = array_filter($this->tags);
        }

        return array_merge($defaultTags, $modelTags, $pathTags, $tags);
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        $res = [];
        $tagValues = $this->getRawTags();
        $allowedTags = config('seo.tags', []);

        foreach ($allowedTags as $key => $data) {
            $tagValue = '';

            // Tag value
            if (!empty($tagValues[$key])) {
                $tagValue = $tagValues[$key];

            // Alternative tag value
            } elseif (isset($data['alt']) && !empty($tagValues[$data['alt']])) {
                $tagValue = $tagValues[$data['alt']];

            // Global Default tag value
            } elseif ($defaultValue = config('seo.default.' . $key)) {
                $tagValue = $defaultValue;
            }

            if ($tagValue) {
                if ($modifiers = $allowedTags[$key]['modifiers'] ?? []) {
                    $modifiers = is_array($modifiers) ? $modifiers : [$modifiers];
                    foreach ($modifiers as $modifierAlias) {
                        if (($class = config('seo.modifiers.'.$modifierAlias)) && class_exists($class)) {
                            $tagValue = app($class)->modify($key, $tagValue);
                        }
                    }
                }

                if ($max = $allowedTags[$key]['max'] ?? false) {
                    $tagValue = mb_substr($tagValue, 0, $max);
                }

                $res[$key] = $tagValue;
            }
        }

        return $res;
    }

    /**
     * @return array
     */
    public function getHtmlRows(): array
    {
        $allowedTags = config('seo.tags', []);

        $res = [];
        foreach ($this->getTags() as $key => $value) {
            $type = $allowedTags[$key]['type'];
            if (!empty($allowedTags[$key]['hide'])) {
                continue;
            }
            $method = str_replace(['og_', 'twitter_'], '', $key);
            if ($composer = config('seo.html_formatters.' . $type)) {
                if (class_exists($composer)) {

                    if ($method && method_exists($composer, $method)) {
                        $res[] = app($composer)->{$method}($value);
                    } else {
                        $res[] = app($composer)->default($key, $value);
                    }
                }
            }
        }

        return $res;
    }

    /**
     * @return string
     */
    public function renderHtml(): string
    {
        return implode("\n", $this->getHtmlRows());
    }
}
