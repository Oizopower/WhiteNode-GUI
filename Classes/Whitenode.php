<?php

class Whitenode
{
    static public $settings;
    static public $walletSettings;
    static public $clientd;
    static public $db;
    static public $lang;
    static public $currentPage;

    static public function init()
    {
        if (file_exists('/home/pi/.whitecoin-xwc/whitecoin.conf')) {
            self::$walletSettings = parse_ini_file('/home/pi/.whitecoin-xwc/whitecoin.conf');
        } else if (file_exists(getenv('appdata') . "\whitecoin-xwc\whitecoin.conf")) {
            self::$walletSettings = parse_ini_file(getenv('appdata') . "\whitecoin-xwc\whitecoin.conf");
        }

        self::$settings     = parse_ini_file(ROOT . '/settings.ini');
        self::$lang         = Whitenode::getSiteLanguage();
        self::$currentPage  = addslashes($_SERVER['REQUEST_URI']);

        if(self::$currentPage == "/logout") {
            self::logout();
        }

        $loggedIn = self::checkLogin();

        if(!$loggedIn) {
            if(isset($_POST['login'])) {
                if(self::$settings['app_name'] == $_POST['app_name'] && self::$settings['app_password'] == $_POST['app_password']) {
                    $_SESSION['is_logged_in'] = 1;
                } else {
                    unset($_SESSION['is_logged_in']);
                    include(ROOT.'login.php');
                    exit;
                }
            } else {
                include(ROOT.'login.php');
                exit;
            }
        }

        self::$clientd      = new jsonRPCClient("http://" . self::$walletSettings['rpcuser'] . ":" . self::$walletSettings['rpcpassword'] . "@localhost:15815");

        $defines = array
        (
            'WALLET' => '/home/pi/.whitecoin-xwc/',
            'ROOT' => $_SERVER['DOCUMENT_ROOT'] . "/",
            'TEMPLATES' => $_SERVER['DOCUMENT_ROOT'] . "/Templates/",
            'SNIPPETS' => $_SERVER['DOCUMENT_ROOT'] . "/Snippets/",
        );

        foreach ($defines as $define => $value)
        {
            if (!defined($define)) {
                define($define, $value);
            }
        }
    }

    static public function logout()
    {
        unset($_SESSION['is_logged_in']);
        header("Location: /");
    }

    static public function checkLogin()
    {
        $allowed = array(
            "/login"
        );

        if(self::$settings['app_enable_login'] == "1")
        {
            if(!isset($_SESSION['is_logged_in']) && !in_array(self::$currentPage, $allowed))
            {
                header("Location: /login");
                exit;
            }

            if(isset($_SESSION['is_logged_in'])) {
                return true;
            }
        }
        else
        {
            return true;
        }
    }

    static public function humanSize($bytes, $decimals = 2)
    {
        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    static public function getLocale()
    {
        $locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        return $locale;
    }

    static public function getSiteLanguage()
    {
        $locale = self::getLocale();

        if (!file_exists(ROOT."/Languages/" . $locale . ".php")) {
            $language = "en_GB";
        } else {
            $language = $locale;
        }

        return $language;
    }

    static public function secondsToTime($seconds)
    {
        $days = floor($seconds / 86400);
        $seconds -= ($days * 86400);

        $hours = floor($seconds / 3600);
        $seconds -= ($hours * 3600);

        $minutes = floor($seconds / 60);
        //$seconds -= ($minutes * 60);

        $values = array(
            'day' => $days,
            'hour' => $hours,
            'minute' => $minutes,
            //'second' => $seconds
        );

        $parts = array();

        foreach ($values as $text => $value) {
            if ($value > 0) {
                $parts[] = $value . ' ' . $text . ($value > 1 ? 's' : '');
            }
        }

        return implode(' ', $parts);
    }

    static public function timeago($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime(date("Y-m-d H:i:s", $datetime));

        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    static public function write_php_ini($array, $file)
    {
        $res = array();

        if(!isset($array["app_enable_login"])) {
            $array['app_enable_login '] = 0;
        }

        foreach ($array as $key => $val)
        {
            if (is_array($val))
            {
                $res[] = "[$key]";
                foreach ($val as $skey => $sval) {
                    $res[] = "$skey = " . (is_numeric($sval) ? $sval : '"' . $sval . '"');
                }
            }
            else
            {
                $res[] = "$key = " . (is_numeric($val) ? $val : '"' . $val . '"');
            }
        }

        self::safefilerewrite($file, implode("\r\n", $res));
        self::$settings     = parse_ini_file(ROOT . '/settings.ini');

    }

    static private function safefilerewrite($fileName, $dataToSave)
    {
        $save = file_put_contents($fileName, $dataToSave);
        return $save;

    }

    static public function tl($string)
    {
        include(ROOT."Languages/".self::$lang.".php");

        $string = strtolower(str_replace(" ", "-", $string));

        if(isset($language[$string])) {
            $return = $language[$string];
        } else {
            if(empty($string)) {
                $return = "";
            } else {
                $return = "{".$string."}";
            }

        }
        return $return;
    }

}
