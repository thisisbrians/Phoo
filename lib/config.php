<?

/*
This file is reserved for server-specific configuration, such as document root, time zone, etc.

Eventually it should be removed from the git repository, because it is environment-specific. 
However, a sample config should be included in the repo for clarity.
*/

define(DEV, true);

# If your application isn't in your server's document root, append the directory to the document root here
define(DOC_ROOT, $_SERVER['DOCUMENT_ROOT'].'/phoo/');
