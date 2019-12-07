# PHP VNC Password

Use PHP to encrypt/decrypt the VNC password stored in your registry. 

Tested with PHP 7.1, PHP 7.2, PHP 7.3. Should be compatible with PHP 5.3+. Uses openssl_encrypt/openssl_decrypt instead of mcrypt_encrypt/mcrypt_decrypt, since mcrypt was deprecated in PHP 7.1 and removed in PHP 7.2.

## Getting Started

See encrypt and decrypt example in `tests` folder.

### Prerequisites

This is known to work with WinVNC 3 and WinVNC 4 from RealVNC. May work with other versions of VNC such as TightVNC, TigerVNC, or UltraVNC if they use the same encryption method and encryption key.

Open a GitHub Issue or submit a Pull Request to report any successes so I can update the documentation.

Here are sample registry locations and values to look for.

```
HKEY_LOCAL_MACHINE\Software\ORL\WinVNC3\\Default
"Password" = "hex:d7,a5,14,d8,c5,56,aa,de"


HKEY_LOCAL_MACHINE\Software\RealVNC\WinVNC4\\
"Password" = "hex:d7,a5,14,d8,c5,56,aa,de"
```

### Installing

You must download and install to your project manually. If you are using this, open an issue and I'll publish to packagist so you can install with composer and automatically receive any future updates.

```
<?php
use JasonKlein\PhpVncPassword\VncPassword;

$vnc = new VncPassword();
$encrypted = 'd7a514d8c556aade';
$decrypted = $vnc->decrypt($encrypted);
// returns 'Secure!'

$vnc = new VncPassword();
$decrypted = 'Secure!';
$encrypted = $vnc->encrypt($decrypted);
// returns 'd7a514d8c556aade'
```

## Running the tests

```
composer install
./vendor/phpunit/phpunit/phpunit tests/
```

## Contributing

Please open a GitHub Issue or submit a Pull Request if you'd like to suggest or contribute changes to this code.

## Authors

* **Jason Klein** - *Initial work* - [Jason-Klein](https://github.com/Jason-Klein)

See also the list of [contributors](https://github.com/jason-klein/php-vnc-password/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

This is based on the many WinVNC encryption/decryption examples available online, with no particular origin of work.
