<?php

class Template
{
    static public $menus = array(
        "Dashboard" => array("icon" => "ti-panel", "url" => "", "show" => 1),
        "Staking info" => array("icon" => "fa fa-gavel", "url" => "staking", "show" => 1),
        "Transactions" => array("icon" => "ti-view-list-alt", "url" => "transactions", "show" => 1),
        "Send" => array("icon" => "fa fa-arrow-circle-right", "url" => "send", "show" => 1),
        "Receive" => array("icon" => "fa fa-arrow-circle-left", "url" => "receive", "show" => 1),
        "Address" => array("icon" => "fa fa-address-card-o", "url" => "address", "show" => 1),
        "Wallet info" => array("icon" => "ti-wallet", "url" => "walletinfo", "show" => 1),
        "Settings" => array("icon" => "", "url" => "settings", "show" => 0),
        "Connections" => array("icon" => "", "url" => "connections", "show" => 0),
    );

    static public $currentPage;

    static public function addBlock($icon, $title, $value, $subicon, $subtext)
    {
        include(SNIPPETS . "Block.php");
    }

    static public function getMenu()
    {
        $currentPage = Whitenode::$currentPage;

        ob_start();

        foreach (self::$menus as $pageName => $pageData)
        {
            if($currentPage == '/'.$pageData['url']) {
                $active = 'class="active"';
                self::$currentPage = array("title" => tl($pageName), "data" => $pageData);
            } else {
                $active = '';
            }
            if($pageData['show'] == 0) continue;
            ?>

            <li <?=$active?>>
                <a href="/<?=$pageData['url']?>">
                    <i class="<?=$pageData['icon']?>"></i>
                    <p><?=tl($pageName)?></p>
                </a>
            </li>

            <?php
        }
        return  ob_get_clean();
    }

    static public function getTemplate()
    {
        $url = Whitenode::$currentPage;

        if(file_exists(TEMPLATES.$url.'.php')) {
            $template = TEMPLATES.$url.'.php';
        } else {
            $template = TEMPLATES.'dashboard.php';
        }

        return $template;
    }

    static public function getPageData()
    {
        $data = array();

        $data['template_file'] = self::getTemplate();
        $data['menu'] = self::getMenu();

        return $data;
    }
}
