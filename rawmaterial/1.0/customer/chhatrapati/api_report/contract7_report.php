<?php
    include_once("../api_oracle/contract_db_oracle.php");
	//include_once("../api_oracle/area_db_oracle.php");
	include_once("../api_oracle/contracttransportdetail_db_oracle.php");
	include_once("../api_oracle/contractharvestdetail_db_oracle.php");
	include_once("../api_oracle/contracttransporttrailerdetail_db_oracle.php");
	include_once("../api_oracle/contractguarantordetail_db_oracle.php");
	include_once("../api_oracle/servicecontractor_db_oracle.php");
	include_once("../api_oracle/contractperformancedetail_db_oracle.php");
    include_once("../api_oracle/contractnomineedetail_db_oracle.php");
    include_once("../api_oracle/contractadvancedetail_db_oracle.php");
    include_once("../api_oracle/contractreceiptdetail_db_oracle.php");
    include_once("../api_oracle/contractwitnessdetail_db_oracle.php");
    include_once("../api_oracle/contractphotodetail_db_oracle.php");
    include_once("../api_oracle/contractfingerprintdetail_db_oracle.php");

class contract_7
{	
	public $contractid;
    public $connection;
    
	public function __construct(&$connection)
	{
		$this->connection = $connection;
	}

    function printpageheader(&$pdf,&$liney,$contractid)
    {
    	require("../info/phpsqlajax_dbinfo.php");
    	// Opens a this->connection to a MySQL server
        //$this->connection=mysqli_connect($hostname_rawmaterial, $username_rawmaterial, $password_rawmaterial, $database_rawmaterial);
        // Check this->connection
        /* if (mysqli_connect_errno())
        {
            echo '<span style="background-color:#f44;color:#ff8;text-align:left;">Communication error1</span>';
            exit;
        }
        mysqli_query($this->connection,'SET NAMES UTF8'); */
        //$this->connection = new rawmaterial_connection();
        $contract1 = new contract($this->connection);

		if ($contract1->fetch($contractid))
		{
			$pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'जामिन रोखा',0,'L',false,1,85,$liney,true,0,false,true,10);
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $curdate = date('d/m/Y');
            $liney = $liney+15;
			//$contractguarantordetail1 = new contractguarantordetail($this->connection);
			//$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1);
            /* $servicecontractor_guarantor1 = new servicecontractor($this->connection);
			$servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);
             */
            $contractguarantordetail1 = new contractguarantordetail($this->connection);
            $servicecontractor_guarantor1 = new servicecontractor($this->connection);
            
            $list1 = $contract1->guarantorcontractorlist();
            $i=0;
            foreach ($list1 as $value)
            {
                $val = intval($list1[$i]);
                $contractguarantordetail1->fetch($val,1);
                $servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);
                $pdf->multicell(30,10,'जामीनदार '.++$i.')',0,'L',false,1,15,$liney,true,0,false,true,10);
                $pdf->multicell(100,10,'श्री '.$servicecontractor_guarantor1->name_unicode,0,'L',false,1,40,$liney,true,0,false,true,10);
                $pdf->multicell(25,10,'वय: '.$servicecontractor_guarantor1->age,0,'L',false,1,130,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->line(30,$liney,130,$liney);
                $pdf->line(135,$liney,200,$liney);
                $liney = $liney+2;

                $pdf->multicell(10,10,'धंदा:',0,'L',false,1,15,$liney,true,0,false,true,10);
                $pdf->multicell(50,10,'वहातूकदार',0,'L',false,1,30,$liney,true,0,false,true,10);
                $pdf->multicell(20,10,'मु.पो.:',0,'L',false,1,80,$liney,true,0,false,true,10);
                $pdf->multicell(120,10,$servicecontractor_guarantor1->address_unicode,0,'L',false,1,95,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->line(30,$liney,80,$liney);
                $pdf->line(95,$liney,200,$liney);
                $liney = $liney+2;
            }

            $liney = $liney+15;


            //$contractreceiptdetail1 = new contractreceiptdetail($this->connection);
			//$contractreceiptdetail1 = $this->contractreceiptdetail($this->connection,$contractid,763589425,1);
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $wrdamt = NumberToWords(number_format_indian($contractreceiptdetail1->chequeamount,0,false,false),1);
            $html = '<span style="text-align:justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            कारणे जामिनरोखा लिहून देतो की, वरील वाहतूक करारदार हे कराराप्रमाणे वर्तणूक करतील.
            करार पाळतील, अॅडव्हान्सची रक्कम कबुल केलेप्रमाणे फेड करून देतील, ऊस वाहतूक करारांपोटी दिलेली 
            अॅडव्हान्सची रक्कम व पुढे त्यास जरुरीप्रमाणे तुम्ही जी रक्कम अॅडव्हान्स म्हणून द्याल त्या सर्व रक्कमेची 
            परतफेड करणेची हमी घेऊन आम्ही जामिनदार राहत आहोत. करारदाराने करार मोडला तर नुकसान भरपाई
            म्हणून रक्कम देण्याची जबाबदारी जामिनदार म्हणून आम्ही पत्करीत आहोत.तसेच अॅडव्हान्स रकमेची
            करारदाराने फेड न केल्यास ती रक्कम फेडण्याची जबाबदारी आम्ही पत्करीत आहोत.
            वरील सर्व बाबींसाठी करारदार व आमची जबाबदारी जॉईंट सेव्हरल राहील.
            आम्हा सर्वांकडून अगर तुम्हास वाटेल त्याचे एकाकडून अगर काही जणांकडून ही रक्कम
            वसूल करण्याचा तुम्हास अधिकार राहील. आमचे भरवशावर व 
            जामिनकीवर तुम्ही करारदाराकडून करार करून घेऊन त्यास अॅडव्हान्स दिलेला आहे
            व देणार आहात. करारदारास मिलाफी होऊन तुमचेकडून केवळ अॅडव्हान्स
            उपटणेसाठी आम्ही जामिनदार झालेलो नाही.<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            ऊस वाहतूक करारदार कराराप्रमाणे काम करणेस सहभागीदारासह आला नाही अगर
            अॅडव्हान्सची रक्कम न फेडताच कराराप्रमाणे काम अर्धवट सोडून गेला तर ती करारदार व आम्ही
            सर्वांनी मिळून जाणून बुजुन केलेली मोठी फसवणूक होईल. त्यावेळी करारदाराबरोबर आम्हीही 
            गुन्ह्यास पात्र राहू.</p><p></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            येणे प्रमाणे जामिनपत्र स्वखुशीने लिहून दिले</span>';
            $pdf->writeHTML($html, true, 0, true, true);
            $liney = $liney+80;

			/* $contractwitnessdetail1 = new contractwitnessdetail($this->connection);
			$contractwitnessdetail1 = $this->contractwitnessdetail($this->connection,$contractid,1);
			$servicecontractor_witness1 = new servicecontractor($this->connection);
			$servicecontractor_witness1->fetch($contractwitnessdetail1->witnessid);
             */
            $pdf->SetFont('siddhanta', '', 11);
			
            $pdf->multicell(40,10,'स्थळ: भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
            $curdate = date('d/m/Y');
            $pdf->multicell(50,10,'दिनांक:'.$curdate,0,'L',false,1,15,$liney+10,true,0,false,true,10);
            $liney = $liney+15;
            $list1 = $contract1->guarantorcontractorlist();
            $i=0;
            foreach ($list1 as $value)
            {
                if ($liney+20 >= 260)
				{
					//$pdf->line(15,$liney,200,$liney);
					$liney = 30;
					$pdf->AddPage();
					//$this->printpageheader($pdf,$liney,$date,$saletransactionid);
				}
                $val = intval($list1[$i]);
                $contractguarantordetail1= new contractguarantordetail($this->connection); 
                $contractguarantordetail1->fetch($val,1);
                $servicecontractor_guarantor1 = new servicecontractor($this->connection);
                $servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);
                
                $pdf->multicell(35,10,++$i.')जामिनदार',0,'L',false,1,15,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->rect(70,$liney,10,10);
                $liney = $liney+14;
                $contractsigndetail1 = new contractsigndetail($this->connection);
			    $contractsigndetail1 = $this->contractguarantorsigndetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $signdata2 = $contractsigndetail1->sign;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                //$pdf->setJPEGQuality(90);
                $pdf->Image('@'.$signdata2,20,$liney-20,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
            
                $pdf->multicell(60,10,'सही',0,'L',false,1,70,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->multicell(35,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
                $pdf->multicell(100,10,$servicecontractor_guarantor1->name_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);
                $liney = $liney+5;
                
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

                
                /* $file_pointer = '../fingerprint/bmp/'.$contractfingerprintdetail1->contractfingerprintdetailid.'.bmp';
                if (file_exists($file_pointer)) 
                {
                    $file_pointer1 = '../fingerprint/jpg/'.$contractfingerprintdetail1->contractfingerprintdetailid.'.jpg';
                    if (file_exists($file_pointer1)) 
                    {
                        //$pdf->Image($file_pointer,120,$liney-25,25,25);
                        $pdf->Image($file_pointer1, 130,$liney-25,25,25, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
                    }
                    else
                    {
                        $this->convertImage($file_pointer,$file_pointer1,100);
                    }
                }
                else
                {
                    $pdf->multicell(100,10,$contractfingerprintdetail1->contractfingerprintdetailid,0,'L',false,1,45,$liney-25,true,0,false,true,10);
                } */
                $liney = $liney+5;
            }
			/* $pdf->multicell(30,10,'जामीनदार 2)',0,'L',false,1,70,$liney,true,0,false,true,10);
            $pdf->multicell(10,10,'सही',0,'L',false,1,100,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(100,$liney,200,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'श्री '.$servicecontractor_guarantor2->name_unicode,0,'L',false,1,100,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(100,$liney,200,$liney);
            $liney = $liney+10;

			$pdf->multicell(30,10,'जामीनदार 3)',0,'L',false,1,70,$liney,true,0,false,true,10);
            $pdf->multicell(10,10,'सही',0,'L',false,1,100,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(100,$liney,200,$liney);
            $liney = $liney+2;
			$pdf->multicell(100,10,'श्री '.$servicecontractor_guarantor3->name_unicode,0,'L',false,1,100,$liney,true,0,false,true,10);            
            $liney = $liney+5;
            $pdf->line(100,$liney,200,$liney);
            $liney = $liney+10;
 */
            /*$contractwitnessdetail1 = new contractwitnessdetail($this->connection);
			$contractwitnessdetail1 = contractwitnessdetail($this->connection,$contractid,2);
			$servicecontractor_witness1 = new servicecontractor($this->connection);
			$servicecontractor_witness1->fetch($contractwitnessdetail1->witnessid);

            $pdf->multicell(30,10,'साक्षीदार ',0,'L',false,1,70,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,'श्री '.$servicecontractor_witness1->name_unicode,0,'L',false,1,100,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(100,$liney,200,$liney);
            $liney = $liney+2;
            $pdf->multicell(10,10,'सही',0,'L',false,1,100,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(100,$liney,200,$liney);
            $liney = $liney+2;*/

		}
    }

    function convertImage($originalImage, $outputImage, $quality)
    {
        // jpg, png, gif or bmp?
        $exploded = explode('.',$originalImage);
        $ext = $exploded[count($exploded) - 1]; 

        if (preg_match('/jpg|jpeg/i',$ext))
            $imageTmp=imagecreatefromjpeg($originalImage);
        else if (preg_match('/png/i',$ext))
            $imageTmp=imagecreatefrompng($originalImage);
        else if (preg_match('/gif/i',$ext))
            $imageTmp=imagecreatefromgif($originalImage);
        else if (preg_match('/bmp/i',$ext))
            $imageTmp=imagecreatefromwbmp($originalImage);
        else
            return 0;

        // quality is a value from 0 (worst) to 100 (best)
        imagejpeg($imageTmp, $outputImage, $quality);
        imagedestroy($imageTmp);

        return 1;
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
        $query = "select d.contractnomineedetailid from contract c,contractnomineedetail d,servicecontractor t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.nomineeid=t.servicecontractorid and c.contractid=".$contractid." order by d.contractnomineedetailid";
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

    function contractadvancedetail(&$connection,$contractid,$sequencenumber)
    {
        $contractadvancedetail1 = new contractadvancedetail($connection);
        $query = "select d.contractadvancedetailid from contract c,contractadvancedetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid." order by d.contractadvancedetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractadvancedetail1->fetch($row['CONTRACTADVANCEDETAILID']);
                return $contractadvancedetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractreceiptdetail(&$connection,$contractid,$receiptcategoryid,$sequencenumber)
    {
        $contractreceiptdetail1 = new contractreceiptdetail($connection);
        $query = "select d.contractreceiptdetailid from contract c,contractreceiptdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and d.receiptcategoryid=".$receiptcategoryid." and c.contractid=".$contractid." order by d.contractreceiptdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractreceiptdetail1->fetch($row['CONTRACTRECEIPTDETAILID']);
                return $contractreceiptdetail1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractwitnessdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractwitnessdetail1 = new contractwitnessdetail($connection);
        $query = "select d.contractwitnessdetailid from contract c,contractwitnessdetail d,servicecontractor t where c.active=1 and d.active=1 and t.active=1 and c.contractid=d.contractid and d.witnessid=t.servicecontractorid and c.contractid=".$contractid." order by d.contractwitnessdetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractwitnessdetail1->fetch($row['CONTRACTWITNESSDETAILID']);
                return $contractwitnessdetail1;
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