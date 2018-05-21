<ul class="nav">
    <?= $pageData['menu']; ?>
    <li>
        <a data-toggle="collapse" href="#componentsExamples" class="collapsed" aria-expanded="false">
            <i class="ti-package"></i>
            <p><?= tl("System") ?>
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse" id="componentsExamples" aria-expanded="false" style="height: 0px;">
            <ul class="nav">
                <li>
                    <a href="/webconsole.php" target="_blank">
                        <i class="fa fa-desktop"></i>
                        <p><?= tl("Terminal") ?></p>
                    </a>
                </li>
                <li>
                    <a href="#" class="js--doAction" data-action="reboot" data-title="Reboot" data-content="Are you sure you want to reboot?">
                        <i class="fa fa-refresh icon-warning"></i>
                        <p><?= tl("Reboot") ?></p>
                    </a>
                </li>
                <li>
                    <a href="#" class="js--doAction" data-action="shutdown" data-title="Shutdown" data-content="Are you sure you want to shutdown?">
                        <i class="fa fa-power-off icon-danger"></i>
                        <p><?= tl("Shutdown") ?></p>
                    </a>
                </li>
                <li>
                    <a href="#" class="js--doAction" data-action="updateGUI" data-title="Update" data-content="Are you sure you want to update the GUI?">
                        <i class="fa fa-cog icon-success"></i>
                        <p><?= tl("Update GUI") ?></p>
                    </a>
                </li>
                <?php
                if (Wallet::isWalletRunning())
                {
                    if (!Wallet::isWalletEncrypted())
                    {
                        ?>
                        <li class="js--encrypt-button">
                            <a href="" data-toggle="modal" data-target="#encrypt" data-title="<?= tl("Encrypt your wallet") ?>">
                                <i class="fa fa-gavel"></i>
                                <p><?= tl("Encrypt wallet") ?></p>
                            </a>
                        </li>
                        <?php

                    }
                    else if (!Wallet::isWalletStaking())
                    {
                        ?>
                        <li class="js--unlock-staking-button">
                            <a href="" data-toggle="modal" data-target="#stakepassword" data-title="<?= tl("Unlock wallet for staking") ?>">
                                <i class="fa fa-gavel"></i>
                                <p><?= tl("Unlock for staking") ?></p>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </li>
    <div class="discord-widget">
        <a href="https://discord.gg/GbpdbMt">
            <img alt="Logo" src="https://discordapp.com/api/guilds/370118731151441921/widget.png?style=banner2" width="260px">
        </a>
    </div>
