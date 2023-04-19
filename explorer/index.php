
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LiteCash Block Explorer</title>
        <meta name="description" content="LiteCash - A private coin at the speed of lite!" />
        <meta name="keywords" content="litecash, CASH, bitcoin, beam, btc, eth" />
        <meta name="author" content="LiteCash Developers Group"/>

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
	<link href="assets/css/dark.css" rel="stylesheet" type="text/css">

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

$market_cap = number_format( $coins_mined * $cash_current_price, 4 );
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

	<?php include('header.php') ?>

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
						<p>Current pricing is based upon <a href="https://www.coingecko.com/en/coins/litecash" target="_blank">CoinGecko</a> data.</p>
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
			</div>
		</div>
	</section>

<div>

</div>

<?php include('footer.php') ?>


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
xhttp.open("GET", "blockchain_info.php?mktcap", true);
xhttp.send();
}
//setInterval(refCap,15000);


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

