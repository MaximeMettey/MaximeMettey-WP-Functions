# Welcome to Maxime Mettey - WP Functions & Snippets

Author: Maxime Mettey <contact@maxime-mettey.com>   
URL : [https://www.maxime-mettey.com](https://www.maxime-mettey.com)

## Warning and disclaimer

Please read **carefully** all this documentation file before using.
This code **turns off and alterate** some standard behaviours on Wordpress.
It is designed to suit **my own** developing habits on a Wordpress website.
You may need to adjust it to your needs, maybe using some parts of this code only.

## License

GNU GPL

## Install

1. Copy the file `maximemettey_wp_functions.php`
2. Paste it in your child / custom Wordpress theme folder [WordpressRootFolder]/wp-content/themes/[YourTheme]/
3. Add this code at the end of the `functions.php` file in your theme folder :   
`require 'maximemettey_wp_functions.php';`

## Project layout

    maximemettey_wp_functions.php    # The one and only file to import

## List of functions and snippets available

```
function no_wordpress_errors_on_login()
{
    return __('Login error.');
}
add_filter('login_errors', 'no_wordpress_errors_on_login');
```

Disable login error messages to prevent hackers from finding informations using brute-force attacks on the login page.

---

```
global $user_ID;
if ($user_ID) {
    if (!current_user_can('administrator')) {
        if (
            strlen($_SERVER['REQUEST_URI']) > 255 ||
            stripos($_SERVER['REQUEST_URI'], "eval(") ||
            stripos($_SERVER['REQUEST_URI'], "CONCAT") ||
            stripos($_SERVER['REQUEST_URI'], "UNION+SELECT") ||
            stripos($_SERVER['REQUEST_URI'], "base64")
        ) {
            @header("HTTP/1.1 414 Request-URI Too Long");
            @header("Status: 414 Request-URI Too Long");
            @header("Connection: Close");
            @exit;
        }
    }
}
```
: Automatically reject suspicious requests.
    
```
add_filter('xmlrpc_enabled', '__return_false');
```

