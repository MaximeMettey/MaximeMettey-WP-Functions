<?php
/**
 * The custom functions written specifically for Maxime Mettey's WordPress projects
 * Include this file into your custom/child theme's functions.php
 * 
 * @author Maxime Mettey <contact@maxime-mettey.com>
 * @see https://www.maxime-mettey.com
 * @version 1.0.0
 */

/**
 * Hide edit post link when loggged in
 */
function hide_edit_post_link()
{
    return false;
}
add_filter('edit_post_link', 'hide_edit_post_link', 999, 3);

/**
 * Automatically format and generate the "tel" link for <a> tags
 * 
 * @param mixed $phoneNumber        The phone number to format
 * @return string                   "tel" link/href formatted
 */
function telLink(string $phoneNumber)
{
    return 'tel:' . str_replace([' ', '(0)'], '', $phoneNumber);
}

/**
 * Automatically generate the link title :
 * Get the post's title 
 */
function get_link_title($l)
{
    $smtitle = $l['lien']['title'];
    if (empty($smtitle)) {
        $urlpost = url_to_postid($l['lien']['url']);

        if ($urlpost > 0) {
            $smtitle = get_the_title($urlpost);
        }
    }

    return $smtitle;
}

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
