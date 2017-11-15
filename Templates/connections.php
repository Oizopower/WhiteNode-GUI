<?php
    $connections = Wallet::$clientd->getpeerinfo();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=tl("Connections")?></h4>
                    <p class="category"><?=tl("current wallet connections")?></p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <th><?=tl("address")?></th>
                        <th><?=tl("version")?></th>
                        <th><?=tl("subversion")?></th>
                        <th><?=tl("inbound")?></th>
                        <th><?=tl("conntime")?></th>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($connections)) 
                            {
                                foreach($connections as $d)
                                {
                                    ?>
                                    <tr>
                                        <td><?=$d['addr']?></td>
                                        <td><?=$d['version']?></td>
                                        <td><?=$d['subver']?></td>
                                        <td><?=$d['inbound']?></td>
                                        <td><?=date("Y-m-d H:i:s",$d['conntime'])?></td>
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
