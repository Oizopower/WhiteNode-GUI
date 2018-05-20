<ul class="nav navbar-nav navbar-right">
    <li>
        <a href="#">
            <i class="fa fa-circle <?=Wallet::walletStakingIcon()?>"></i>
            <p><?=tl("Staking Status")?></p>
        </a>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-circle <?=Wallet::walletStatusIcon()?>"></i>
            <p><?=tl("Wallet Status")?></p>
        </a>
    </li>
    <li>
        <a href="/connections">
            <p><?=tl("Connections")?>: <?=Wallet::$clientd->getconnectioncount()?></p>
        </a>
    </li>
    <li>
        <a href="/settings">
            <i class="ti-settings"></i>
            <p><?=tl("Settings")?></p>
        </a>
    </li>
    <li>
        <a href="/logout">
            <i class="ti-user"></i>
            <p><?=tl("Logout")?></p>
        </a>
    </li>
    <li>
        <div class="btn-group">
            <?php
            $languageFiles = array_diff(scandir(LANGUAGES), array('..', '.'));
            $currentLanguage = $_COOKIE['WhiteNodeLanguage'];
            ?>
            <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown">
                <img src="/Img/Flags/<?=$currentLanguage?>.png" />
                <?=tl($currentLanguage)?><span class="caret"></span>
            </button>
            <ul id='js--language' class="dropdown-menu" role="menu">
                <?php
                    foreach($languageFiles as $languageFile) {
                        $languageFile = str_replace(".php","",$languageFile);
                        if($languageFile === $currentLanguage) continue;
                        ?>
                            <li><a href="#" data-value='<?=$languageFile?>'><img src="/Img/Flags/<?=$languageFile?>.png" />&nbsp;<?= tl($languageFile)?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </li>
</ul>