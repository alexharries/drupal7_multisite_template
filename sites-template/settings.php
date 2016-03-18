<?php

// Work out the directory name of this multisite:
define('MULTISITE_IDENTIFIER', substr(dirname(__FILE__), strrpos(dirname(__FILE__), '/') + 1));

// Include the common settings.php file. Paths relative to index.php!
require_once '../configuration/common.settings.php';
