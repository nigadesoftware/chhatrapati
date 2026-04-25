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
    include_once("../api_oracle/contractmortgagedetail_db_oracle.php");
    include_once("../api_oracle/contractphotodetail_db_oracle.php");
    include_once("../api_oracle/contractfingerprintdetail_db_oracle.php");
    
class contract_21
{	
	public $contractid;
    public $connection;
    
	public function __construct(&$connection)
	{
		$this->connection = $connection;
	}

    function printpageheader(&$pdf,&$liney,$contractid,$contractadvancedetailid)
    {
    	require("../info/phpsqlajax_dbinfo.php");
    	// Opens a this->connection to a MySQL server
        $this->connection=mysqli_connect($hostname_rawmaterial, $username_rawmaterial, $password_rawmaterial, $database_rawmaterial);
        // Check this->connection
        if (mysqli_connect_errno())
        {
            echo '<span style="background-color:#f44;color:#ff8;text-align:left;">Communication error1</span>';
            exit;
        }
        mysqli_query($this->connection,'SET NAMES UTF8');
        $contract1 = new contract($this->connection);

		if ($contract1->fetch($contractid))
		{
            $liney = 190;
            $pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'ट्रक ट्रॅक्टर ऊस तोडणी मजूरासह करारनामा',0,'L',false,1,45,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $curdate = date('d/m/Y');
			$pdf->multicell(180,10,'आज तारीख '.$curdate.' रोज चे दिवशी मौजे भवानीनगर, ता.बारामती, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->multicell(180,10,'मे. नोटरी ऑफिसर --- यांचे समोर आज --- वार  --- माहे  --- इसवी  --- ते दिवसी',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$contracttransportdetail1 = new contracttransportdetail($this->connection);
			$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor_transportor1 = new servicecontractor($this->connection);
			$servicecontractor_transportor1->fetch($contracttransportdetail1->servicecontractorid);
            
			$contractharvestdetail1 = new contractharvestdetail($this->connection);
			$contractharvestdetail1 = $this->contractharvestdetail($this->connection,$contract1->contractid);
			$servicecontractor_harvester1 = new servicecontractor($this->connection);
			$servicecontractor_harvester1->fetch($contractharvestdetail1->servicecontractorid);
			
            $contractreceiptdetail1 = new contractreceiptdetail($this->connection);
			$contractreceiptdetail1 = $this->contractreceiptdetail($this->connection,$contractid,1);
			
			$pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून घेणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor_transportor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->multicell(25,10,'वय: '.$servicecontractor_transportor1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$servicecontractor_transportor1->professionname_unicode,0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(37,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
            $area1 = new area($this->connection);
			$area1->fetch($contract1->areaid);
            
            
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->areaname_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'ता.:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,110,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);

   			$liney = $liney+5;
			$pdf->line(43,$liney,100,$liney);
			$pdf->line(105,$liney,145,$liney);
            $pdf->line(157,$liney,200,$liney);
            $liney = $liney+2;

			$pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून देणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor_harvester1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->multicell(25,10,'वय: '.$servicecontractor_harvester1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$servicecontractor_harvester1->professionname_unicode,0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(37,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
            $area2 = new area($this->connection);
			$area2->fetch($servicecontractor_harvester1->areaid);
            
            
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area2->areaname_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'ता.:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area2->subdistrictname_unicode,0,'L',false,1,110,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area2->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);

   			$liney = $liney+5;
			$pdf->line(43,$liney,100,$liney);
			$pdf->line(105,$liney,145,$liney);
            $pdf->line(157,$liney,200,$liney);
            $liney = $liney+2;
            $liney = $liney+10;

			$contractmortgagedetail1 = new contractmortgagedetail($this->connection);
			$contractmortgagedetail1 = $this->contractmortgagedetail($this->connection,$contractid,1);
			$area3 = new area($this->connection);
			$area3->fetch($contractmortgagedetail1->areaid);

			$contractmortgagedetail2 = new contractmortgagedetail($this->connection);
			$contractmortgagedetail2 = $this->contractmortgagedetail($this->connection,$contractid,2);

			if ($contractmortgagedetail1->propertycategoryid == 248796545)
			{
				$property1 = ' घर मिळकत नंबर - <u>'.$contractmortgagedetail1->propertynumber.'</u>';
			}
			elseif ($contractmortgagedetail1->propertycategoryid == 248796692)
			{
				$property1 = ' शेतजमीन मिळकत गट नंबर - <u>'.$contractmortgagedetail1->propertynumber.'</u>';
			}

			if ($contractmortgagedetail2->propertycategoryid == 248796545)
			{
				$property2 = ' घर मिळकत नंबर - <u>'.$contractmortgagedetail2->propertynumber.'</u>';
			}
			elseif ($contractmortgagedetail2->propertycategoryid == 248796692)
			{
				$property2 = ' शेतजमीन मिळकत गट नंबर - <u>'.$contractmortgagedetail2->propertynumber.'</u>';
			}

			$liney = 20;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->AddPage();
            $html = '<span style="text-align:justify;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;कारणे करारनामा लिहून देतो की,<br>
            ज्या अर्थी :<br>
            प्रस्तुत करारनामा लिहून घेणार यांनी श्री छत्रपति सह. सा.का.लि., भवानीनगर, ता.बारामती, जि.पुणे 
            यांचेशी सन <u>'.$contract1->seasonname_unicode.'</u> या गाळप हंगामासाठी आपला <u>'.$contracttransportdetail1->transportationvehiclename_unicode.'</u> चा 
            नंबर <u>'.$contracttransportdetail1->vehiclenumber.'</u> चा करार करून फक्त ऊस वाहतुकीच्या 
            कामासाठी केलेला आहे. आणि<br>
            ज्या अर्थी :</br>
            प्रस्तुत करारनामा लिहून देणार यांचेकडे ऊस तोडणी / भरणी शेतातील ऊस तोडून वाहून तो वाहनामध्ये भरून 
            देण्याची आवश्यक ती यंत्रणा व मजुर टोळ्या आहेत. सदर मजुर टोळ्यांची आवश्यकता करारनामा लिहुन 
            घेणार यांना असल्याचे लिहून देणार यांना समजले व त्यानुसार उभयता सदर बाबत समक्ष चर्चा व वाटाघाटी होऊन 
            करारनामा लिहून देणार यांनी करारनामा लिहुन घेणार यांना तोडणी मजुर टोळ्या पुरवण्यास मान्यता दिलेली आहे. 
            त्याअर्थी प्रस्तुत करारनामा लिहून देणार व करारनामा लिहुन घेणार यांच्यामध्ये ठरलेल्या शर्ती अटी खालीलप्रमाणे.
            </span>';
            $pdf->writeHTML($html, true, 0, true, true);
            //$liney = $liney+60;

            $html0 = '<span style="text-align:center;">
<br>कराराच्या शर्ती व अटी<br></span>';
			$html1 = '<span style="text-align:justify;">
१)&nbsp;मी माझे मजूर घेऊन श्री छत्रपति सह.सा.का.लि.,भवानीनगर येथे ऊस पुरवठादाराचे ऊसाचे वाहतुकीसाठी चालू हंगामात या कारखान्याच्या 
कार्यक्षेत्रात येईल. ऊस पुरवठादाराकडून ऊस वाहतूकीचे काम मिळवीन. हंगामभर काम मिळवीत राहील.
हंगाम चालू असताना तसेच तो संपण्यापूर्वी तोडणीचे काम सोडून अगर अर्धवट टाकून जाणार नाही.<br>
२)&nbsp;चालू गळीत हंगाम कधी सुरु होणार हे कळविण्याचे कामी तुम्ही मला मदत करावी.<br>
३)&nbsp;ज्या ऊस पुरवठादाराचे ऊसाची वाहतूक करायची असेल त्याचे बरोबर मी प्रत्यक्ष बोलणी करून वाहतुकीचा
वेगळा करार करून देईल. त्या कराराप्रमाणे ऊस वाहतूक करून देईल. ऊस पुरवठादाराकडून हे काम 
मिळवण्याचे कामी तुम्ही मला मदत करावी. मदत करणे वा ना करणे ही बाब तुमच्या मर्जीतील व 
सदिच्छेतील राहील.<br>
४)&nbsp;ऊस तोडणी वाहतूक करण्याचे काम ऊस पुरवठादाराचे आहे, हे मला माहित आहे. गळीत हंगामात तोडणी वाहतूकीचे
काम करण्यासाठी आल्यानंतर जर मी ऊस उत्पादकाकडून काम मिळवू शकलो नाही तर त्याची कोणतीही 
जबाबदारी तुमचेवर राहणार नाही.<br>
५)&nbsp;मी केलेल्या ऊस तोडणीच्या कामाची बिले संबंधीत ऊस पुरवठादाराकडून घेऊन मला वेळोवेळी व तुम्ही
ठरविलेल्या नियमाप्रमाणे द्यावीत. तोडणी बिलाची रक्कम मला मिळवून देण्याचे कामी तुम्ही मदत करावी.
ही बाब तुमच्या मर्जीतील व सदिच्छेतील राहील. या कामासाठी तुम्हास जो मोबदला अगर खर्चासाठी 
रक्कम द्यायची ती रक्कम मी व ऊस पुरवठादार मिळून ठरवू. आम्हास मदत देत असता तुम्हास झळ 
लागू देणार नाही. ज्या ऊस पुरवठादाराचे तोडणीचे काम पुर्ण झालेनंतरच तुमचे वाहनास त्या ठिकाणी काम मिळेल 
तेथे मी तुमच्या सूचनेप्रमाणे माझी मजुर टोळी विना तक्रार हंगाम चालू होऊन संपेपर्यंत कार्यरत ठेवीन.
 </span>';
            $html2 = '<span style="text-align:justify;">
६)&nbsp;मी ऊस पुरवठादाराबरोबर संपूर्ण गळीत हंगामासाठी त्यांना जसजशी तोड मिळेल त्या त्या वेळी ऊस 
तोडणी करील. ऊस पुरवठादारांनाही तुम्ही त्यांचे ऊस तोड वाहतूकीचे कामी सहाय्य व मदत करीत 
असता याची मला / आम्हांला माहिती आहे. ऊस पुरवठादाराची व तुमची फसवणूक व गैरसोय करून गळीत
हंगाम चालू असताना अगर गळीत हंगाम संपण्यापूर्वी तोडणी वाहतूकीचे काम अर्धवट सोडून जाणार नाही. त्याची खात्री
तुम्ही ऊस पुरवठादारांना देवून मला मदत करावी. त्यामुळेच मला सतत,कायम,अखंड असे ऊस तोडणीचे काम
ऊस पुरवठादाराकडून मिळेल. याची मला जाणीव आहे.<br>
७)&nbsp;मी ऊस तोडणीचा जो करार करील, त्यातील अटीप्रमाणे गळीत हंगाम अखेर 
पावेतो माझे तोडणी कामाचे बिलातून प्रत्येक पेमेंटमधून तुमचे मर्जीनुसार रक्कम वसुल करून घ्यावी.
 संपूर्ण हंगामभर ऊस तोडणीचे काम मी 
ज्यावेळी करीन त्यावेळी व गळीत हंगाम संपल्यानंतर तोडणी हिशोब पूर्ण झाल्यानंतर 
उर्वरीत रक्कम मला देय रक्कम तुमचेकडून घेण्यास पात्र होईल. गळीत हंगाम संपण्यापूर्वी 
अगर तो चालू असताना मी कारखाना परिसरातून ऊस तोडणीचे काम सोडून जाणारा नाही.
</span>';
            $html3 = '<span style="text-align:justify;">
८)&nbsp;ऊस पुरवठादाराचे  ऊसाच्या तोडणी वहातुकीचे कामासाठी तुम्ही कारखान्याकडून साखळ्या, वायररोप वगैरे सामान तुम्ही माझेसाठी 
आम्हास द्यावे. त्याची होणारी रक्कम तुम्ही माझे कामाचे बिलातून, डिपॉझिटचे रक्कमेतून 
व कमिशनच्या रकमेमधून परस्पर कापून घ्यावी. त्यास मी संमती देत आहे.<br>
९)&nbsp;ऊस तोडणी कामी श्री छत्रपति सह. सा.का.लि.,भवानीनगर मार्फत श्री छत्रपति सह.सा.का.लि.,भवानीनगर चे कार्यक्षेत्रात येण्यासाठी 
पूर्वतयारीकरिता तसेच वाहतूकीचे काम चालू असताना तुम्ही वेळोवेळी जरुरीप्रमाणे व तुमच्या मर्जीनुसार अॅडव्हान्स देऊन 
मदत करावी अॅडव्हान्स मागणेचा व तुम्ही मला देणेचा हक्क या कराराने निर्माण करणेत आलेला नाही. असा अॅडव्हान्स 
देण्याचे तुमचेवर कोणतेही बंधन राहणार नाही.<br>
१०)&nbsp;मी व ऊस पुरवठादार यांच्यामध्ये तोडणी कामाबाबतीत मतभेद अगर वादविवाद झाल्यास त्या कामी तुम्ही
मध्यस्थी करावी. मध्यस्थ म्हणून तुम्ही दिलेला निर्णय मला मान्य राहील.<br>
</span>';
            $html4 = '<span style="text-align:justify;">
