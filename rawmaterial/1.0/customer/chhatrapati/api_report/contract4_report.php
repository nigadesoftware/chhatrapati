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
    include_once("../api_oracle/contractnomineedetail_db_oracle.php");
    
    
class contract_4
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
			$pdf->multicell(50,10,'दिनांक:'.$curdate,0,'L',false,1,160,$liney,true,0,false,true,10);
			//$liney = $liney+7;
            $pdf->multicell(70,10,'मा.अध्यक्ष / मॅनेजर,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->multicell(150,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट)',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$contracttransportdetail1 = new contracttransportdetail($this->connection);
			$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor1 = new servicecontractor($this->connection);
			$servicecontractor1->fetch($contract1->servicecontractorid);
            
            $pdf->multicell(100,10,'मी/आम्ही: '.$servicecontractor1->name_unicode,0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(25,10,'वय: '.$contract1->age,0,'L',false,1,130,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'जात: '.$contract1->caste_unicode,0,'L',false,1,152,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,130,$liney);
            $pdf->line(138,$liney,150,$liney);
            $pdf->line(162,$liney,200,$liney);
            $liney = $liney+2;
            /* $area1 = new area($this->connection);
			$area1->fetch($contract1->areaid); */
            $pdf->multicell(10,10,'धंदा:',0,'L',false,1,15,$liney,true,0,false,true,10);
            if ($contract1->contractcategoryid == 521478963)
            {
                $pdf->multicell(30,10,'वहातूकदार',0,'L',false,1,25,$liney,true,0,false,true,10);
            }
            elseif ($contract1->contractcategoryid == 785415263)
            {
                $pdf->multicell(30,10,'बैलगाडी मुकादम',0,'L',false,1,25,$liney,true,0,false,true,10);
            }
            
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,55,$liney,true,0,false,true,10);
			$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,65,$liney,true,0,false,true,10);

			/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,105,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,115,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);
 */
   			$liney = $liney+5;
			$pdf->line(23,$liney,55,$liney);
			$pdf->line(65,$liney,200,$liney);
            //$liney = $liney+7;
            $pdf->SetY($liney-7);
            $contractnomineedetail1 = new contractnomineedetail($this->connection);
			$contractnomineedetail1 = $this->contractnomineedetail($this->connection,$contract1->contractid,1);
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $html = '<span style="text-align:justify;"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			खाली सही करणार / करणारे अर्ज करतो की, मला / अाम्हाला आपण आपले संघाचे नाममात्र सभासद करून घ्यावे. 
			अशी विनंती आहे.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			आपले संघाचे पोटनियमाप्रमाणे मी / अाम्ही दिनांक <u>'.$contract1->applicationdatetime.'</u> 
			रोजी प्रवेश फी बद्दल रुपये एक आणि नाममात्र सभासदत्वासाठी रुपये दहा असे 
			एकूण रुपये अकरा फक्त भरले आहेत.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			आपले संघाचे पोटनियम मी / अाम्ही वाचले आहेत. अगर ते वाचून घेऊन ते मला / अाम्हाला ते मान्य असतील. 
			मला / अाम्हाला नाममात्र सभासद करून घेतल्यास संघाच्या व नंतर वेळोवेळी जरूर तर दुरुस्त 
			होणाऱ्या पोटनियमाप्रमाणे वागण्यास मी / अाम्ही तयार आहे / अाहोत. व त्या नियमाप्रमाणे आपले संघाच्या 
			होणाऱ्या माझ्या / अामच्या सर्व व्यवहाराबद्दल बांधून घेण्याचे मी / अाम्ही कबूल करीत आहे / अाहोत. संघाला काही करार 
			करून द्यावे लागल्यास ते करून देण्यास व बिनतक्रार पाळण्यास मी / अाम्ही बांधलो गेलो आहे / अाहोत. <br />
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;कळावे,</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			मी / अाम्ही माझ्या / अामच्या पश्चात माझे / अामचे करार व्यवहाराचे पुर्ततेसाठी वारस म्हणून 
			श्री.<u>'.$contractnomineedetail1->name_unicode.'</u> यांस नेमून देत आहे / अाहोत.</p></span>';
            $pdf->writeHTML($html, true, 0, true, true);

            $liney = $liney+70;
			/* $pdf->multicell(100,10,'साक्षीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,'नाव: '.$servicecontractor1->name_unicode,0,'L',false,1,100,$liney,true,0,false,true,10);
			*/
            $contractsigndetail1 = new contractsigndetail($this->connection);
			$contractsigndetail1 = $this->contracttransportsigndetail($this->connection,$contract1->contractid,1);
 
			$signdata = $contractsigndetail1->sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,100,$liney-5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

                
            $liney = $liney+5;
			$pdf->line(110,$liney,200,$liney);
			$liney = $liney+2;
            $pdf->multicell(100,10,'१)',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,'अर्जदाराची सही',0,'L',false,1,100,$liney,true,0,false,true,10);
			
            /* $liney = $liney+5;
            $pdf->line(17,$liney,80,$liney);
			$pdf->line(125,$liney,200,$liney);
			$liney = $liney+2;
            $pdf->multicell(100,10,'२)',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->line(17,$liney,80,$liney);
			$liney = $liney+2;
            $pdf->multicell(100,10,'साक्षीदाराची सही',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
   			$pdf->line(15,$liney,200,$liney);
            $liney = $liney+7; */
            $liney = $liney-7;
            $list1 = $contract1->guarantorcontractorlist();
            $i=0;
            foreach ($list1 as $value)
            {
                $val = intval($list1[$i]);
                $contractguarantordetail1 = new contractguarantordetail($this->connection);
                $contractguarantordetail1->fetch($val,1);
                $servicecontractor_guarantor1 = new servicecontractor($this->connection);
                $servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);

                $pdf->multicell(35,10,++$i.')साक्षीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
                    //$liney = $liney+5;
                    $pdf->rect(70,$liney,10,10);
                    $contractsigndetail1 = new contractsigndetail($this->connection);
                    $contractsigndetail1 = $this->contractguarantorsigndetail($this->connection,$contract1->contractid,$servicecontractor_guarantor1->servicecontractorid);
    
                    $signdata2 = $contractsigndetail1->sign;
                    $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                    //$pdf->setJPEGQuality(90);
                    $pdf->Image('@'.$signdata2,20,$liney,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
                    $liney = $liney+14;
                    $pdf->multicell(60,10,'सही',0,'L',false,1,70,$liney,true,0,false,true,10);
                    $liney = $liney+5;
                    $pdf->multicell(35,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
                    $pdf->multicell(100,10,$servicecontractor_guarantor1->name_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);
                    $pdf->multicell(35,10,'जामीनदार '.$i.':',0,'L',false,1,100,$liney,true,0,false,true,10);
                    $pdf->multicell(100,10,$servicecontractor_guarantor1->name_unicode,0,'L',false,1,125,$liney,true,0,false,true,10);
                    $pdf->multicell(60,10,'सही',0,'L',false,1,170,$liney,true,0,false,true,10);
                    $pdf->line(170,$liney,200,$liney);
                    $liney = $liney+5;
                
                
            /*     $liney = $liney+5;
                $pdf->line(40,$liney,130,$liney);
                $pdf->line(140,$liney,200,$liney);
                $liney = $liney+2; */
                //$liney = $liney+5;
                $signdata2='';
                //$i++;
            }

            /* $pdf->addpage();
            $liney = 20; */
            $liney = $liney+5;
            $pdf->SetFont('siddhanta', '', 15);
			$pdf->multicell(100,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट)',0,'L',false,1,85,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 12);
	        $pdf->multicell(100,10,'भवानीनगर, ता.बारामती, जि.पुणे',0,'L',false,1,85,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 11);
			/* $area1 = new area($this->connection);
			$area1->fetch($contract1->areaid); */
			
            $pdf->multicell(15,10,'प्रति',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->multicell(15,10,'श्री.',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor1->name_unicode,0,'L',false,1,25,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(25,$liney,200,$liney);
            $liney = $liney+2;
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);

			/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,80,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,90,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,140,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,150,$liney,true,0,false,true,10);
            */
            $liney = $liney+5;
            $pdf->line(30,$liney,200,$liney);
            $liney = $liney+2;
            $pdf->SetY($liney);
            // set UTF-8 Unicode font
			$pdf->SetFont('siddhanta', '', 11);
			$html = '<span style="text-align:justify;">महाशय,<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			संघाच्या नाममात्र सभासदत्ववासाठी आपण केलेला 
			दिनांक <u>'.$contract1->applicationdatetime.'</u> चा 
			अर्ज संघाच्या कार्यकारी मंडळाने दिनांक:&nbsp;&nbsp;/&nbsp;&nbsp;/&nbsp;&nbsp;
			रोजीच्या सभेत मंजुर झाला असुन आपणास संस्थेने नाममात्र सभासदत्व देण्यात आले आहे.</span>';
            // output the HTML content
			$pdf->writeHTML($html, true, 0, true, true);
			$liney = $liney+15;
			$pdf->multicell(100,10,'आपला विश्वासू',0,'L',false,1,125,$liney,true,0,false,true,10);
            $name_unicode = $this->contractmanagername($this->connection,$contract1->seasonid);
            $sign = $this->contractmanagersign($this->connection,$contract1->seasonid);
			$signdata = $sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,110,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

            $liney = $liney+20;
            $pdf->multicell(100,10,'मॅनेजर',0,'L',false,1,135,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$pdf->multicell(100,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट)',0,'L',false,1,115,$liney,true,0,false,true,10);
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

    function contractnomineedetail(&$connection,$contractid,$sequencenumber)
    {
        $contractnomineedetail1 = new contractnomineedetail($connection);
        $query = "select d.contractnomineedetailid from contract c,contractnomineedetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid." order by d.contractnomineedetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractnomineedetail1->fetch($row['CONTRACTNOMINEEDETAILID']);
                return $contractnomineedetail1;
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

    function contractmanagername(&$connection,$seasonid)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select managernameuni from season t where t.active=1 and seasonid =".$seasonid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return $row['AGRIOFFICERNAMEUNI'];
        }
    }
    function contractmanagersign(&$connection,$seasonid)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select managersign from season t where t.active=1 and seasonid =".$seasonid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return $row['MANAGERSIGN']->load();
        }
    }
    function contractguarantorsigndetail(&$connection,$contractid,$guarantorid)
    {
        $contractsigndetail1 = new contractsigndetail($connection);
        //$query = "select d.contractphotodetailid from contract c,contractguarantordetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractphotodetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,3) as CONTRACTSIGNDETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractsigndetail1->fetch($row['CONTRACTSIGNDETAILID']);
            return $contractsigndetail1;
        }
    }
   
}
?>