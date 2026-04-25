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
    include_once("../api_oracle/contractphotodetail_db_oracle.php");
    include_once("../api_oracle/contractfingerprintdetail_db_oracle.php");
    include_once("../api_oracle/contractsigndetail_db_oracle.php");
class contract_10
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
            $liney = 190;
            $pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'हंगाम:'.$contract1->seasonname_unicode,0,'L',false,1,65,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'ट्रक - ट्रॅक्टर / तोडणी व वाहतूकदार करारनामा',0,'L',false,1,65,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $curdate = date('d/m/Y');
			$pdf->multicell(180,10,'आज तारीख '.$curdate.' रोज चे दिवशी मौजे भवानीनगर, ता.इंदापूर, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून घेणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->SetFont('siddhanta', '', 11, '', true);
            $liney = $liney+5;
            $pdf->multicell(100,10,'मा. मॅनेजर / सेक्रेटरी',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट), भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'भवानीनगर, ता.इंदापूर, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $contracttransportdetail1 = new contracttransportdetail($this->connection);
			$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor1 = new servicecontractor($this->connection);
			$servicecontractor1->fetch($contract1->servicecontractorid);
            $servicecontractor11 = new servicecontractor($this->connection);
			$servicecontractor11->fetch($contract1->servicecontractorid,$contract1->contractcategoryid);
            
            $pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून देणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->multicell(25,10,'वय: '.$contract1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'वहातूकदार',0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(37,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
            /* $area1 = new area($this->connection);
			$area1->fetch($contract1->areaid); */
            
            
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(120,10,$servicecontractor1->address_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);

			/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,110,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);
 */
   			$liney = $liney+5;
			$pdf->line(43,$liney,200,$liney);
            $liney = $liney+2;
            //$liney = $liney+10;

            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor11->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+3;
            $pdf->multicell(25,10,'वय: '.$contract1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,'तोडणीदार',0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+3;
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(120,10,$servicecontractor11->address_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(37,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->AddPage();
            $html = '<span style="text-align:justify;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;कारणे करारनामा लिहून देतो की, माझे मालकीचा <u>'.$contracttransportdetail1->transportationvehiclename_unicode.'</u> 
            आहे. माझे <u>'.$contracttransportdetail1->transportationvehiclename_unicode.'</u> चा 
            नंबर <u>'.$contracttransportdetail1->vehiclenumber.'</u> हा आहे. मी या वाहनाने 
            सन <u>'.$contract1->seasonname_unicode.'</u> चे 
गळीत हंगामात तोडणी वाहतूकीचे काम करणेसाठी श्री छत्रपति सहकारी साखर कारखाना लि. भवानीनगर यांचे परिसरात 
येऊन ऊस उत्पादकाकडून त्यांचे ऊसाचे वाहतूकीचे काम मिळवणार आहे. 
तुमचा संघ सेवाभावी ट्रस्ट अाहे. ऊस तोड वाहतुकीचे काम  करणाऱ्यांना 
तुमचा ट्रस्ट मिशनरी म्हणून मदत करीत असतो. ऊस तोडणी वाहतुकीचे काम ऊस उत्पादकाकडून
 मिळवून देण्याचे कामे व माझे तोडणी वाहतुकीचे काम सुरळीत चालावे म्हणून 
 तुम्ही आम्हास मदत / सहकार्य करण्याचे मान्य केले आहे. ज्या ऊस उत्पादकाचे
  ऊस तोडणी वाहतुकीचे काम मी करीन त्यांचेकडून मला त्यांचेशी ठरविलेल्या दराने तोडणी वाहतुकीची रक्कम मिळणार आहे. 
  मी करणार असलेल्या तोडणी वाहतुकीचे कामात तुमचेकडून जी मदत व सहकार्य मिळणार 
  आहे त्यासाठी हा करार तुम्हास लिहून देत आहे.
</span>';
            $pdf->writeHTML($html, true, 0, true, true);
            //$liney = $liney+60;

            /*$pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'कराराच्या शर्ती व अटी',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 11, '', true);*/
			
            $html0 = '<span style="text-align:center;">
<br>कराराच्या शर्ती व अटी<br></span>';
			$html1 = '<span style="text-align:justify;">
१)&nbsp;मी माझा <u>'.$contracttransportdetail1->transportationvehiclename_unicode.'</u> 
घेऊन छत्रपति सहकारी साखर कारखाना लि. भवानीनगर येथे ऊस पुरवठादाराचे ऊसाचे वाहतुकीसाठी चालू हंगामात या कारखान्याच्या 
कार्यक्षेत्रात येईल. ऊस पुरवठादाराकडून ऊस वाहतूकीचे काम मिळवीन. हंगामभर काम मिळवीत राहील.
हंगाम चालू असताना तसेच तो संपण्यापूर्वी वाहतूकीचे काम सोडून अगर अर्धवट टाकून जाणार नाही.<br>
२)&nbsp;चालू गळीत हंगाम कधी सुरु होणार हे कळविण्याचे कामी तुम्ही मला मदत करावी.<br>
३)&nbsp;ज्या ऊस पुरवठादाराचे ऊसाची तोडणी / वाहतूक करायची असेल त्याचे बरोबर मी प्रत्यक्ष बोलणी करून तोडणी / वाहतुकीचा
वेगळा करार करून देईल. त्या कराराप्रमाणे ऊस वाहतूक करून देईल. ऊस पुरवठादाराकडून हे काम 
मिळवण्याचे कामी तुम्ही मला मदत करावी. मदत करणे वा ना करणे ही बाब तुमच्या मर्जीतील व 
सदिच्छेतील राहील.<br>
४)&nbsp;ऊस वाहतूक करण्याचे काम ऊस पुरवठादाराचे आहे, हे मला माहित आहे. गळीत हंगामात ऊस वाहतूकीचे
काम करण्यासाठी आल्यानंतर जर मी ऊस उत्पादकाकडून काम मिळवू शकलो नाही तर त्याची कोणतीही 
जबाबदारी तुमचेवर राहणार नाही.<br>
५)&nbsp;मी केलेल्या ऊस तोडणी वाहतूकीच्या कामाची बिले संबंधीत ऊस पुरवठादाराकडून घेऊन मला वेळोवेळी 
व तुम्ही ठरविलेल्या नियमाप्रमाणे द्यावीत.तोडणी वाहतुक बिलाची रक्कम मला मिळवून देण्याचे कामी 
तुम्ही मदत करावी. ही बाब तुमच्या म‌र्जीतील व सदिच्छेतील राहील.या कामासाठी तुम्हास जो मोबदला 
अगर ख‌र्चासाठी रक्कम दयावयाची ती रक्कम मी व ऊस पुरवठादार मिळून ठरवू.आम्हास मदत देत 
असता तुम्हास झळ लागू देणार नाही. ज्या ऊस पुरवठादाराचे तोडणी वाहतूकीचे काम मी करीन त्याने 
त्याचे ऊसाचे किंमतीमधून कारखान्याने ठरविलेल्या ऊस तोडणी वाहतुकीचे दराप्रमाणे माझी तोडणी 
वाहतूक बिले दयावीत,असे तुम्हास अधिकार पत्र दिलेले असले पाहिजे, अगर तसा करार तुमचे बरोबर 
केलेला असला पाहिजे, त्याची पु‌र्तता ऊस पुरवठादाराकडून करुन देण्यासाठी तुम्हास पुर्ण मदत करीन.</span>';
            $html2 = '<span style="text-align:justify;">
