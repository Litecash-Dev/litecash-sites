<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Litecash Block Explorer Detail</title>
        <meta name="description" content="Litecash is a privacy centric cryptocurrency." />
        <meta name="keywords" content="litecash, CASH, bitcoin, beam, btc, eth" />
        <meta name="author" content="litecash developer"/>

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
        <link href="assets/css/dark.css" rel="stylesheet" type="text/css">

</head>
<body>


<?php
include "time_ago.php";
include "blockchain_info.php";

$height = get_height();

$block_detail = get_block( $_GET["block"] );

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
						<a href="/" class="logo">
							<img src="assets/images/logos/Logo24.png" class="light-logo" alt=""/>
							<img src="assets/images/logos/Logo24.png" class="dark-logo" alt=""/>
						</a>
						<!-- ***** Logo End ***** -->

						<!-- ***** Lang Start ***** -->
<!--
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
							<li><a href="/">BLOCKCHAIN HOME</a></li>
							<li><a href="blocks.php">LATEST BLOCKS</a></li>
							<li><a target="_blank" href="http://lite-cash.com" class="btn-nav-box">Litecash Website</a></li>
                                                        <li><a target="_blank" href="https://github.com/Litecash-Dev/litecash" class="btn-nav-box">Litecash Github</a></li>
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
						<h1>Blockchain Explorer Detail</h1>
					</div>
					<div class="offset-lg-3 col-lg-6">
						<p>Up To Block <?php echo $height; ?> </p>
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

	<section class="block-explorer-section section bg-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="center-heading">
						<h2 class="section-title">Details for Block</h2>
					</div>
				</div>
				<div class="offset-lg-3 col-lg-6">
					<div class="center-text">
						<p></p> <!-- block detail wording goes here.. -->
					</div>
				</div>
			</div>			
			<div class="row m-bottom-70">
				<div class="col-lg-9 col-md-9 col-sm-12">
					<div class="table-responsive">
						<table class="table table-striped table-latests table-detail">
							<tbody>
                                                                <tr>
                                                                        <td><strong>Block</strong></td>
                                                                        <td> <?php echo $block_detail['height']; ?> </td>
                                                                </tr>
								<tr>
									<td><strong>Chain Work</strong></td>
									<td> <?php echo $block_detail['chainwork']; ?> </td>
								</tr>
								<tr>
									<td><strong>Hash</strong></td>
									<td> <?php echo $block_detail['hash']; ?> </td>
								</tr>
								<tr>
									<td><strong>Difficulty</strong></td>
									<td> <?php echo $block_detail['difficulty']; ?> </td>
								</tr>
								<tr>
									<td><strong>Block Subsidy</strong></td>
									<td> <?php echo $block_detail['subsidy'] / 100000000; ?> </td>
								</tr>
								<tr>
									<td><strong>Timestamp</strong></td>
									<td> <?php echo $block_detail['timestamp']; ?> </td>
								</tr>
                                                                <tr>
                                                                        <td><strong>Maturity</strong></td>
                                                                        <td> <?php echo $block_detail['height'] + 3; ?> </td>
                                                                </tr>

							</tbody>
						</table>
					</div>
				</div>


<!--
				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="qr">
						<img src="assets/images/qr.svg" class="img-fluid d-block mx-auto" alt="">
					</div>
				</div>
-->
			</div>


		</div>
	</section>


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
	<script src="assets/js/particle-dark.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>
