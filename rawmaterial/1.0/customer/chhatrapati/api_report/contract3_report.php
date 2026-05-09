<?php
    include_once("../api_oracle/contract_db_oracle.php");
	//include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contract_db_oracle.php");
	//include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contract_db_oracle.php");
	//include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contracttransportdetail_db_oracle.php");
	include_once("../api_oracle/contractharvestdetail_db_oracle.php");
	include_once("../api_oracle/contracttransporttrailerdetail_db_oracle.php");
	include_once("../api_oracle/contractguarantordetail_db_oracle.php");
	include_once("../api_oracle/servicecontractor_db_oracle.php");
	include_once("../api_oracle/contractperformancedetail_db_oracle.php");
	include_once("../api_oracle/contractitemloandetail_db_oracle.php");
	include_once("../api_oracle/contractapproverdetail_db_oracle.php");
	
class contract_3
{	
	public $contractid;
    public $connection;
    
	public function __construct(&$connection)
	{
		$this->connection = $connection;
	}

	function printpageheader(&$pdf,&$liney,$contractid)
    {
        $contract1 = new contract($this->connection);

		if ($contract1->fetch($contractid))
		{
			$pdf->SetFont('siddhanta', '', 11, '', true);
			$curdate = date('d/m/Y');
			$pdf->multicell(50,10,'दिनांक:'.$contract1->contractdatetime,0,'L',false,1,160,$liney,true,0,false,true,10);
            $pdf->multicell(50,10,'प्रति,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->multicell(70,10,'मा.विश्वस्तसो / मॅनेजरसो,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->multicell(150,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट)',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->multicell(150,10,'भवानीनगर, ता.इंदापूर, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+10;
			$pdf->SetFont('siddhanta', '', 14, '', true);
			$pdf->MultiCell(180, 10, 'करार करून घेणेसाठी अर्ज', 0, 'C', false, 1, 15, $liney, true, 0, false, true, 10);
			$liney = $liney + 10;
			$pdf->SetFont('siddhanta', '', 11, '', true);
			$contracttransportdetail1 = new contracttransportdetail($this->connection);
			$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor1 = new servicecontractor($this->connection);
			$servicecontractor1->fetch($contract1->servicecontractorid);
			
			$contractharvestdetail1 = new contractharvestdetail($this->connection);
			$contractharvestdetail1 = $this->contractharvestdetail($this->connection,$contract1->contractid);
		
			if ($contract1->contractcategoryid == 521478963)
			{
				$pdf->multicell(100,10,'अर्जदार: '.$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
				$pdf->multicell(70,10,'मो.नं.:'.$servicecontractor1->contactnumber,0,'L',false,1,130,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(43,$liney,103,$liney);
				$pdf->line(140,$liney,200,$liney);
				$liney = $liney+2;

				$pdf->multicell(120,10,'मु.पो. '.$servicecontractor1->address_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(10,$liney,120,$liney);
				$liney = $liney+2;

				$subject = 'विषय - आपले साखर कारखान्यास गळीत हंगाम '.$contract1->seasonname_unicode.' साठी '.$contracttransportdetail1->transportationvehiclename_unicode.'ने ऊस तोडणी-वाहतूक करून देण्याचे काम मिळणे बाबत...';
				$pdf->multicell(150,10,$subject,0,'L',false,1,30,$liney,true,0,false,true,10);
				$liney = $liney+7;
				

				/* $area1 = new area($this->connection);
				$area1->fetch($servicecontractor1->areaid); */
				
				/* $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,43,$liney,true,0,false,true,10);
				$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,55,$liney,true,0,false,true,10);
 */
				/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,105,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,115,$liney,true,0,false,true,10);

				$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);
				 */$liney = $liney+5;
				$pdf->line(43,$liney,150,$liney);
				/* $pdf->line(115,$liney,145,$liney);
				$pdf->line(157,$liney,200,$liney); */
	            $liney = $liney+2;

				//$pdf->multicell(100,10,'महोदय,',0,'J',false,1,15,$liney,true,0,false,true,10);
				//$liney = $liney+5;
				$pdf->SetFont('siddhanta', '', 11, '', true);
				// create some HTML content
				$html = '<span style="text-align:justify;">महोदय,<br>मी वरील पत्त्यावरील कायमचा रहिवासी 
				असून माझा साखर कारखान्यांना <u>'.$contracttransportdetail1->transportationvehiclename_unicode.'</u> 
				ने ऊस तोडणी 
				वाहतूक करण्याचा व्यावसाय आहे. आपले भवानीनगर तालुका इंदापूर जिल्हा पुणे येथील 
				कारखान्याची हंगाम साठी ऊस तोडणी व वाहतुकीचे काम घेऊ इच्छितो. मी यापूर्वी 
				दुसरीकडे कोठेही करार किंवा अर्ज केलेला नाही. आपले नियम व अटी मला मान्य आहेत. 
				मला याचे पूर्ण कल्पना आहे की, प्रस्तुतच्या कराराचा विषय म्हणजेच तोडणी व वाहतूक 
				मी भवानीनगर कार्यक्षेत्रातील ऊस उत्पादकांसाठी करतो आहे. तरी माझे 
				<u>'.$contractharvestdetail1->transportationuptovehiclename_unicode.'</u> मजुरांमार्फत ऊस 
				तोडणी करून माझ्या मालकीच्या / ताब्यातील <u>'.$contracttransportdetail1->transportationvehiclename_unicode.'</u> 
				ने वाहतूक करणेचे काम मंजूर करण्यात यावे, 
				माझा तसा स्वतंत्र तोडणी व वाहतूक कामाचा करार करून घ्यावा व मला आपले धोरणानुसार 
				सदर कामासाठी मजूर उपलब्ध करणे, वाहन दुरुस्ती करणे इत्यादीसाठी ॲडव्हान्स रक्कम 
				मिळावी. आणि उधारीने पुढील साहित्य मिळावे व सदरील साहित्याच्या मोबदल्यात
				 माझे बिलातून साहित्याची किंमत कपात करून घ्यावे ही विनंती.</span>';
				// set UTF-8 Unicode font
				$pdf->SetFont('siddhanta', '', 11);
				// output the HTML content
				$pdf->writeHTML($html, true, 0, true, true);
				$liney = $liney+50;
			}
			elseif ($contract1->contractcategoryid == 785415263)
			{
				$subject = 'विषय - बैलगाडी करार मिळणेबाबत.';
				$pdf->multicell(150,10,$subject,0,'L',false,1,30,$liney,true,0,false,true,10);
				$liney = $liney+7;
				$pdf->multicell(100,10,'अर्जदार: '.$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
				$pdf->multicell(70,10,'मो.नं.:'.$servicecontractor1->contactnumber,0,'L',false,1,130,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(43,$liney,103,$liney);
				$pdf->line(140,$liney,200,$liney);
				$liney = $liney+2;
				/* $area1 = new area($this->connection);
				$area1->fetch($servicecontractor1->areaid); */
				
				$pdf->multicell(120,10,'मु.पो. '.$servicecontractor1->address_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
				$liney = $liney+5;

				$liney = $liney+7;
				$pdf->multicell(100,10,'महाशय,',0,'J',false,1,15,$liney,true,0,false,true,10);
				$liney = $liney+7;
				$pdf->SetFont('siddhanta', '', 11, '', true);
				// create some HTML content
				$html = '<span style="text-align:justify;">मी आपले जय भवानी सर्व सेवा संघ (ट्रस्ट)
				 भवानीनगर यांचेकडे सन <u>'.$contract1->seasonname_unicode.'</u> 
				 करिता ऊस तोडणी वाहतुकीसाठी बैलगाडी करार करु इच्छित आहे. 
				 तरी आपले नियमाप्रमाणे सर्व कागदपत्रांची पुर्तता करून देत आहे. 
				 तरी कृपया माझा करार करून घेवून मला आपले नियमाप्रमाणे अॅडव्हान्स मिळावा ही विनंती. 
				 आपण आपले बैलगाडी करार करून घेतला तर मी श्री छत्रपति सहकारी साखर कारखान्याच्या 
				 कार्यक्षेत्रातील संपूर्ण ऊसाची तोडणी / वाहतूक होईपर्यंत आपणाकडे काम करीन. 
				 तसेच माझा अॅडव्हान्स माझ्या धंद्यातून वसूल न झालेस इतर देय रक्कमेतून 
				 कपात करून घेणेस माझी पुर्ण संमती आहे. 
				 तरी करार करून घेऊन काम करण्याची संधी द्यावी ही नम्र विनंती.</span>';
				// set UTF-8 Unicode font
				$pdf->SetFont('siddhanta', '', 11);
				// output the HTML content
				$pdf->writeHTML($html, true, 0, true, true);
				$liney = $liney+50;
			}
			$contractitemloandetail1 = new contractitemloandetail($this->connection);
			$list1 = $contract1->itemloanlist();
			$startliney = $liney;
			$pdf->line(15,$liney,200,$liney);
			$pdf->multicell(20,10,'अ.नं.',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(70,10,'वस्तूचा तपशिल',0,'L',false,1,35,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'नग',0,'R',false,1,105,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'दर',0,'R',false,1,135,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'एकूण किंमत',0,'R',false,1,165,$liney,true,0,false,true,10);
			$liney = $liney +5; 
			$pdf->line(15,$liney,200,$liney);
			$liney = $liney +2; 
			$i=1;
			$sumamount = 0;
			foreach ($list1 as &$value)
			{
				$val = intval($value);
				$contractitemloandetail1->fetch($val);
				$pdf->multicell(20,10,$i++,0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(70,10,$contractitemloandetail1->name_unicode,0,'L',false,1,35,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,$contractitemloandetail1->qty,0,'R',false,1,105,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,$contractitemloandetail1->rate,0,'R',false,1,135,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,$contractitemloandetail1->amount,0,'R',false,1,165,$liney,true,0,false,true,10);
				$sumamount = $sumamount + $contractitemloandetail1->amount;
				$liney = $liney +5; 
				$pdf->line(15,$liney,200,$liney);
				$liney = $liney +2; 
			}
			$endliney = $liney-2;
			$pdf->line(15,$startliney,15,$endliney+7);
			$pdf->line(35,$startliney,35,$endliney);
			$pdf->line(105,$startliney,105,$endliney);
			$pdf->line(135,$startliney,135,$endliney);
			$pdf->line(165,$startliney,165,$endliney+7);
			$pdf->line(200,$startliney,200,$endliney+7);
			/* $pdf->line(15,$liney,200,$liney);
			$liney = $liney+2; */
			$pdf->multicell(30,10,'एकूण किंमत',0,'R',false,1,135,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$sumamount,0,'R',false,1,165,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$pdf->line(15,$liney,200,$liney);
			//$liney = $liney+7;
			$pdf->multicell(100,10,'आपला विश्वासू,',0,'L',false,1,125,$liney,true,0,false,true,10);
			
			$contractsigndetail1 = new contractsigndetail($this->connection);
			$contractsigndetail1 = $this->contracttransportsigndetail($this->connection,$contract1->contractid,1);

			$signdata = $contractsigndetail1->sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,110,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

			
			$liney = $liney+15;
			$pdf->multicell(100,10,'सही / अंगठा',0,'L',false,1,100,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$pdf->line(100,$liney,200,$liney);
			$liney = $liney+2;
			if ($contract1->contractcategoryid == 521478963)
			{
				$pdf->multicell(100,10,'नाव: '.$servicecontractor1->name_unicode.'यांचे डा.हा.असे',0,'L',false,1,100,$liney,true,0,false,true,10);
				$liney = $liney+5;
			}
			elseif ($contract1->contractcategoryid == 785415263)
			{
				$pdf->multicell(100,10,'नाव: '.$servicecontractor1->name_unicode.'यांचे डा.हा.असे',0,'L',false,1,100,$liney,true,0,false,true,10);
				$liney = $liney+5;
			}
			$pdf->line(100,$liney,200,$liney);
			$pdf->multicell(100,10,' दस्तूर देणार नाव व सही',0,'L',false,1,100,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$pdf->line(100,$liney,200,$liney);
			$liney = $liney+2;
			$pdf->line(15,$liney,200,$liney);
			$liney = $liney+2;
			
			$pdf->SetFont('siddhanta', '', 13);
			$pdf->multicell(100,10,'कार्यालयीन उपयोगासाठी',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
			//$pdf->multicell(100,10,'मा.मुख्य शेतकी अधिकारी सो,',0,'L',false,1,15,$liney,true,0,false,true,10);
			//$liney = $liney+7;
			$html = '<span style="text-align:justify;">श्री./श्रीमती <u>'.$servicecontractor1->name_unicode.'</u>
			यांचे कागदपत्रांची पडताळणी केली असून समक्ष चर्चेअंती सदर इसम कामावर येण्याची खात्री आहे. तरी सदरचा अर्ज मंजूर करून कारखाना व जय भवानी ट्रस्टचे धोरणानुसार त्यांना  साहित्य आणि  ॲडव्हान्सची रक्कम देणेस शिफारस आहे.</span>';
			// set UTF-8 Unicode font
			$pdf->SetFont('siddhanta', '', 11);
			// output the HTML content
			$pdf->writeHTML($html, true, 0, true, true);
			$liney = $liney+20;
			$chitbuoy1 = new contractapproverdetail($this->connection);
			$chitbuoy1->fetchbyresponsibility($contract1->contractid,248798796);
			$pdf->SetFont('siddhanta', '', 11);
			$pdf->multicell(100,10,'मुकादम / चिटबाॅय नाव :'.$chitbuoy1->name_unicode,0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(15,10,'सही :',0,'L',false,1,115,$liney,true,0,false,true,10);
			$liney = $liney+7;
			
			$supervisor1 = new contractapproverdetail($this->connection);
			$supervisor1->fetchbyresponsibility($contract1->contractid,248798649);
			
			$pdf->multicell(100,10,'सुपरवायझर नाव :'.$supervisor1->name_unicode,0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(15,10,'सही :',0,'L',false,1,115,$liney,true,0,false,true,10);
			$liney = $liney+7;

			$canesupplyofficer1 = new contractapproverdetail($this->connection);
			$canesupplyofficer1->fetchbyresponsibility($contract1->contractid,248798502);

			$pdf->multicell(100,10,'ऊस पुरवठा अधिकारी नाव :'.$canesupplyofficer1->name_unicode,0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(15,10,'सही :',0,'L',false,1,115,$liney,true,0,false,true,10);
			$liney = $liney+7;
			
			$name_unicode = $this->contractagriofficername($this->connection,$contract1->seasonid);
            $sign = $this->contractagriofficersign($this->connection,$contract1->seasonid);
			
			$html = '<span style="text-align:justify;">मा. फायनान्स मॅनेजर,
			श्री/ श्रीमती <u>'.$servicecontractor1->name_unicode.'</u> यांचा अर्ज मंजूर / नामंजूर केला असून साहित्य आणि ऍडव्हान्स रक्कम देण्यात यावी/ देऊ नये
		   </span>';
			// set UTF-8 Unicode font
			$pdf->SetFont('siddhanta', '', 11);
			// output the HTML content
			$pdf->writeHTML($html, true, 0, true, true);
			$liney = $liney+15;
			$signdata = $sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,110,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);


			$pdf->multicell(15,10,'सही',0,'L',false,1,125,$liney,true,0,false,true,10);
			$liney = $liney+20;
			$pdf->multicell(100,10,'मॅनेजर जय भवानी सर्व सेवा संघ (ट्रस्ट), भवानीनगर',0,'L',false,1,125,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$name_unicode,0,'L',false,1,125,$liney+7,true,0,false,true,10);
			//$liney = $liney+7;
			//$pdf->multicell(100,10,'श्री छत्रपति सह.सा.का.लि.',0,'L',false,1,125,$liney,true,0,false,true,10);
		}
    }

    function contracttransportdetail(&$connection,$contractid)
    {
        $contracttransportdetail1 = new contracttransportdetail($connection);
        $query = "select d.contracttransportdetailid from contract c,contracttransportdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contracttransportdetail1->fetch($row['CONTRACTTRANSPORTDETAILID']);
            return $contracttransportdetail1;
        }
    }

    function contractharvestdetail(&$connection,$contractid)
    {
        $contractharvestdetail1 = new contractharvestdetail($connection);
        $query = "select d.contractharvestdetailid from contract c,contractharvestdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractharvestdetail1->fetch($row['CONTRACTHARVESTDETAILID']);
            return $contractharvestdetail1;
        }
    }

    function contracttransporttrailerdetail(&$connection,$contracttransportdetailid,$sequencenumber)
    {
        $contracttransporttrailerdetail1 = new contracttransporttrailerdetail($connection);
        $query = "select t.contracttransporttrailerdetailid from contract c,contracttransportdetail d, contracttransporttrailerdetail t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.contracttransportdetailid=t.contracttransportdetailid and t.contracttransportdetailid=".$contracttransportdetailid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contracttransporttrailerdetail1->fetch($row['CONTRACTTRANSPORTTRAILERDETAILID']);
                return $contracttransporttrailerdetail1;
                exit;
            }
            else
            {
                $i++;	
            }
        }
    }

    function contractperformancedetail(&$connection,$contractid)
    {
        $contractperformancedetail1 = new contractperformancedetail($connection);
        $query = "select d.contractperformancedetailid from contract c,contractperformancedetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractperformancedetail1->fetch($row['CONTRACTPERFORMANCEDETAILID']);
            return $contractperformancedetail1;
        }
    }

    function contractguarantordetail(&$connection,$contractid,$sequencenumber)
    {
        $contractguarantordetail1 = new contractguarantordetail($connection);
        $query = "select d.contractguarantordetailid from contract c,contractguarantordetail d,servicecontractor t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.servicecontractorid=t.servicecontractorid and c.contractid=".$contractid." order by t.servicecontractorcategoryid desc,d.contractguarantordetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractguarantordetail1->fetch($row['CONTRACTGUARANTORDETAILID']);
                return $contractguarantordetail1;
            }
            else
            {
                $i++;
            }
        }
    }
	function contractagriofficername(&$connection,$seasonid)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select agriofficernameuni from season t where t.active=1 and seasonid =".$seasonid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return $row['AGRIOFFICERNAMEUNI'];
        }
    }
    function contractagriofficersign(&$connection,$seasonid)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select sign from season t where t.active=1 and seasonid =".$seasonid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return $row['SIGN']->load();
        }
    }
	function contracttransportsigndetail(&$connection,$contractid,$sequencenumber)
    {
        $contractsigndetail1 = new contractsigndetail($connection);
        $query = "select d.contractsigndetailid from contract c,contracttransportdetail t,contractsigndetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contracttransportdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=584251658 order by d.contractsigndetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractsigndetail1->fetch($row['CONTRACTSIGNDETAILID']);
                return $contractsigndetail1;
            }
            else
            {
                $i++;
            }
        }
    }
   
}
?>