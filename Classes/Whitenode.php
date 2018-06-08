<?php

class Whitenode
{
    static public $settings;
    static public $walletSettings;
    static public $clientd;
    static public $db;
    static public $lang;
    static public $currentPage;
    static public $rpcSettings;
    static public $newCoinsYear = 2628000;

    static public function init()
    {
        $defines = array
        (
            'REBOOTFILE' => '/var/www/public/.reboot',
            'DAEMONFILE' => '/usr/local/bin/whitecoind',
            'WALLETDATADIR' => '/home/pi/.whitecoin-xwc/',
            'GITHUBRELEASES' => 'https://api.github.com/repos/Whitecoin-org/whitecoin/releases',
            'GITHUBGUIRELEASES' => 'https://api.github.com/repos/Oizopower/WhiteNode-GUI/releases',
            'ROOT' => $_SERVER['DOCUMENT_ROOT'] . "/",
            'TEMPLATES' => $_SERVER['DOCUMENT_ROOT'] . "/Templates/",
            'SNIPPETS' => $_SERVER['DOCUMENT_ROOT'] . "/Snippets/",
            'LANGUAGES' => $_SERVER['DOCUMENT_ROOT'] . "/Languages/",
            'HOMEDIR'   => "/home/pi/",
            'DISKTHRESHOLD' => 80,
            'DEVELOP' => false,
        );

        foreach ($defines as $define => $value)
        {
            if (!defined($define)) {
                define($define, $value);
            }
        }

        if (file_exists('/home/pi/.whitecoin-xwc/whitecoin.conf')) {
            self::$walletSettings = parse_ini_file('/home/pi/.whitecoin-xwc/whitecoin.conf');
        } else if (file_exists(getenv('appdata') . "\whitecoin-xwc\whitecoin.conf")) {
            self::$walletSettings = parse_ini_file(getenv('appdata') . "\whitecoin-xwc\whitecoin.conf");
        }

        self::checkForUpgrade();

        self::$settings     = parse_ini_file(ROOT . '/settings.ini');
        self::$lang         = Whitenode::getSiteLanguage();
        self::$currentPage  = addslashes($_SERVER['REQUEST_URI']);

        if(self::$currentPage == "/logout") {
            self::logout();
        }

        $loggedIn = self::checkLogin();
        $needReboot = self::checkReboot();

        if($needReboot)
        {
            include(ROOT.'reboot.php');
            exit;
        }

        if(!$loggedIn)
        {
            if(isset($_POST['login']))
            {
                // check if current password is in new format otherwise make it in new format
                if(self::countBits(self::$settings['app_password']) != 256)
                {
                    self::$settings['app_password'] = self::createPassword(self::$settings['app_password']);
                }

                $password = self::createPassword($_POST['app_password']);

                if(self::$settings['app_name'] == $_POST['app_name'] && self::$settings['app_password'] == $password) {
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

        if(self::$currentPage == "/login" && isset($_SESSION['is_logged_in'])) {
            header("Location: /");
        }

        self::$rpcSettings  = self::getRPCSettings();
        self::$clientd      = new jsonRPCClient("http://" . self::$rpcSettings['rpcuser'] . ":" . self::$rpcSettings['rpcpassword'] . "@" . self::$rpcSettings['rpchost'] . ":15815");
    }

    static private function checkForUpgrade()
    {
        $file = "/home/pi/scripts/firstboot";
        $check = "rm -f ".REBOOTFILE;

        if(file_exists($file)) {
            $data = file_get_contents($file);

            if(!stristr($data,$check))
            {
                $write = PHP_EOL.'if [ -f '.REBOOTFILE.' ]; then'.PHP_EOL.'    '.$check.PHP_EOL."fi".PHP_EOL;
                file_put_contents($file, $write, FILE_APPEND | LOCK_EX);
            }
        }

    }

    static private function createPassword($pass)
    {
        if(empty(self::$rpcSettings))
        {
            self::$rpcSettings  = self::getRPCSettings();
        }
        return hash('sha256', self::$rpcSettings['rpcpassword'].$pass.self::$rpcSettings['rpcpassword']);
    }

    static public function getRPCSettings()
    {
        if(file_exists(ROOT."remote.ini")) {
            $return = parse_ini_file(ROOT.'remote.ini');
        } else {
            self::$walletSettings['rpchost'] = "localhost";
            $return = self::$walletSettings;
        }

        return $return;
    }

    static protected function reboot()
    {
        if(!file_exists(REBOOTFILE))
        {
            $fp = fopen(REBOOTFILE,"wb");
            fwrite($fp,date("YmdHis"));
            fclose($fp);

            sleep(1);
        }

        header("Location: /");
    }

    static protected function service($action)
    {
        return shell_exec("sudo systemctl ".$action." whitecoin");
    }

    static public function updateWallet()
    {
        $latestRelease = self::getlatestWhitecoin();

        if($latestRelease)
        {
            set_time_limit(0);

            self::service('stop');

            shell_exec("sudo mv ".DAEMONFILE." ".DAEMONFILE.".".date("YmdHis"));

            $fileName = "/home/pi/".basename($latestRelease);
            $options = array(
                CURLOPT_FILE    => fopen($fileName, 'w'),
                CURLOPT_TIMEOUT =>  28800, // set this to 8 hours so we dont timeout on big files
                CURLOPT_URL     => $latestRelease,
            );

            $result = self::getData($options);

            shell_exec("sudo tar xf ".$fileName." -C /usr/local/bin/");
            shell_exec("sudo chmod +x ".DAEMONFILE);
            unlink($fileName);
            self::reboot();
        }
    }

    static private function getlatestWhitecoin()
    {
        $options = array(
            CURLOPT_SSL_VERIFYPEER    => false,
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_URL               => GITHUBRELEASES,
        );

        $result = self::getData($options);
        $data = json_decode($result, true);

        foreach($data as $dataResult)
        {
            foreach($dataResult['assets'] as $assets)
            {
                if(stristr($assets['browser_download_url'],'whitenode'))
                {
                    return $assets['browser_download_url'];
                }
            }
        }
    }

    static public function deleteBlockFiles()
    {
        self::service('stop');
        self::recurseRmdir(WALLETDATADIR);
    }

    static private function recurseRmdir($dir)
    {
        $files = array_diff(scandir($dir), array('.','..','whitecoin.conf', 'wallet.dat'));

        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::recurseRmdir("$dir/$file") : unlink("$dir/$file");
        }

        if($dir != WALLETDATADIR) {
            return rmdir($dir);
        } else {
            self::reboot();
        }
    }

    static public function getData($options)
    {
        $options += array(
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
            CURLOPT_FOLLOWLOCATION     => true,
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    static public function logout()
    {
        unset($_SESSION['is_logged_in']);
        header("Location: /");
    }

    static private function checkReboot()
    {
        return (file_exists(REBOOTFILE)) ? true : false;
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

    static public function setSiteLanguage($data)
    {
        if (!file_exists(ROOT."/Languages/" . $data['language']. ".php")) {
            $language = "en_GB";
        } else {
            $language = $data['language'];
        }

        setcookie("WhiteNodeLanguage", "", time()-3600,'/');
        setcookie("WhiteNodeLanguage",$language,time() + (10 * 365 * 24 * 60 * 60),'/');

        $return = array('finished' => 1, 'action' => 'refresh');
        return $return;
    }

    static public function getSiteLanguage()
    {
        $locale = self::getLocale();

        if (!file_exists(ROOT."/Languages/" . $locale . ".php")) {
            $language = "en_GB";
        } else {
            $language = $locale;
        }

        if(!isset($_COOKIE["WhiteNodeLanguage"]))
        {
            setcookie("WhiteNodeLanguage",$language,time() + (10 * 365 * 24 * 60 * 60),'/');
        }

        if(isset($_COOKIE["WhiteNodeLanguage"])) {
            $language = $_COOKIE["WhiteNodeLanguage"];
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
            $array['app_enable_login'] = 0;
        }

        if(!isset($array["app_enable_terminal"])) {
            $array['app_enable_terminal'] = 0;
        }


        // Generate Strong password:
        if(empty($array['app_password']))
        {
            // check if password is in old format, convert to new.
            $password = Whitenode::$settings['app_password'];

            if(self::countBits($password) != 256)
            {
                $array['app_password'] = self::createPassword($password);
            }
            else
            {
                $array['app_password'] = $password;
            }
        }
        else
        {
            $array['app_password'] = self::createPassword($array['app_password']);
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

    static private function countBits(string $key) : int
    {
        $bits  =   (ctype_xdigit($key)) ? 4 : 8;
        return strlen($key)*$bits;
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
