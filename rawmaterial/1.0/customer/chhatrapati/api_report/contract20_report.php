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
class contract_20
{	
	public $contractid;
    public $connection;
    
	public function __construct(&$connection)
	{
		$this->connection = $connection;
	}

    function printpageheader(&$pdf,&$liney,$contractid)
    {
    	/* require("../info/phpsqlajax_dbinfo.php");
    	// Opens a this->connection to a MySQL server
        $this->connection=mysqli_connect($hostname_rawmaterial, $username_rawmaterial, $password_rawmaterial, $database_rawmaterial);
        // Check this->connection
        if (mysqli_connect_errno())
        {
            echo '<span style="background-color:#f44;color:#ff8;text-align:left;">Communication error1</span>';
            exit;
        }
        mysqli_query($this->connection,'SET NAMES UTF8'); */
        $contract1 = new contract($this->connection);

		if ($contract1->fetch($contractid))
		{
            $liney = 200;
            $pdf->SetFont('siddhanta', '', 15, '', true);
            $pdf->multicell(150,10,'बैलगाडी तोडणी करारनामा',0,'L',false,1,45,$liney,true,0,false,true,10);
            $liney = $liney+10;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $curdate = date('d/m/Y');
			$pdf->multicell(180,10,'आज तारीख '.$curdate.' रोज चे दिवशी मौजे भवानीनगर, ता.बारामती, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून घेणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$pdf->SetFont('siddhanta', '', 11, '', true);
            $liney = $liney+7;
            $pdf->multicell(100,10,'मा. मॅनेजर / सेक्रेटरी',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->multicell(150,10,'जय भवानी सर्व सेवा संघ (ट्रस्ट), भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            $pdf->multicell(150,10,'भवानीनगर, ता.इंदापूर, जि.पुणे',0,'L',false,1,15,$liney,true,0,false,true,10);
            $liney = $liney+7;
            
			//$contracttransportdetail1 = new contracttransportdetail($this->connection);
			//$contracttransportdetail1 = $this->contracttransportdetail($this->connection,$contract1->contractid);
			$servicecontractor1 = new servicecontractor($this->connection);
			$servicecontractor1->fetch($contract1->servicecontractorid);
			$contractharvestdetail1 = new contractharvestdetail($this->connection);
			$contractharvestdetail1 = $this->contractharvestdetail($this->connection,$contract1->contractid);
            $pdf->SetFont('siddhanta', '', 13, '', true);
            $pdf->multicell(70,10,'लिहून देणार,',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+7;
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->multicell(100,10,'श्री '.$servicecontractor1->name_unicode,0,'L',false,1,30,$liney,true,0,false,true,10);
			$liney = $liney+5;
            $pdf->multicell(25,10,'वय: '.$servicecontractor1->age,0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(10,10,'धंदा:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$servicecontractor1->professionname_unicode,0,'L',false,1,120,$liney,true,0,false,true,10);
            $liney = $liney+5;
            $pdf->line(15,$liney,100,$liney);
            $pdf->line(110,$liney,200,$liney);
            $liney = $liney+2;
           /*  $area1 = new area($this->connection);
			$area1->fetch($contract1->areaid); */
            
            
            $pdf->multicell(15,10,'मु.पो.:',0,'L',false,1,30,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$servicecontractor1->address_unicode,0,'L',false,1,45,$liney,true,0,false,true,10);

			/* $pdf->multicell(10,10,'ता.:',0,'L',false,1,100,$liney,true,0,false,true,10);
			$pdf->multicell(30,10,$area1->subdistrictname_unicode,0,'L',false,1,110,$liney,true,0,false,true,10);

			$pdf->multicell(10,10,'जि.:',0,'L',false,1,150,$liney,true,0,false,true,10);
			$pdf->multicell(40,10,$area1->districtname_unicode,0,'L',false,1,160,$liney,true,0,false,true,10);
 */
   			$liney = $liney+5;
			$pdf->line(43,$liney,100,$liney);
			/* $pdf->line(105,$liney,145,$liney);
            $pdf->line(157,$liney,200,$liney); */
            $liney = $liney+2;
            $liney = $liney+5;
            $pdf->SetFont('siddhanta', '', 13, '', true);
            
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->AddPage();
            $html = '<span style="text-align:justify;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;कारणे करारनामा लिहून देतो की, 
            मी व माझे सहभागीदार जातीने ऊस वाहतूकीचे काम करीत असतो.
            सन <u>'.$contract1->seasonname_unicode.'</u> चे 
हंगामात श्री छत्रपति सहकारी साखर कारखाना लि. भवानीनगर ता. इंदापूर जि. पुणे यांचे 
सभासदांचे व बिगर सभासदांच्या ऊस तोड वाहतूकीइंदापूरचे काम करण्यासाठी 
मौजे भवानीनगर, ता.इंदापूर, जि.पुणे यांचे कार्यक्षेत्र व कार्यक्षेत्राबाहेर
येऊन आम्ही त्या कारखान्यास ऊस पुरवणाऱ्या ऊस उत्पादकांकडून तोडणी वाहतूकीचे काम 
मिळवणार आहोत. हे काम मिळवून देणेचे कामी व पार पाडणेचे कामी
तुम्ही आम्हाला मदत / सहकार्य देणेचे कबूल केलेले आहे. त्यासाठी ज्या ऊस 
उत्पादकाचे तोड वाहतूकीचे काम आम्ही करू, त्यांच्याकडून आम्हाला मोबदला मिळणार आहे.
तुमचेकडून जी मदत व सहकार्य मिळणार आहे, त्यासाठी हा करार मी स्वतः सहभागीदाराचे 
वतीने तुम्हाला लिहून देत आहे. सहभागीदाराचे वतीने त्यासाठी हा करार करून 
देण्यास मला अधिकार आहे.</span>';
            $pdf->writeHTML($html, true, 0, true, true);
			
            $html0 = '<span style="text-align:center;">
<br>कराराच्या शर्ती व अटी<br></span>';

            $html1 = '<span style="text-align:justify;">
१)मी व माझे सहभागीदार <u>'.$contractharvestdetail1->noofvehicles.'</u> 
बैलगाड्या मजुरासह (कोयते) घेऊन, 
श्री छत्रपति सहकारी साखर कारखाना लि. भवानीनगर चे ऊस उत्पादकांचे 
ऊस तोडण्यासाठी चालू हंगामात कारखाना कार्यक्षेत्रात येऊ  व ऊस पुरवठादाराकडून 
तोडणी वाहतूकीचे काम मिळवू / हंगामात कामे मिळवीत राहू, हंगाम कधी सुरु होणार हे 
कळविण्याचे कामी तुम्ही आम्हास मदत करावी. हंगामभर नेमून दिलेले क्षेत्रातील ऊस तोडणी 
व त्याची वाहतूक दररोज मी माझ्या बैलगाड्या व मजूर लावून करीन, प्रत्येक गाडीतून 
कमीतकमी एक टन ऊसाची वाहतूक करीन.<br>
ज्या ऊस उत्पादकाची ऊस तोड वाहतूक करावयाची आहे, त्यांचेबरोबर करार करून 
कराराप्रमाणे त्याचा ऊस तोड वाहतूक करून देऊ हे काम मिळवणेचे कामी तुम्ही आम्हास 
मदत करावयाची आहे. ही बाब तुमचे सदिच्छेतील राहील. ऊस तोडणी व वाहतुकीसाठी 
लागणारे पुरेसे मजूर व बैलगाड्या मी पुरविण व सिझन अखेर पावेतो कायम कार्यरत ठेवण्याची 
व्यवस्था करीन.<br>
२)आम्ही केलेल्या ऊस तोड वाहतूकीचे कामाची बिले तुम्ही त्या त्या ऊस उत्पादकाकडून 
घेऊन आम्हास वेळोवेळी तुम्ही ठरविलेल्या नियमाप्रमाणे देणे कामी मदत करावी ही बाब तुमचे 
सदिच्छेतील राहील. या कामासाठी तुम्ही आम्हास जो मोबदला अगर खर्चासाठी रक्कम 
द्यावयाची ती रक्कम आम्ही व ऊस उत्पादक मिळून ठरवू. आम्हास मदत देत असता 
तुम्हास झळ लागू देणार नाही.<br>
३)तुम्ही दिलेल्या तोडणी प्रोग्रामनुसार नेमुन दिलेल्या ऊस क्षेत्रात दररोज बैलगाड्या व माणसे 
हजर ठेवून ऊस तोडणीचे काम करू. ऊस व्यवस्थित भुईसपाट तोडून साळून त्याच्या एका 
माणसाला उचलता येईल अशा मोठ्या तीन आळ्याने मोळ्या बांधीन. मोळ्या बांधताना 
ऊसास पाचट वाढे, मुळ्या अगर कचरा राहणार नाही याची दक्षता घेऊ.</span>';

$html2 = '<span style="text-align:justify;">४)ऊसाची तोड करीत असताना सर्व पाचट 
गोळा करून मी त्याच्या आठ सरीवर ओळी 
मारीन व त्यात ऊस व खोडक्या जाणार नाहीत याबद्दल दक्षता घेईन व तसे न झाल्यास 
व त्यामुळे सभासदाचे नुकसान झाल्यास त्यांची जबाबदारी माझेवर राहील.<br>
५)ज्या सभासदाचे स्थळात ऊसाची तोड चालू असेल त्या स्थळातील ऊसाचे वाढे भेळे बांधून 
एकत्र करून त्या सभासद मालकास देईन व मला ठरवून दिलेले वाढ्याचे भेळे मी माझ्या गाडीवानासाठी 
ठेवीन. त्यापेक्षा जास्त ठेवणार नाही, मी करारातील कामाचे मुदतीत माझेजवळ असलेल्या (बिनकामाची) 
जनावरांची माहिती देईन किंवा जास्त भाकड जनावरे ठेवणार नाही.<br>
६)हंगाम सुरु होणेचे दिवशी अगर कारखाना ठरवील त्या दिवशी मी व माझे मजूर कामावर हजर 
राहू. ठरविलेल्या दिवशी मी मजुरासह हजर न झाल्यास सदर करार रद्द करण्यास आपणास अधिकार राहील.<br>
७)अनपेक्षित कारणामुळे कारखाना बंद पडल्यास त्याबद्दल नुकसान भरपाई मागणार नाही व तुमचे सूचनेनुसार 
तोड / वाहतूक बंद ठेवीन.<br>
८)मी सरकारी नियमाप्रमाणे दर गाडीस लागणारी लायसेन्स, विमा पॉलिसी काढीन व त्याची फी मी स्वतः देईन.<br>
९)मी कराराचे मुदतीत तोड व वाहतूक सुरु असता प्लॉटमध्ये कायम हजर राहून देखरेख करीन व माझ्या 
देखरेखीखाली फडातून नियमितपणे गाड्या पाठवून देईन.<br>
१०)ऊसाची वाहतूक करीत असता माझे व मजुरांचे हलगर्जीपणामुळे ऊस मालकांच्या ऊसाचे नुकसान झाल्यास 
अगर रस्त्यात बैलगाडी मोडून ऊसाचे नुकसान झाल्यास त्या ऊसाची नुकसान भरपाई मी करून देईन.<br>
११)माझे करारात काम करणारे लोकांकडून ऊसाचे अगर / स्थळाचे शेजारील पिकांचे कोणत्याही प्रकारे नुकसान 
झाल्यास नुकसानीची जबाबदारी माझेवर राहील.
<br>
१२)कराराच्या मुदतीत माझे मजुरास काही अपघात वगैरे झाल्यास त्याची जबाबदारी संपूर्णपणे माझेवर राहील. 
याबाबत संस्थेस कोणत्याही तऱ्हेची तोषीस लागू देणार नाही.माझे जनावरांना व  मजुरांना रोगप्रतिबंधक लस टोचून घेऊन रोग  फैलावणार नाही याबाबत दक्षता  घेईन.</span>';

