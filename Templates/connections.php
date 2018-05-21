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
                        <th><?=tl("location")?></th>
                        <th><?=tl("conntime")?></th>
                        </thead>
                        <tbody>
                        <?php
                            if(!empty($connections)) 
                            {
                                foreach($connections as $d)
                                {
                                    $cleanIP = explode(":", $d['addr']);
                                    $ip = array_shift($cleanIP);

                                    if((strpos($ip, ":") === false)) {
                                        //ipv4
                                        $gi = geoip_open(ROOT."assets/geoip/GeoIP.dat",GEOIP_STANDARD);
                                        $country =  geoip_country_name_by_addr($gi, $ip);
                                    }
                                    else {
                                        //ipv6
                                        $gi = geoip_open(ROOT."assets/geoip/GeoIPv6.dat",GEOIP_STANDARD);
                                        $country = geoip_country_name_by_addr_v6($gi, $ip);
                                    }
                                    ?>
                                    <tr>
                                        <td><?=$d['addr']?></td>
                                        <td><?=$d['version']?></td>
                                        <td><?=$d['subver']?></td>
                                        <td><?=$d['inbound']?></td>
                                        <td><?=$country?> </td>
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
