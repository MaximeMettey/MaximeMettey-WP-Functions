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

1. no_wordpress_errors_on_login

    Disable login error messages to prevent hackers from finding informations using brute-force attacks on the login page.

2. Protect site from maliciours requests

    Automatically reject suspicious requests.
    
3. Disable XML RPC protocol

    If not used, it is more safe to disable XML RPC.

4. Hide edit post link

    The edit post link is usually breaking your front design when you are logged in.