६)&nbsp;मी ऊस पुरवठादाराबरोबर संपूर्ण गळीत हंगामासाठी त्यांना जसजशी तोड मिळेल त्या त्या वेळी ऊस 
वाहतुकीचा करार करील. ऊस पुरवठादारांनाही तुम्ही त्यांचे ऊस तोड वाहतूकीचे कामी सहाय्य व मदत करीत 
असता याची मला / आम्हांला माहिती आहे. ऊस पुरवठादाराची व तुमची फसवणूक व गैरसोय करून गळीत
हंगाम चालू असताना अगर गळीत हंगाम संपण्यापूर्वी वाहतूकीचे काम अर्धवट सोडून जाणार नाही. त्याची खात्री
तुम्ही ऊस पुरवठादारांना देवून मला मदत करावी. त्यामुळेच मला सतत,कायम,अखंड असे ऊस वाहतूकीचे काम
ऊस पुरवठादाराकडून मिळेल.<br>
७)&nbsp;ऊस पुरवठादाराबरोबर मी ऊस वाहतुकीचा जो करार करील, त्यातील अटीप्रमाणे गळीत हंगाम अखेर 
पावेतो माझे वाहतूक कामाचे बिलातून प्रत्येक पेमेंटमधून १०% रक्कम डिपॉझिट म्हणून गळीत हंगाम अखेर
पावेतो तुम्ही कापून ठेवावी. ही डिपॉझिट रक्कम बिनव्याजी राहील. संपूर्ण हंगामभर ऊस तोडणी वाहतूकीचे काम मी 
ज्यावेळी करीन त्यावेळी व गळीत हंगाम संपल्यानंतरच ही रक्कम तुमचेकडून घेण्यास पात्र होईल. गळीत 
हंगाम संपण्यापूर्वी अगर तो चालू असताना मी कारखाना परिसरातून ऊस वाहतूकीचे काम सोडून गेल्यास
ही रक्कम आपोआप जप्त होईल. ती परत मागण्याचा हक्क अगर अधिकार मला राहणार नाही.<br>
८)&nbsp;ऊस पुरवठादाराबरोबर ऊस वाहतुकीचा जो करार करील त्या करारानुसार संबंधीत ऊस पुरवठादाराने जो जो 
मोबदला कबूल केला असेल तो सर्व त्याने तुमचेबरोबर जे करार केले असतील त्यास अनुसरून त्यांचेकडून घेऊन 
मला मिळवून देण्याचे कामी तुम्ही मला मदत करावयाची आहे.<br>
</span>';
            $html3 = '<span style="text-align:justify;">
