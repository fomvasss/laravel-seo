
# Laravel SEO package

[![License](https://img.shields.io/packagist/l/fomvasss/laravel-seo.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-seo)
[![Build Status](https://img.shields.io/github/stars/fomvasss/laravel-seo.svg?style=for-the-badge)](https://github.com/fomvasss/laravel-seo)
[![Latest Stable Version](https://img.shields.io/packagist/v/fomvasss/laravel-seo.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-seo)
[![Total Downloads](https://img.shields.io/packagist/dt/fomvasss/laravel-seo.svg?style=for-the-badge)](https://packagist.org/packages/fomvasss/laravel-seo)
[![Quality Score](https://img.shields.io/scrutinizer/g/fomvasss/laravel-seo.svg?style=for-the-badge)](https://scrutinizer-ci.com/g/fomvasss/laravel-seo)

With this package you can manage meta-tags and SEO-fields from Laravel app.

## Installation

You can install the package via composer:

```bash
composer require fomvasss/laravel-seo
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Fomvasss\Seo\SeoServiceProvider"
php artisan migrate
```

## Usage

The Eloquent model must has the Trait `HasSeo`:

```php
namespace App\Models;

use Fomvasss\Seo\Models\HasSeo;

class PostModel extends Model {
	use HasSeo;
	//...

    public function registerSeoDefaultTags(): array
    {
        return [
            'title' => $this->name,
            'description' => $this->description,
            'og_image' => $this->getFirstMediaUrl('images', 'thumb'),
        ];
    }
}
```

Also in model you can define default tags in method `registerSeoDefaultTags`


Allowed next methods (By increasing priority):
```php
Seo::setDefault(['title' => 'Blog']);
Seo::setModel($post);
Seo::setPath('page/faq');
Seo::setTags(['keywords' => 'Laravel, SEO, tags']);
```

Rendering tags in Blade (in HTML head):
```blade
{!!
\Seo::setGroup(app()->getLocale())
    ->setDefault([
        'og_site_name' => config('app.name'),
        'og_url' => URL::full(),
        'og_locale' => app()->getLocale(),
    ])->renderHtml()
!!}
```

Get array tags (for API resource, etc.): 
```php
\Seo::setGroup(app()->getLocale())
    ->setDefault([
        'og_site_name' => config('app.name'),
        'og_locale' => app()->getLocale(),
    ])->getTags();
```

You can save tags for model in DB:
```php
$post->seo('uk')->updateOrCreate([], ['tags' => ['title' => 'Hello Page', 'description' => 'Lorem Ipsum'], 'group' => 'uk']);
```

And get tags (for edit) for dashboard:
```php
$tags = $post->getRawSeoTags('uk');
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [fomvasss](https://github.com/fomvasss)
- [Google docs] (https://developers.google.com/search/docs/crawling-indexing/special-tags)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
