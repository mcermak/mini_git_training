<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--  HTML CSS Template Designed by w w w . t e m p l a t e m o . c o m  -->

<?php
$username = "pruvodcenakole";
$password = "9e6b8dba6a95fa6a";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db("dbpruvodcenakole",$dbhandle)
  or die("Could not select database");
mysql_query('SET CHARACTER SET "utf8"');
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Jihomoravské zážitky s kolem a na kole</title>

<meta name="keywords" content="Cyklotrasy, Cyklovýlety, víno, Jižní Morava, srdcemjiznimoravy.cz" />

<meta name="description" content="Cyklotrasy po jižní moravě" />

<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jquery-1.2.6.min.js"></script>

<script type="text/javascript" src="jquery.galleriffic.js"></script>

</head>

<body>

<div id="templatemo_container">

  <div id="templatemo_top_section1"></div>

  <div id="templatemo_top_section2">

    <div id="templatemo_title">Jihomoravské zážitky s kolem a na kole</div>

    <div id="container">

				<!-- Start Gallery Html Containers -->

				<div id="gallery" class="content">

				<!-- 	<div id="controls" class="controls"></div> -->

					<div id="slideshow" class="slideshow"></div>

				</div>

				<div id="navigation" class="navigation">

					<ul class="thumbs noscript">

						<li><a href="gallery/gallery1.jpg"><img src="gallery/s-gallery1.jpg" alt="Photo 1" /></a></li>

						<li><a href="gallery/gallery2.jpg"><img src="gallery/s-gallery2.jpg" alt="Photo 2" /></a></li>

						<li><a href="gallery/gallery3.jpg"><img src="gallery/s-gallery3.jpg" alt="Photo 3" /></a></li>

						<li><a href="gallery/gallery4.jpg"><img src="gallery/s-gallery4.jpg" alt="Photo 4" /></a></li>

						<li><a href="gallery/gallery5.jpg"><img src="gallery/s-gallery5.jpg" alt="Photo 5" /></a></li>

						<li><a href="gallery/gallery6.jpg"><img src="gallery/s-gallery6.jpg" alt="Photo 6" /></a></li>

					</ul>

				</div>

				<!-- End Gallery Html Containers -->

		  </div>

  </div>

  <div id="templatemo_top_section3"></div>

  <div id="templatemo_top_section4">

    <div class="templatemo_hor_menu">

      <ul>
	<?php
		//Get list of links from db
		$result = mysql_query("SELECT label FROM link WHERE horizontal=1 AND hidden=0");
		//include links
		while ($row = mysql_fetch_array($result)) {
			echo "<li><a href=\"index.php?page=".strtolower($row{'label'})."\">".$row{'label'}."</a></li>";
		}
	?>
      </ul>

    </div>

    <div class="templatemo_ver_menu">

      <ul>
	<?php
		//Get list of links from db
		$result = mysql_query("SELECT * FROM link WHERE horizontal=0 AND hidden=0");
		//include links
		while ($row = mysql_fetch_array($result)) {
			echo "<li><a href=\"index.php?page=".strtolower($row{'label'})."\">".$row{'label'}."</a></li>";
		}
	?>
      </ul>

    </div>

  </div>

  <div id="templatemo_top_section5"></div>

  <div id="templatemo_container_left">
	&nbsp;
	<?php
		if($_GET['action']){
			//Get list of links from db
			$result = mysql_query("SELECT path FROM action WHERE id=".$_GET['action']);
			//include links
			while ($row = mysql_fetch_array($result)) {
				include $row{'path'};
			}
		}
		elseif($_GET['page']){
			//Get list of links from db
			$result = mysql_query("SELECT path FROM link WHERE label='".$_GET['page']."'");
			//include links
			while ($row = mysql_fetch_array($result)) {
				include $row{'path'};
			}
		}
		else {
			//Get list of links from db
			$result = mysql_query("SELECT path FROM link ORDER BY id LIMIT 1");
			//include links
			while ($row = mysql_fetch_array($result)) {
				include $row{'path'};
			}
		}
	?>

  </div>

  <div id="templatemo_container_right">

    <p><strong>Nejnovější události</strong></p>
	<?php
		//Get list of links from db
		$result = mysql_query("SELECT DATE(event_time) as event, description, title, id FROM action");
		//include links
		while ($row = mysql_fetch_array($result)) {
			echo "<div class=\"templatemo_right_paragraph\"><span>".$row{'event'}." ".$row{'title'}."</span><br/>";
			echo $row{'description'};
    			echo "</div><div class=\"more\"><a href=\"index.php?action=".$row{'id'}."\">Více</a></div>";
		}
		mysql_close($dbhandle);
	?>
  </div>

</div>

<div id="templatemo_footer_link">

  <div class="templatemo_footer_menu">&nbsp;</div>

</div>

<div id="templatemo_footer">

<script type="text/javascript">

			$(document).ready(function() {

				var gallery = $('#gallery').galleriffic('#navigation', {

					delay:                3,

					numThumbs:            11,

					imageContainerSel:    '#slideshow',

					controlsContainerSel: '#controls',

					titleContainerSel:    '#image-title',

					descContainerSel:     '#image-desc',

					downloadLinkSel:      '#download-link'

				});


				gallery.onFadeOut = function() {

					$('#details').fadeOut('fast');

				};


				gallery.onFadeIn = function() {

					$('#details').fadeIn('fast');

				};

			});

</script>

</body>
<!--  Inspired by a Template Designed by w w w . t e m p l a t e m o . c o m  -->
</html>
