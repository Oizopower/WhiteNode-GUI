<ul class="nav">
    <?=$pageData['menu'];?>

    <?php
    if(Wallet::isWalletRunning())
    {
        ?>
        <li>
            <a href="/Operators/Action.php?action=download">
                <i class="fa fa-hdd-o"></i>
                <p>Download Wallet</p>
            </a>
        </li>
        <li>
            <a>
            &nbsp;<p>System</p>
            </a>
        </li>
        <li>
            <a href="#" id="js--reboot">
                <i class="fa fa-refresh icon-warning"></i>
                <p>Reboot</p>
            </a>
        </li>
        <li>
            <a href="#" id="js--shutdown">
                <i class="fa fa-power-off icon-danger"></i>
                <p>Shutdown</p>
            </a>
        </li>
        <?php
        if(!Wallet::isWalletEncrypted())
        {
            ?>
            <li>
                &nbsp;
            </li>
            <li class="js--encrypt-button">
                <a href="" data-toggle="modal" data-target="#encrypt" data-title="<?=tl("Encrypt your wallet")?>">
                    <i class="fa fa-gavel"></i>
                    <p><?=tl("Encrypt wallet")?></p>
                </a>
            </li>
            <?php
        }
        else if(!Wallet::isWalletStaking())
        {
        ?>
            <li>
                &nbsp;
            </li>
            <li class="js--unlock-staking-button">
                <a href="" data-toggle="modal" data-target="#stakepassword" data-title="<?=tl("Unlock wallet for staking")?>">
                    <i class="fa fa-gavel"></i>
                    <p><?=tl("Unlock for staking")?></p>
                </a>
            </li>
        <?php
        }
    }
    ?>

</ul>
