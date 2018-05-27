<?php
class Wallet extends Whitenode
{
    static public $startTime = 1486940013;

    static public function listTransactions($account = '*', $amount = 20)
    {
        $tx = Whitenode::$clientd->listtransactions($account, $amount);

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

    static public function backupDownloadWallet()
    {

        $backupFile = HOMEDIR."wallet.dat";
        $backup    = Wallet::$clientd->backupwallet($backupFile);

        if( !file_exists($backupFile) ) die("File not found");
        // Force the download
        header("Content-Disposition: attachment; filename=" . basename($backupFile) . "");
        header("Content-Length: " . filesize($backupFile));
        header("Content-Type: application/octet-stream;");
        readfile($backupFile);

        unlink($backupFile);
    }

    static public function cleanTransactions($amount = 1000000, $account = '*')
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
        $encryptPasswordVerify = addslashes($request['encryptVerify']);

        if(empty($encryptPassword))
        {
            $request['message'] = tl('Password cannot be empty');
            $return = $request;
        }
        elseif($encryptPassword != $encryptPasswordVerify)
        {
            $request['message'] = tl('Password does not match');
            $return = $request;
        }
        else
        {
            $data = Whitenode::$clientd->encryptwallet($encryptPassword);

            if (isset($request['message'])) {
                $return = $data;
            } else {
                sleep(10);
                Whitenode::service('start');
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

    static public function getAccounts()
    {
        $accounts = Whitenode::$clientd->listaddressgroupings();
        return $accounts;
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