११)&nbsp;पूर्व तयारीसाठी तसेच गळीत हंगाम चालू असताना तुमचेकडून जी अॅडव्हान्सची रक्कम घेतली असेल ती माझे होणारे कामाचे 
बिलातून तुम्ही वेळोवेळी कापून घ्यावी. तसा तुम्हास अधिकार दिलेला आहे. अॅडव्हान्स रक्कमेमुळे माझे कामात तुमची मोठी
मदत होणार आहे. गळीत हंगाम अखेर पावेतो वेगवेगळ्या ऊस पुरवठादाराबरोबर ऊस तोड वाहतूकीचे करार करून या
कामाचे बिलातून तुमचेकडून घेतलेल्या अॅडव्हान्स रक्कमेची मी फेड करील. अॅडव्हान्स घेऊन कारखान्याचे परिसरात 
तोडणी वाहतूकीचे काम करण्यास न आल्यास अगर आल्यानंतर तुमचे अॅडव्हान्सची फेड न होताच गळीत हंगाम संपनेचे आत 
तोडणी वाहतूकीचे काम मिळवण्याचे व करण्याचे सोडून गेल्यास ती बाब मी स्वतः केलेली तुमची फसवणूक ठरेल.मदत म्हणून 
अॅडव्हान्स घेऊन कारखाना परिसरात कामावर न येता अगर कामावर आल्याचे दाखवून मध्यंतरी काम सोडून देवून
अॅडव्हान्स फेडीबाबत तुमची फसवणूक करणार नाही. तसे घडल्यास तुमची मी स्वतः केलेली फसवणूक ठरेल. फसवणूकीने व 
लबाडीने अॅडव्हान्सची रक्कम तुमचेकडून घेतली व मदतीचा गैरफायदा घेतला असे होईल व राहील त्यावेळी मी फौजदारी 
गुन्ह्यास पात्र राहील. तुम्हास माझेविरुद्ध तुम्हांस त्यावेळी फौजदारी गुन्हा केला असल्यामुळे फसवणूक वगैरेचा फौजदारी 
खटला दाखल करता येईल.<br>
१२)&nbsp;तुम्ही जो अॅडव्हान्स द्याल त्याची फेड कारखान्याने ऊस पुरवठादारांची तोडणी वाहतूक करून अॅडव्हान्स रकमेवर १८% प्रमाणे 
व्याज तुम्हास देईन. व्याजासह अॅडव्हान्स रकमेची फेड माझे बिलातून तुम्ही करून घ्यावी. तशी न झाल्यास कोर्टामार्फत 
माझेकडून वसुल करावी.<br>
१३)&nbsp;ऊस पुरवठादाराचे तोडणी काम करीत असताना काही नुकसान आल्यास त्याची भरपाई वा पुरवठादारा बरोबर झालेल्या 
कराराप्रमाणे मी भरपाई करून द्यावयाची आहे. असा प्रसंग आल्यास ही नुकसान भरपाईची रक्कम तुम्ही माझे बिलातून,
कमिशनचे रकमेतून व डिपॉझिटचे रकमेमधून संबंधीत ऊस पुरवठादारासाठी कापून घ्यावी. या कराराने तसा तुम्हास पूर्ण 
अधिकार व हक्क दिलेला आहे.
</span>';
            $html5 = '<span style="text-align:justify;">
