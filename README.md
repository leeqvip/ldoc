# Ldoc

[![Build Status](https://travis-ci.org/techoner/ldoc.svg?branch=master)](https://travis-ci.org/techoner/ldoc)
[![Latest Stable Version](https://poser.pugx.org/techone/ldoc/v/stable)](https://packagist.org/packages/techone/ldoc)
[![Total Downloads](https://poser.pugx.org/techone/ldoc/downloads)](https://packagist.org/packages/techone/ldoc)
[![License](https://poser.pugx.org/techone/ldoc/license)](https://packagist.org/packages/techone/ldoc)

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

# Configuration

Once Ldoc is installed, here’s what your project folder will look like:

The default document should be stored in the `storage/docs` directory:

```
.
├── sidebar.yml
├── version.yml
├── _source
|   ├── index.md
|   └── configuration.md
└── v1
    └── _source
        ├── index.md
        └── configuration.md

```

## License

This project is licensed under the [Apache 2.0 license](LICENSE).