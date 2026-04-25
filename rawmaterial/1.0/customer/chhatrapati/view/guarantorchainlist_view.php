<?php
    require("../info/phpgetloginview.php");
    require("../info/ncryptdcrypt.php");
    require("../info/rawmaterialroutine.php");
    require_once('../tcpdf/examples/tcpdf_include.php');
    require_once('../api_report/guarantorchainlist_report.php');
    if (isaccessible(452365784154249)==0 and isaccessible(658741245893258)==0)
    {
        echo 'Communication Error';
        exit;
    }
    $seasonid = $_POST["seasonid"];
    $contractcategoryid = $_POST["contractcategoryid"];
    $fromdate = DateTime::createFromFormat('d/m/Y',$_POST["fromdate"])->format('d-M-Y');
    $todate = DateTime::createFromFormat('d/m/Y',$_POST["todate"])->format('d-M-Y');
    
    require("../info/phpsqlajax_dbinfo.php");
    $connection = rawmaterial_connection();
	$gurantorchainlist1 = new guarantorchainlist($connection,250);
    $gurantorchainlist1->seasonid = $seasonid;
    $gurantorchainlist1->contractcategoryid = $contractcategoryid;
    $gurantorchainlist1->fromdate=$fromdate;
    $gurantorchainlist1->todate=$todate;
    
    $gurantorchainlist1->newpage(true);
    $gurantorchainlist1->detail();
    $gurantorchainlist1->endreport();
?>