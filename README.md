# Laravel Sociable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require draperstudio/laravel-sociable
```

And then, if using Laravel 5, include the service provider within `app/config/app.php`.

``` php
'providers' => [
    // ... Illuminate Providers
    // ... App Providers
    DraperStudio\Sociable\ServiceProvider::class
];
```

## Migration

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="DraperStudio\Sociable\ServiceProvider"
```

And then run the migrations to setup the database table.

```bash
$ php artisan migrate
```

## Usage

##### Setup a Model

``` php
namespace App;

use DraperStudio\Sociable\Traits\Sociable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Sociable;
}
```

##### Authenticating a User

``` php
use DraperStudio\Sociable\Services\Authenticator;
use DraperStudio\Sociable\Events\UserHasSocialized;

$router->get('/', function (Authenticator $authenticate, Request $request) {
    return $authenticate->provider('github') // authenticate with github
                        ->model(User::class) // this can also be a model like User::find(1) if you want to attach multiple social profiles to one model
                        ->mapField('username', 'nickname') // map the nickname field to the username column on the user model
                        ->mapField('email', 'email') // map the email field to the email column on the user model
                        ->mapField('avatar', 'avatar') // map the avatar field to the avatar column on the user model
                        ->mapField('password', bcrypt(str_random(10)), true) // add an additional password field to the user model
                        ->event(UserHasSocialized::class) // this event will be fired after the user profile has been retrieved
                        ->execute($request->has('code')); // if no code is available we will redirect instead of processing the response
});
```

##### Default Event

The default event that is fired is `UserHasSocialized` which will take care of creating and updating all models.

##### Custom Event

If you need to have your own way of handling the response take a look at `UserHasSocialized` and `UserHasSocializedListener` and create your event and listener.

Once you've done that you can just use `->event(MyCustomEvent::class)` and the response will be passed through to your event.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email hello@draperstudio.tech instead of using the issue tracker.

## Credits

- [DraperStudio][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/DraperStudio/laravel-sociable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/DraperStudio/Laravel-Sociable/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/DraperStudio/laravel-sociable.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/DraperStudio/laravel-sociable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/DraperStudio/laravel-sociable.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/DraperStudio/laravel-sociable
[link-travis]: https://travis-ci.org/DraperStudio/Laravel-Sociable
[link-scrutinizer]: https://scrutinizer-ci.com/g/DraperStudio/laravel-sociable/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/DraperStudio/laravel-sociable
[link-downloads]: https://packagist.org/packages/DraperStudio/laravel-sociable
[link-author]: https://github.com/DraperStudio
[link-contributors]: ../../contributors
