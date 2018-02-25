<?php
session_start();

ini_set('display_errors','on');
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/');

spl_autoload_register(function ($class_name) {
    include ROOT.'Classes/'.$class_name . '.php';
});

Whitenode::init();
$pageData = Template::getPageData();

function debug()
{
        $debug = func_get_args();
        $debug = (count($debug) > 1) ? $debug : array_shift($debug);

        if (is_bool($debug)) {
            echo $debug ? 'true' : 'false';
            return;
        }

        if (empty($debug) && $debug !== 0){
            echo 'NULL';
            return;
        }

        echo "<pre>";
        print_r($debug);
        echo "</pre>";

        return;
}

function tl($string)
{
    return Whitenode::tl($string);
}