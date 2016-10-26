<?php
ob_start();
header('Content-Type: text/html; charset=utf-8');
ini_set("memory_limit", "520M");
//if (!session_id())

session_start();
//  header('X-Frame-Options: ALLOWALL');
/* header("Access-Control-Allow-Origin: *"); */
/// header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');

/* session_start();
  session_destroy(); */
require_once('Includes/CommonIncludes.php');
 

if ((isset($_GET['page'])) && ($_GET['page'] != ''))
    $_GET['page'] = rtrim($_GET['page'], '/');
else {
   $_GET['page'] = 'dashboard';
}





//header("Cache-Control: public");
//error_reporting(-1);



$site_path = SITE_PATH;
 

/*
  require_once 'Mobile_Detect.php';
  $detect = new Mobile_Detect;
 */

/*
 */

if ((isset($_GET['page'])) && ($_GET['page'] != '')) {
	include('templates/header.php');
    if (file_exists('Views/' . $_GET['page'] . '.php')) {
        require_once('Views/' . $_GET['page'] . '.php');
    } else if (file_exists('Views/' . $_GET['page'])) {
        require_once('Views/' . $_GET['page'] . '.php');
    } else {
        header('Location:' . SITE_PATH . 'index.php?page=404');
        die;
    }
} else {
    require_once('Views/dashboard.php');
}
include('templates/footer.php');