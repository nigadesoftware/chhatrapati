<?php
	require("../info/phpgetlogin.php");
	require("../info/ncryptdcrypt.php");
	require("../info/swapproutine.php");
    vouchervalidation();
	if ($_SESSION['changedefaultusersettings'] == 'on')
	{
		$_SESSION['changedefaultusersettings'] = 'off';
	}
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8"></meta>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/w3.css">
		<title>Entity Menu</title>
		<style type="text/css">
			body
			{
				background-color: #fff;
			}
			header
			{
				background-color: #fff;
				min-height: 38px;
				color: #070;
				font-family: arial;
				font-size: 19px;
			}
			nav
			{
				width: 300px;
				float: left;
				list-style-type: none;
				font-family: verdana;
				font-size: 15px;
				color: #000;
				line-height: 30px;
			}
			article
			{
				background-color: #fff;
				display: table;
				margin-left: 0px;
				padding-left: 10px;
				font-family: verdana;
				font-size: 15px;
			}
			section
			{
				margin-left: 0px;
				margin-right: 15px;
				float: left;
				text-align: left;
				color: #fc8;
				line-height: 23px;
			}
			a.navbar
			{
				color: #f48;
			}
			a.servicebar
			{
				color: #f48;
			}
			footer
			{
				float: bottom;
				color: #000;
				font-family: verdana;
				font-size: 12px;
			}
			div
			{
				float:left;
			}
			ul
			{
				line-height: 30px;
			}
		</style>
		<script src="../js/1.11.0/jquery.min.js">
 		 </script>
 		 <script>
 			$(document).ready(function(){
			 setInterval(function(){cache_clear()},3600000);
			 });
			 function cache_clear()
			{
			 window.location.reload(true);
			}
		</script>