९)&nbsp;ऊस पुरवठादाराने ऊसाच्या तोडणी वाहतूकीचे कामासाठी त्यांचेकडून साखळ्या, वायररोप वगैरे सामान तुम्ही माझेसाठी 
त्यांचेकडून घेऊन आम्हास द्यावे. प्रत्येक ऊस पुरवठादाराचे ऊस तोड वाहतूक काम संपलेनंतर त्यांचेसाठी व करिता तुमचेकडे प्रत्येक वेळी
हे सामान जमा करून नव्या पुरवठादारासाठी व वतीने तुमचेकडून परत घेऊन दरवेळी हे सामान देण्याघेण्याचा त्रास 
वाचविण्यासाठी गळीत हंगाम संपल्यानंतर अगर वाहतूकीचे काम संपल्यानंतर तुम्हास परत करू. मात्र यामुळे प्रत्येक वेळी
मी हे सामान तुम्हास परत केले व नवीन पुरवठादारासाठी व वतीने तुमचेकडून परत घेतले असे होईल व घडेल असे
गृहीत धरण्यात येईल. हे सामान गहाळ झाल्यास अगर त्याची नुकसान किंवा अफरातफर झाल्यास तुम्ही ठरवाल
तेवढी रक्कम तुम्हास नुकसानभरपाई म्हणून भरून देईन. अशी रक्कम तुम्ही माझे कामाचे बिलातून, डिपॉझिटचे रक्कमेतून 
व कमिशनच्या रकमेतून परस्पर कापून घ्यावी. त्यास मी संमती देत आहे.<br>
१०)&nbsp;माझ्या वाहनाने केलेल्या कामाचे बिल मला अगर मी ज्या वाहतूक कंपनीचा अगर सोसायटीचा सभासद असेल किंवा
त्या कंपनीत अगर सोसायटीत काम करीत असेल त्यांना तुम्ही परस्पर डिपॉझिट कापून घेऊन द्यावे. त्या अन्वये 
तोडणी वाहतूकीचे बिल मला मिळाले असे होईल.<br>
११)&nbsp;मी व ऊस पुरवठादार यांच्यामध्ये ऊस तोडणी वाहतूकीचे कामामधील मतभेद अगर वादविवाद झाल्यास त्या कामी तुम्ही
मध्यस्थी करावी. मध्यस्थ म्हणून तुम्ही दिलेला निर्णय मला मान्य राहील.<br>
१२)&nbsp;ऊस पुरवठादाराकडून मला मिळणारी कमिशनची रक्कम तुमचेकडून गळीत हंगाम संपल्यानंतर घेईल. त्या अगोदर कमिशनची 
रक्कम मागण्याचा अधिकार मला ठेवलेला नाही.<br>
१३)&nbsp;ऊस तोड वाहतूकीचे कामी छत्रपति सहकारी साखर कारखाना लि. भवानीनगर चे कार्यक्षेत्रात 
येण्यासाठी पूर्वतयारीकरिता तसेच वाहतूकीचे काम चालू असताना तुम्ही 
वेळोवेळी जरुरीप्रमाणे व तुमच्या मर्जीनुसार अॅडव्हाॅन्स देऊन मदत करावी. अॅडव्हाॅन्स मागणेचा व तुम्ही मला देणेचा 
हक्क या कराराने निर्माण करणेत आलेला नाही. असा अॅडव्हाॅन्स देण्याचे तुमचेवर कोणतेही बंधन राहणार नाही.<br>
</span>';
            $html4 = '<span style="text-align:justify;">
