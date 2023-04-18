<?php

function get_volume() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.coingecko.com/api/v3/simple/price?ids=litecash&vs_currencies=btc');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        $decoded = json_decode($result, true);

        curl_close($ch);

        //$price = number_format( $decoded['litecash']['btc'] );
        $price = $decoded['litecash']['btc'] * 100000000;

        return $price;
}

function get_cash_price() {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.coingecko.com/api/v3/simple/price?ids=litecash&vs_currencies=btc');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        $decoded = json_decode($result, true);

        curl_close($ch);

        //$price = number_format( $decoded['litecash']['btc'] );
	$price = $decoded['litecash']['btc'] * 100000000;

        return $price;
}

function get_cash_usd_price() {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.coingecko.com/api/v3/coins/litecash?localization=false&tickers=false&market_data=true&community_data=false&developer_data=false&sparkline=false');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

        $decoded = json_decode($result, true);

        curl_close($ch);

        $price = number_format( $decoded['market_data']['current_price']['usd'], 6 );

        return $price;
}


function get_btc_price() {
        $ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'https://cex.io/api/last_price/BTC/USD');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);

	$decoded = json_decode($result, true);

        curl_close($ch);

	$price = number_format( $decoded['lprice'], 2 );

	return $price;
}


function get_height() {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, 'http://localhost:8888/status');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($ch);

	$status_decoded = json_decode($result, true);

	$height = $status_decoded['height'];

	curl_close($ch);

	return $height;
}

function get_total_coins_mined($height) {
	if ($height <= 525600) {
	    $total_coins_mined = number_format(intval($height) * 275);
	} else {
	    $total_coins_mined_pre = 525600 * 275;
	    $total_coins_mined = number_format( $total_coins_mined_pre + ( ( intval($height) - 525600 ) * 137.5) );
	}

	return $total_coins_mined;
}

function get_block($height) {
        $ch = curl_init();

	// now get the most current block info..
	curl_setopt($ch, CURLOPT_URL, 'http://localhost:8888/block?height=' . $height);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$block_result = curl_exec($ch);
	$block_decoded = json_decode($block_result, true);

        curl_close($ch);

	return $block_decoded;
}

function get_diff($height) {
        $ch = curl_init();

        // now get the most current block info..
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8888/block?height=' . $height);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $block_result = curl_exec($ch);
        $block_decoded = json_decode($block_result, true);

        $current_diff = $block_decoded['difficulty'];

        curl_close($ch);

        return $current_diff;
}

function get_blocks($height, $count) {
	$ch = curl_init();

	// now get the last $display_blocks blocks..
	$display_blocks = $count;
	$start_height = intval($height) + 1 - $display_blocks;
	curl_setopt($ch, CURLOPT_URL, 'http://localhost:8888/blocks?height=' . $start_height . '&n=' . $display_blocks);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$blocks_result = curl_exec($ch);
	$blocks_decoded = json_decode($blocks_result, true);


	// finally, close the connection
	curl_close($ch);

	return $blocks_decoded;
}

if(isSet($_REQUEST['difficulty']))
{
 $h = get_height();
 echo get_diff($h);
}
if(isSet($_REQUEST['btcprice']))
{
 echo get_btc_price();
}
if(isSet($_REQUEST['cashbtcprice']))
{
 echo get_cash_price();
}
if(isSet($_REQUEST['usdprice']))
{
 echo get_cash_usd_price();
}
if(isSet($_REQUEST['mined']))
{
 $h = get_height();
 echo get_total_coins_mined($h);
}
if(isSet($_REQUEST['height']))
{
 echo get_height();
}

?>
