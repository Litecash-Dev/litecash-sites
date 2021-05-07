<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Litecash Press Kit</title>
        <meta name="description" content="Litecash is a privacy centric cryptocurrency." />
        <meta name="keywords" content="litecash, CASH, bitcoin, beem, btc, eth" />
        <meta name="author" content="litecash developer"/>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="assets/images/logos/litecash.ico">

        <!-- Bootstrap & Plugins CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Custom CSS -->
        <link href="assets/css/dark.css" rel="stylesheet" type="text/css">

</head>
<body>


<?php

// max image width or height allowed for thumbnail
$config['size'] = 150;

// jpeg thumbnail image quality
$config['imagequality'] = 70;

// rows of images per page
$config['rows'] = 4;

// columns of images per page
$config['cols'] = 3;

// max page numbers to show at once (so if you have 100 pages, it won't show links to all 100 at once)
$config['maxShow'] = 20;

// folder where full size images are stored (include trailing slash)
$config['fulls'] = "./press/";

// folder where thumbnails are to be created (include trailing slash)
$config['thumbs'] = "./press/thumbs/";




#-#############################################
# desc: prints out html for the table and the images found in directory
function PrintThumbs(){
        global $config;


// full directory error check
        if (!file_exists($config['fulls'])) {
                Oops("Fullsize image directory <b>$config[fulls]</b> does not exist.");
        }

// thumb directory error check
        if (!file_exists($config['thumbs'])) {
                if (!@mkdir($config['thumbs'], 0755)) {
                        Oops("Thumbnail image directory <b>$config[thumbs]</b> does not exist and can not be created. Check directory write permissions.");
                }
        }

// get the list of all the fullsize images
   $imagelist = GetFileList($config['fulls']);

// number of and which images on current page
        $config['start'] = ($config['page']*$config['cols']*$config['rows']);
        $config['max'] = ( ($config['page']*$config['cols']*$config['rows']) + ($config['cols']*$config['rows']) );
        if($config['max'] > count($imagelist)){$config['max']=count($imagelist);}
        if($config['start'] > count($imagelist)){$config['start']=0;}

// start table
        echo '<table border="0" cellpadding="0" cellspacing="0" align="center" class="gallery">';
        echo "<tr>\n<td colspan=\"$config[cols]\" class=\"entries\">";

// "showing results"
        if ($config['max'] == "0"){echo "Showing results <b>0 - 0</b> of <b>0</b></td></tr>\n";}
        else{echo "Showing results <b>".($config['start']+1)." - $config[max]</b> of <b>".count($imagelist)."</b> entries</td>\n</tr>\n\n";}


        $column_counter = 1;

// start row
        echo "<tr>\n";

// for the images on the page
        for($i=$config['start']; $i<$config['max']; $i++){

                $thumb_image = $config['thumbs'].$imagelist[$i];
                $thumb_exists = file_exists($thumb_image);

                // create thumb if not exist
                if(!$thumb_exists){
                        set_time_limit(30);
                        if(!($thumb_exists = ResizeImageUsingGD("$config[fulls]$imagelist[$i]", $thumb_image, $config['size']))){
                                Oops("Creating Thumbnail image of <strong>$config[fulls]$imagelist[$i]</strong> failed. Possible directory write permission errors.");
                        }
                }

                $imagelist[$i] = rawurlencode($imagelist[$i]);


        #########################################################
        # print out the image and link to the page
        #########################################################
                echo '<td>';
                        echo '<a href="'. $config['fulls'].$imagelist[$i] .'" title="'. $imagelist[$i] .'" target="_blank">';
                        echo '<img src="'. $config['thumbs'].$imagelist[$i] .'" alt="'. $imagelist[$i] .'">';
                        echo '</a>';
                echo '</td>'."\n";
        #########################################################


                //if the max columns is reached, start new col
                if(($column_counter == $config['cols']) && ($i+1 != $config['max'])){
                        echo "</tr>\n\n<tr><td colspan=\"$config[cols]\" class=\"spacer\"></td></tr>\n\n<tr>\n";
                        $column_counter=0;
                }
                $column_counter++;
        }//for(images on the page)


// if there are no images found
        if($config['start'] == $config['max']){
                echo "<td colspan=\"$config[cols]\" class=\"entries\">No Entries found</td>\n";
        }

// if there are empty "boxes" at the end of the row (ie; last page)
        elseif($column_counter != $config['cols']+1){
                echo "<td colspan=\"".($config['cols']-$column_counter+1)."\">&nbsp;</td>\n";
        }

// end row
        echo "</tr>\n\n";

// print out page number list
        echo "<tr>\n<td colspan=\"$config[cols]\" class=\"pagenumbers\">\n";
                GetPageNumbers(count($imagelist));
        echo "</td>\n</tr>\n\n";

// end table
        echo "</td></tr></table>\n";

}#-#PrintThumbs()


