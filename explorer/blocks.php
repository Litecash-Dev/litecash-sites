<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="refresh" content="60">
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


	<?php include('footer.php') ?>


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


