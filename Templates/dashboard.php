<div class="container-fluid">
    <?php
    $blocks = Whitenode::$clientd->getblockcount();
    $peers = Whitenode::$clientd->getpeerinfo();
    $info = Whitenode::$clientd->getinfo();
    $diskUsage = System::getDiskUsage();

    $listNode = 0;
    $percetage = 0;

    if(!empty($peers))
    {
        foreach($peers as $peer) {
            if($peer['startingheight'] > $listNode) {
                $listNode = $peer['startingheight'];
            }
        }
        $percetage = (int) round(($blocks/$listNode)*100);
    }

    if($blocks < $listNode)
    {
    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="Progress">
                        <div class="header">
                            <p>
                                <i class="ti-pulse"></i>
                                <?=tl("Synchronizing")?>:
                                <div id="js--sync"><strong><?=$percetage?>%</strong> (<?=$blocks?> / <?=$listNode?>)</div>
                            </p>
                        </div>
                        <div class="content">
                            <progress max="100" value="<?=$percetage?>" class="Progress-main">
                                <div class="Progress-bar" role="presentation">
                                    <span class="Progress-value" style="width: <?=$percetage?>%;"> </span>
                                </div>
                            </progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    if($diskUsage['percentage'] > DISKTHRESHOLD)
    {
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="Progress">
                        <div class="header">
                            <i class="ti-harddrive"></i>
                            <?=tl("Disk warning")?>:
                            <div id="js--disk"><strong><?=$diskUsage['message']?>%</strong></div>
                        </div>
                        <div class="content">
                            <progress max="100" value="<?=$diskUsage['percentage']?>" class="Progress-main">
                                <div class="Progress-bar" role="presentation">
                                    <span class="Progress-value" style="width: <?=$diskUsage['percentage']?>%;"> </span>
                                </div>
                            </progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <?php /* <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-big icon-warning text-center">
                                <i class="fa fa-thermometer-half"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers">
                                <p>Temp</p>
                                <?=System::getCpuTemp()?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i> Updated now
                        </div>
                    </div>
                </div>
            </div>*/ ?>
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="icon-big icon-warning text-center">
                                <i class="fa fa-btc" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers">
                                <p><?=tl("Last price")?></p>
                                <?=Exchange::bittrexTicker()?>
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
                                <i class="ti-wallet"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers">
                                <p><?=tl("Revenue")?></p>
                                $ <?=Exchange::getBittrexRevenue();?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i> <?=tl("Bittrex - BTC price")?>: $<?=number_format(Exchange::$bitcoinprice,2)?>
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
                                <i class="ti-pulse"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers">
                                <p><?=tl("Blocks")?></p>
                                <?=Whitenode::$clientd->getblockcount();?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-timer"></i> <?=tl("Total blocks since")?> <?=date("Y-m-d H:i:s", Wallet::$startTime)?>
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
                                <i class="ti-ticket"></i>
                            </div>
                        </div>
                        <div class="col-xs-10">
                            <div class="numbers text-nowrap">
                                <p><?=tl("Balance")?></p>
                                <?=Whitenode::$clientd->getbalance();?> XWC
                                <?php
                                    if(isset($info['stake']) && $info['stake'] > 0) {
                                        ?><p><?=tl("Staking")?>: <small><?=$info['stake'];?> XWC</small></p><?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-wallet"></i> <?=Whitenode::$clientd->getaccountaddress("")?>
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
                    <h4 class="title"><?=tl("Recent transactions")?></h4>
                    <p class="category"><?=tl("view your recent transactions below")?></p>
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
                        foreach(Wallet::cleanTransactions(25) as $d) {
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