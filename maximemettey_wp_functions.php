<?php
/**
 * The custom functions written specifically for Maxime Mettey's projects
 * 
 * @author Maxime Mettey <contact@maxime-mettey.com>
 * @see https://www.maxime-mettey.com
 * @version 1.0.0
 */

/**
 * Hide edit post link when the user is loggged in, because it is annoying
 * 
 * @since 1.0.0
 * @return bool     Always False
 */
function hide_edit_post_link()
{
    return false;
}
add_filter('edit_post_link', 'hide_edit_post_link', 999, 3);

/**
 * Automatically format and generate the "tel" link for <a> tags
 * 
 * @since 1.0.0
 * @param mixed $phoneNumber        The phone number to format
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