#-#############################################
# desc: gets the list of image files in the directory
# param: [optional] directory to look through
# returns: array with alphabetically sorted list of images
function GetFileList($dirname="."){
        global $config;
        $list = array();

        if ($handle = opendir($dirname)) {
                while (false !== ($file = readdir($handle))) {
                        //this matches what type of files to get. jpeg, jpg, gif, png (ignoring case)
                        if (preg_match("/\.(jpe?g|gif|png)$/i",$file)) {
                                $list[] = $file;
                        }
                }
                closedir($handle);
        }
        sort($list);

        return $list;
}#-#GetFileList()

#-#############################################
# desc: resizes image using GD library
# param: ($fullFilename) filename of full size image ($thumbFilename) filename to save thumbnail as ($size) max width or height to resize to
# returns: true if image created, false if failed
function ResizeImageUsingGD($fullFilename, $thumbFilename, $size) {

        list ($width,$height,$type) = GetImageSize($fullFilename);

        if($im = ReadImageFromFile($fullFilename,$type)){
                //if image is smaller than the $size, show the original
                if($height <= $size && $width <= $size){
                        $newheight=$height;
                        $newwidth=$width;
                }
                //if image height is larger, height=$size, then calc width
                else if($height > $width){
                        $newheight=$size;
                        $newwidth=round($width / ($height/$size));
                }
                //if image width is larger, width=$size, then calc height
                else{
                        $newwidth=$size;
                        $newheight=round($height / ($width/$size));
                }

                $im2=ImageCreateTrueColor($newwidth,$newheight);
                ImageCopyResampled($im2,$im,0,0,0,0,$newwidth,$newheight,$width,$height);

                return WriteImageToFile($im2,$thumbFilename,$type);
        }

        return false;
}#-#ResizeImageUsingGD()

#-#############################################
# desc: reads the image from the server into memory depending on type
# param: ($filename) filename of image to create ($type) int of type. 1=gif,2=jpeg,3=png
# returns: image resource
function ReadImageFromFile($filename, $type) {
        $imagetypes = ImageTypes();

        switch ($type) {
                case 1 :
                        if ($imagetypes & IMG_GIF){
                                return ImageCreateFromGIF($filename);
                        }
                        else{Oops("File type <b>.gif</b> not supported by GD version on server");}
                break;

                case 2 :
                        if ($imagetypes & IMG_JPEG){
                                return ImageCreateFromJPEG($filename);
                        }
                        else{Oops("File type <b>.jpg</b> not supported by GD version on server");}
                break;

                case 3 :
                        if ($imagetypes & IMG_PNG){
                                return ImageCreateFromPNG($filename);
                        }
                        else{Oops("File type <b>.png</b> not supported by GD version on server");}
                break;

                default:
                        Oops("Unknown file type passed to ReadImageFromFile");
                return 0;
        }
}#-#ReadImageFromFile()


#-#############################################
# desc: creates the new thumbnail image depending on type
# param: ($im) image resource ($filename) filename of image to create ($type) int of type. 1=gif,2=jpeg,3=png
# returns: true if created, false if failed
function WriteImageToFile($im, $filename, $type) {
        global $config;

        switch ($type) {
                case 1 :
                        return ImageGIF($im, $filename);
                case 2 :
                        return ImageJpeg($im, $filename, $config['imagequality']);
                case 3 :
                        return ImagePNG($im, $filename);
                default:
                        return false;
        }
}#-#WriteImageToFile()

