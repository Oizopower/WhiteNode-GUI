<?php
    $staking = Wallet::$clientd->getstakinginfo();
    $transactions = Wallet::listTransactions('*', 10);

    $info = Wallet::$clientd->getinfo();

    $stakeArray  = array();
    $totalStakes = 0;
    $latestStake = 0;
    foreach($transactions as $trans) {
        if(isset($trans['generated']) && $trans['generated'] == 1)
        {
            if($trans['time'] > $latestStake) {
                $latestStake = $trans['time'];
            }

            $stakeArray[] = $trans;
            $totalStakes++;
        }
    }

    $calculateStake = Wallet::calculateStakePercentage($staking['weight']);
    $newamountInterest = $calculateStake['calculated'];
    $calculateInterest =  $calculateStake['interest'];

    $expectedStake      = ($staking['expectedtime'] == 0) ? tl("Wallet not staking") : Whitenode::secondsToTime($staking['expectedtime']);

//    $unlockedUntill = date("Y-m-d H:i:s",(int)number_format($info['unlocked_until'],0,'',''));
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-big icon-warning text-center">
                                <i class="fa fa-balance-scale" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers">
                                <p><?=tl("Network stake weight")?></p>
                                <?=floor(floor($staking['netstakeweight'])/100000000)?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i> <?=tl("Last updated")?> <?=date("H:i:s")?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-big icon-success text-center">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers">
                                <p><?=tl("Your weight")?></p>
                                <?=floor($staking['weight']/100000000)?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i> <?=tl("network weight based on the amount of coins")?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-big icon-danger text-center">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers ">
                                <p><?=tl("Expected stake")?></p>
                                <p style="font-size: 20px; padding-top: 10px;"><?=$expectedStake?></p>
                            </div>

                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-timer"></i> <?=tl("Latest stake")?> <?=Whitenode::timeago($latestStake)?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-big icon-info text-center">
                                <i class="fa fa-gavel" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers text-nowrap">
                                <p><?=tl("Staking coins")?></p>
                                <?=(isset($info['stake'])) ? money_format($info['stake'],8) : 0;?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-wallet"></i> <?=tl("Reserved coins unable to spend")?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=tl("Stake calculator")?></h4>
                    <p class="small"><?=tl("Calcultated from current")?> <?=number_format($calculateInterest,2)?>%</p>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <p><?=tl("Staking coins")?></p>
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount"><?=tl("Amount (in XWC)")?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="js--calc-xwc-amount" placeholder="Amount" value="<?=(isset($info['balance'])) ?  floor($info['balance']) : 0;?>">
                                        <div class="input-group-addon"><?=tl("XWC")?></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <p><?=tl("Compound interest")?></p>
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputAmount"><?=tl("Amount (in XWC)")?></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" readonly id="js--calc-xwc-interest" placeholder="Amount" value="<?=floor($newamountInterest)?>">
                                        <div class="input-group-addon"><?=tl("XWC")?></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=tl("Recent stakes")?></h4>
                    <p class="category"><?=tl("view your recent stakes below")?></p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <th><?=tl("date")?></th>
                        <th><?=tl("account")?></th>
                        <th><?=tl("amount")?></th>
                        <th><?=tl("confirmations")?></th>
                        <th><?=tl("category")?></th>
                        <th></th>
                        </thead>
                        <tbody>
                        <?php
                        foreach($stakeArray as $d) {
                            ?>
                            <tr>
                                <td><?=date("Y-m-d H:i:s",$d['time'])?></td>
                                <td><?=(!empty($d['account'])) ? $d['account'] : $d['address'];?></td>
                                <td><?=$d['amount']?></td>
                                <td><?=$d['confirmations']?></td>
                                <td><?=$d['icon']?></td>
                                <td><a href="<?=Whitenode::$settings['block_explorer']?><?=$d['txid']?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