१४)&nbsp;पूर्व तयारीसाठी तसेच गळीत हंगाम चालू असताना तुमचेकडून जी अॅडव्हाॅन्सची रक्कम घेतली असेल ती माझे होणारे कामाचे 
बिलातून तुम्ही वेळोवेळी कापून घ्यावी. तसा तुम्हास अधिकार दिलेला आहे. अॅडव्हाॅन्स रक्कमेमुळे माझे कामात तुमची मोठी
मदत होणार आहे. गळीत हंगाम अखेर पावेतो वेगवेगळ्या ऊस पुरवठादाराबरोबर ऊस वाहतूकीचे करार करून या
कामाचे बिलातून तुमचेकडून घेतलेल्या अॅडव्हाॅन्स रकमेची मी फेड करील. अॅडव्हाॅन्स घेऊन कारखान्याने परिसरात 
वाहतूकीचे काम करण्यास न आल्यास अगर आल्यानंतर तुमचे अॅडव्हाॅन्सची फेड न होताच गळीत हंगाम संपनेचे आत 
तोडणी वाहतूकीचे काम मिळवण्याचे व करण्याचे सोडून गेल्यास ती बाब मी स्वतः केलेली तुमची फसवणूक ठरेल.
मदत म्हणून ॲडव्हाॅन्स घेऊन कारखाना परिसरात कामावर न येता अगर कामावर आल्याचे दाखवून मध्यंतरी काम 
सोडून देवून ॲडव्हाॅन्स फेडीबाबत तुमची फसवणूक करणार नाही. तसे घडल्यास तुमची मी स्वतः केलेली फसवणूक ठरेल. 
फसवणूकीने व लबाडीने ॲडव्हाॅन्सची रक्कम तुमचेकडून घेतली व मदतीचा गैरफायदा घेतला असे होईल व राहील त्यावेळी 
मी फौजदारी गुन्ह्यास मी पात्र राहील. तुम्हास माझेविरुध्द त्यावेळी फौजदारी गुन्हा केला असल्यामुळे फसवणूक वगैरेचा 
फौजदारी खटला दाखल करता येईल.<br>
१५)&nbsp;तुम्ही जो अॅडव्हाॅन्स द्याल त्याची परतफेड कारखान्याचे ऊस पुरवठादारांनी तोडणी वाहतूक करून अॅडव्हाॅन्स 
रकमेवर १८% प्रमाणे व्याज तुम्हास देईन. व्याजासह अॅडव्हाॅन्स रकमेची फेड माझे बिलातून तुम्ही करून घ्यावी. तशी न झाल्यास 
कोर्टामार्फत माझेकडून वसूल करावी.<br>
१६)&nbsp;ऊस तोड करून कारखान्याने गेटवर पोहचविण्याची जबाबदारी ऊस पुरवठादाराची आहे. असा पुरवठादार 
कारखान्याने ठरविलेल्या दराप्रमाणे ऊस तोड वाहतुकीचा खर्च ऊसाची किंमत म्हणून मिळण्यास पात्र होईल.ऊस तोडणी 
वाहतुकीच्या मिळणाऱ्या खर्चापेक्षा जादा रक्कम मी ऊस उत्पादकाबरोबर केलेल्या कराराप्रमाणे झाल्यास अशी होणारी जादा 
रक्कम ऊस पुरवठादाराकडून मला मिळवून देण्याचे कामी तुम्ही मदत करावी. अशी मदत मला हक्क म्हणून मागता 
येणार नाही. ती बाब तुमच्या मर्जीतील राहील. जादा रक्कम तोडणी वाहतूक करार केलेल्या ऊस पुरवठादाराकडून मी 
परस्पर वसुल करीन.<br>
१७)&nbsp;ऊस पुरवठादाराचे तोडणी वाहतूकीचे काम करीत असताना काही नुकसान आल्यास त्याची भरपाई वा पुरवठादारा 
बरोबर झालेल्या कराराप्रमाणे मी भरपाई करून द्यावयाची आहे. असा प्रसंग आल्यास ही नुकसान भरपाईची रक्कम तुम्ही 
माझे बिलातून, कमिशनचे रकमेतून व डिपॉझिटचे रकमेमधून संबंधीत ऊस पुरवठादारासाठी कापून घ्यावी. या कराराने 
तसा तुम्हास पूर्ण अधिकार व हक्क दिलेला आहे.<br>
</span>';
            $html5 = '<span style="text-align:justify;">
