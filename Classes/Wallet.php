<?php
class Wallet extends Whitenode
{
    static public $startTime = 1486940013;
   /* static public $testStr ='[
    {
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    },{
        "account" : "ky-addr-001",
        "address" : "WNreTxASynsHNcrnbBsvjKeWurxaHVHWEg",
        "category" : "receive",
        "amount" : 100.00000000,
        "confirmations" : 1137,
        "blockhash" : "5af660e57285068c7141d053bf03e363e1c279701df568b22c4387d6535206a9",
        "blockindex" : 2,
        "blocktime" : 1511951456,
        "txid" : "200361a33e01379e7837df1a60f23a5331e00e59ac8304f48dbb3390920b9749",
        "time" : 1511951384,
        "timereceived" : 1511951384
    }]';*/
    static public function listTransactions($account = '*', $amount = 20)
    {
        $tx = Whitenode::$clientd->listtransactions($account, $amount);
        //$tx = json_decode(Wallet::$testStr,true);
        if(!empty($tx))
        {
            $tx = array_reverse($tx);

            foreach($tx as &$t)
            {
                switch($t['category'])
                {
                    case "receive":
                        $t['icon'] = '<i class="fa fa-cloud-download" aria-hidden="true"></i>';
                        break;
                    case "send":
                        $t['icon'] = '<i class="fa fa-cloud-upload" aria-hidden="true"></i>';
                        break;
                    case "generate":
                        $t['icon'] = '<i class="fa fa-gavel" aria-hidden="true" title="'.$t['confirmations'].' blocks"></i>';
                        break;
                    case "immature":
                        $t['icon'] = ' <i class="fa fa-clock-o" aria-hidden="true" title="'.$t['confirmations'].' blocks"></i>';
                        break;
                    default:
                        $t['icon'] = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';
                        break;
                }

            }


        } else {
            $tx = array();
        }

        return $tx;
    }

    static public function walletStatusIcon()
    {
        $icon = "danger";

        if(self::isWalletRunning()) {
            $icon = "warning";
        }

        if(self::isWalletOnline()) {
            $icon = "success";
        }

	echo "walletStatusIcon=".$icon;
        return 'icon-'.$icon;
    }

    static public function isWalletRunning()
    {
        $running = false;

        if(empty(Whitenode::$rpcSettings)) {
            Whitenode::$rpcSettings = Whitenode::getRPCSettings();
        }

        $checkconn = fsockopen(Whitenode::$rpcSettings['rpchost'], 15815, $errno, $errstr, 1);
        if($checkconn >= 1){
            $running = true;
        }

        return $running;
    }

    static public function isWalletOnline()
    {
        $info   = parent::$clientd->getinfo();
        $online = false;

        if($info['connections'] > 0) {
            $online = true;
        }
	echo "isWalletOnline=".$online;
        return $online;
    }

    static public function isWalletEncrypted()
    {
        $help   = parent::$clientd->help();

        if($help)
        {
            $helpLines = explode(PHP_EOL,$help);

            if(in_array("walletlock", $helpLines)) {
                return true;
            }
        }

        return false;
    }

    static public function isWalletStaking()
    {
        $info   = parent::$clientd->getstakinginfo();
        return ($info['staking'] > 0) ? true : false;
    }

    static public function walletStakingIcon()
    {
        $info   = parent::$clientd->getstakinginfo();
        $icon = "danger";

        if($info['staking'] > 0) {
            $icon = "success";
        }


        return 'icon-'.$icon;
    }

    static public function getTransactions($amount = 1000000, $account = '*')
    {
        $transactions = Wallet::listTransactions($account, $amount);
        $listT = array();

        foreach($transactions as $transaction)
        {
            if(isset($listT[$transaction['txid']]))
            {
                /*if($transaction['category'] == "stake")
                {
                    $listT[$transaction['txid']] = $transaction;
                }*/
                $listT[] = $transaction;
            }
            else
            {
//                $listT[$transaction['txid']] = $transaction;
                $listT[] = $transaction;
            }
        }

        return $listT;
    }

    static public function calculateStakePercentage($coinAmount)
    {
        $staking    = Wallet::$clientd->getstakinginfo();
       
        $stakingWeight      = floor($coinAmount);
        $netStakeWeight     = floor($staking['netstakeweight'])/100000000;

        $calculateInterest  = ($staking['netstakeweight'] > 0) ? (Whitenode::$newCoinsYear/$netStakeWeight)*100 : 0;
        $newamountInterest  = ($stakingWeight * ($calculateInterest/100))+$stakingWeight;

        return array
        (
            'interest' => $calculateInterest,
            'input' => $coinAmount,
            'calculated' => $newamountInterest
        );
    }

    static public function actionEncrypt($request)
    {
        $encryptPassword = addslashes($request['encrypt']);

        if(empty($encryptPassword))
        {
            $request['message'] = tl('Password cannot be empty');
            $return = $request;
        }
        else
        {
            $data = Whitenode::$clientd->encryptwallet($encryptPassword);

            if (isset($request['message'])) {
                $return = $data;
            } else {
                $return = array('encrypted' => true);
            }
        }



        return $return;
    }

    static public function actionUnlock($request)
    {
        $unlockPassword = addslashes($request['unlock']);

        $data = Whitenode::$clientd->walletpassphrase($unlockPassword, 9999999999, true);

        if (isset($data['message'])) {
            $return = $data;
        } else {
            $return = array('unlocked' => true);
        }

        return $return;
    }

    static public function sendToAddress($address,$amount,$comment,$commentto)
    {
        $iamount = (real)$amount;
        $data = Whitenode::$clientd->sendtoaddress($address,$iamount,$comment,$commentto);

        if(!empty($data)){
            $return = $data;
        } else {
            $return = array('message' => 'success');
        }

        return $return;
    }

    static public function signMessage($address,$message)
    {
        $data = Whitenode::$clientd->signmessage($address,$message);

        if(!empty($data)){
            $return = $data;
        } else {
            $return = array('message' => 'success');
        }

        return $return;
    }


    static public function verifyMessage($address,$signature,$message)
    {
        $data = Whitenode::$clientd->verifymessage($address,$signature,$message);

        if(!empty($data)){
            $return = $data;
        } else {
            $return = array('message' => 'success');
        }

        return $return;
    }

    static public function getNewAddress($label)
    {
        
        $data = Whitenode::$clientd->getnewaddress($label);

        if(!empty($data)){
            $return = $data;
        }else{
            $return = array('message' => 'error');
        }
        
        return $return;
    }

    static public function getReceivedByAddress($address)
    {

        $data = Whitenode::$clientd->getreceivedbyaddress($address);

        if(!empty($data)){
            $return = $data;
        }else{
            $return = 0;
        }

        return $return;
    }

    static public function actionUpdateSync()
    {

        $blocks = Whitenode::$clientd->getblockcount();
        $peers = Whitenode::$clientd->getpeerinfo();

        $listNode = 0;
        $percentage = 0;
        $return = array();

        if(!empty($peers))
        {
            foreach($peers as $peer) {
                if($peer['startingheight'] > $listNode) {
                    $listNode = $peer['startingheight'];
                }
            }
            $percentage = (int) round(($blocks/$listNode)*100);

            $return = array(
                'percentage' => $percentage,
                'blocks' => $blocks,
                'height' => $listNode
            );
        }

        return $return;
    }

}
