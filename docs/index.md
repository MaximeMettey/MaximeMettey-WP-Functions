# Welcome to Maxime Mettey - WP Functions & Snippets

Author: Maxime Mettey <contact@maxime-mettey.com>

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

*N.B. : You can also just copy the snippets you want to use, and paste them in your own code.*

## Project layout

- maximemettey_wp_functions.php

## List of functions and snippets available

### Security snippets

**Snippet n°1 :**

Disable login error messages to prevent hackers from finding informations using brute-force attacks on the login page.

```
function no_wordpress_errors_on_login()
{
    return __('Login error.');
}
add_filter('login_errors', 'no_wordpress_errors_on_login');
```

**Snippet n°2 :**

Automatically reject suspicious requests.

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

**Snippet n°3 :**

Disable XML RPC protocol from Wordpress. If you do not need it, it is safer.

```
add_filter('xmlrpc_enabled', '__return_false');
```

---

### Performance snippets

**Snippet n°1 :**

Automatic empty trash after five days - You can adjust this number if needed.

```
define('EMPTY_TRASH_DAYS', 5);
```

**Snippet n°2 :**

Limit post revisions to five - You can adjust this number if needed.

```
define('WP_POST_REVISIONS', 5);
```

---

### Useful and time saving snippets

**Snippet n°1 :**  

Hide edit post link on the front. THis prevents your design from breaking when you are logged in.

```
function hide_edit_post_link()
{
    return false;
}
add_filter('edit_post_link', 'hide_edit_post_link', 999, 3);
```

**Snippet n°2 :**  

Disable Wordpress dashboard welcome panel.

```
remove_action('welcome_panel', 'wp_welcome_panel');
```

**Snippet n°3 :**  

Automatically format and generate the "tel" link for link tags

```
function telLink(string $phoneNumber)
{
    return 'tel:' . str_replace([' ', '(0)'], '', $phoneNumber);
}
```

**Snippet n°4 :**  

**Only useful for the Advanced Custom Fields plugin users.** Automatically generates the link title for an ACF link field. By order of priority :
1. Get the link title in the link array
2. Get the post's by URL

```
function get_link_title_from_acf_array($link)
{
    $smtitle = $link['lien']['title'];
    if (empty($smtitle)) {
        $urlpost = url_to_postid($link['lien']['url']);

        if ($urlpost > 0) {
            $smtitle = get_the_title($urlpost);
        }
    }

    return $smtitle;
}
```

**Snippet n°5 :**  

**Only useful for the Advanced Custom Fields plugin users.** Automatically generates a link tag for an ACF link field.

```
function generate_link_tag_from_acf_array($link, $class = '')
{
    return '
        <a
            href="' . $link['lien']['url'] . '"
            target="' . $link['lien']['target'] . '"
            class="' . $class . '"
        >
            ' . get_link_title($link) . '
        </a>
    ';
}
```