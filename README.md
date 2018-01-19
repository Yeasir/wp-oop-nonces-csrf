#WordPress Nonces in OOP Environment

A composer package, which serves the functionality working with WordPress Nonces in an object orientated environment.

#Requirement

```php

Wordpress Version: Minimum 4.8
PHP Version: Minimum 5.6
PHP Unit Version: 5

```

#Installation
Add this package as requirement at your composer.json file and then run 'composer update'

```php

"ympervej/wp-oop-nonces-csrf": "1.0.*"

```


Or directly run

```php
composer require ympervej/wp-oop-nonces-csrf

```

##Usage

add to your functions.php, in the active theme

```php

// Autoload files using Composer autoload
require __DIR__ . '/vendor/autoload.php';

```

##Examples

###Create a nonce

##### This will creates a cryptographic token tied to a specific action
####### Arguments string or int $action Scalar value to add context to the nonce.
####### Return The token.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_nonce_create = $Wp_Csrf_Nonce->wp_oop_create_nonce( $action );

```

For example:

```php
<a href='my_url.php?nonce_something=nonce_action&_wpnonce=<?php echo $csrf_nonce_create; ?>'>Your Nonce Action</a>
```

###Verify a nonce
##### Verify that correct nonce was used with time limit.
####### Arguments $nonce and $action.
####### Return Boolean or 1.


```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_nonce_verify = $Wp_Csrf_Nonce->wp_oop_verify_nonce( $nonce, $action );

```
###Add a nonce to a URL
##### Retrieve URL with nonce added to URL query.
####### Arguments $action_url and $action and $name.
####### Return Escaped URL with nonce action added.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_nonce_url = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_URL($action_url, $action, $name );

```
###Add a nonce to a form
##### Retrieve URL with nonce added to URL query.
####### Arguments action, $name, $referer, $echo.
####### Return Nonce field HTML markup.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_nonce_field = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_field(action, $name, $referer, $echo );

```
###Ajax Nonce Verification
###Verify a nonce passed in an AJAX request
####### Arguments $action, $query_arg, $die.
####### Return Boolean or 1.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_nonce_ajax_ref = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_checka_ajax_referer($action, $query_arg, $die);

```
### Admin Nonce Verification.
####Makes sure that a user was referred from another admin page.
####### Arguments $action, $query_arg.
####### Return Boolean or 1.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_nonce_admin_ref = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_check_admin_referer($action, $query_arg);
```
###Display Nonce Action Message.
####This will display 'Are you sure you want to do this?' message to confirm the action being taken.
####### Arguments $action.
####### Return Boolean or 1.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_action_text = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_ays($action);

```
###Retrieve or display referer hidden field for forms.
####The referer link is the current Request URI from the server super global.
####### Arguments $echo Boolean.
####### Return Referer field HTML markup.

```php

$Wp_Csrf_Nonce = new \wp_oop_nonce_csrf\Wp_Oop_Nonces_Csrf();
$csrf_refer_field = $Wp_Csrf_Nonce->wp_oop_nonce_csrf_referer_field($echo);

```

# How to run Unit Tests
1. In Terminal Run this
```php

$ CD /wordpress/your-theme-folder/wp-oop-nonces-csrf

```
2. Run Composer Update
```php

$ composer update

```
3. Run This in Terminal
```php

$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/WpOopCsrfTest

```
4. You can also test with this
```php

$ ./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests

```
## Thanks to
* [Wordpress Nonces Documentation](https://codex.wordpress.org/WordPress_Nonces)
* [PHP Unit Testing Documentation](https://phpunit.de)

## License

[GPL](http://www.gnu.org/licenses/gpl-2.0.html)
