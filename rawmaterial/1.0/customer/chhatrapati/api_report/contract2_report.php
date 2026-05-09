<?php
    include_once("../api_oracle/contract_db_oracle.php");
	////include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contract_db_oracle.php");
	//include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contracttransportdetail_db_oracle.php");
	include_once("../api_oracle/contractharvestdetail_db_oracle.php");
	include_once("../api_oracle/contracttransporttrailerdetail_db_oracle.php");
	include_once("../api_oracle/contractguarantordetail_db_oracle.php");
	include_once("../api_oracle/servicecontractor_db_oracle.php");
	include_once("../api_oracle/contractdocumentdetail_db_oracle.php");
class contract_2
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
			$pdf->SetFont('siddhanta', '', 13, '', true);
			$title = '';
			$pdf->multicell(35,10,$title,0,'L',false,1,85,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$pdf->SetFont('siddhanta', '', 12 , '', true);
			$pdf->multicell(200,30,'गाळप हंगाम '.$contract1->seasonname_unicode.' करीता ऊस तोडणी वाहतूक करार करणे कामी तोडणी वाहतूकदार जामीनदार आणि वाहनांची माहिती खालीलप्रमाणे',0,'L',false,1,15,$liney,true,0,false,true,20);
			$liney = $liney+17;
			$pdf->SetFont('siddhanta', '', 12, '', true);
			$contracttransportdetail1 = new contracttransportdetail($this->connection);
			$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor1 = new servicecontractor($this->connection);
			$servicecontractor1->fetch($contract1->servicecontractorid);
			$contractharvestdetail1 = new contractharvestdetail($this->connection);
			$contractharvestdetail1 = $this->contractharvestdetail($this->connection,$contract1->contractid);
			if ($contract1->contractcategoryid == 521478963)
			{
				$pdf->multicell(60,10,$contract1->contractcategoryname_unicode.' कंत्राटदाराचे नाव :',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(70,10,$servicecontractor1->name_unicode,0,'L',false,1,70,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$liney = $liney+5;
				$pdf->SetLineStyle(array('width' => 0.10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,0,0)));
				$pdf->line(70,$liney,200,$liney);

				$liney = $liney+2;
/* 				$area1 = new area($this->connection);
				$area1->fetch($contract1->areaid); */
				$pdf->multicell(20,10,'मु.पो.:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);

				/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,85,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$area1->subdistrictname_unicode,0,'L',false,1,95,$liney,true,0,false,true,10);

				$pdf->multicell(10,10,'जि.:',0,'L',false,1,140,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,150,$liney,true,0,false,true,10);
 */
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$liney = $liney+5;
				$pdf->line(30,$liney,200,$liney);
/* 				$pdf->line(95,$liney,135,$liney);
				$pdf->line(150,$liney,200,$liney); */
				$liney = $liney+2;

				$pdf->multicell(20,10,'मोबाईल:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$servicecontractor1->contactnumber,0,'L',false,1,30,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'पॅनकार्ड नंबर:',0,'L',false,1,85,$liney,true,0,false,true,10);
				$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(40,10,$servicecontractor1->pannumber,0,'L',false,1,107,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'आधारकार्ड नंबर:',0,'L',false,1,140,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$servicecontractor1->aadharnumber,0,'L',false,1,167,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(30,$liney,80,$liney);
				$pdf->line(107,$liney,135,$liney);
				$pdf->line(167,$liney,200,$liney);
				$liney = $liney+2;

				$pdf->multicell(150,10,'पुणे जिल्हा मध्यवर्ती सहकारी बँक, भवानीनगर खाते नंबर:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$servicecontractor1->bankaccountnumber,0,'L',false,1,110,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(107,$liney,200,$liney);
				$liney = $liney+2;

				
				$pdf->multicell(30,10,'बँकेचे नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(185,10,$contracttransportdetail1->bankbranchname_unicode,0,'L',false,1,40,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(35,$liney,200,$liney);
				$liney = $liney+2;

				//$pdf->multicell(30,10,'चेक क्रमांक:',0,'L',false,1,15,$liney,true,0,false,true,10);
				//$pdf->multicell(40,10,$contracttransportdetail1->chequenumber,0,'L',false,1,40,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(35,$liney,200,$liney);
				$liney = $liney+2;

				$contractphotodetail1 = new contractphotodetail($this->connection);
			$contractphotodetail1 = $this->contracttransportphotodetail($this->connection,$contract1->contractid,1);

			$imgdata = $contractphotodetail1->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata,170,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

			$contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail1 = $this->contracttransportfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata = $contractfingerprintdetail1->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata,130,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

            $contractsigndetail1 = new contractsigndetail($this->connection);
			$contractsigndetail1 = $this->contracttransportsigndetail($this->connection,$contract1->contractid,1);

			$signdata = $contractsigndetail1->sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,30,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

			$liney = $liney+20;

			}
			$liney = $liney+5;

			if ($contract1->contractcategoryid == 521478963 or $contract1->contractcategoryid == 785415263 or $contract1->contractcategoryid == 947845153)
			{
				$servicecontractor1->fetch($contract1->servicecontractorid,$contract1->contractcategoryid);
				if ($contract1->contractcategoryid == 521478963)
				{
					$pdf->multicell(60,10,'तोडणी मुकादमाचे नाव::',0,'L',false,1,15,$liney,true,0,false,true,10);
				}
				elseif ($contract1->contractcategoryid == 947845153)
				{
					$pdf->multicell(60,10,'तोडणी मुकादमाचे नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
				}
				elseif ($contract1->contractcategoryid == 785415263)
				{
					$pdf->multicell(60,10,'बैलगाडी मुकादमाचे नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
				}
				
				$pdf->multicell(70,10,$servicecontractor1->name_unicode,0,'L',false,1,65,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$liney = $liney+5;
				$pdf->SetLineStyle(array('width' => 0.10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,0,0)));
				$pdf->line(50,$liney,200,$liney);

				$liney = $liney+2;
/* 				$area1 = new area($this->connection);
				$area1->fetch($servicecontractor1->areaid); */
				$pdf->multicell(20,10,'मु.पो.:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);

				/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,85,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$area1->subdistrictname_unicode,0,'L',false,1,95,$liney,true,0,false,true,10);

				$pdf->multicell(10,10,'जि.:',0,'L',false,1,140,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,150,$liney,true,0,false,true,10);
 */
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$liney = $liney+5;
				$pdf->line(30,$liney,200,$liney);
/* 				$pdf->line(95,$liney,135,$liney);
				$pdf->line(150,$liney,200,$liney); */
				$liney = $liney+2;

				if ($contract1->contractcategoryid == 785415263)
				{
					$pdf->multicell(40,10,'बैलगाडी करार संख्या:',0,'L',false,1,15,$liney,true,0,false,true,10);
					$pdf->multicell(30,10,$contractharvestdetail1->noofvehicles,0,'L',false,1,55,$liney,true,0,false,true,10);	
					$liney = $liney+5;
					$pdf->line(50,$liney,75,$liney);
					$liney = $liney+2;	
				}
				$pdf->multicell(20,10,'मोबाईल:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$servicecontractor1->contactnumber,0,'L',false,1,30,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'पॅनकार्ड नंबर:',0,'L',false,1,85,$liney,true,0,false,true,10);
				$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(40,10,$servicecontractor1->pannumber,0,'L',false,1,107,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'आधारकार्ड नंबर:',0,'L',false,1,140,$liney,true,0,false,true,10);
				//$pdf->multicell(40,10,$servicecontractor1->aadharnumber,0,'L',false,1,167,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(30,$liney,80,$liney);
				$pdf->line(107,$liney,135,$liney);
				$pdf->line(167,$liney,200,$liney);
				$liney = $liney+2;


				$contractphotodetail1 = new contractphotodetail($this->connection);
			$contractphotodetail1 = $this->contractharvestphotodetail($this->connection,$contract1->contractid,1);

			$imgdata = $contractphotodetail1->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata,170,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

			$contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail1 = $this->contractharvestfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata = $contractfingerprintdetail1->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata,130,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

            $contractsigndetail1 = new contractsigndetail($this->connection);
			//$contractsigndetail1 = $this->contractharvestsigndetail($this->connection,$contract1->contractid,1);

			$signdata = $contractsigndetail1->sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,30,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

			//$liney = $liney+5 ;
			$pdf->SetFont('siddhanta', '', 11, '', true);
			$pdf->multicell(180,10,'वरीलप्रमाणे संपूर्ण माहितीचा करार करून घेतला आहे व तो बरोबर असल्याची खातरजमा केली आहे.   ',0,'L',false,1,20,$liney,true,0,false,true,10);				
			$liney = $liney+15 ;
			$pdf->line(100,$liney-5,200,$liney-5);
			$pdf->SetFont('siddhanta', '', 11, '', true);
			$pdf->multicell(100,10,'हार्वेस्टिंग क्लार्क',0,'L',false,1,140,$liney,true,0,false,true,10);				
			
			/*$pdf->multicell(30,10,'बँकेचे नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(120,10,'पुणे जिल्हा मध्यवर्ती सहकारी बँक, भवानीनगर',0,'L',false,1,40,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(35,$liney,200,$liney);
				$liney = $liney+2;

				$pdf->multicell(30,10,'खाते नंबर:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$servicecontractor1->bankaccountnumber,0,'L',false,1,40,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(35,$liney,200,$liney);
				$liney = $liney+2;*/

				/* $pdf->multicell(30,10,'चेक क्रमांक:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$contractharvestdetail1->chequenumber,0,'L',false,1,40,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(35,$liney,200,$liney); */
			}

			$liney = $liney+7;
			
			if ($contract1->contractcategoryid == 521478963 )
			{
				$pdf->SetFont('siddhanta', '', 14, '', true);
				$pdf->multicell(40,10,'वाहनाबाबत माहिती',0,'L',false,1,85,$liney,true,0,false,true,10);
				$liney = $liney+10;
				$contracttransportdetail1 = new contracttransportdetail($this->connection);
				$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
				
				$pdf->rect(15,$liney,185,40);
				$pdf->line(45,$liney,45,$liney+40);
				$pdf->line(85,$liney,85,$liney+40);
				//$pdf->line(115,$liney,115,$liney+40);
				$pdf->line(145,$liney,145,$liney+40);
				$pdf->line(175,$liney,175,$liney+40);
				
				$pdf->line(15,$liney+10,200,$liney+10);
				$pdf->line(15,$liney+20,200,$liney+20);
				$pdf->line(15,$liney+30,200,$liney+30);

				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'वाहनाचा प्रकार',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,'वाहन क्रमांक',0,'L',false,1,45,$liney,true,0,false,true,10);
				$pdf->multicell(60,10,'वाहन चासी नंबर',0,'L',false,1,85,$liney,true,0,false,true,10);
				//$pdf->multicell(30,10,'विमा भरल्याचा दिनांक',0,'L',false,1,115,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,'आर.सी. झेरॉक्स',0,'L',false,1,145,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,'टी.सी. झेरॉक्स',0,'L',false,1,175,$liney,true,0,false,true,10);

				$pdf->SetFont('siddhanta', '', 11, '', true);

				//$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(30,10,$contracttransportdetail1->transportationvehiclename_unicode,0,'L',false,1,17,$liney+12,true,0,false,true,10);
				$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(40,10,$contracttransportdetail1->vehiclenumber,0,'L',false,1,45,$liney+12,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(60,10,$contracttransportdetail1->rtopassingdatetime,0,'L',false,1,87,$liney+12,true,0,false,true,10);
				//$pdf->multicell(30,10,$contracttransportdetail1->insurancepaiddatetime,0,'L',false,1,117,$liney+12,true,0,false,true,10);
				if ($contracttransportdetail1->isrcattached == 1)
				{
					$isrcattached = 'होय';
				}
				else
				{	
					$isrcattached = 'नाही';
				}
				if ($contracttransportdetail1->istcattached == 1)
				{
					$istcattached = 'होय';
				}
				else
				{	
					$istcattached = 'नाही';
				}
				$pdf->multicell(30,10,$isrcattached,0,'L',false,1,147,$liney+12,true,0,false,true,10);
				$pdf->multicell(30,10,$istcattached,0,'L',false,1,177,$liney+12,true,0,false,true,10);
				
				if ($contracttransportdetail1->transportationvehicleid==248768236)
				{
					$contracttransporttrailerdetail1 = new contracttransporttrailerdetail($this->connection);
					$list2 = $contracttransportdetail1->trailerlist();
					$tlist='';
					$i=1;
					$j=22;
					foreach ($list2 as $value)
					{
						$val = intval($value);
						$contracttransporttrailerdetail1->fetch($val);
						$pdf->multicell(30,10,'ट्रेलर नं.'.$i,0,'L',false,1,17,$liney+$j,true,0,false,true,10);
						$pdf->SetFont('helvetica', '', 11, '', true);
						$pdf->multicell(40,10,$contracttransporttrailerdetail1->trailernumber,0,'L',false,1,45,$liney+$j,true,0,false,true,10);
						$pdf->SetFont('siddhanta', '', 11, '', true);
						$pdf->multicell(60,10,$contracttransporttrailerdetail1->rtopassingdatetime,0,'L',false,1,87,$liney+$j,true,0,false,true,10);
						//$pdf->multicell(30,10,$contracttransporttrailerdetail1->insurancepaiddatetime,0,'L',false,1,117,$liney+$j,true,0,false,true,10);
						if ($contracttransporttrailerdetail1->isrcattached == 1)
						{
							$isrcattached = 'होय';
						}
						else
						{	
							$isrcattached = 'नाही';
						}
						if ($contracttransporttrailerdetail1->istcattached == 1)
						{
							$istcattached = 'होय';
						}
						else
						{	
							$istcattached = 'नाही';
						}
						$pdf->multicell(30,10,$isrcattached,0,'L',false,1,147,$liney+$j,true,0,false,true,10);
						$pdf->multicell(30,10,$istcattached,0,'L',false,1,177,$liney+$j,true,0,false,true,10);
						$j=$j+10;
					}
					$liney = $liney+35;	
					/*$contracttransporttrailerdetail1 = new contracttransporttrailerdetail($this->connection);
					$contracttransporttrailerdetail1 = $this->contracttransporttrailerdetail($this->connection,$contracttransportdetail1->contracttransportdetailid,1);
					$contracttransporttrailerdetail2 = new contracttransporttrailerdetail($this->connection);
					$contracttransporttrailerdetail2 = $this->contracttransporttrailerdetail($this->connection,$contracttransportdetail1->contracttransportdetailid,2);

					$pdf->multicell(30,10,'ट्रेलर नं.१',0,'L',false,1,17,$liney+22,true,0,false,true,10);
					$pdf->SetFont('helvetica', '', 11, '', true);
					$pdf->multicell(40,10,$contracttransporttrailerdetail1->trailernumber,0,'L',false,1,45,$liney+22,true,0,false,true,10);
					$pdf->SetFont('siddhanta', '', 11, '', true);
					$pdf->multicell(30,10,$contracttransporttrailerdetail1->rtopassingdatetime,0,'L',false,1,87,$liney+22,true,0,false,true,10);
					$pdf->multicell(30,10,$contracttransporttrailerdetail1->insurancepaiddatetime,0,'L',false,1,117,$liney+22,true,0,false,true,10);
					if ($contracttransporttrailerdetail1->isrcattached == 1)
					{
						$isrcattached = 'होय';
					}
					else
					{	
						$isrcattached = 'नाही';
					}
					if ($contracttransporttrailerdetail1->istcattached == 1)
					{
						$istcattached = 'होय';
					}
					else
					{	
						$istcattached = 'नाही';
					}
					$pdf->multicell(30,10,$isrcattached,0,'L',false,1,147,$liney+22,true,0,false,true,10);
					$pdf->multicell(30,10,$istcattached,0,'L',false,1,177,$liney+22,true,0,false,true,10);
					
					$pdf->multicell(30,10,'ट्रेलर नं.२',0,'L',false,1,17,$liney+32,true,0,false,true,10);
					$pdf->SetFont('helvetica', '', 11, '', true);
					$pdf->multicell(40,10,$contracttransporttrailerdetail2->trailernumber,0,'L',false,1,45,$liney+32,true,0,false,true,10);
					$pdf->SetFont('siddhanta', '', 11, '', true);
					$pdf->multicell(30,10,$contracttransporttrailerdetail2->rtopassingdatetime,0,'L',false,1,87,$liney+32,true,0,false,true,10);
					$pdf->multicell(30,10,$contracttransporttrailerdetail2->insurancepaiddatetime,0,'L',false,1,117,$liney+32,true,0,false,true,10);
					if ($contracttransporttrailerdetail2->isrcattached == 1)
					{
						$isrcattached = 'होय';
					}
					else
					{	
						$isrcattached = 'नाही';
					}
					if ($contracttransporttrailerdetail2->istcattached == 1)
					{
						$istcattached = 'होय';
					}
					else
					{	
						$istcattached = 'नाही';
					}
					$pdf->multicell(30,10,$isrcattached,0,'L',false,1,147,$liney+32,true,0,false,true,10);
					$pdf->multicell(30,10,$istcattached,0,'L',false,1,177,$liney+32,true,0,false,true,10);
					
					$liney = $liney+7;*/
				}
				else
				{
					$liney = $liney+7;
				}
				/*$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'ट्रेलर नंबर: 1.',0,'L',false,1,75,$liney,true,0,false,true,10);
				$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(40,10,$contracttransporttrailerdetail1->trailernumber,0,'L',false,1,105,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(10,10,'2.',0,'L',false,1,145,$liney,true,0,false,true,10);
				$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(40,10,$contracttransporttrailerdetail2->trailernumber,0,'L',false,1,155,$liney,true,0,false,true,10);*/
				$liney = $liney+5;
			}
			elseif ($contract1->contractcategoryid == 785415263)
			{
				$contractdocumentdetail1 = new contractdocumentdetail($this->connection);
				/* $query = "select d.contractdocumentdetailid from contract c,contractdocumentdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contract1->contractid;
				$result = mysqli_query($this->connection,$query);
				$i=1; */
				$pdf->SetFont('siddhanta', '', 13, '', true);
				$pdf->multicell(100,10,'करारासाठी दाखल केलेली कागदपत्रे',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				/* while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
				{
					$liney=$liney+7;
					$contractdocumentdetail1->fetch($row['CONTRACTDOCUMENTDETAILID']);
					$pdf->multicell(100,10,$i.')'.$contractdocumentdetail1->documentname_unicode.' [√]',0,'L',false,1,30,$liney,true,0,false,true,10);
					$i++;
				} */
				$list2 = $contract1->documentlist();
				$tlist='';
				$i=1;
				$j=22;
				foreach ($list2 as $value)
				{
					$val = intval($value);
					$contractdocumentdetail1->fetch($val);
					$pdf->multicell(100,10,$i.')'.$contractdocumentdetail1->documentname_unicode.' [√]',0,'L',false,1,30,$liney,true,0,false,true,10);
					$i++;
				}
				$liney=$liney+35;
			}
            /* $contractguarantordetail1 = new contractguarantordetail($this->connection);
			$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1,1);
 */
			$contractguarantordetail1 = new contractguarantordetail($this->connection);
			//$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1);

			$pdf->SetFont('siddhanta', '', 14, '', true);
			$liney = $liney+3;
			$pdf->multicell(40,10,'जामीनदार',0,'L',false,1,95,$liney,true,0,false,true,10);
			$liney = $liney+10;
			$cnt = $contract1->gurantorcount(1);
			for ($i=1;$i<=$cnt;$i++)
			{
				if ($liney+20 >= 260)
				{
					//$pdf->line(15,$liney,200,$liney);
					$liney = 30;
					$pdf->AddPage();
					//$this->printpageheader($pdf,$liney,$date,$saletransactionid);
				}
				$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1,$i);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'कोड नंबर:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(30,10,$contractguarantordetail1->servicecontractorid%10000,0,'L',false,1,40,$liney,true,0,false,true,10);
				$pdf->multicell(20,10,'नाव:',0,'L',false,1,85,$liney,true,0,false,true,10);
				$pdf->multicell(50,10,$contractguarantordetail1->servicecontractorname_unicode,0,'L',false,1,95,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(32,$liney,60,$liney);
				$pdf->line(95,$liney,200,$liney);
				$liney = $liney+2;

				$guarantorservicecontractor1 = new servicecontractor($this->connection);
				$guarantorservicecontractor1->fetch($contractguarantordetail1->servicecontractorid);
				$pdf->multicell(20,10,'मु.पो.:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(120,10,$guarantorservicecontractor1->address_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);

				$liney = $liney+5;
				$pdf->line(30,$liney,150,$liney);

				$liney = $liney+2;
				$pdf->multicell(20,10,'मोबाईल:',0,'L',false,1,15,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$contractguarantordetail1->contactnumber,0,'L',false,1,30,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'पॅनकार्ड नंबर:',0,'L',false,1,85,$liney,true,0,false,true,10);
				$pdf->SetFont('helvetica', '', 11, '', true);
				$pdf->multicell(40,10,$contractguarantordetail1->pannumber,0,'L',false,1,107,$liney,true,0,false,true,10);
				$pdf->SetFont('siddhanta', '', 11, '', true);
				$pdf->multicell(30,10,'आधारकार्ड नंबर:',0,'L',false,1,140,$liney,true,0,false,true,10);
				$pdf->multicell(40,10,$contractguarantordetail1->aadharnumber,0,'L',false,1,167,$liney,true,0,false,true,10);
				$liney = $liney+5;
				$pdf->line(30,$liney,80,$liney);
				$pdf->line(107,$liney,135,$liney);
				$pdf->line(167,$liney,200,$liney);
				$liney = $liney+2;
				$liney = $liney+5;
				$liney = $liney+20;

				$contractphotodetail1 = new contractphotodetail($this->connection);
			    $contractphotodetail1 = $this->contractguarantorphotodetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $imgdata2 = $contractphotodetail1->photo;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                $pdf->setJPEGQuality(90);
                $pdf->Image('@'.$imgdata2,170,$liney-25,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

                $contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
                $contractfingerprintdetail1 = $this->contractguarantorfingerprintdetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $fingerprintdata1 = $contractfingerprintdetail1->fingerprint;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                $pdf->setJPEGQuality(90);
                $pdf->Image('@'.$fingerprintdata1,130,$liney-25,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

				$contractsigndetail1 = new contractsigndetail($this->connection);
                $contractsigndetail1 = $this->contractguarantorsigndetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $signdata1 = $contractsigndetail1->sign;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                //$pdf->setJPEGQuality(90);
                $pdf->Image('@'.$signdata1,30,$liney-25,25,25,'PNG', '', '', true, 150, '', false, false, 1, false, false, false);

			}
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

    function contractguarantordetail(&$connection,$contractid,$category,$sequencenumber)
    {
		$contractguarantordetail1 = new contractguarantordetail($connection);
		if ($category == 1)
		{
			$query = "select d.contractguarantordetailid from contract c,contractguarantordetail d,servicecontractor t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.servicecontractorid=t.servicecontractorid and d.iscultivator=0 and c.contractid=".$contractid." order by d.contractguarantordetailid";
		}
		elseif ($category == 2)
		{
			$query = "select d.contractguarantordetailid from contract c,contractguarantordetail d,cultivator t where c.active=1 and d.active=1 and c.contractid=d.contractid and d.servicecontractorid=t.cultivatorid and d.iscultivator=1 and c.contractid=".$contractid." order by d.contractguarantordetailid";
		}
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractguarantordetail1->fetch($row['CONTRACTGUARANTORDETAILID'],$category);
                return $contractguarantordetail1;
            }
            else
            {
                $i++;
            }
        }
    }

	function contracttransportphotodetail(&$connection,$contractid,$sequencenumber)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        $query = "select d.contractphotodetailid from contract c,contracttransportdetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contracttransportdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=584251658 order by d.contractphotodetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
                return $contractphotodetail1;
            }
            else
            {
                $i++;
            }
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
	function contracttransportfingerprintdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        $query = "select d.contractfingerprintdetailid from contract c,contracttransportdetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contracttransportdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=584251658 order by d.contractfingerprintdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
                return $contractfingerprintdetail1;
            }
            else
            {
                $i++;
            }
        }
    }

	function contractharvestphotodetail(&$connection,$contractid,$sequencenumber)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        $query = "select d.contractphotodetailid from contract c,contractharvestdetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractharvestdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=254156358 order by d.contractphotodetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
                return $contractphotodetail1;
            }
            else
            {
                $i++;
            }
        }
    }
    
	function contractharvestfingerprintdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        $query = "select d.contractfingerprintdetailid from contract c,contractharvestdetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractharvestdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=254156358 order by d.contractfingerprintdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
                return $contractfingerprintdetail1;
            }
            else
            {
                $i++;
            }
        }
    }

	function contractguarantorphotodetail(&$connection,$contractid,$guarantorid)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        //$query = "select d.contractphotodetailid from contract c,contractguarantordetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractphotodetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,1) as CONTRACTPHOTODETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractphotodetail1->fetch($row['CONTRACTPHOTODETAILID']);
            return $contractphotodetail1;
        }
    }

    function contractguarantorfingerprintdetail(&$connection,$contractid,$guarantorid)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        //$query = "select d.contractfingerprintdetailid from contract c,contractguarantordetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractfingerprintdetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,2) as CONTRACTFINGERPRINTDETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
            return $contractfingerprintdetail1;
        }
    }
	function contractguarantorsigndetail(&$connection,$contractid,$guarantorid)
    {
        $contractsigndetail1 = new contractsigndetail($connection);
        //$query = "select d.contractfingerprintdetailid from contract c,contractguarantordetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractfingerprintdetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,3) as CONTRACTSIGNDETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractsigndetail1->fetch($row['CONTRACTSIGNDETAILID']);
            return $contractsigndetail1;
        }
    }
}
?>