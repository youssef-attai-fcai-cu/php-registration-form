## Todos

- [x] Use the born on the same day API, call it using AJAX.
- [ ] Make sure locale changes strings everywhere, even in the UserRegistered mail, and the error messages.
- [ ] Add a unit test.
- [x] Configure a gmail account to send emails.
- [ ] Implement client-side validations.

## How to configure locale

1. By default, Laravel does not include lang directory. Create one via the lang:publish Artisan command. The lang:publish command will create the lang directory in your application and publish the default set of language files used by Laravel:

```bash
php artisan lang:publish
```

2. You may modify the default language for a single HTTP request at runtime using the setLocale method provided by the App facade:

```php
<?php
use Illuminate\Support\Facades\App;
 
Route::get('/greeting/{locale}', function (string $locale) {
    if (! in_array($locale, ['en', 'es', 'fr'])) {
        abort(400);
    }
 
    App::setLocale($locale);
 
    // ...
});
```

3. You may use the currentLocale and isLocale methods on the App facade to determine the current locale or check if the locale is a given value:

```php
<?php

use Illuminate\Support\Facades\App;
 
$locale = App::currentLocale();
 
if (App::isLocale('en')) {
    // ...
}
```

4. Structure the lang directory this way using language files:

```txt
lang
    /en
        messages.php
    /es
        messages.php
```

5. All language files return an array of keyed strings. For example:

```php
<?php
 
// lang/en/messages.php
 
return [
    'welcome' => 'Welcome to our application!',
];
```

6. You may retrieve translation strings from your language files using the __ helper function. If you are using "short keys" to define your translation strings, you should pass the file that contains the key and the key itself to the __ function using "dot" syntax. For example, let's retrieve the welcome translation string from the lang/en/messages.php language file:

```php
<?php echo __('messages.welcome'); ?>
```
