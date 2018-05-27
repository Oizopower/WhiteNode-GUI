<?php
$action = addslashes($_REQUEST['action']);

$ajaxExemption = array(
    "download",
    "update",
    "updatewallet",
    "deleteblockchain",
    "backupwallet"
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
    case "changelanguage":
        $return = Whitenode::setSiteLanguage($_REQUEST);
    break;
    case "shutdown":
	    exec('sudo halt');
        exit;
    break;
    case "backupwallet":
        $return = Wallet::backupDownloadWallet();
    break;
    case "updatewallet":
        $return = Whitenode::updateWallet();
    break;
    case "deleteblockchain":
        $return = Whitenode::deleteBlockFiles();
    break;
    case "updateGUI":
        $return = shell_exec("cd /var/www/public && /usr/bin/git pull  2>&1");
        if($return) {
            $return = array('message' => 'Update is complete', 'finished' => 1, 'action' => 'refresh');
        }
    break;
    case "calculatestake":
        $return = Wallet::calculateStakePercentage($_REQUEST['amount']);
    break;
}

header('Content-Type: application/json');
echo json_encode($return);

