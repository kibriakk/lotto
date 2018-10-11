<?php
$baseurl = "https://domain.com";      //input base url
$sender = "no-reply@domain.com";  //input sender email adress
    error_reporting(E_ALL);
    
$dbname = "lotto_lotto";   //input database name
$dbhost = "localhost";   //input database host
$dbuser = "root";   //input database username
$dbpass = "";   //input database password
$basecurrency = "USD";    //change USD to your base currency
function connectdb()
{
    global $dbname, $dbuser, $dbhost, $dbpass;
    $conms = @mysql_connect($dbhost,$dbuser,$dbpass); //connect mysql
    if(!$conms) return false;
    $condb = @mysql_select_db($dbname);
    if(!$condb) return false;
    return true;
}   //database connection function
function is_user()
{
    if (isset($_SESSION['username']))
        return true;
}   
function redirect($url)
{echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\" />";
    //header('Location: ' .$url);
    exit;
}
function valid_username($str){
    return preg_match('/^[a-z0-9_-]{3,16}$/', $str);
}
function valid_password($str){
    return preg_match('/^[a-z0-9_-]{6,18}$/', $str);
}
//////////////////GENERATE TRX #
$trxd = date("ymd", time());
$trxr = rand(100,999);
$trxu = substr(uniqid(), 7);
$trxc1 = chr(rand(97,122));
$trxc2 = chr(rand(97,122));
$trxc3 = chr(rand(97,122));
$ok = "$trxc1$trxd$trxu$trxc3$trxr";
$txn_id = strtoupper($ok);
//////////////////GENERATE TRX #
function toBTC($usd){
$api = "https://blockchain.info/tobtc?currency=USD&value=$usd";
$BTC = file_get_contents($api);
return $BTC;
}  //usd to btc converter
function toScan($usd, $account){
$var = "bitcoin:$account?amount=$usd";
echo "<img src=\"https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$var&choe=UTF-8\" title='' style='width:300px;' />";
}   //btc adress to QR code
?>
