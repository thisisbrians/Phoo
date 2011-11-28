<?php

/*
This file is reserved for server-specific configuration, such as document root, time zone, etc.

Eventually it should be removed from the git repository, because it is environment-specific. 
However, a sample config should be included in the repo for clarity.
*/

define('DEV', true);

# If your application isn't in your server's document root, append the directory to the document root here
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'].'/phoo/');

# The absolute path to this application's root directory on your server
define('ABS_PATH', '/Applications/XAMPP/xamppfiles/htdocs/phoo/');

/** The name of the MySQL database */
define('DB_NAME', 'phoo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');