#-#############################################
# desc: prints out the limited space page numbers
# param: number of entries
# returns: prints out text
function GetPageNumbers($entries) {
        global $config;

        $prev = "&laquo;Prev";
        $next = "Next&raquo;";

        $config['totalPages']=Ceil(($entries)/($config['cols']*$config['rows']));

// calculate how and what numbers to print
        $start=0; // starting image number
        $end=$config['totalPages']-1; // ending image number (total / number image on page)

        // cutoff size < page. or . page != last page (otherwise keep above values)
        if($config['maxShow'] < $config['page'] || (($config['cols']*$config['rows']*$config['maxShow'])< $entries) ){
                // if page >= cutoff size+1 -> start at page - cutoff size
                if($config['page'] >= ($config['maxShow']+1) && $config['page'] < $end-$config['maxShow']){ $start = $config['page']-$config['maxShow'];}
                elseif($end < $config['page']+$config['maxShow']+1 && $config['totalPages']-1 >= $config['maxShow']*2+1){$start = $config['totalPages']-1-$config['maxShow']*2;}
                else{$start=0;} // else start at 0

                // if page+cutoff+1 > number of pages total -> end= number of pages total
                if( $config['page']+$config['maxShow']+1 > $config['totalPages']-1 ){$end = $entries/($config['cols']*$config['rows']);}
                elseif($start == 0 && $end > $config['maxShow']*2){$end = $config['maxShow']*2;}
                elseif($start == 0 && $config['totalPages'] <= $config['maxShow']*2){$end = $config['totalPages']-1;}
                else{$end = ($config['page']+$config['maxShow']);} //end = page+cutoff+1
        }


// number of pages
        echo "Page ($config[totalPages]): \n";

// PREV
        if(($config['page']-1) >= 0){echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=".($config['page']-1)."\">$prev</a>\n";}
        else{echo "$prev\n";}

// divide marker
        if($start > 0){echo " ... ";}
        else{echo " - ";}

// each of the actual numbers
        for($i=$start; $i<=$end ; $i++){
                if($config['page']==$i){echo "[".($i+1)."] \n";}
                else{echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=$i\">".($i+1)."</a>\n";}
        }

// divide marker
        if(Ceil($end) < $config['totalPages']-1){echo " ... ";}
        else{echo " - ";}

// each of the actual numbers
        for($i=$start; $i<=$end ; $i++){
                if($config['page']==$i){echo "[".($i+1)."] \n";}
                else{echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=$i\">".($i+1)."</a>\n";}
        }

// divide marker
        if(Ceil($end) < $config['totalPages']-1){echo " ... ";}
        else{echo " - ";}

// NEXT
        if(($config['page']+1) <= $config['totalPages']-1){echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=".($config['page']+1)."\">$next</a>\n";}
        else{echo "$next\n";}

}#-#end GetPageNumbers()


#-#############################################
# desc: throw an error message
# param: [optional] any custom error to display
# returns: nothing, but exits and stops script
function Oops($msg) {
?>
<div style="width:450px;">
        <h3 style="margin:0px;">Error</h3>
        <?php echo $msg; ?>

        <hr style="height:1px;width:80%">
        Please hit the <a href="javaScript:history.back();"><b>back button</b></a> on your browser to try again.
</div>
<?php
exit;
}#-#Oops()



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
						<a href="https://lite.cash" class="logo">
							<img src="assets/images/logos/Logo24.png" class="light-logo" alt=""/>
							<img src="assets/images/logos/Logo24.png" class="dark-logo" alt=""/>
						</a>
						<!-- ***** Logo End ***** -->

						<!-- ***** Lang Start ***** -->
						<!-- ***** Lang End ***** -->

						<!-- ***** Menu Start ***** -->
<!--
						<ul class="nav">
							<li><a target="_blank" href="http://lite.cash" class="btn-nav-box">Litecash Website</a></li>
						</ul>
						<a class='menu-trigger'>
							<span>Menu</span>
						</a>
-->
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
<!--
				<div class="row">
					<div class="col-lg-12 align-self-center">
						<h1>Blockchain Explorer Detail</h1>
					</div>
					<div class="offset-lg-3 col-lg-6">
						<p>Up To Block <?php echo $height; ?> </p>
					</div>
-->
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
						<h2 class="section-title"></h2>
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

<!-- print images here.... -->

<?php

// do not change any of these. used for internal purposes
$config['start']=0;
$config['max']=0;
$config['page']=isset($_GET['page'])?$_GET['page']:"0";

//#############################################
// print out the page with all the thumbnails
PrintThumbs();
//#############################################

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
						<p class="copyright">2019 Litecash Developers Group</p>
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

