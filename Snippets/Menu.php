<ul class="nav">
    <?=$pageData['menu'];?>

    <?php
    if(Wallet::isWalletRunning())
    {
        ?>
        <li>
            <a href="/Operators/Action.php?action=download">
                <i class="fa fa-hdd-o"></i>
                <p><?=tl("Download Wallet")?></p>
            </a>
        </li>
        <li>
            <a>
            &nbsp;<p><?=tl("System")?></p>
            </a>
        </li>
        <li>
            <a href="#" id="js--reboot">
                <i class="fa fa-refresh icon-warning"></i>
                <p><?=tl("Reboot")?></p>
            </a>
        </li>
        <li>
            <a href="#" id="js--shutdown">
                <i class="fa fa-power-off icon-danger"></i>
                <p><?=tl("Shutdown")?></p>
            </a>
        </li>
        <li>
            <a href="/Operators/Action.php?action=update">
                <i class="fa fa-cog icon-success"></i>
                <p><?=tl("Update GUI")?></p>
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
