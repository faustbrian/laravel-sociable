# Laravel Sociable

I would appreciate you taking the time to look at my [Patreon](https://www.patreon.com/faustbrian) and considering to support me if I'm saving you some time with my work.

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

``` bash
$ composer require faustbrian/laravel-sociable
```

And then include the service provider within `app/config/app.php`.

``` php
BrianFaust\Sociable\SociableServiceProvider::class
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

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability within this package, please send an e-mail to Brian Faust at hello@brianfaust.de. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [Brian Faust](https://brianfaust.de)