$html3 = '<span style="text-align:justify;">
१३)आम्ही ऊस उत्पादकांकडून संपूर्ण सिझनसाठी करार करणार आहोत. या करारातील अटीप्रमाणे सिझन अखेर पावेतो आमच्या 
बिलातून १०% रक्कम सिक्युरिटी डिपॉझिट म्हणून कापून घेण्याचा अधिकार ठेवलेला आहे. याप्रमाणे १०% रक्कम 
तुम्ही प्रत्येक बिलाचे वेळी कापून घ्यावी व सिझन संपलेनंतर ती आम्हास परत करावी.<br>
१४)ऊस उत्पादकाबरोबर ऊस तोड वाहतुकीचा आम्ही जो करार केला / करू. या कराराप्रमाणे संबंधीत ऊस उत्पादकाने 
जो जो कामाचा मोबदला कबुल केला असेल तो सर्व त्यांचेकडून घेवून तुम्ही आम्हास मिळवून देणेचे कामी मदत करावयाची आहे.<br>
१५)तुम्ही सांगाल त्या ठिकाणी मी माझ्या मजुराच्या राहण्याची व बैलगाड्या ठेवण्याची व्यवस्था करीन. ऊस उत्पादकाचे कामासाठी 
त्यांचेकडून कोयते, बांबू, चटया वगैरे सामान तुम्ही घेऊन आम्हास पत्र द्यावे. सिझन संपल्यानंतर हे सामान तुम्हास परत करू. 
हे सामान गहाळ झाल्यास अगर त्याची अफरातफर 
झाल्यास तुम्ही ठरवाल  तेवढी रक्कम  नुकसान भरपाई  करून तुम्हास देवू, तुम्ही आमचे बिलातून, डिपॉझिट, बक्षीस, 
कमिशनच्या रकमेतून परस्पर  कापून घ्यावी. त्यास आम्ही संमती देत आहोत.<br>
१६)मी व माझे सहभागीदार यांनी केलेल्या कामाची बिले माझेकडे देण्यात यावीत. माझे सहभागीदारांनी केलेल्या 
कामाच्या प्रमाणात त्यांची वाटणी सहभागीदारांना करून देईन. मजुरांचे व गाडीवानाचे मी हजेरीबुक व हिशोब ठेवीन व 
अधिकारी मागतील त्यावेळी तपासणीसाठी देईन. काही तक्रार असल्यास त्याचे मी परस्पर निवारण करीन. तुम्हास 
तोषीस लागल्यास त्याची भरपाई करून देईन.<br>
१७)आम्ही ज्या ऊस उत्पादकाचे काम करू त्यांचेकडून मिळणारी कमिशनची व मर्जीमधील अगर इच्छेप्रमाणे आमचेसाठी दिलेली 
रक्कम तुमचेकडून सिझन संपल्यानंतर घेऊ. अशी रक्कम हंगाम संपण्यापूर्वी मागणीचा आम्हास अधिकार ठेवला नाही.<br>
१८)तुम्ही टायरच्या गाड्या भाड्याने दिल्यास त्याचे ठरवाल ते भाडे तुम्हास रितसर देवू किंवा आमचे होणारे ऊस तोड 
वाहतूकीचे बिलातून तुम्ही ते परस्पर कापून घ्यावे.</span>';

