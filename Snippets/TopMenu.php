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
        <div class="btn-group">
            <?php
                $language = DataManager::getInstance()->getLanguage();
                $lang = $language[0]['lang'];
                //echo "lang=".$lang;
                if($lang=='en_GB'){
                    $lang_img = '/Img/en.png';
                }else{
                    $lang_img = '/Img/zh.png';
                }
            ?>
            <button type="button" class="btn btn-default dropdown-toggle"  data-toggle="dropdown">
            <img src="<?php echo $lang_img;?>" alt="langimg" />
            <?=tl("Language")?><span class="caret"></span>
            </button>
            <ul id='js-language' class="dropdown-menu" role="menu">
                <li><a href="javascript:;" data-value='zh'><img src="/Img/zh.png" alt="langimg" />&nbsp;<?= tl("Chinese")?></a></li>
                <li><a href="javascript:;" data-value='en'><img src="/Img/en.png" alt="langimg" />&nbsp;<?= tl("English")?></a></li>
                
            </ul>
        </div>
    </li>

    <?php
    if(Whitenode::checkLoginFlag())
    {
    ?>
    <li>
        <a href="/logout">
            <img src="/Img/exit.png"  alt="langimg" />&nbsp;<?= tl("Logout")?>
        </a>
    </li>
    <?php
    }
    ?>
    
</ul>


