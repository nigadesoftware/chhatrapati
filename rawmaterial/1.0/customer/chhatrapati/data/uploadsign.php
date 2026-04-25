<?php
	require("../info/phpgetloginview.php");
	require("../info/ncryptdcrypt.php");
	require("../info/rawmaterialroutine.php");
	include("../api_oracle/contractsigndetail_db_oracle.php");
	$connection = rawmaterial_connection();
    $contractsigndetail1= new contractsigndetail($connection);
    $contractsigndetail1->contractid = $_POST["contractid"];
    $contractsigndetail1->contractreferencecategoryid = $_POST["contractreferencecategoryid"];
    $contractsigndetail1->contractreferencedetailid = $_POST["contractreferencedetailid"];
    session_start(); 
    //$upload_dir = "../doc_signs/";
    $img = $_POST['mysign'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    //$file = $upload_dir . $_POST['contractid']. ".png";
    //$success = file_put_contents($file, $data);
    //print $success ? $file : 'Unable to save the file.';
    //$contractsigndetail1->sign = fread(fopen($file, "r"), filesize($file));
    //$contractsigndetail1->sign = $file;
    $contractsigndetail1->sign=$data;
    $ret = $contractsigndetail1->insert();
    if ($ret==1)
    {
        oci_commit($connection);
    }
    else
    {
        oci_rollback($connection);
    }
    //$contractid_en = fnEncrypt($_POST['contractid']);
    //$contractreferencecategoryid_en = fnEncrypt($_POST['contractreferencecategoryid']);
    //$contractreferencedetailid_en = fnEncrypt($_POST['contractreferencedetailid']);
    //header('location: ../data/contractsigndetail_list.php?contractid='.$contractid_en.'&contractreferencecategoryid='.$contractreferencecategoryid_en.'&contractreferencedetailid='.$contractreferencedetailid_en.'&flag='.fnEncrypt('Display'));
    //exit;
?>