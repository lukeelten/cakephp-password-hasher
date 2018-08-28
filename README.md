# Collection of CakePHP Password Hasher

This project provides a collection of CakePHP password hasher.
Most hasher classes use the default password hasher of CakePHP under the hood.

The most useful class is the "Argon2PasswordHasher" which provides the functionality to hash password with the new and more secure Argon2i algorithm.
The algorithm has been integrated into PHP 7.2, nevertheless this project provides backwards compatibility to PHP 7.0.

Furthermore, PHP 7.2 on Alpine does not support Argon2i up to now. This project provides a polyfill for that.


## Requirements

### PHP 7.2
You ususally do not need any requirements. It should work out-of-the-box. <br>
__Important:__ If you run PHP 7.2 on Alpine Linux, please install the __sodium__ extension (php7-sodium).


### PHP 7.0 / 7.1

Please install the __libsodium__ extension, either via PECL or via package manager.


## Usage

You can use the Argon2PasswordHasher with the default Auth plugin as seen below.

```php
$this->loadComponent('Auth', [
    'authenticate' => [
        'Form' => [
            'passwordHasher' => Argon2PasswordHasher::class
            // 'passwordHasher' => SecurePasswordHasherChain::class
        ]
    ]
];
```

Make sure, that you hash the password correctly when setting the user's model property:
```php
class User extends Entity
{
    protected function _setPassword($value) {
        $hasher = new Argon2PasswordHasher();
        return $hasher->hash($value);
    }
}
```