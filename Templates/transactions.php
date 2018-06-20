<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Transactions</h4>
                    <p class="category">view your transactions</p>
                </div>
                <div class="content table-responsive ">
                    <table class="table table-striped" id="datatable">
                        <thead>
                        <th>date</th>
                        <th>account</th>
                        <th>amount</th>
                        <th>confirmations</th>
                        <th>category</th>
                        <th></th>
                        </thead>
                        <tbody>
                        <?php
                            $transactions = Wallet::cleanTransactions();

                            foreach($transactions as $d)
                            {
                                ?>
                                <tr>
                                    <td><?=date("Y-m-d H:i:s",$d['blocktime'])?></td>
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
