<?php
define('IN_TRACKER', true);
define("PROJECTNAME","p2pnow.net");
define("NEXUSPHPURL","https://github.com/cs17899219/p2pnow-nexus");
define("NEXUSWIKIURL","http://www.nexusphp.com/wiki");
define("VERSION","Powered by <a href=\"aboutnexus.php\">".PROJECTNAME."</a>");
define("THISTRACKER","General");
$showversion = " - Powered by ".PROJECTNAME;
$rootpath=realpath(dirname(__FILE__) . '/..');
set_include_path(get_include_path() . PATH_SEPARATOR . $rootpath);
$rootpath .= "/";
include($rootpath . 'include/core.php');
include_once($rootpath . 'include/functions.php');
