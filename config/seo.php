<?php

return [
    /* -----------------------------------------------------------------
     |  The global default tag values
     | -----------------------------------------------------------------
     */
    'default' => [
        'title_prefix' => 'Site',
        'title' => env('APP_NAME'),
        'title_suffix' => 'Page',

        'og_site_name' => env('APP_NAME'),
//        'og_image_type' => 'image/png',
//        'og_image_width' => '780',
//        'og_image_height' => '780',

        'fb_app_id' => env('SEO_FB_ID', null),
    ],

    /* -----------------------------------------------------------------
     |  Will be render in blade
     |  Uncomment needed
     | -----------------------------------------------------------------
     */
    'tags' => [
        // Common tags
        'title' => ['title' => 'Title', 'type' => 'common', 'max' => 60],                // recommend max => 60
        'description' => ['title' => 'Description', 'type' => 'common', 'modifiers' => 'stripTags'],    // recommend max => 300
        'keywords' => ['title' => 'Keywords', 'type' => 'common'],          // recommend max => 300
        'viewport' => ['viewport' => 'Viewport', 'type' => 'common'],

        'canonical' => ['title' => 'Canonical link', 'type' => 'common'],
        'robots' => ['title' => 'Robots', 'type' => 'common'],
        'fb_app_id' => ['title' => 'Facebook app ID', 'type' => 'common'],

        // OG-tags
        'og_site_name' => ['title' => 'OG-site name', 'type' => 'og'],
        'og_locale' => ['title' => 'OG-locale', 'type' => 'og'],
        'og_locale_alternate' => ['title' => 'OG-locale', 'type' => 'og'],
        'og_title' => ['title' => 'OG-title', 'type' => 'og', 'alt' => 'title'],
        'og_description' => ['title' => 'OG-description', 'type' => 'og', 'alt' => 'description'],
        'og_type' => ['title' => 'OG-type', 'type' => 'og'],
        'og_image' => ['title' => 'OG-image', 'type' => 'og'],
        'og_image_width' => ['title' => 'OG-image', 'type' => 'og'],
        'og_image_height' => ['title' => 'OG-image', 'type' => 'og'],
        'og_url' => ['title' => 'OG-url', 'type' => 'og'],
        'og_audio' => ['title' => 'OG-audio', 'type' => 'og'],
        'og_determiner' => ['title' => 'OG-determiner', 'type' => 'og'],
        'og_video' => ['title' => 'OG-video', 'type' => 'og'],

        // Twitter tags
        'twitter_title' => ['title' => 'Twitter domain', 'type' => 'twitter', 'alt' => 'title'],
        'twitter_description' => ['title' => 'Twitter description', 'type' => 'twitter', 'alt' => 'description'],
        'twitter_card' => ['title' => 'Twitter card', 'type' => 'twitter'],
        'twitter_site' => ['title' => 'Twitter site', 'type' => 'twitter'],
        'twitter_creator' => ['title' => 'Twitter creator', 'type' => 'twitter'],
        'twitter_image' => ['title' => 'Twitter image', 'type' => 'twitter'],
    ],

    'html_formatters' => [
        'common' => \Fomvasss\Seo\HtmlFormatters\Common::class,
        'og' => \Fomvasss\Seo\HtmlFormatters\OpenGraph::class,
        'twitter' => \Fomvasss\Seo\HtmlFormatters\Twitter::class,
    ],

    'modifiers' => [
        'stripTags' => \Fomvasss\Seo\TagModifiers\StripTagsModifier::class
    ],

    /* -----------------------------------------------------------------
     |  This is example, for dashboard SEO form,...
     |  Available values
     |  This list is a sample and is not used in the package
     | -----------------------------------------------------------------
     */
    'values' => [
        'robots' => ['none', 'all', 'index', 'noindex', 'nofollow', 'follow',],
        'changefreq' => ['always', 'daily', 'hourly', 'weekly',],
        'priority' => [0.1, 0.2, 0.3, 0.5, 0.6, 0.7, 0.8, 0.9,],
    ],


    /* -----------------------------------------------------------------
     |  The default Model meta-tag
     | -----------------------------------------------------------------
     */
    'model' => \Fomvasss\Seo\Models\Seo::class,
];
