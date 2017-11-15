<?php
    $connections = Wallet::$clientd->getpeerinfo();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Connections</h4>
                    <p class="category">the current wallet connections</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <th>address</th>
                        <th>version</th>
                        <th>subversion</th>
                        <th>inbound</th>
                        <th>conntime</th>
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
