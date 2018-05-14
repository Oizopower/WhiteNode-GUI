<?php
/**
 * Created by PhpStorm.
 * User: Oizopower
 * Date: 9-10-2017
 * Time: 19:04
 */
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Accounts</h4>
                    <p class="category">list your wallet accounts</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <th>account</th>
                        <th>address</th>
                        <th>amount</th>
                        <th></th>
                        </thead>
                        <tbody>
                        <?php
                        $accounts = Wallet::getAccounts();

                        foreach($accounts as $account)
                        {
                            foreach($account as $subAccount)
                            {
                                ?>
                                <tr>
                                    <td><?=$subAccount[2]?></td>
                                    <td><?=$subAccount[0]?></td>
                                    <td><?=$subAccount[1]?></td>
                                    <td><a href="<?=Whitenode::$settings['block_explorer']?>../address/<?=$subAccount[0]?>" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


