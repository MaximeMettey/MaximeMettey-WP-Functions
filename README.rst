Sleep Well Documentation
========================

:Author: Maxime Mettey <contact@maxime-mettey.com>
:Version: $1.0$
:License: Creative Commons  

Contents
------------

Custom Wordpress functions to develop faster and increase performance.

Technologies
------------

* PHP

How to use
----------

* Duplicate the file maximemettey_wp_functions.php in your child / custom Wordpress theme
* include this new file into functions.php file of your theme with

..  code-block:: PHP
    :caption: test
    :linenos:
    :lineno-start: 10
    :emphasize-lines: 32
    :name: maximemettey_wp_functions.php
    
    function test()
    {
        echo 'ok';
    }
