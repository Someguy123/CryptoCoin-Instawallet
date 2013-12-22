<?php // Wallet
  session_start();
  include("functions.php");

  $start = timer();

  include("config.php");

  //if($_SERVER['SERVER_PORT'] != 443) {
  //  header("Location: " . $redirect . $_SERVER['REQUEST_URI']);
  //}

  include("bitcoin.inc");
  include("address.inc");
  include("recaptchalib.inc");

  // init
  $btclient = new bitcoinClient("http",$btclogin["username"],$btclogin["password"],$btclogin["host"],$btclogin["port"]);
  $addr = new Address($btclient,$sqlogin,$minconf);
  $derp = $btclient->getinfo();

  //$this->PDO_Conn = new PDO("mysql:host={$sqllogin['host']};dbname={$sqllogin['dbname']}", $sqllogin['username'], $sqllogin['password']);
  $dbconn = mysql_connect($sqlogin['host'],$sqlogin['username'],$sqlogin['password']);
  mysql_select_db($sqlogin['dbname']);

  // time for pages
  // some sql
  $res = mysql_query("SELECT count(distinct id) as wallets FROM instaltc");
  $count = mysql_fetch_assoc($res);
  $wallets = $count["wallets"];
?>