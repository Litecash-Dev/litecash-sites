
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Litecash Block Explorer</title>
        <meta name="description" content="Litecash is a privacy centric cryptocurrency." />
        <meta name="keywords" content="litecash, CASH, bitcoin, beem, btc, eth" />
        <meta name="author" content="litecash developers"/>

	<!-- Favicon -->
        <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

	<!-- Bootstrap & Plugins CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
<?php
$css1 = $_REQUEST['theme'];
 if ( isset($_REQUEST['theme']) ) { $_REQUEST['theme'] = $css1; echo '<link href="assets/css/' . $css1 . '.css" rel="stylesheet" type="text/css">'; }
    else echo '<link href="assets/css/dark.css" rel="stylesheet" type="text/css">';
?>

</head>
<body>



<?php

include "time_ago.php";
include "blockchain_info.php";

$height = get_height();
$current_diff = get_diff($height);
$coins_mined = get_total_coins_mined($height);

$cash_current_price = 0.03;
$cash_current_price = get_cash_usd_price();

$market_cap = number_format( $coins_mined * $cash_current_price, 2 );
$btc_current_price = get_btc_price();

$litecash_price = get_cash_price();


?>

	<div class="loading-wrapper">
		<div class="loading">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>	

	<!-- ***** Header Area Start ***** -->
	<header class="header-area">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="main-nav">
						<!-- ***** Logo Start ***** -->
						<a href="index.php" class="logo">
							<img src="assets/images/logos/Logo24.png" class="light-logo" alt=""/>
							<img src="assets/images/logos/Logo24.png" class="dark-logo" alt=""/>
						</a>
						<!-- ***** Logo End ***** -->

						<!-- ***** Lang Start ***** -->
<!-- hide
						<div class="lang">
							<div class="selected">
								<img src="assets/images/flags/en.png" alt="">
								<i class="fa fa-angle-down"></i>
							</div>
							<ul class="flag-list">
								<li>
									<a href="#">
										<img src="assets/images/flags/en.png" alt=""><span>EN</span>
									</a>
								</li>	
								<li>
									<a href="#">
										<img src="assets/images/flags/ru.png" alt=""><span>RU</span>
									</a>
								</li>	
								<li>
									<a href="#">
										<img src="assets/images/flags/br.png" alt=""><span>BR</span>
									</a>
								</li>	
							</ul>
						</div>
-->
						<!-- ***** Lang End ***** -->

						<!-- ***** Menu Start ***** -->
						<ul class="nav">
							<li><a href="index.php">BLOCKCHAIN HOME</a></li>
							<li><a href="blocks.php">LATEST BLOCKS</a></li>
							<li><a target="_blank" href="http://lite-cash.com" class="btn-nav-box">Litecash Website</a></li>
						</ul>
						<a class='menu-trigger'>
							<span>Menu</span>
						</a>
						<!-- ***** Menu End ***** -->						
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- ***** Header Area End ***** -->

	<!-- ***** Wellcome Area Start ***** -->
	<section class="block-explorer-wrapper bg-bottom-center" id="welcome-1">
		<div class="block-explorer text">
			<div class="container text-center">
				<div class="row">
					<div class="col-lg-12 align-self-center">
						<h1>Blockchain Explorer</h1>
					</div>
					<div class="offset-lg-3 col-lg-6">
						<p id="height">Up To Block <?php echo $height; ?> </p>
					</div>
				</div>
			</div>
		</div>
<!--
		<div class="search">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="input-wrapper">
							<div class="input">
								<input type="text" placeholder="block, hash, transaction, etc...">
								<button><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
-->	
	</section>
	<!-- ***** Wellcome Area End ***** -->

	<section class="block-explorer-features section bg-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="center-heading">
						<h2 class="section-title">General Information</h2>
					</div>
				</div>
				<div class="offset-lg-3 col-lg-6">
					<div class="center-text">
						<p>Current pricing is based upon CoinGecko data.</p>
					</div>					
				</div>
			</div>
			<div class="row">

                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                        <div class="item">
                                                <div class="title">
                                                        <div class="icon"></div>
                                                        <h5>Current BTC Price</h5>
                                                </div>
                                                <div class="text">
                                                        <span id="btcprice"> $<?php echo $btc_current_price; ?> </span>
                                                </div>
                                        </div>
                                </div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Litecash BTC Price</h5>
						</div>
						<div class="text">
							<span id="cashbtcprice"><?php echo $litecash_price; ?> Satoshi </span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>USD Price</h5>
						</div>
						<div class="text">
							<span id="usdprice">$ <?php echo $cash_current_price; ?> </span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Market Cap</h5>
						</div>
						<div class="text">
							<span id="mktcap">$ <?php echo $market_cap; ?> M</span>
						</div>
					</div>
				</div>
