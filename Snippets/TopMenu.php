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
</ul>