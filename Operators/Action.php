<?php
$action = addslashes($_REQUEST['action']);

$ajaxExemption = array(
    "download",
    "update"
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
	     exec('sudo halt');
         exit;
         break;
    case "changepasswd":
         $return = actionChangePasswd();
         break;     
    case "update":
         $return = shell_exec("cd /var/www/public && /usr/bin/git pull  2>&1");
         if($return) {
            header("Location: /");
            exit;
         }
         break;
    case "calculatestake":
         $return = Wallet::calculateStakePercentage($_REQUEST['amount']);
         break;
    case "sendwhitecoin":
         $return = actionSend();
         break;    
    case "newaddress":
         $return = actionNewAddress();
         break;
    case "addaddress":
         $return = actionAddAddress();
         break;
    case "deleteotheraddress":
         $return = actionDeleteAddressOther();
         break;
    case "editaddresslabel":
         $return = actionEditAddressLabel();
         break;
    case "signmessage":
         $return = actionSignMessage();
         break;
    case "verifymessage":
         $return = actionVerifyMessage();
         break;
    case "listtransaction":
         $return = actionListTransaction();
         break;
    case "changelanguage":
        $return = actionChangeLanguage();
        break;
          
    /*case "download":
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=wallet.dat");
        echo readfile('/home/pi/.whitecoin-xwc/wallet.dat');
        exit;
    break;*/
}

function actionChangeLanguage()
{
    $lang = $_POST['language'];
    //echo "action lang=".$lang;
    Whitenode::setSiteLanguage($lang);
    $ret['message'] = 'success';
}

function runLocalCommand($command) {
    $status = 1;
    $log = '';
    exec($command.' 2>&1', $log, $status);
    $ret['command'] = $command;
    $ret['status'] = !$status;
    return $ret;
}

function actionChangePasswd()
{
    $passwd = $_POST['passwdinput'];
    $config = $_POST['passwdconfig'];
    $change = $_POST['passwdchange'];
    $inputp = md5($passwd);
    $saveps = md5($change);
    
    /*
    echo "-------------------------<br>";
    print($inputp);
    echo "-------------------------<br>";
    print($config);*/
    
    $cmp = strcmp($inputp,$config);
    
    if($cmp!=0){
        $ret['message'] = 'fail';    
    }else{
        $command = "echo \"pi:$change\" | chpasswd";
        file_put_contents("/var/www/public/whitenode.cmd",$command);
        DataManager::getInstance()->editPassword($saveps);
        $ret['message'] = 'success';
    }
    //var_dump($ret);
    return $ret;
}
function actionNewAddress()
{
    $address = $_POST['newaddress'];
    $label = $_POST['newlabel'];

    $data = Wallet::getNewAddress($label);

    if(!empty($data)){
        DataManager::getInstance()->newAddress($label,$data);
        $ret['message'] = 'success';
        $ret['address'] = $data;
    }

    return $ret;
}

function actionAddAddress()
{
    $address = $_POST['addaddress'];
    $label = $_POST['addlabel'];
    //echo "newaddress=".$address." newaddress=".$label;
    DataManager::getInstance()->addAddress($label,$address);
    $data['message'] = 'success';
    return $data;
}

function actionDeleteAddressOther()
{
    $address = $_POST['address'];
    DataManager::getInstance()->delAddressOther($address);
    $data['message'] = 'success';
    return $data;
}

function actionEditAddressLabel()
{
    $address = $_POST['newaddress'];
    $label = $_POST['newlabel'];
    //echo "newaddress=".$address." newaddress=".$label;
    //$data = Wallet::getNewAddress($label);
    //var_dump($return);
    if(!empty($address) && !empty($label))
    {
        DataManager::getInstance()->editAddress($label,$address);
    }
    $return = array('message'=>'success');
    
    return $return;
}

function actionSignMessage()
{
    $address = $_POST['whitecoinAddress'];
    $message = $_POST['signMessage'];
    $data = Wallet::signMessage($address,$message);

    if(!empty($data)){
        $return['signature'] = $data;
        $return['message'] = 'success';
    }
    return $return;
}

function actionVerifyMessage()
{
    $address = $_POST['whitecoinAddress'];
    $message = $_POST['signMessage'];
    $signature = $_POST['signature'];
    $data = Wallet::signMessage($address,$signature,$message);

    if(!empty($data)){
        $return['signature'] = $data;
        $return['message'] = 'success';
    }
    return $return;
}

function actionListTransaction()
{
    $data['transactions'] = Wallet::getTransactions();
    $data['block_explorer'] = Whitenode::$settings['block_explorer'];
    $data['message'] = 'success';
    return $data;
}

function actionSend()
{
    $address = $_POST['sendaddress'];
    $comment = $_POST['sendlabel'];
    $amount = $_POST['sendamount'];
    $type = $_POST['sendtype'];
    $commentto = "";

    if($type == 'mXWC')
    {
        $amount = $amount /1000;
    }
    else if($type == 'uXWC')
    {
        $amount = $amount /1000000;
    }

    /*$return['message'] = 'success';
    $return['address']= $address;
    $return['amount']= $amount;
    $return['type']= $type;*/
    $return = Wallet::sendToAddress($address,$amount,$comment,$commentto);
    return $return;
}
header('Content-Type: application/json');
echo json_encode($return);

