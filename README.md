# Short URL
 
A simple short URL generator for Laravel Framework.


## Installation

To get the latest version of Laravel Short URL, simply require the project using [composer](https://getcomposer.org):

```
composer require andrey-helldar/short-url
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "andrey-helldar/short-url": "^1.0"
    }
}
```

If you don't use auto-discovery, add the `ServiceProvider` to the providers array in `config/app.php`:

```php
Helldar\ShortUrl\ServiceProvider::class,
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

$url = ShortUrl::get('foo')
// returned URL string.
// For example, 'http://<your_site>.com/go/qdr'.
```


### routing

To create a route you can use the following code:

```php
use \Helldar\ShortUrl\Facades\ShortUrl;

$item = ShortUrl::set('https://example.com');

return route('short_url', [$item->key]); 
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

This package is released under the [MIT License](LICENSE).
