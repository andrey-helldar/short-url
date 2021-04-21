# Short URL

A simple short URL generator for Laravel Framework.

[![StyleCI Status][badge_styleci]][link_styleci]
[![Github Workflow Status][badge_build]][link_build]
[![Coverage Status][badge_coverage]][link_scrutinizer]
[![Scrutinizer Code Quality][badge_quality]][link_scrutinizer]
[![For Laravel][badge_laravel]][link_packagist]

[![Stable Version][badge_stable]][link_packagist]
[![Unstable Version][badge_unstable]][link_packagist]
[![Total Downloads][badge_downloads]][link_packagist]
[![License][badge_license]][link_license]

## Installation

To get the latest version of Laravel Short URL, simply require the project using [composer](https://getcomposer.org):

```
composer require andrey-helldar/short-url
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "andrey-helldar/short-url": "^2.0"
    }
}
```

If you don't use auto-discovery, add the `ServiceProvider` to the providers array in `config/app.php`:

```php
Helldar\ShortUrl\ServiceProvider::class;
```

You can also publish the config file to change implementations (ie. interface to specific class):

```
php artisan vendor:publish --provider="Helldar\ShortUrl\ServiceProvider"
```

Now you can use a `Helldar\ShortUrl\Facades\ShortUrl` facade.


## Using

### Identifiers

When creating records, there are two ways to create unique identifiers:
The first one is by the record identifier in the database with its conversion into a letter index:

| id | key | url | output url |
|---|---|---|---|
| 1 | b | https://example.com | https://my-site.com/go/b |
| 2 | c | https://example.com/foo | https://my-site.com/go/c |
| 3 | d | https://example.com/bar | https://my-site.com/go/d |
| ... | ... | ... | ... |
| 100 | dw | https://example.com/baz | https://my-site.com/go/dw |
| 200 | hs | https://example.com/qwe | https://my-site.com/go/hs |
| ... | ... | ... | ... |
| 1000 | bmm | https://example.com/rty | https://my-site.com/go/bmm |
| 5000 | hki | https://example.com/qax | https://my-site.com/go/hki |
| ... | ... | ... | ... |

The second is unique identifier based on the current time in microseconds:

| id | key | url | output url |
|---|---|---|---|
| 1 | 5d35b1610705f679245100 | https://example.com | https://my-site.com/go/5d35b1610705f679245100 |
| 2 | 5d35b1727eb33156257300 | https://example.com/foo | https://my-site.com/go/5d35b1727eb33156257300 |
| 3 | 5d35c3193aaf8239852915 | https://example.com/bar | https://my-site.com/go/5d35c3193aaf8239852915 |
| ... | ... | ... | ... |
| 100 | 5d35c3195eaaa426635669 | https://example.com/baz | https://my-site.com/go/5d35c3195eaaa426635669 |
| 200 | 5d35c3199d7f7453462663 | https://example.com/qwe | https://my-site.com/go/5d35c3199d7f7453462663 |
| ... | ... | ... | ... |
| 1000 | 5d35c31a44398568656171 | https://example.com/rty | https://my-site.com/go/5d35c31a44398568656171 |
| 5000 | 5d35c31aca1c1975257906 | https://example.com/qax | https://my-site.com/go/5d35c31aca1c1975257906 |
| ... | ... | ... | ... |

### set()

To create a record, use the method `set()`:

```php
use \Helldar\ShortUrl\Facades\ShortUrl;

$item = ShortUrl::set('https://example.com');
// returned instance of `Helldar\ShortUrl\Models\Short` eloquent model.
```

### get()

To get record, use the method `get()`:

```php
use \Helldar\ShortUrl\Facades\ShortUrl;

$url = ShortUrl::get('foo');
// returned URL string.
// For example, 'http://<your_site>.com/go/qdr'.
```

### routing

To create a route you can use the following code:

```php
use \Helldar\ShortUrl\Facades\ShortUrl;

$item = ShortUrl::set('https://example.com');

return route('short_url', ['key' => $item->key]); 
```

or

```php
use \Helldar\ShortUrl\Facades\ShortUrl;

$url = ShortUrl::get('foo');

return redirect()->away($url); 
```

You can also [change the name](src/config/settings.php) of the route in the package settings.


### Blade templates

You can also call the facade from the template engine:

```html
<a href="{{ \Helldar\ShortUrl\Facades\ShortUrl::get('foo') }}">open link</a>

{{-- <a href="http://your-site.com/go/foo">open link</a> --}}

```

or

```html
<a href="{{ \Helldar\ShortUrl\Facades\ShortUrl::set('http://example.com') }}">open link</a>

{{-- <a href="http://your-site.com/go/cr">open link</a> --}}

```

## License

This package is licensed under the [MIT License](LICENSE).


## For Enterprise

Available as part of the Tidelift Subscription.

The maintainers of `andrey-helldar/short-url` and thousands of other packages are working with Tidelift to deliver commercial support and maintenance for the open source packages you use to build your applications. Save time, reduce risk, and improve code health, while paying the maintainers of the exact packages you use. [Learn more](https://tidelift.com/subscription/pkg/packagist-andrey-helldar-short-url?utm_source=packagist-andrey-helldar-short-url&utm_medium=referral&utm_campaign=enterprise&utm_term=repo).

[badge_build]:      https://img.shields.io/github/workflow/status/andrey-helldar/short-url/phpunit?style=flat-square

[badge_coverage]:   https://img.shields.io/scrutinizer/coverage/g/andrey-helldar/short-url.svg?style=flat-square

[badge_downloads]:  https://img.shields.io/packagist/dt/andrey-helldar/short-url.svg?style=flat-square

[badge_laravel]:    https://img.shields.io/badge/Laravel-5.5+%20%7C%206.x%20%7C%207.x%20%7C%208.x-orange.svg?style=flat-square

[badge_license]:    https://img.shields.io/packagist/l/andrey-helldar/short-url.svg?style=flat-square

[badge_quality]:    https://img.shields.io/scrutinizer/g/andrey-helldar/short-url.svg?style=flat-square

[badge_stable]:     https://img.shields.io/github/v/release/andrey-helldar/short-url?label=stable&style=flat-square

[badge_styleci]:    https://styleci.io/repos/197787449/shield

[badge_unstable]:   https://img.shields.io/badge/unstable-dev--main-orange?style=flat-square

[link_build]:       https://github.com/andrey-helldar/short-url/actions

[link_license]:     LICENSE

[link_packagist]:   https://packagist.org/packages/andrey-helldar/short-url

[link_scrutinizer]: https://scrutinizer-ci.com/g/andrey-helldar/short-url

[link_styleci]:     https://github.styleci.io/repos/197787449