१४)&nbsp;गळीत हंगामामध्ये कामे करीत असताना माझ्या वाहनास काही अपघात झाल्यास व त्यामुळे माझी अगर माझ्या मजुरांना 
दुखापत किंवा मयत झाल्यास त्याची सर्व जबाबदारी माझीच राहील त्या अपघाताची कोणतीही जबाबदारी तुमचेवर राहणार नाही.<br>
१५)&nbsp;अचानक अनपेक्षित कारणात्सव माझे ऊस तोडणी काम बंद पडल्यास अगर मला हे काम न मिळाल्यास त्याची 
कोणतीही जबाबदारी तुमचेवर राहणार नाही. मात्र अडव्हांस घेतलेली रक्कम मी तुम्हास परत करेन.<br>
१६)&nbsp;लि.घेणार यांनी, लि. देणार यांना कामापोटी ठरोती नुसार रक्कम <u>Rs'.$contractreceiptdetail1->chequeamount.' 
</u>इतका अॅडव्हान्स चेक/रोखीने नंबर <u>'.$contractreceiptdetail1->chequenumber.'</u> अन्वये <u>'
.$contractreceiptdetail1->bankbranchname_unicode.'</u> बॅंकेवरील 
दिनांक <u>'.$contractreceiptdetail1->chequedatetime.'</u> चा दिलेला आहे. 
तो लि. देणार यांना प्राप्त झालेला असुन ती रक्कम लिहुन देणाऱ्यांना मिळालेली आहे. 
त्या बाबत लिहुन देणाऱ्यांची काहीही तक्रार नाही.<br>
१७)&nbsp;करारनामा लिहुन देणार यांनी लिहुन घेणार यांचे कडून घेतलेल्या उचल रक्कम 
<u>Rs'.$contractreceiptdetail1->chequeamount.'</u> चे सुरक्षिततेपोटी व परतफेडीची हमी 
म्हणुन त्यांचे गाव मौजे <u>'.$area3->areaname_unicode.'</u> तालुका <u>'.$area3->subdistrictname_unicode.
'</u> जि <u>'.$area3->districtname_unicode.'</u> '.$property1.' तसेच '.$property2.' ही 
तारण घाण म्हणुन दिलेली आहे. उचल रक्कम वसुल न झाल्यास लिहुन देणाऱ्यांनी सदर जमिनीची कायदेशीर मार्गाने 
विक्री करून रक्कम वसुल करून घ्यावी. सदर शेत जमिनीवर या करार नाम्यानुसार योग्य तो बोजा दाखल करण्यास लिहुन देणार यांची 
संमती आहे. हा करार लिहुन देणार व लिहुन घेणार यांचा या दोघांवर बंधनकारक राहील.<br>
१८)&nbsp;या कराराने तुम्ही आम्हास कोणतेही काम मिळवून देण्याची हमी घेतलेली नाही. फक्त तुम्ही मला मदत अगर 
सहकार्य करावयाचे आहे. तसेच अशी मदत अगर सहाय्य हा तुमच्या मर्जीतील भाग राहणार आहे.<br>
१९)&nbsp;तोडणी वाहतूकीचे कामास येण्यासाठी पूर्व तयारीकरिता म्हणून तसेच गळीत हंगाम संपेपावेतो तुम्ही मर्जीप्रमाणे 
ज्या अॅडव्हान्स रकमा द्याल त्यासाठी व नुकसान भरपाईचे रकमेसाठी दोन लायक जामिन देईन व त्याचा जामिनरोखा या 
कराराचा भाग म्हणून राहील.<br>
२०)&nbsp;हा करार माझे वरती व माझे जामीनदार व माझे वारसदारांवर बंधनकारक राहील.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;येणे प्रमाणे करार नामा पुर्ण समजुन कोणाच्या ही दडपणास बळी न पडता कोणतेही नशा पान 
न करता पूर्णता अवैध हुशारीने खात्रीने साक्षीदारांचे समक्ष करून दिला आहे.<br>
</span>';
            
            $pdf->SetFont('siddhanta', '', 13, '', true);
			$pdf->writeHTML($html0, true, 0, true, true);
			$pdf->SetFont('siddhanta', '', 11, '', true);
			$pdf->writeHTML($html1, true, 0, true, true);
            //$liney = $liney+60;
            $pdf->writeHTML($html2, true, 0, true, true);
            //$liney = $liney+60;
            $pdf->writeHTML($html3, true, 0, true, true);
            //$liney = $liney+60;
            $pdf->writeHTML($html4, true, 0, true, true);
            //$liney = $liney+60;
            $pdf->writeHTML($html5, true, 0, true, true);
            //$liney = $liney+60;
            $pdf->writeHTML($html6, true, 0, true, true);
            //$liney = $liney+60;
            $pdf->AddPage();
            $liney = 20;
            $pdf->multicell(40,10,'स्थळ: भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$curdate = date('d/m/Y');
            $pdf->multicell(50,10,'दिनांक:'.$curdate,0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+10;

            $contractphotodetail1 = new contractphotodetail($this->connection);
			$contractphotodetail1 = $this->contractharvestphotodetail($this->connection,$contract1->contractid,1);

			$imgdata = $contractphotodetail1->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata,120,$liney,25,25);

			$contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail1 = $this->contractharvestfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata = $contractfingerprintdetail1->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata,160,$liney,25,25);
			

			$pdf->multicell(60,10,'करारनामा लिहून देणार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(40,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
            //$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor_harvester1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
			$liney = $liney+15;

			//QRCODE,H : QR-CODE Best error correction
			//$pdf->write2DBarcode('www.swapp.co.in', 'QRCODE,H', 140, 210, 25, 25, $style, 'N');
			//$pdf->Text(140, 205, 'Swapp Software Application');

            $contractphotodetail11 = new contractphotodetail($this->connection);
			$contractphotodetail11 = $this->contracttransportphotodetail($this->connection,$contract1->contractid,1);

			$imgdata11 = $contractphotodetail11->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata11,120,$liney,25,25);

			$contractfingerprintdetail11 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail11 = $this->contracttransportfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata11 = $contractfingerprintdetail11->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata11,160,$liney,25,25);
            
            $pdf->multicell(60,10,'करारनामा लिहून घेणार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(40,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
            //$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor_transportor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
			$liney = $liney+15;

            $contractguarantordetail1 = new contractguarantordetail($this->connection);
			$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1);
			$servicecontractor_guarantor1 = new servicecontractor($this->connection);
			$servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);

            $area1 = new area($this->connection);
            $area1->fetch($servicecontractor_guarantor1->areaid);

            $contractguarantordetail2 = new contractguarantordetail($this->connection);
			$contractguarantordetail2 = $this->contractguarantordetail($this->connection,$contract1->contractid,2);
			$servicecontractor_guarantor2 = new servicecontractor($this->connection);
			$servicecontractor_guarantor2->fetch($contractguarantordetail2->servicecontractorid);

            $area2 = new area($this->connection);
            $area2->fetch($servicecontractor_guarantor2->areaid);

			/* $pdf->addpage();
            $liney = 20; */
            $contractphotodetail2 = new contractphotodetail($this->connection);
			$contractphotodetail2 = $this->contractguarantorphotodetail($this->connection,$contract1->contractid,1);

			$imgdata2 = $contractphotodetail2->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata2,120,$liney,25,25);

			$contractfingerprintdetail2 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail2 = $this->contractguarantorfingerprintdetail($this->connection,$contract1->contractid,1);

			$fingerprintdata2 = $contractfingerprintdetail2->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata2,160,$liney,25,25);

            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(35,10,'साक्षीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            
            $pdf->multicell(40,10,'१)सही',0,'L',false,1,15,$liney,true,0,false,true,10);
			//$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
			$pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor_guarantor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;

			$pdf->multicell(100,10,'वय:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$servicecontractor_guarantor1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'धंदा:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$servicecontractor_guarantor1->professionname_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'मु.पो.:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$area1->areaname_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            
			$liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'ता.:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$area1->subdistrictname_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,'जि.:',0,'L',false,1,60,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$area1->districtname_unicode,0,'L',false,1,70,$liney,true,0,false,true,10);
            
            $liney = $liney+5;
            $pdf->line(30,$liney,60,$liney);
            $pdf->line(70,$liney,100,$liney);
            $liney = $liney+10;

            $contractphotodetail3 = new contractphotodetail($this->connection);
			$contractphotodetail3 = $this->contractguarantorphotodetail($this->connection,$contract1->contractid,2);

			$imgdata3 = $contractphotodetail3->photo;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata3,120,$liney,25,25);

			$contractfingerprintdetail3 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail3 = $this->contractguarantorfingerprintdetail($this->connection,$contract1->contractid,2);

			$fingerprintdata3 = $contractfingerprintdetail3->fingerprint;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata3,160,$liney,25,25);

            $pdf->multicell(100,10,'२)सही',0,'L',false,1,15,$liney,true,0,false,true,10);
			//$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$servicecontractor_guarantor2->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            

			$pdf->multicell(100,10,'वय:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$servicecontractor_guarantor2->age,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'धंदा:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$servicecontractor_guarantor2->professionname_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'मु.पो.:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$area2->areaname_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
            $pdf->multicell(100,10,'ता.:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$area2->subdistrictname_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,'जि.:',0,'L',false,1,60,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$area2->districtname_unicode,0,'L',false,1,70,$liney,true,0,false,true,10);
            
            $liney = $liney+5;
            $pdf->line(30,$liney,60,$liney);
            $pdf->line(70,$liney,100,$liney);
            $liney = $liney+2;
            $liney = $liney+5;
			
            if ($contract1->contractcategoryid == 521478963 or $contract1->contractcategoryid == 785415263)
            {
                $servicecontractor_ao1 = new servicecontractor($this->connection);
                $servicecontractor_ao1 = $this->contractagriofficerdetail($this->connection);

                $pdf->multicell(60,10,'सही',0,'L',false,1,110,$liney,true,0,false,true,10);
                //$liney = $liney+5;
                $pdf->rect(150,$liney,10,10);
                $liney = $liney+14;
                $pdf->multicell(100,10,'नाव:',0,'L',false,1,110,$liney,true,0,false,true,10);
                $pdf->multicell(100,10,$servicecontractor_ao1->name_unicode,0,'L',false,1,130,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->line(120,$liney,200,$liney);
                $liney = $liney+2;
                $pdf->multicell(100,10,'मुख्य शेतकी अधिकारी',0,'L',false,1,110,$liney,true,0,false,true,10);
                $liney = $liney+7;
                $pdf->multicell(100,10,'श्री छत्रपति सह. सा.का.लि.',0,'L',false,1,110,$liney,true,0,false,true,10);
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

    function contractreceiptdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractreceiptdetail1 = new contractreceiptdetail($connection);
        $query = "select d.contractreceiptdetailid from contract c,contractreceiptdetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid." order by d.contractreceiptdetailid";
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


    function contractguarantorphotodetail(&$connection,$contractid,$sequencenumber)
    {
        $contractphotodetail1 = new contractphotodetail($connection);
        $query = "select d.contractphotodetailid from contract c,contractguarantordetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractphotodetailid";
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

    function contractguarantorfingerprintdetail(&$connection,$contractid,$sequencenumber)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        $query = "select d.contractfingerprintdetailid from contract c,contractguarantordetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractfingerprintdetailid";
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

    function contractmddetail(&$connection)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select t.servicecontractorid from servicecontractor t where t.active=1 and t.servicecontractorcategoryid = 874536268";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $servicecontractor1->fetch($row['SERVICECONTRACTORID']);
                return $servicecontractor1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractagriofficerdetail(&$connection)
    {
        $servicecontractor1 = new servicecontractor($connection);
        $query = "select t.servicecontractorid from servicecontractor t where t.active=1 and t.servicecontractorcategoryid = 439715246";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        $sequencenumber =1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $servicecontractor1->fetch($row['SERVICECONTRACTORID']);
                return $servicecontractor1;
            }
            else
            {
                $i++;
            }
        }
    }

    function contractmortgagedetail(&$connection,$contractid,$sequencenumber)
    {
        $contractmortgagedetail1 = new contractmortgagedetail($connection);
        $query = "select d.contractmortgagedetailid from contract c,contractmortgagedetail d where c.active=1 and d.active=1 and c.contractid=d.contractid and c.contractid=".$contractid." order by d.contractmortgagedetailid";
        $result = oci_parse($this->connection, $query);             $r = oci_execute($result);
        $i=1;
        while ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            if ($i==$sequencenumber)
            {
                $contractmortgagedetail1->fetch($row['CONTRACTMORTGAGEDETAILID']);
                return $contractmortgagedetail1;
            }
            else
            {
                $i++;
            }
        }
    }
    
}
?>