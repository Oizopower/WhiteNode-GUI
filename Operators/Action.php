<?php
$action = addslashes($_REQUEST['action']);

$ajaxExemption = array(
    "download"
);

if(!in_array($action, $ajaxExemption))
{
    define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    if (!IS_AJAX) die('Restricted access');
}

$pos = strpos($_SERVER['HTTP_REFERER'], getenv('HTTP_HOST'));
if ($pos === false) die('Restricted access');

include_once("Prepend.php");

$return = array();

switch($action)
{
    case "encrypt":
        $return = Wallet::actionEncrypt($_REQUEST);
    break;
    case "unlock":
        $return = Wallet::actionUnlock($_REQUEST);
    break;
    case "updatesync":
        $return = Wallet::actionUpdateSync();
    break;
    case "reboot":
        exec('sudo reboot');
        exit;
    break;
    case "shutdown":
        exec('sudo shutdown');
        exit;
    break;
    case "download":
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=wallet.dat");
        echo readfile('/home/pi/.whitecoin-xwc/wallet.dat');
        exit;
    break;
}

header('Content-Type: application/json');
echo json_encode($return);

