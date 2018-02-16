# Laravel Sociable

[![Build Status](https://img.shields.io/travis/faustbrian/Laravel-Sociable/master.svg?style=flat-square)](https://travis-ci.org/faustbrian/Laravel-Sociable)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/faustbrian/laravel-sociable.svg?style=flat-square)]()
[![Latest Version](https://img.shields.io/github/release/faustbrian/Laravel-Sociable.svg?style=flat-square)](https://github.com/faustbrian/Laravel-Sociable/releases)
[![License](https://img.shields.io/packagist/l/faustbrian/Laravel-Sociable.svg?style=flat-square)](https://packagist.org/packages/faustbrian/Laravel-Sociable)

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-sociable
```

## Migration

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="BrianFaust\Sociable\SociableServiceProvider"
```

And then run the migrations to setup the database table.

```bash
$ php artisan migrate
```

## Usage

##### Setup a Model

``` php
namespace App;

use BrianFaust\Sociable\Sociable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use Sociable;
}
```

##### Authenticating a User

``` php
use BrianFaust\Sociable\Services\Authenticator;
use BrianFaust\Sociable\Events\UserHasSocialized;

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

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.me)
