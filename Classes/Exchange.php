<?php
class Exchange extends Whitenode {
    static public $bittrexTicker = 0;
    static public $bitcoinprice = 0;

    static public $externalData;

    static public function getBittrexRevenue()
    {
        if(self::$bittrexTicker == 0)
        {
            self::$bittrexTicker = self::bittrexTicker();
        }

        $info = self::$clientd->getinfo();

        $balance = (int) $info['balance'];

        if(isset($info['stake']) && (int) $info['stake'] > 0) {
            $balance = $balance + $info['stake'];
        }

        $bitcoinTotalAmount = ($balance * self::$bittrexTicker);
        $bitcoinPrice = self::getBitcoinPrice();

        return number_format($bitcoinPrice*$bitcoinTotalAmount, 2);
    }

    static public function getBitcoinPrice()
    {
        $url = "https://bittrex.com/api/v1.1/public/getticker?market=USDT-BTC";
        $data = self::getData($url);

        self::$bitcoinprice = $data['result']['Last'];

        return self::$bitcoinprice;

    }


    static public function bittrexTicker()
    {
        $url = "https://bittrex.com/api/v1.1/public/getticker?market=BTC-XWC";
        $data = self::getData($url);

        self::$bittrexTicker = $data['result']['Last'];

        return number_format(self::$bittrexTicker, 8);
    }

    static private function getData($url)
    {
        if(isset(self::$externalData[$url]) && !empty(self::$externalData[$url]))
        {
            $result = self::$externalData[$url];
        }
        else
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch);
            curl_close($ch);

            self::$externalData[$url] = $result;
        }

        $data = json_decode($result, true);

        return $data;
    }

    static public function getCoinMarketCap()
    {
        $data = self::getData(Whitenode::$settings['coinmarketcap']);
        return array_shift($data);
    }

}