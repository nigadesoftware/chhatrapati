<?php
    include_once("../api_base/mypdf_a4_p.php");
    include_once("../api_oracle/contract_db_oracle.php");
	include_once("../api_oracle/contracttransportdetail_db_oracle.php");
	include_once("../api_oracle/contractharvestdetail_db_oracle.php");
	include_once("../api_oracle/contractguarantordetail_db_oracle.php");
    include_once("../api_oracle/servicecontractor_db_oracle.php");
    include_once("../api_oracle/servicecontractor_db_oracle.php");
    include_once("../api_oracle/cultivator_db_oracle.php");
	include_once("../api_oracle/contractdocumentdetail_db_oracle.php");
class guarantorchainlist
{	
    public $connection;
    public $liney;
    public $maxlines;
    public $pdf;
    public $seasonid;
    public $contractcategoryid;
    public $fromdate;
    public $todate;

    public function __construct(&$connection,$maxlines)
	{
		$this->connection = $connection;
        $this->maxlines = $maxlines;
        $headerfontname = TCPDF_FONTS::addTTFfont('../tcpdf/fonts/siddhanta.ttf', 'TrueTypeUnicode', '', 96);
	    $fontname1 = TCPDF_FONTS::addTTFfont('../tcpdf/fonts/SakalMarathiNormal9.22.ttf', 'TrueTypeUnicode', '', 32);
    	// create new PDF document
	    $this->pdf = new MYPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
        //$this->pdf = $this->pdf;
        //$this->liney = $this->liney;
        	// set document information
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor(PDF_AUTHOR);
        $this->pdf->SetTitle(PDF_HEADER_TITLE);
        $this->pdf->SetSubject('Guarantor Chain List');
        $this->pdf->SetKeywords('GRCHNLST_000.MR');

        // set font
        // set header and footer fonts
        $this->pdf->setHeaderFont(Array($headerfontname, '', 12));
        $this->pdf->setFooterFont(Array($headerfontname, '', 12));

        $title = str_pad(' ', 30).'भवानीनगर, ता.इंदापूर, जि.पुणे';
    	$this->pdf->SetHeaderData('', 0,str_pad(' ', 21).'जय भवानी सर्व सेवा संघ (ट्रस्ट)' ,$title);
	// set margins
        $this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        // set auto page breaks
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set default monospaced font
        $this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        
        // set auto page breaks
        //$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language dependent data:
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        $lg['a_meta_dir'] = 'ltr';
        $lg['a_meta_language'] = 'mr';
        $lg['w_page'] = 'पान - ';
        // set some language-dependent strings (optional)
	    $this->pdf->setLanguageArray($lg);
	}

	public function isnewpage($projected)
    {
        if ($this->liney+$projected>=$this->maxlines)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function newpage($force=false)
    {
        if ($force==false)
        {
            if ($this->liney >= $this->maxlines)
            {
                $this->pdf->SetLineStyle(array('width' => 0.10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,0,0)));
                $this->pdf->line(15,$this->liney,300,$this->liney);
                $this->liney = 20;
                $this->pdf->AddPage();
                // set color for background
                $this->pdf->SetFillColor(0, 0, 0);
                // set color for text
                $this->pdf->SetTextColor(0, 0, 0);
                $this->pageheader();
            }
        }
        else
        {
            $this->pdf->SetLineStyle(array('width' => 0.10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 1, 'color' => array(0,0,0)));
            $this->pdf->line(15,$this->liney,300,$this->liney);
            $this->liney = 20;
            $this->pdf->AddPage();
            // set color for background
            $this->pdf->SetFillColor(0, 0, 0);
            // set color for text
            $this->pdf->SetTextColor(0, 0, 0);
            $this->pageheader();
        }
    }
    function endreport()
    {
        // reset pointer to the last page*/
	    $this->pdf->lastPage();

        // ---------------------------------------------------------

        //Close and output PDF document
        $this->pdf->Output('GUARCHNLST_000.pdf', 'I');
    }
	function pageheader()
    {
		$this->pdf->SetFont('siddhanta', '', 14, '', true);
    	/* $title = 'जामिनदार यादी';
    	//$row['entityvoucherseriesname'];
    	//$this->pdf->multicell(50,10,$title,0,'C',false,1,0,$this->liney,true,0,false,true,10);
        $this->pdf->Cell(0, 15, $title, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        */ $this->liney = $this->liney+10;
    	// set font
		$this->pdf->SetFont('siddhanta', '', 12, '', true);

    	$this->pdf->SetLineStyle(array('width' => 0.10, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0,0,0)));

