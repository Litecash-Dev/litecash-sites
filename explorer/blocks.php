<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="60">
	<title>Litecash Block Explorer</title>
	<meta name="description" content="Litecash is a privacy centric cryptocurrency." />
	<meta name="keywords" content="litecash, CASH, bitcoin, beam, btc, eth" />
	<meta name="author" content="litecash developer"/>

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
						<h1>Blockchain Explorer</h1>
					</div>
					<div class="offset-lg-3 col-lg-6">
						<p>Up To Block <?php echo $height; ?> </p>
					</div>
				</div>
			</div>
		</div>

	</section>
	<!-- ***** Wellcome Area End ***** -->

	<section class="block-explorer-section section bg-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="center-heading">
						<h2 class="section-title">Latest Blocks</h2>
					</div>
				</div>
				<div class="offset-lg-3 col-lg-6">
					<div class="center-text">
						<p></p> <!-- comments and such go here.. -->
					</div>					
				</div>
			</div>			
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table table-striped table-latests">
							<thead>
								<tr>
									<td>Block Height</td>
									<td>Age</td>
									<td>Hash</td>
									<td>Extracted at</td>
								</tr>
							</thead>
							<tbody>
<?php

$blocks = get_blocks($height, 25);

## write block information
foreach($blocks as $block) {
    $dtime = date('Y-m-d H:i:s', $block['timestamp']);
    $block_age = get_time_ago( $block['timestamp'] );
    echo '<tr><td><a href="block-detail.php?block=' . $block['height'] .'">' . $block['height'] . '</a></td><td>' . $block_age . '</td><td>' . $block['hash'] . '</td><td>' . $dtime . '</td></tr>';
}

?>



							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- ***** Contact & Footer Start ***** -->
	<footer id="contact">
		<div class="footer-bottom slim">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p class="copyright">&copy; 2023 Litecash Developers Group</p>
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