१८)&nbsp;गळीत हंगामामध्ये कामे करीत असताना माझ्या वाहनास काही अपघात झाल्यास त्या अपघाताची कोणतीही 
जबाबदारी तुमचेवर राहणार नाही.<br>
१९)&nbsp;अचानक अनपेक्षित कारणात्सव माझे ऊस वाहतूकीचे काम बंद पडल्यास अगर मला हे काम न मिळाल्यास त्याची 
कोणतीही जबाबदारी तुमचेवर राहणार नाही. माझ्या वाहनाकरीता भरावी लागणारी लायसेन्स फी, रोड टॅक्स, गुडस टॅक्स व 
इतर कायदेशीर कर भरण्याची जबाबदारी माझी राहील.<br>
२०)&nbsp;ज्या ऊस पुरवठादाराकडून मी ऊस तोडणी वाहतूकीचे काम मिळवीन व करार करीन त्याची माहिती तुम्हास वेळोवेळी 
व वेळच्यावेळी देत जाईल.<br>
२१)&nbsp;वाहतूक करार केलेल्या ऊस पुरवठादाराचे ऊसाची तोडणी वाहतूक त्यास ज्यावेळी कारखान्याने दिलेली असेल ती वेळ व 
तारीख ऊस पुरवठादाराच्या वतीने व तर्फे त्याने तसे अधिकार पत्र तुम्हास दिले असल्यास अगर तसा करार तुमचेबरोबर केला 
असल्यास तुम्ही मला कळवावे.<br>
२२)&nbsp;या कराराने तुम्ही आम्हास कोणतेही काम मिळवून देण्याची हमी घेतलेली नाही. फक्त तुम्ही मला मदत अगर 
सहकार्य करावयाचे आहे. तसेच अशी मदत अगर सहाय्य हा तुमच्या मर्जीतील भाग राहणार आहे.<br>
२३)&nbsp;तोडणी वाहतूकीचे कामास येण्यासाठी पूर्व तयारीकरिता म्हणून तसेच गळीत हंगाम संपेपावेतो तुम्ही मर्जीप्रमाणे 
ज्या अॅडव्हाॅन्स रकमा द्याल त्यासाठी व नुकसान भरपाईचे रकमेसाठी दोन लायक जामिन देईन व त्याचा जामिनरोखा या 
कराराचा भाग म्हणून राहील.<br>
२४)&nbsp;आपले संस्थेशी करार केलेनंतर माझे वाहतूकीचे वहानासाठी ८-१० कोयते (ऊस तोडणी मजुर) ठेविन त्यापेक्षा 
कमी कोयते ठेवल्यास आपण पुरवित असलेल्या सवलतीचा फायदा मला मिळणार नाही. याची मला जाणीव आहे. व आपण 
दिलेल्या ॲडन्हान्स रक्कमेवर व्याज आकारलेस त्यास माझी संमती राहील. त्याबाबत मी कोणाकडेही तक्रार करणार नाही.<br>
२५)&nbsp;कारखान्याचे तोडणी प्रोग्रामनुसार व शेतकी खातेच्या सुचनेप्रमाणे ऊस तोडणी वाहतूकीसाठी मला दिलेल्या गट 
बदली प्रमाणे काम न केलेस ती, माझी वैयक्तिक चुक असेल व त्यासाठी मी कारवाईसाठी पात्र राहील.<br>
२६)&nbsp;ऊस तोडणी वहातुकीचे काम करीत असताना माझे ऊस तोडणी मजुरांकडून काही चुक झालेस त्याची सर्वस्वी 
जबाबदारी माझी राहील.याची मला जाणीव आहे.<br>
२७)&nbsp;ऊस वाहतुकीचे काम करीत असताना कारखान्याचे नियोजनाप्रमाणे काम करणे माझ्यावर बंधनकारक राहील. 
माझे ड्रायव्हारने कोणत्याही प्रकारचे गैरवर्तनुक केल्यास ( वजन काटा बंद पाडणे, नंबर नसताना वहाण काटेवर आणणे, 
ट्रेलरमध्ये भरुन आणलेल्या ऊसाची वजने व्यवस्थित न करणे, केनयार्ड सुपरवायझर यांचे सुचनेप्रमाणे काम न करणे, 
इ.) या सर्व चुका माझेवर बंधनकारक राहतील.त्यास मी जबाबदार राहील. व त्याची होणारी नुकसान भरपाई माझे 
तोडणी वाहतूक बिलातून करुन घेणेस माझी संमती राहील.<br>
२८)कारखान्यास दैनंदिन गाळपास अनुसरुन लागणारा ताजा ऊस राचट विरहीत पुरविन. माझे वहाणातील ऊसास पाचट 
आलेस ती माझी जबाबदारी समजुन आपण कराल ती कार्यवाही माझेवर बंधनकारक राहील.<br>
२९)मी करार करते वेळी माझे वाहणावरील तोडणी मुकादमाचा पत्ता  व मोबाईल नंबर देईल. व त्याप्रमाणे माझे 
मुकादमाकडे तोडणी मजुरांची चौकशी करुनच उर्वरीत ॲडव्हान्स मला मिळावा. त्याबद्दल माझी काही तक्रार असणार नाही.<br>
३०)कारखाना सुरु झालेपासुन ५ दिवसाचे आत माझे वाहणावर काम करणार्या मजुरांची नावे व त्यांचे असणारे वय याची माहिती 
विमा उतरविण्यासाठी माझे सहीने ॲाफिसला पोहोच करील नावे न दिल्यास सिझनमध्ये माझे कोयत्यास / ड्रायव्हरला 
काही अपघात झालेस त्याची संपुर्ण जबाबदारी माझेवर राहील. त्यासाठी मी कारखान्यास तोशिष लागु देणार नाही.<br>
३१) माझे व माझे कुटुंबातील आपले  कारखान्यास  दोन किंवा त्यापेक्षा जास्त  करार  आपले कारखान्यास असतील 
तर प्रत्येक करारासाठी ऊस तोडणीसाठी तोडणी मजूर  ठेवीन व वेगवेगळ्या प्लॉटमध्ये ऊस  तोड करेन
कोणत्याही परिस्थिती मध्ये एका टोळीचे पाठीमागे दोन वाहने भरून देणार नाही याची मी  जबाबदारी  घेत  आहे.<br>
३२)कारखान्याकडे ऊस तोडणी वाहतुकीचा करार केलेनंतर   ठरोतीप्रमाणे ८-१०  कोयते (  मजूर )  
यादी एका  ट्रक / ट्रॅक्टर  वाहनासाठी दिलेनंतर  आपण सूचना  दिलेनंतर  वाहनासह  टोळी (  मजूर )  
कारखाना साइटवर कारखाना सुरू होण्याच्या  अगोदर दोन दिवस   हजर  राहील आपले सूचने प्रमाणे  
टोळी ( मजूर )  मुदतीत हजर न केलेस  व त्यामुळे  कारखान्यास आवश्यक तेवढा ऊस पुरवठा न 
झाल्यास होणाऱ्या नुकसानीस आम्हास जबाबदार  धरणेत  येईल.  व कराराप्रमाणे किंवा कारखाना ठरविन 
त्या  दंडास आम्ही  पात्र राहू.<br>
३३) ऊस तोडणी व वाहतूक यंत्रणेतील ड्रायव्हर, कोयते, मजूर मुकादम यांचा विमा मी स्वरकमेने उतरविण. 
या बाबत संपूर्णतः कायदेशीर जबाबदारी माझी राहील. कारखान्यास अपघात व इतर कारणासाठी 
आर्थिक तोषीस लागू  देणार नाही.
३४) माझे  मालकीचे वाहनांसंबंधी चे मूळ कागदपत्रे व इतर कागदपत्रे करार करताना आपणाकडे जमा करून घेण्यास 
माझी काही हरकत नाही व त्यानंतर करार ग्राह्य धरून पेमेंट करण्यात यावे त्यासंबंधी आहे.<br>
३५) मी कारखान्याचे ऊस तोडणी वाहतुकीचे काम नियोजनाप्रमाणे करीन. ट्रक, ट्रॅक्टर मधील  
ऊस कारखान्याचे नियोजनाप्रमाणे खाली करून घेणेस माझी संमती राहील. याबद्दल मी कोणतीही तक्रार करणार 
नाही. तसे  घडल्यास माझा करार व बिलाची रक्कम कपात करण्याची अधिकार कारखान्यास  राहील.  
येणेप्रमाणे  करार स्वखुशीने  लिहून दिला असे. <br>
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
            //$pdf->writeHTML($html6, true, 0, true, true);
            //$liney = $liney+60;
            //$liney = 160;

            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->addpage();
            $liney = 20;
			$pdf->multicell(40,10,'स्थळ: भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$curdate = date('d/m/Y');
            $pdf->multicell(50,10,'दिनांक:'.$curdate,0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            
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

			$pdf->multicell(60,10,'करारनामा लिहून देणार वाहतूकदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(40,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
            //$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
			$liney = $liney+10;

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

			$pdf->multicell(60,10,'करारनामा लिहून देणार तोडणीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(40,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
            //$liney = $liney+5;
            $pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
            $pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
            $pdf->multicell(100,10,$servicecontractor11->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(30,$liney,100,$liney);
            $liney = $liney+2;
			$liney = $liney+10;

			//QRCODE,H : QR-CODE Best error correction
			//$pdf->write2DBarcode('www.swapp.co.in', 'QRCODE,H', 140, 210, 25, 25, $style, 'N');
			//$pdf->Text(140, 205, 'Swapp Software Application');

			$name_unicode = $this->contractagriofficername($this->connection,$contract1->seasonid);
            $sign = $this->contractagriofficersign($this->connection,$contract1->seasonid);
			$signdata = $sign;
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			//$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$signdata,30,$liney+5,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

            $pdf->multicell(60,10,'करारनामा लिहून घेणार',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$pdf->multicell(100,10,'सही',0,'L',false,1,15,$liney,true,0,false,true,10);
			//$liney = $liney+5;
			$pdf->rect(50,$liney,10,10);
            $liney = $liney+14;
			$pdf->multicell(100,10,'नाव:',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->multicell(100,10,$name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
            $liney = $liney+5;
			$pdf->line(30,$liney,100,$liney);
			$liney = $liney+2;
			$pdf->multicell(100,10,'मा. शेतकी अधिकारी सो',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$pdf->multicell(100,10,'श्री छत्रपति सहकारी साखर कारखाना लि. भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
			$liney = $liney+5;

            /* $contractguarantordetail1 = new contractguarantordetail($this->connection);
			$contractguarantordetail1 = $this->contractguarantordetail($this->connection,$contract1->contractid,1);
			$servicecontractor_guarantor1 = new servicecontractor($this->connection);
			$servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);

            /* $area1 = new area($this->connection);
            $area1->fetch($servicecontractor_guarantor1->areaid); */

            /* $contractguarantordetail2 = new contractguarantordetail($this->connection);
			$contractguarantordetail2 = $this->contractguarantordetail($this->connection,$contract1->contractid,2);
			$servicecontractor_guarantor2 = new servicecontractor($this->connection);
			$servicecontractor_guarantor2->fetch($contractguarantordetail2->servicecontractorid);
 */
            /* $area2 = new area($this->connection);
            $area2->fetch($servicecontractor_guarantor2->areaid); */

            /* $contractphotodetail2 = new contractphotodetail($this->connection);
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
			$pdf->Image('@'.$fingerprintdata2,160,$liney,25,25); */ 

            $contractguarantordetail1 = new contractguarantordetail($this->connection);

            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(35,10,'जामीनदार',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            
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
                $contractguarantordetail1 = new contractguarantordetail($this->connection);
                $contractguarantordetail1->fetch($val,1);
                $servicecontractor_guarantor1 = new servicecontractor($this->connection);
                $servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);
                
                $pdf->multicell(35,10,++$i.')जामीनदार',0,'L',false,1,15,$liney,true,0,false,true,10);
                $liney = $liney+5;
                $pdf->rect(70,$liney,10,10);
                $liney = $liney+14;
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


                $contractsigndetail1 = new contractsigndetail($this->connection);
			    $contractsigndetail1 = $this->contractguarantorsigndetail($this->connection,$contract1->contractid,$contractguarantordetail1->servicecontractorid);

                $signdata2 = $contractsigndetail1->sign;
                $pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
                //$pdf->setJPEGQuality(90);
                $pdf->Image('@'.$signdata2,50,$liney-25,60,15,'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
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
            
            $liney = $liney+5;
            $pdf->line(30,$liney,60,$liney);
            $pdf->line(70,$liney,100,$liney);
            $liney = $liney+2;
            $liney = $liney+5;
			
            /* $servicecontractor_ao1 = new servicecontractor($this->connection);
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
			$pdf->multicell(100,10,'श्री छत्रपति सहकारी साखर कारखाना लि.',0,'L',false,1,110,$liney,true,0,false,true,10);
 */
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

    /* function contractguarantorphotodetail(&$connection,$contractid,$sequencenumber)
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
    } */

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

    /* function contractguarantorfingerprintdetail(&$connection,$contractid,$sequencenumber)
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
    } */

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

    function contractguarantorfingerprintdetail(&$connection,$contractid,$guarantorid)
    {
        $contractfingerprintdetail1 = new contractfingerprintdetail($connection);
        //$query = "select d.contractfingerprintdetailid from contract c,contractguarantordetail t,contractfingerprintdetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractguarantordetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=753621495 order by d.contractfingerprintdetailid";
        $query = "select getcontractbyguarantor(c.seasonid,g.servicecontractorid,2) as CONTRACTFINGERPRINTDETAILID
        from contract c,contractguarantordetail g 
        where c.contractid=g.contractid and c.active=1 
        and g.active=1 and g.servicecontractorid=".$guarantorid." and c.contractid=".$contractid;
        $result = oci_parse($connection, $query);             $r = oci_execute($result);
        $i=1;
        if ($row = oci_fetch_array($result,OCI_ASSOC+OCI_RETURN_NULLS))
        {
            $contractfingerprintdetail1->fetch($row['CONTRACTFINGERPRINTDETAILID']);
            return $contractfingerprintdetail1;
        }
    }
   function contractharvestphotodetail(&$connection,$contractid,$sequencenumber)
{
    $contractphotodetail1 = new contractphotodetail($connection);
    $query = "select d.contractphotodetailid from contract c,contractharvestdetail t,contractphotodetail d where c.active=1 and t.active=1 and d.active=1 and c.contractid=t.contractid and c.contractid=d.contractid and t.contractharvestdetailid=d.contractreferencedetailid and c.contractid=".$contractid." and d.contractreferencecategoryid=254156358 order by d.contractphotodetailid";
    $result = oci_parse($connection, $query);             $r = oci_execute($result);
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
    $result = oci_parse($connection, $query);             $r = oci_execute($result);
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
}
?>