    	$this->pdf->line(15,$this->liney,200,$this->liney);
    	//$this->pdf->line(200,$this->liney,200,$this->liney+245);
        $this->pdf->multicell(25,10,'कंत्राट नं',0,'L',false,1,15,$this->liney,true,0,false,true,10);
		$this->pdf->multicell(25,10,'कं.दिनांक',0,'L',false,1,40,$this->liney,true,0,false,true,10);
        $this->pdf->multicell(25,10,'कं.कोड',0,'L',false,1,65,$this->liney,true,0,false,true,10);
		$this->pdf->multicell(60,10,'कंत्राटदार नाव',0,'L',false,1,90,$this->liney,true,0,false,true,10);
        $this->pdf->multicell(10,10,'ठसा',0,'L',false,1,150,$this->liney,true,0,false,true,10);
        $this->pdf->multicell(12,10,'फोटो',0,'L',false,1,170,$this->liney,true,0,false,true,10);
        
        $this->liney = $this->liney+7;
        $this->pdf->line(15,$this->liney,200,$this->liney);
        $this->liney = $this->liney+3;
    }

	function detail()
    {
        $contract1 = new contract($this->connection);
        $query = "select c.contractid from contract c,vw_complete_chain h 
        where c.active=1 and c.seasonid = ".$this->seasonid." 
        and c.contractcategoryid = ".$this->contractcategoryid." 
        and contractdatetime>='".$this->fromdate."' and contractdatetime<='".$this->todate."' 
        and c.contractid=h.contractid
        order by h.contractchainno,contractnumber";
		$result = oci_parse($this->connection, $query);
        $r = oci_execute($result);
        $p=1;
		while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
		{
            if ($contract1->fetch($row['CONTRACTID']))
            {
                if ($p++ == 1)
                {
                    $dt1= DateTime::createFromFormat('d-M-Y',$this->fromdate)->format('d/m/Y');
                    $dt2= DateTime::createFromFormat('d-M-Y',$this->todate)->format('d/m/Y');
                    $title = 'हंगाम '.$contract1->seasonname_unicode.' '.$contract1->contractcategoryname_unicode.' कंत्राटदार जामिनदार यादी कालावधी '.$dt1.' ते '.$dt2;
                    //$row['entityvoucherseriesname'];
                    $this->pdf->SetFont('siddhanta', '', 13, '', true);
                    $this->pdf->multicell(250,10,$title,0,'L',false,1,15,$this->liney-18,true,0,false,true,10);
                }
                if ($this->isnewpage(0))
                {
                    $this->newpage();
                }
                /* $title = '';
                $this->pdf->multicell(35,10,$title,0,'L',false,1,85,$this->liney,true,0,false,true,10);
                $this->liney = $this->liney+5;
                $this->pdf->multicell(200,30,'गाळप हंगाम '.$contract1->seasonname_unicode.' करीता ऊस तोडणी वाहतूक करारासाठी आवश्यक असलेल्या कागदपत्रांची व इतर सर्व साधारण माहिती',0,'L',false,1,15,$this->liney,true,0,false,true,20);
                $this->liney = $this->liney+17; */
                $this->pdf->SetFont('siddhanta', '', 12, '', true);
                
                $contracttransportdetail1 = new contracttransportdetail($this->connection);
                $contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
                $servicecontractor1 = new servicecontractor($this->connection);
                $servicecontractor1->fetch($contract1->servicecontractorid);
                $contractharvestdetail1 = new contractharvestdetail($this->connection);
                $contractharvestdetail1 = $this->contractharvestdetail($this->connection,$contract1->contractid);
                if ($contract1->contractcategoryid == 521478963 or $contract1->contractcategoryid == 785415263)
                {
                    $this->pdf->SetFont('siddhanta', '', 11, '', true);
                    $this->pdf->multicell(25,10,$contract1->contractnumber,0,'L',false,1,15,$this->liney,true,0,false,true,10);
                    //$dt = date('d/m/Y',strtotime($contract1->contractdatetime));
                    $this->pdf->multicell(25,10,$contract1->contractdatetime,0,'L',false,1,40,$this->liney,true,0,false,true,10);
                    $this->pdf->multicell(25,10,$servicecontractor1->servicecontractorid%10000,0,'L',false,1,65,$this->liney,true,0,false,true,10);
                    $this->pdf->multicell(60,10,$servicecontractor1->name_unicode,0,'L',false,1,90,$this->liney,true,0,false,true,10);
                    $yn=$this->contractorfingerprintuploaded($this->connection,$contract1->contractid);
                    $this->pdf->SetFont('zapfdingbats', '', 11, '', true);
                    if ($yn == 1)
                    {
                        $txt='4';
                        $this->pdf->multicell(10,10,$txt,0,'L',false,1,150,$this->liney,true,0,false,true,10);
                    }
                    else
                    {
                        $txt='5';
                        $this->pdf->multicell(10,10,$txt,0,'L',false,1,150,$this->liney,true,0,false,true,10);
                    }
                    $yn1=$this->contractorphotouploaded($this->connection,$contract1->contractid);
                    if ($yn1 == 1)
                    {
                        $txt='4';
                        $this->pdf->multicell(10,10,$txt,0,'L',false,1,170,$this->liney,true,0,false,true,10);
                    }
                    else
                    {
                        $txt='5';
                        $this->pdf->multicell(10,10,$txt,0,'L',false,1,170,$this->liney,true,0,false,true,10);
                    }
                    $this->pdf->SetFont('siddhanta', '', 11, '', true);
                    $this->liney = $this->liney+7;
                    $contractguarantordetail1 = new contractguarantordetail($this->connection);

                    $cnt = $contract1->gurantorcount(1);
                    $this->pdf->SetFont('siddhanta', '', 11, '', true);
                    /* if ($cnt>0)
                    {
                        $this->pdf->multicell(25,10,'जामिनदार',0,'L',false,1,65,$this->liney,true,0,false,true,10);
                        $this->liney = $this->liney+5;
                    } */
                    for ($i=1;$i<=$cnt;$i++)
                    {
                        $contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1,$i);
                        $this->pdf->SetFont('siddhanta', '', 11, '', true);
                        $guarantorservicecontractor1 = new servicecontractor($this->connection);
                        $guarantorservicecontractor1->fetch($contractguarantordetail1->servicecontractorid);
                        if ($i==1)
                        {
                            $this->pdf->multicell(25,10,$guarantorservicecontractor1->servicecontractorid%10000,0,'L',false,1,15,$this->liney,true,0,false,true,10);
                            $this->pdf->multicell(60,10,$guarantorservicecontractor1->name_unicode,0,'L',false,1,25,$this->liney,true,0,false,true,10);
                        }
                        elseif ($i==2)
                        {
                            $this->pdf->multicell(25,10,$guarantorservicecontractor1->servicecontractorid%10000,0,'L',false,1,75,$this->liney,true,0,false,true,10);
                            $this->pdf->multicell(60,10,$guarantorservicecontractor1->name_unicode,0,'L',false,1,85,$this->liney,true,0,false,true,10);
                        }
                        elseif ($i==3)
                        {
                            $this->pdf->multicell(25,10,$guarantorservicecontractor1->servicecontractorid%10000,0,'L',false,1,135,$this->liney,true,0,false,true,10);
                            $this->pdf->multicell(60,10,$guarantorservicecontractor1->name_unicode,0,'L',false,1,145,$this->liney,true,0,false,true,10);
                        }
                        /* $this->pdf->multicell(25,10,$guarantorservicecontractor1->servicecontractorid%10000,0,'L',false,1,65,$this->liney,true,0,false,true,10);
                        $this->pdf->multicell(60,10,$guarantorservicecontractor1->name_unicode,0,'L',false,1,90,$this->liney,true,0,false,true,10);
                        */ 
                        if ($this->isnewpage(5))
                        {
                            $this->newpage();
                        }
                    }
                    $this->liney = $this->liney+5;
                    $cnt = $contract1->gurantorcount(2);
                    $this->pdf->SetFont('siddhanta', '', 11, '', true);
                    if ($cnt>0)
                    {
                        $this->pdf->multicell(35,10,'क्षेत्र जामिनदार',0,'L',false,1,65,$this->liney,true,0,false,true,10);
                        $this->liney = $this->liney+5;
                    }
                    for ($i=1;$i<=$cnt;$i++)
                    {
                        $contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,2,$i);
                        $this->pdf->SetFont('siddhanta', '', 11, '', true);
                        $guarantorcultivator1 = new cultivator($this->connection);
                        $guarantorcultivator1->fetch($contractguarantordetail1->servicecontractorid);
                        $this->pdf->multicell(25,10,$guarantorcultivator1->cultivatorid,0,'L',false,1,65,$this->liney,true,0,false,true,10);
                        $this->pdf->multicell(60,10,$guarantorcultivator1->name_unicode,0,'L',false,1,90,$this->liney,true,0,false,true,10);
                        if ($this->isnewpage(5))
                        {
                            $this->newpage();
                        }
                        $this->liney = $this->liney+5;
                    }

                }
                $this->pdf->line(15,$this->liney,200,$this->liney);
            }
        }
    }

    function contractorfingerprintuploaded(&$connection,$contractid)
    {
        $query = "select 1 as loaded from contract c,contractfingerprintdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and d.contractreferencecategoryid in (584251658,254156358) and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return true;
        }
        else 
        {
            return false;
        }
    }

    function contractorphotouploaded(&$connection,$contractid)
    {
        $query = "select 1 as loaded from contract c,contractphotodetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and d.contractreferencecategoryid in (584251658,254156358) and c.contractid=".$contractid;
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            return true;
        }
        else 
        {
            return false;
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
}
?>