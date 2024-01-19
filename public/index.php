<?php

require_once "../bootstrap.php";

$browser = get_browser(null , true);
$browser['cookies'] == 0 ? exit('<small>Enable the use of cookies for the venus blog</small>') : '';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Libraries\Core\Core;

//init core library
$init = new Core;
