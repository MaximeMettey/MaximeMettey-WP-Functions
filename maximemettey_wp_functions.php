<?php
/**
 * The custom snippets I use in my WP projects.
 * 
 * WARNING :
 * These snippets and functions should be used carefully.
 * They are mostly used in starter themes, so they can
 * cause problems and/or conflicts with some plugins,
 * other snippets, themes...
 * Some of the snippets are changing the default behaviour
 * of WordPress, so you may also notice some different
 * things than usual.
 * 
 * @author Maxime Mettey <contact@maxime-mettey.com>
 * @see https://www.maxime-mettey.com
 * @version 1.0.0
 */

/**
 * -------------------------
 * --- SECURITY SNIPPETS ---
 * -------------------------
 */

/**
 * Disable login error messages to
 * prevent hackers from finding informations by brute-force attack.
 * 
 * WARNING : THIS DOES NOT REPLACE A REAL SECURITY PLUGIN.
 * 
 * @since 1.0.0
 * @source
 * @see https://wpformation.com/snippets-wordpress/
 * @return string                   Generic error message
 */
function no_wordpress_errors_on_login()
{
    return __('Login error.');
}
add_filter('login_errors', 'no_wordpress_errors_on_login');

/**
 * Protect site from malicious requests
 * 
 * @see https://themeisle.com/blog/code-snippets-for-wordpress/
 */
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

/**
 * Disable XML RPC
 * 
 * @since 1.0.0
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Hide edit post link when the user is loggged in
 * 
 * @since 1.0.0
 * @return bool                     Always False
 */
function hide_edit_post_link()
{
    return false;
}
add_filter('edit_post_link', 'hide_edit_post_link', 999, 3);

/**
 * --------------------------------
 * --- END OF SECURITY SNIPPETS ---
 * --------------------------------
 */

/**
 * ----------------------------
 * --- PERFORMANCE SNIPPETS ---
 * ----------------------------
 */

/**
 * Automatic empty trash after five days - You can
 * adjust this number if needed
 * 
 * @since 1.0.0
 * @see https://wpformation.com/snippets-wordpress/
 */
define('EMPTY_TRASH_DAYS', 5);

/**
 * Limit post revisions to five - You can adjust this
 * number if needed
 * 
 * @since 1.0.0
 * @see https://wpformation.com/snippets-wordpress/
 */
define('WP_POST_REVISIONS', 5);

/**
 * -----------------------------------
 * --- END OF PERFORMANCE SNIPPETS ---
 * -----------------------------------
 */

/**
 * ---------------------------------------
 * --- USEFUL AND TIME SAVING SNIPPETS ---
 * ---------------------------------------
 */

/**
 * Disable WordPress dashboard welcome panel - Because
 * it is useless and annoying
 * 
 * @since 1.0.0
 * @see https://wpformation.com/snippets-wordpress/
 */
remove_action('welcome_panel', 'wp_welcome_panel');


/**
 * Automatically format and generate the "tel" link for <a> tags
 * 
 * @since 1.0.0
 * @param string $phoneNumber       The phone number to format
 * @return string                   "tel" link/href formatted
 */
function telLink(string $phoneNumber)
{
    return 'tel:' . str_replace([' ', '(0)'], '', $phoneNumber);
}

/**
 * Automatically generate the link title for an ACF link field.
 * By order of priority :
 *      1. Get the link title in the link array
 *      2. Get the title of the post by URL
 * 
 * @since 1.0.0
 * @param Array $link               ACF Link field array
 * @return string                   Formatted link title
 */
function get_link_title($link)
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

/**
 * Automatically generate link tag for an ACF link field
 * 
 * @since 1.0.0
 * @param Array $link               ACF Link field array
 * @param string $class             Class to apply to the tag
 * @return string                   HTML link tag
 */
function generate_link($link, $class = '')
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

/**
 * ----------------------------------------------
 * --- END OF USEFUL AND TIME SAVING SNIPPETS ---
 * ----------------------------------------------
 */