<!-- disabled
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Hashrate</h5>
						</div>
						<div class="text">
							<span>224.562 GH/s</span>
						</div>
					</div>
				</div>
-->
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Difficulty</h5>
						</div>
						<div class="text">
							<span id="difficulty"> <?php echo $current_diff; ?> <i class="blue fa fa-long-arrow-up"></i></span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Outstanding</h5>
						</div>
						<div class="text">
							<span id="mined"> <?php echo $coins_mined; ?> CASH</span>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Blocks Per Day</h5>
						</div>
						<div class="text">
							<span>Approx 1440</span>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="item">
						<div class="title">
							<div class="icon"></div>
							<h5>Trade Volume</h5>
						</div>
                                                <div class="text" id="mktcap">
                                                    
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

<div>

<?php 
#echo "<form name='myForm'><select onchange='this.form.submit()' name='theme'>";
#echo "<option value='dark'>Select Theme</option>";
#echo "<option value='dark'>Dark Theme</option>";
#echo "<option value='blue'>Blue Theme</option>";
#echo "</select></form>";
?>

</div>


	<!-- ***** Contact & Footer Start ***** -->
	<footer id="contact">
		<div class="footer-bottom slim">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="copyright">&copy; 2021 Litecash Developers Group</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- ***** Contact & Footer End ***** -->

<!-- crypto currency ticker

<div style="width: 100%; height:62px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; box-sizing:content-box; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;padding:1px;padding: 0px; margin: 0px;"><div style="height:40px;"><iframe src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=dark&pref_coin_id=1505&invert_hover=no" width="100%" height="36" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing:content-box; margin: 5px 6px 10px 0px; font-family: Verdana, Tahoma, Arial, sans-serif;">powered by&nbsp;<a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #626B7F; text-decoration:none; font-size: 11px;">Coinlib</a></div></div>

-->

<script>
function refHeight()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("height").innerHTML = "Up To Block " + this.responseText;
   }
 };
xhttp.open("GET", "blockchain_info.php?height", true);
xhttp.send();
}
setInterval(refHeight,15000);
function refDiff()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("difficulty").innerHTML = this.responseText;
   }
 };
xhttp.open("GET", "blockchain_info.php?difficulty", true);
xhttp.send();
}
setInterval(refDiff,15050);
function refBtc()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("btcprice").innerHTML = "$"+this.responseText;
   }
 };
xhttp.open("GET", "blockchain_info.php?btcprice", true);
xhttp.send();
}
setInterval(refBtc,15060);

function refCash()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("cashbtcprice").innerHTML = this.responseText + " Satoshi";
   }
 };
xhttp.open("GET", "blockchain_info.php?cashbtcprice", true);
xhttp.send();
}
setInterval(refCash,15070);

function refUsd()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("usdprice").innerHTML = "$"+this.responseText;
   }
 };
xhttp.open("GET", "blockchain_info.php?usdprice", true);
xhttp.send();
}
setInterval(refUsd,15080);

function refMined()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("mined").innerHTML = this.responseText + " CASH";
   }
 };
xhttp.open("GET", "blockchain_info.php?mined", true);
xhttp.send();
}
setInterval(refMined,15090);

function refCap()
{
 var xhttp = new XMLHttpRequest();
 xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
     document.getElementById("mktcap").innerHTML = "$"+this.responseText;
   }
 };
xhttp.open("GET", "chart.php", true);
xhttp.send();
}
setInterval(refCap,15000);


        </script>

	<!-- jQuery -->
	<script src="assets/js/jquery-2.1.0.min.js"></script>

	<!-- Bootstrap -->
	<script src="assets/js/popper.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- Plugins -->
	<script src="assets/js/particles.min.js"></script>
	<script src="assets/js/scrollreveal.min.js"></script>
	<script src="assets/js/jquery.downCount.js"></script>
	<script src="assets/js/parallax.min.js"></script>

	<!-- Global Init -->
	<script src="assets/js/particle-blue.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>

