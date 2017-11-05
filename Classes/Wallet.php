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
        $isWindows = false;
        $running = false;

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $isWindows = true;
        }

        if($isWindows)
        {
            $checkconn = fsockopen('127.0.0.1', 15815, $errno, $errstr, 1);
            if($checkconn >= 1){
                $running = true;
            }
        }
        else
        {
            if(file_exists(WALLET.'whitecoind.pid')) {
                $running = true;
            }
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

    static public function actionEncrypt($request)
    {
        $encryptPassword = addslashes($request['encrypt']);

        $data = Whitenode::$clientd->encryptwallet($encryptPassword);

        if (isset($request['message'])) {
            $return = $data;
        } else {
            $return = array('encrypted' => true);
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