$html4 = '<span style="text-align:justify;">१९)कामावर येण्यापूर्वी पूर्व तयारीसाठी तुम्ही आम्हास वेळोवेळी व तुमचे मर्जीप्रमाणे अॅडव्हान्स द्यावा. ही 
अॅडव्हान्सची रक्कम आम्ही कामावर आलेनंतर आमचे होणाऱ्या बिलातून वेळोवेळी कापून घेण्याचा तुम्हास 
अधिकार दिलेला आहे. सिझन अखेरोपावेतो वेगवेगळ्या ऊस उत्पादकाबरोबर करार करून ऊस तोड वाहतूकीचे काम करून 
या कामाचे बिलातून तुमचेकडून घेतलेल्या अॅडव्हान्स रकमेची परतफेड करू. अॅडव्हान्स घेवून कामावर न आल्यास अगर कामावर 
आल्यानंतर अॅडव्हान्सची फेड न होताच सिझन संपण्याचे आत श्री छत्रपति सहकारी साखर कारखाना लि. भवानीनगर यांना 
ऊस पुरवठा करणाऱ्या ऊस उत्पादकाकडून मिळणारे काम सोडून गेल्यास ती मी स्वतः केलेली फसवणूक ठरेल. त्यावेळी 
मी फौजदारी गुन्ह्यास पात्र राहीन व होईन. माझ्या विरुद्ध फसवणुकीबाबत फौजदारी फिर्याद अगर दिवाणी दावा करण्याचा 
तुम्हास अधिकार राहील. तुमच्याकडून काम मिळवण्यासाठी अॅडव्हान्स घेवून कामावर न येता अगर कामावर आल्याचे 
दाखवून मध्यंतरी काम अर्धवट सोडून अॅडव्हान्स फेडीबाबत तुमची फसवणूक करणार नाही.<br>
२०)मी जी अॅडव्हान्सची रक्कम तुमचेकडून वेळोवेळी घेईन त्याची परतफेड करण्यास मी व माझे या करारातील जामिनदार 
एकत्र तसेच व संयुक्तरित्या जबाबदार राहतील. कराराप्रमाणे अॅडव्हान्सचे रकमेची फेड न केल्यास अॅडव्हान्स घेतलेल्या 
तारखेपासून रक्कम तुम्हास परत देई पावेतो. कमीतकमी १८% प्रमाणे व्याज देईन. तसेच या खेरीज करार भंग केला म्हणून 
जनरल स्पेशल व लेंडेंड डॅमेज म्हणून उक्ती रक्कम रुपये --- तुम्हास अधिक जादा देईन.<br>
२१)ऊस तोड वाहतूक करून कारखान्याने गेटवर पोहोचविण्याची जबाबदारी ऊस उत्पादकाची आहे. असा ऊस उत्पादक 
कारखान्याने ठरविलेल्या दराप्रमाणे ऊस तोड वाहतुकीचा खर्च ऊसाची किंमत म्हणून मिळण्यास पात्र होईल. 
या मिळणाऱ्या खर्चापेक्षा जादा रक्कम ऊस उत्पादकाबरोबर आम्ही केलेल्या कराराप्रमाणे झाल्यास अशी जादा रक्कम 
तुमचेकडून आम्हास हक्क म्हणून मागता येणार नाही. जादा रक्कम आम्ही करार केलेल्या ऊस उत्पादकाकडून परस्पर 
वसूल करू. ऊस उत्पादकाबरोबर केलेल्या करारातील दराप्रमाणे तुमचेकडून रक्कम मिळणेस आम्ही पात्र राहू, त्यापेक्षा 
जादा रक्कम मागण्याचा आम्हास हक्क राहणार नाही. ही अट आम्हास कबुल आहे.<br>
२२)सदर कराराबाबत तुमचे व आमचे दरम्यान काही वाद निर्माण झाल्यास त्या वादाचा निर्णय कायद्यातील 
तरतुदीप्रमाणे माझेवर बंधनकारक राहील.</span>';

