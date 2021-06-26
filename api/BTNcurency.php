<?php

//header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
//header('Pragma: no-cache'); // HTTP 1.0.
//header('Expires: 0'); // Proxies.

class BTNcurency{

    private $url = 'https://bitpay.com/api/rates';

    public function getBtncurrencyInGrivnas(){

        // getting 1 bitcoin in dollars
        $json = json_decode(file_get_contents($this->url));
        $bitcoin = 0;
        foreach( $json as $obj ){
            if( $obj->code=='USD' )$bitcoin=$obj->rate;
        }


        $xml = simplexml_load_file("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5");
        $m = $xml->xpath('//exchangerate[@ccy="USD"]');
        $exrate = (string)$m[0]['buy'];

        $uah = $bitcoin * $exrate;

        return 'Result: 1 BTC = ' . $uah . ' UAH. <br>';
    }
}


session_start();
if($_SESSION['status'] === 1) {
    $a = new BTNcurency();
    echo "<h1>Bitcoin price in Ukrainian Grivnas</h1>";
    echo $a->getBtncurrencyInGrivnas();
}else{
    header("Location: /user/signin.php");

}
?>