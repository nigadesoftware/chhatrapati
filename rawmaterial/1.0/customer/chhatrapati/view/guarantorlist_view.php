<?php
    require("../info/phpgetloginview.php");
    require("../info/ncryptdcrypt.php");
    require("../info/rawmaterialroutine.php");
    require_once('../tcpdf/examples/tcpdf_include.php');
    require_once('../api_report/guarantorlist_report.php');
    if (isaccessible(452365784154249)==0 and isaccessible(658741245893258)==0)
    {
        echo 'Communication Error';
        exit;
    }
    $seasonid = $_POST["seasonid"];
    $contractcategoryid = $_POST["contractcategoryid"];
    $fromdate = DateTime::createFromFormat('d/m/Y',$_POST["fromdate"])->format('d-M-y');
    $todate = DateTime::createFromFormat('d/m/Y',$_POST["todate"])->format('d-M-y');
    
    require("../info/phpsqlajax_dbinfo.php");
    $connection = rawmaterial_connection();
	$gurantorlist1 = new guarantorlist($connection,250);
    $gurantorlist1->seasonid = $seasonid;
    $gurantorlist1->contractcategoryid = $contractcategoryid;
    $gurantorlist1->fromdate=$fromdate;
    $gurantorlist1->todate=$todate;
    
    $gurantorlist1->newpage(true);
    $gurantorlist1->detail();
    $gurantorlist1->endreport();
?>