$html5 = '<span style="text-align:justify;">२५)मी संस्थेच्या नियमाप्रमाणे नाममात्र सभासद होणेस कबूल आहे. 
येणेप्रमाणे मी यातील शर्ती व अटी समजावून 
घेवून करारनामा केला आहे.<br>
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
            $pdf->SetFont('siddhanta', '', 11, '', true);
            $pdf->addpage();
            $liney = 20;
			$pdf->multicell(40,10,'स्थळ: भवानीनगर',0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
			$curdate = date('d/m/Y');
            $pdf->multicell(50,10,'दिनांक:'.$curdate,0,'L',false,1,15,$liney,true,0,false,true,10);
			$liney = $liney+5;
            
			$contractphotodetail1 = new contractphotodetail($this->connection);
			$contractphotodetail1 = $this->contractharvestphotodetail($this->connection,$contract1->contractid,1);
            if ($contractphotodetail1->photo != '')
			$imgdata = $contractphotodetail1->photo;
            else
            {
                $contractphotodetail1 = $this->contracttransportphotodetail($this->connection,$contract1->contractid,1);
                $imgdata = $contractphotodetail1->photo;
            }
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$imgdata,170,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

			$contractfingerprintdetail1 = new contractfingerprintdetail($this->connection);
			$contractfingerprintdetail1 = $this->contractharvestfingerprintdetail($this->connection,$contract1->contractid,1);
            if ($contractfingerprintdetail1->fingerprint != '')
			$fingerprintdata = $contractfingerprintdetail1->fingerprint;
            else
            {
                $contractfingerprintdetail1 = $this->contracttransportfingerprintdetail($this->connection,$contract1->contractid,1);
                $fingerprintdata = $contractfingerprintdetail1->fingerprint;
            }
			
			$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );
			$pdf->setJPEGQuality(90);
			$pdf->Image('@'.$fingerprintdata,130,$liney,25,25,'JPG', '', '', true, 150, '', false, false, 1, false, false, false);

			$pdf->multicell(60,10,'करारनामा लिहून देणार',0,'L',false,1,15,$liney,true,0,false,true,10);
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

			//QRCODE,H : QR-CODE Best error correction
			//$pdf->write2DBarcode('www.swapp.co.in', 'QRCODE,H', 140, 210, 25, 25, $style, 'N');
			//$pdf->Text(140, 205, 'Swapp Software Application');

            //$servicecontractor_ao1 = new servicecontractor($this->connection);
			//$servicecontractor_ao1 = $this->contractagriofficerdetail($this->connection);
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
            $pdf->multicell(35,10,'साक्षीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
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
                $contractguarantordetail1->fetch($val,1);
                $servicecontractor_guarantor1 = new servicecontractor($this->connection);
                $servicecontractor_guarantor1->fetch($contractguarantordetail1->servicecontractorid);
                
                $pdf->multicell(35,10,++$i.')साक्षीदार',0,'L',false,1,15,$liney,true,0,false,true,10);
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
    }
 */
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
}
?>