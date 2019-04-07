# Welcome to the Hexo documentation.

------

**Ldoc** is a tool for quickly generating documents written in the PHP language. You write documents in Markdown (or other languages) and Ldoc generates files with a beautiful theme in seconds.

### Installation

```
composer require techone/ldoc
```

Add the ServiceProvider in `config/app.php`

```php
'providers' => [
    /*
     * Package Service Providers...
     */
    Ldoc\LdocServiceProvider::class,
]
```

To publish the config, run the vendor publish command:

```
php artisan vendor:publish
```

This will create a demo in `storage` directory.

Then, you can access 'http://yourdomain.com/docs' and it will show the demo.
