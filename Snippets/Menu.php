<ul class="nav">
    <?=$pageData['menu'];?>

    <li>
        <a>
            &nbsp;<p><?=tl("System")?></p>
        </a>
    </li>
    <li>
        <a href="#" id="js--reboot" data-title="Reboot" data-content="Are you sure you want to reboot?">
            <i class="fa fa-refresh icon-warning"></i>
            <p><?=tl("Reboot")?></p>
        </a>
    </li>
    <li>
        <a href="#" id="js--shutdown" data-title="Shutdown" data-content="Are you sure you want to shutdown?">
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
    if(Wallet::isWalletRunning())
    {
        if(!Wallet::isWalletEncrypted())
        {
            ?>
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
