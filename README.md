# Laravel Enhancement Suite

## Installation

To install with composer you can run:
```
$ composer require gearhub/laravel-enhancement-suite
```

or you can edit your ```composer.json``` with:
```json
"require": {
    "gearhub/laravel-enhancement-suite": "^1.0.0"
}
```

Once that is finished, you need to add the service provider to your ```providers``` array in your ```app.php```:
```php
GearHub\LaravelEnhancementSuite\LaravelEnhancementSuiteServiceProvider::class
```

Next, you need to add the facade to your ```aliases``` array in your ```app.php```:
```php
'Repository' => \GearHub\LaravelEnhancementSuiteApp\Facades\Repository::class
```

Run this in the command line:
```bash
$ php artisan vendor:publish --provider="GearHub\LaravelEnhancementSuite\LaravelEnhancementSuiteServiceProvider"
```
