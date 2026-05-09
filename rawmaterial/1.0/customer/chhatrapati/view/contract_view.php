<?php
    require_once("../info/phpgetloginview.php");
    require_once("../info/ncryptdcrypt.php");
    require_once('../tcpdf/examples/tcpdf_include.php');
	//require_once("../info/swapproutine.php");
	require_once("../info/rawmaterialroutine.php");
    include("../api_report/contract1_report.php");
    include("../api_report/contract2_report.php");
	include("../api_report/contract3_report.php");
	include("../api_report/contract4_report.php");
    include("../api_report/contract5_report.php");
	include("../api_report/contract6_report.php");
	include("../api_report/contract7_report.php");
    include("../api_report/contract8_report.php");
	include("../api_report/contract9_report.php");
	include("../api_report/contract10_report.php");
	include("../api_report/contract11_report.php");
	include("../api_report/contract20_report.php");
	include("../api_report/contract21_report.php");
	include("../api_report/contract51_report.php");
	include("../api_report/contract52_report.php");
	include("../api_report/contract13_report.php");
	include("../api_report/contract14_report.php");
		include("../api_report/contract66_report.php");
    //Raw Material HT Master Addition or HT Master Alteration
    if (isaccessible(452365784154249)==0 and isaccessible(658741245893258)==0)
    {
    	echo 'Communication Error';
    	exit;
    }
	$contractid_de = fnDecrypt($_GET['contractid']);
	$contractcategoryid_de = fnDecrypt($_GET['contractcategoryid']);
	$contracttransportharvestid_de = (int) fnDecrypt($_GET['contracttransportharvestid']);

	$headerfontname = TCPDF_FONTS::addTTFfont('../tcpdf/fonts/siddhanta.ttf', 'TrueTypeUnicode', '', 96);
	$fontname1 = TCPDF_FONTS::addTTFfont('../tcpdf/fonts/SakalMarathiNormal9.22.ttf', 'TrueTypeUnicode', '', 32);

	// create new PDF document
	$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor(PDF_AUTHOR);
	$pdf->SetTitle(PDF_HEADER_TITLE);
	$pdf->SetSubject('Contract');
	$pdf->SetKeywords('contract_000.MR');

    // set font
	// set header and footer fonts
	$pdf->setHeaderFont(Array($headerfontname, '', 12));
	$pdf->setFooterFont(Array($headerfontname, '', 12));
	// set default header data
	$title = str_pad(' ', 30).'भवानीनगर, ता.इंदापूर, जि.पुणे';
	//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'श्री छत्रपति सर्व सेवा संघ' ,$title);
	$pdf->SetHeaderData('', 0,str_pad(' ', 21).'जय भवानी सर्व सेवा संघ (ट्रस्ट)' ,$title);
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    
	// set auto page breaks
	//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language dependent data:
	$lg = Array();
	$lg['a_meta_charset'] = 'UTF-8';
	$lg['a_meta_dir'] = 'ltr';
	$lg['a_meta_language'] = 'mr';
	$lg['w_page'] = 'पान - ';

	// set some language-dependent strings (optional)
	$pdf->setLanguageArray($lg);

	// ---------------------------------------------------------

	// add a page
	

	// set color for background
	$pdf->SetFillColor(0, 0, 0);
	// set color for text
	$pdf->SetTextColor(0, 0, 0);
	$srno =1;
	$liney=20;


    require("../info/phpsqlajax_dbinfo.php");
    /* // Opens a connection to a MySQL server
    $connection=mysqli_connect($hostname_rawmaterial, $username_rawmaterial, $password_rawmaterial, $database_rawmaterial);
    // Check connection
    if (mysqli_connect_errno())
    {
        echo '<span style="background-color:#f44;color:#ff8;text-align:left;">Communication error1</span>';
        exit;
    }
    mysqli_query($connection,'SET NAMES UTF8'); */
	$connection = rawmaterial_connection();
	if ($contractcategoryid_de == 521478963 and $contracttransportharvestid_de == 1)
	{
		/* $contract1_1 = new contract_1($connection);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract1_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$pdf->SetPrintHeader(true);
		$startY = $pdf->GetY();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
	
		$endY = $pdf->GetY();
		if ($endY < $startY+5) {
    	}
		else
			{
				$pdf->SetPrintHeader(true);
				$pdf->AddPage();
			}
		$startY = $pdf->GetY();
		$liney=20;
		$contract2_1 = new contract_2($connection);
		$contract2_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$endY = $pdf->GetY();
		if ($endY < $startY+5) {
    	}
		else
			{
				$pdf->SetPrintHeader(false);
				$pdf->AddPage();
			}
		$startY = $pdf->GetY();	
		$liney=20;
		$contract51_1 = new contract_51($connection);
		$contract51_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$endY = $pdf->GetY();
		if ($endY < $startY+5) {
    	}
		else
			{
				$pdf->AddPage();
			}
		$startY = $pdf->GetY();		
		$liney=20;
		$contract4_1 = new contract_4($connection);
		$contract4_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$endY = $pdf->GetY();
		if ($endY < $startY+5) {
    	}
		else
			{
				$pdf->AddPage();
			}
		$startY = $pdf->GetY();		
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$endY = $pdf->GetY();
		if ($endY < $startY+5) {
    	}
		else
			{
				$pdf->AddPage();
			}
		/* $liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		 $pdf->AddPage(); */
		 $liney=20;
		$contract66_1 = new contract_66($connection);
		$contract66_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		 $pdf->AddPage(); 
		$liney=20;
		$contract10_1 = new contract_10($connection);
		$contract10_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);  
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		/*$pdf->AddPage();
		 $liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->AddPage();
		$liney=20;
		$contract52_1 = new contract_52($connection);
		$contract52_1->printpageheader($pdf,$liney,$contractid_de); */
		//$pdf->AddPage();
		/* $pdf->AddPage();
		$liney=20;
		$contract10_1 = new contract_10($connection);
		$contract10_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract9_1 = new contract_9($connection);
		$contract9_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->lastPage();
		$pdf->Output('transportercontract_000.pdf', 'I');
	}
	elseif ($contractcategoryid_de == 947845153 and $contracttransportharvestid_de == 2)
	{
		$contract1_1 = new contract_1($connection);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract1_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract2_1 = new contract_2($connection);
		$contract2_1->printpageheader($pdf,$liney,$contractid_de);
		/*$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract4_1 = new contract_4($connection);
		$contract4_1->printpageheader($pdf,$liney,$contractid_de);*/
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract21_1 = new contract_21($connection);
		$contract21_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		/*$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract9_1 = new contract_9($connection);
		$contract9_1->printpageheader($pdf,$liney,$contractid_de);*/
		$pdf->lastPage();
		$pdf->Output('harvestercontract_000.pdf', 'I');
	}
	elseif ($contractcategoryid_de == 785415263 and $contracttransportharvestid_de == 3)
	{
		/* $contract1_1 = new contract_1($connection);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract1_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract2_1 = new contract_2($connection);
		$contract2_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract4_1 = new contract_4($connection);
		$contract4_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract20_1 = new contract_20($connection);
		$contract20_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract9_1 = new contract_9($connection);
		$contract9_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->AddPage();
		$liney=20;
		$contract2_1 = new contract_2($connection);
		$contract2_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		/* $pdf->AddPage();
		$liney=20;
		$contract51_1 = new contract_51($connection);
		$contract51_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true); */
		$pdf->AddPage();
		$liney=20;
		$contract4_1 = new contract_4($connection);
		$contract4_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract20_1 = new contract_20($connection);
		$contract20_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->AddPage();
		$liney=20;
		$contract52_1 = new contract_52($connection);
		$contract52_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->lastPage();
		$pdf->Output('bulluckcartcontract_000.pdf', 'I');
	}
	else if ($contractcategoryid_de == 432156897 and $contracttransportharvestid_de == 2)
	{
		/* $contract1_1 = new contract_1($connection);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract1_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract2_1 = new contract_2($connection);
		$contract2_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract51_1 = new contract_51($connection);
		$contract51_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract4_1 = new contract_4($connection);
		$contract4_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		 $pdf->AddPage();
		$liney=20;
		$contract13_1 = new contract_13($connection);
		$contract13_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);  
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->AddPage();
		$liney=20;
		$contract52_1 = new contract_52($connection);
		$contract52_1->printpageheader($pdf,$liney,$contractid_de);
		//$pdf->AddPage();
		/* $pdf->AddPage();
		$liney=20;
		$contract10_1 = new contract_10($connection);
		$contract10_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract9_1 = new contract_9($connection);
		$contract9_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->lastPage();
		$pdf->Output('harvestermachineregularcontract_000.pdf', 'I');
	}
	else if ($contractcategoryid_de == 432157546 and $contracttransportharvestid_de == 2)
	{
		/* $contract1_1 = new contract_1($connection);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract1_1->printpageheader($pdf,$liney,$contractid_de); */
		/* $pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract3_1 = new contract_3($connection);
		$contract3_1->printpageheader($pdf,$liney,$contractid_de);
		 */
		/* $pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract2_1 = new contract_2($connection);
		$contract2_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract51_1 = new contract_51($connection);
		$contract51_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract4_1 = new contract_4($connection);
		$contract4_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(true);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		 $pdf->AddPage();
		$liney=20;
		$contract14_1 = new contract_14($connection);
		$contract14_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);  
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->AddPage();
		$liney=20;
		$contract52_1 = new contract_52($connection);
		$contract52_1->printpageheader($pdf,$liney,$contractid_de);
		//$pdf->AddPage();
		/* $pdf->AddPage();
		$liney=20;
		$contract10_1 = new contract_10($connection);
		$contract10_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract5_1 = new contract_5($connection);
		$contract5_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract6_1 = new contract_6($connection);
		$contract6_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract7_1 = new contract_7($connection);
		$contract7_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract8_1 = new contract_8($connection);
		$contract8_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract9_1 = new contract_9($connection);
		$contract9_1->printpageheader($pdf,$liney,$contractid_de);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$liney=20;
		$contract11_1 = new contract_11($connection);
		$contract11_1->printpageheader($pdf,$liney,$contractid_de); */
		$pdf->lastPage();
		$pdf->Output('harvestermachinefiveyearcontract_000.pdf', 'I');
	}
?>