</head>
	<body>
			<nav "w3-container">
	            <ul class="navbar">
	                <li><a class="navbar" href="../mis/usermenu.php">User Menu</a>
	            </ul>
        	</nav>
			<article class="w3-container">
				<section>
				<?php
					$finalreportperiodid_en = fnEncrypt($_SESSION['finalreportperiodid']);
					//Raw Material Master Addition
					if ($_SESSION["responsibilitycode"] == 451230287895415)
					{
						echo "<p>";
						echo '<ul class="servicebar">';
							echo '<li><a class="servicebar" href="../../../../../index.php">Home</a><br/>';
							echo '<li><a class="servicebar" href="../mis/usermenu.php">User Menu</a><br/>';
							$namecategoryid_en = fnEncrypt(654123874);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Sugar Factory</a>';
							echo '<li><a class="servicebar" href="../data/areadivision.php">Area Division</a>';
							echo '<li><a class="servicebar" href="../data/circle.php">Circle</a>';
							echo '<li><a class="servicebar" href="../data/cultivatorsubdistrict.php">Cultivator SubDistrict</a>';
							echo '<li><a class="servicebar" href="../data/village.php">Village</a>';
							echo '<li><a class="servicebar" href="../data/subvillage.php">SubVillage</a>';
							echo '<li><a class="servicebar" href="../data/bank.php">Bank</a>';
							echo '<li><a class="servicebar" href="../data/bankbranch.php">Bank Branch</a>';
							$namecategoryid_en = fnEncrypt(457895626);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Sugarcane Variety</a>';
							$namecategoryid_en = fnEncrypt(214785236);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Plantation Period</a>';
							$namecategoryid_en = fnEncrypt(874512466);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Sugarcane Plantation Ratoon</a>';
							$namecategoryid_en = fnEncrypt(357159426);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Sugarcane Plantation Method</a>';
							$namecategoryid_en = fnEncrypt(632415263);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Bene Tipare Type</a>';
							$namecategoryid_en = fnEncrypt(368753214);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Irrigation Sources</a>';
							$namecategoryid_en = fnEncrypt(362156874);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Irrigation Type</a>';
							$namecategoryid_en = fnEncrypt(365412547);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Sugarcane Yield Division</a>';
							$namecategoryid_en = fnEncrypt(754815215);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Yield Division Share</a>';
							$namecategoryid_en = fnEncrypt(638745124);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Membership</a>';
							$namecategoryid_en = fnEncrypt(325141722);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Area Unit</a>';
							echo '<li><a class="servicebar" href="../data/cultivator.php">Cultivator</a>';
							echo '<li><a class="servicebar" href="../data/fieldplot.php">Field Plot</a>';
							/*echo '<li><a class="servicebar" href="../data/personnamedetail.php">Person Name Detail</a>';*/
							echo '<li><a class="servicebar" href="../mis/selectresponsibility.php">Switch Responsibility</a><br/>';
							echo '<li><a class="servicebar" href="../../../../../sqlproc/logout.php">Log Out</a><br/>';
						echo '</ul>';
						echo "</p>";
					}
					elseif ($_SESSION["responsibilitycode"] == 475124562358965)
					{
						echo "<p>";
						echo '<ul class="servicebar">';
							echo '<li><a class="servicebar" href="../../../../../index.php">Home</a><br/>';
							echo '<li><a class="servicebar" href="../mis/usermenu.php">User Menu</a><br/>';
							echo '<li><a class="servicebar" href="../data/fieldplot.php">Field Plot</a>';
							echo '<li><a class="servicebar" href="../mis/selectresponsibility.php">Switch Responsibility</a><br/>';
							echo '<li><a class="servicebar" href="../../../../../sqlproc/logout.php">Log Out</a><br/>';
						echo '</ul>';
						echo "</p>";
					}
					elseif ($_SESSION["responsibilitycode"] == 985623541257474)
					{
						echo "<p>";
						echo '<ul class="servicebar">';
							echo '<li><a class="servicebar" href="../../../../../index.php">Home</a><br/>';
							echo '<li><a class="servicebar" href="../mis/usermenu.php">User Menu</a><br/>';
							echo '<li><a class="servicebar" href="../data/fieldplot.php">Field Plot</a>';
							echo '<li><a class="servicebar" href="../mis/selectresponsibility.php">Switch Responsibility</a><br/>';
							echo '<li><a class="servicebar" href="../../../../../sqlproc/logout.php">Log Out</a><br/>';
						echo '</ul>';
						echo "</p>";
					}
					//Raw Material Master Addition
					elseif ($_SESSION["responsibilitycode"] == 452365784154249)
					{
						echo "<p>";
						echo '<ul class="servicebar">';
							echo '<li><a class="servicebar" href="../../../../../index.php">Home</a><br/>';
							echo '<li><a class="servicebar" href="../mis/usermenu.php">User Menu</a><br/>';
							//echo '<li><a class="servicebar" href="../data/servicecontractor.php">Service Contractor</a>';
							$namecategoryid_en = fnEncrypt(398541725);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Transportation Vehicle</a>';
							$namecategoryid_en = fnEncrypt(845125632);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Raw Material Related Service</a>';
							$namecategoryid_en = fnEncrypt(671529934);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Harvesting with Transportation upto Vehicle</a>';
							$namecategoryid_en = fnEncrypt(913742561);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Caste</a>';
							$namecategoryid_en = fnEncrypt(489732156);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Profession</a>';
							$namecategoryid_en = fnEncrypt(365214765);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Document</a>';
							$namecategoryid_en = fnEncrypt(632541254);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Property</a>';
							$namecategoryid_en = fnEncrypt(547812365);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">HT Item</a>';
							$namecategoryid_en = fnEncrypt(843265874);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Official Responsibility</a>';
							$namecategoryid_en = fnEncrypt(325968741);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Vehicle Manufacturer</a>';
							$namecategoryid_en = fnEncrypt(854126547);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Trailor Manufacturer</a>';
							echo '<li><a class="servicebar" href="../data/contract.php">Contract</a>';
							$callingview_en = fnEncrypt('guarantorlist');
							echo '<li><a class="servicebar" href="../view/setseasoncontractcategory.php?callingview='.$callingview_en.'">Guarantor List</a>';
							$callingview_en = fnEncrypt('guarantorchainlist');
							echo '<li><a class="servicebar" href="../view/setseasoncontractcategory.php?callingview='.$callingview_en.'">Guarantor Chain List</a>';
							echo '<li><a class="servicebar" href="../data/contractmapping.php">Contract Mapping</a>';
							//echo '<li><a class="servicebar" href="../view/test1.php">Test1</a>';
							echo '<li><a class="servicebar" href="../mis/selectresponsibility.php">Switch Responsibility</a><br/>';
							echo '<li><a class="servicebar" href="../../../../../sqlproc/logout.php">Log Out</a><br/>';
						echo '</ul>';
						echo "</p>";
					}
					//Raw Material Master Alteration
					elseif ($_SESSION["responsibilitycode"] == 658741245893258)
					{
						echo "<p>";
						echo '<ul class="servicebar">';
							echo '<li><a class="servicebar" href="../../../../../index.php">Home</a><br/>';
							echo '<li><a class="servicebar" href="../mis/usermenu.php">User Menu</a><br/>';
							//echo '<li><a class="servicebar" href="../data/servicecontractor.php">Service Contractor</a>';
							$namecategoryid_en = fnEncrypt(398541725);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Transportation Vehicle</a>';
							$namecategoryid_en = fnEncrypt(845125632);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Raw Material Related Service</a>';
							$namecategoryid_en = fnEncrypt(671529934);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Harvesting with Transportation upto Vehicle</a>';
							$namecategoryid_en = fnEncrypt(913742561);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Caste</a>';
							$namecategoryid_en = fnEncrypt(489732156);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Profession</a>';
							$namecategoryid_en = fnEncrypt(365214765);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Document</a>';
							$namecategoryid_en = fnEncrypt(632541254);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Property</a>';
							$namecategoryid_en = fnEncrypt(547812365);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">HT Item</a>';
							$namecategoryid_en = fnEncrypt(843265874);
							echo '<li><a class="servicebar" href="../data/masterbase.php?namecategoryid='.$namecategoryid_en.'">Official Responsibility</a>';
							echo '<li><a class="servicebar" href="../data/agriofficer.php?categorycode=1">Agri Officer Detail</a>';
							echo '<li><a class="servicebar" href="../data/agriofficer.php?categorycode=2">Manager Detail</a>';
							echo '<li><a class="servicebar" href="../data/contract.php">Contract</a>';
							echo '<li><a class="servicebar" href="../data/contractmapping.php">Contract Mapping</a>';
							echo '<li><a class="servicebar" href="../mis/selectresponsibility.php">Switch Responsibility</a><br/>';
							echo '<li><a class="servicebar" href="../../../../../sqlproc/logout.php">Log Out</a><br/>';
						echo '</ul>';
						echo "</p>";
					}
				?>					
				</section>
			</article>
			<footer>
				<div class="copyright">This is developed and maintained by Swapp Software Application. Copyright &copy;2018 Swapp Software Application</div>
			</footer>
	</body>
</html>